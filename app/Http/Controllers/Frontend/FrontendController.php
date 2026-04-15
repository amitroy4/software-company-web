<?php

namespace App\Http\Controllers\Frontend;

use App\Models\JobApplication;
use Carbon\Carbon;
use App\Models\Career;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\About;
use App\Models\Album;
use App\Models\Client;
use App\Models\Member;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Setting;
use App\Models\WhyNeed;
use App\Models\WhyWork;
use App\Models\Application;
use App\Models\MainCounter;
use App\Models\Testimonial;
use App\Models\BlogCategory;
use App\Models\CallToAction;
use App\Models\WhyWorkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\ServiceClient;
use App\Models\SliderCounter;
use App\Models\ContactMessage;
use App\Models\AlbumImageVideo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\LinesOfCode\Counter;

class FrontendController extends Controller
{
    private function queryContainsApproxKeyword(string $query, array $keywords, int $maxDistance = 1): bool
    {
        $tokens = preg_split('/[^a-z0-9]+/i', strtolower($query)) ?: [];
        $tokens = array_values(array_filter($tokens));

        foreach ($tokens as $token) {
            foreach ($keywords as $keyword) {
                $keyword = strtolower($keyword);

                if ($token === $keyword) {
                    return true;
                }

                if (abs(strlen($token) - strlen($keyword)) > $maxDistance) {
                    continue;
                }

                if (levenshtein($token, $keyword) <= $maxDistance) {
                    return true;
                }
            }
        }

        return false;
    }

    private function detectAssistantIntent(string $query): ?string
    {
        $q = strtolower($query);

        if (preg_match('/\b(hello|hi|hey|salam|assalam)\b/', $q)) {
            return 'greeting';
        }
        if (preg_match('/\b(contact|phone|email|address|location|call|hotline)\b/', $q)) {
            return 'contact';
        }

        if (
            preg_match('/\b(service|services|solution|solutions|offer|provide)\b/', $q) ||
            $this->queryContainsApproxKeyword($q, ['service', 'services', 'solution', 'solutions', 'offer', 'provide'], 2)
        ) {
            return 'services';
        }
        if (preg_match('/\b(team|member|management|developer|engineer|staff)\b/', $q)) {
            return 'members';
        }
        if (preg_match('/\b(blog|news|article|post)\b/', $q)) {
            return 'blogs';
        }
        if (preg_match('/\b(album|gallery|image|photo|picture)\b/', $q)) {
            return 'albums';
        }
        if (preg_match('/\b(product|products)\b/', $q)) {
            return 'products';
        }
        if (preg_match('/\b(career|job|vacancy|hiring|recruit)\b/', $q)) {
            return 'careers';
        }
        if (preg_match('/\b(about|company|profile|overview|history|who\s+are\s+you)\b/', $q)) {
            return 'about';
        }

        return null;
    }

    private function filterItemsByQuery(array $items, array $searchKeys, string $query, int $limit = 8): array
    {
        $query = strtolower(trim($query));
        if ($query === '') {
            return array_slice($items, 0, $limit);
        }

        $queryTokens = preg_split('/[^a-z0-9]+/i', $query) ?: [];
        $queryTokens = array_values(array_filter($queryTokens));

        $matched = array_values(array_filter($items, function ($item) use ($searchKeys, $query, $queryTokens) {
            $haystack = '';
            foreach ($searchKeys as $key) {
                $value = $item[$key] ?? '';
                if (is_scalar($value)) {
                    $haystack .= ' ' . strtolower((string) $value);
                }
            }

            if ($haystack === '') {
                return false;
            }

            if (str_contains($haystack, $query)) {
                return true;
            }

            foreach ($queryTokens as $token) {
                if (strlen($token) >= 3 && str_contains($haystack, $token)) {
                    return true;
                }
            }

            return false;
        }));

        if (empty($matched)) {
            return array_slice($items, 0, $limit);
        }

        return array_slice($matched, 0, $limit);
    }

    private function buildAssistantKnowledgeText(array $context): string
    {
        $sections = [];

        $company = $context['company'] ?? [];
        if (!empty($company)) {
            $companyLines = [];
            if (!empty($company['name'])) {
                $companyLines[] = 'Name: ' . $company['name'];
            }
            if (!empty($company['phone'])) {
                $companyLines[] = 'Phone: ' . $company['phone'];
            }
            if (!empty($company['email'])) {
                $companyLines[] = 'Email: ' . $company['email'];
            }
            if (!empty($company['address'])) {
                $companyLines[] = 'Address: ' . $company['address'];
            }
            if (!empty($companyLines)) {
                $sections[] = "Company\n- " . implode("\n- ", $companyLines);
            }
        }

        if (!empty($context['about'])) {
            $about = $context['about'][0];
            $sections[] = "About\n- " . trim(($about['title'] ?? 'About us') . ' :: ' . ($about['description'] ?? ''));
        }

        $listMap = [
            'services' => ['title' => 'Services', 'label' => 'name', 'extra' => 'details'],
            'service_profiles' => ['title' => 'Service details', 'label' => 'name', 'extra' => 'details'],
            'faqs' => ['title' => 'FAQs', 'label' => 'question', 'extra' => 'answer'],
            'blogs' => ['title' => 'Blogs and News', 'label' => 'title', 'extra' => 'description'],
            'members' => ['title' => 'Team members', 'label' => 'name', 'extra' => 'designation'],
            'albums' => ['title' => 'Gallery albums', 'label' => 'name', 'extra' => null],
            'products' => ['title' => 'Products', 'label' => 'name', 'extra' => null],
            'careers' => ['title' => 'Careers', 'label' => 'title', 'extra' => 'location'],
            'clients' => ['title' => 'Clients', 'label' => 'name', 'extra' => null],
            'testimonials' => ['title' => 'Testimonials', 'label' => 'client_name', 'extra' => 'review'],
            'why_work' => ['title' => 'Why work with us', 'label' => 'title', 'extra' => 'details'],
            'counters' => ['title' => 'Counters', 'label' => 'counter_title', 'extra' => 'data_count'],
        ];

        foreach ($listMap as $key => $config) {
            $items = $context[$key] ?? [];
            if (empty($items)) {
                continue;
            }

            $lines = [];
            foreach (array_slice($items, 0, 5) as $item) {
                $label = trim((string) ($item[$config['label']] ?? ''));
                if ($label === '') {
                    continue;
                }

                $line = '- ' . $label;
                if (!empty($config['extra'])) {
                    $extraValue = trim((string) ($item[$config['extra']] ?? ''));
                    if ($extraValue !== '') {
                        $line .= ' :: ' . $extraValue;
                    }
                }
                if (!empty($item['url'])) {
                    $line .= ' (' . $item['url'] . ')';
                }
                $lines[] = $line;
            }

            if (!empty($lines)) {
                $sections[] = $config['title'] . "\n" . implode("\n", $lines);
            }
        }

        if (!empty($context['contacts'])) {
            $contact = $context['contacts'][0];
            $contactLines = [];
            if (!empty($contact['phone'])) {
                $contactLines[] = 'Phone: ' . $contact['phone'];
            }
            if (!empty($contact['email'])) {
                $contactLines[] = 'Email: ' . $contact['email'];
            }
            if (!empty($contact['address'])) {
                $contactLines[] = 'Address: ' . $contact['address'];
            }
            if (!empty($contact['url'])) {
                $contactLines[] = 'Contact page: ' . $contact['url'];
            }
            if (!empty($contactLines)) {
                $sections[] = 'Contact\n- ' . implode("\n- ", $contactLines);
            }
        }

        return implode("\n\n", $sections);
    }

    private function assistantAnswerLooksUncertain(?string $answer): bool
    {
        if (!is_string($answer)) {
            return true;
        }

        $normalized = strtolower(trim($answer));
        if ($normalized === '') {
            return true;
        }

        $uncertainPatterns = [
            '/\b(i\s+do\s+not\s+know|i\s+don\'t\s+know|not\s+enough\s+information|need\s+more\s+information|cannot\s+answer|can\'t\s+answer|uncertain|not\s+sure)\b/',
            '/\b(please\s+provide\s+more\s+details|ask\s+more\s+specific|i\s+could\s+not\s+find\s+an\s+exact\s+match)\b/',
        ];

        foreach ($uncertainPatterns as $pattern) {
            if (preg_match($pattern, $normalized)) {
                return true;
            }
        }

        return false;
    }

    private function buildLiveSearchFallbackAnswer(string $query, array $results): string
    {
        $lines = [];
        $lines[] = "I could not answer directly, so I searched the website for: \"{$query}\".";

        $groupTitles = [
            'services' => 'Services',
            'products' => 'Products',
            'careers' => 'Careers',
            'faqs' => 'FAQs',
            'members' => 'Team',
            'blogs' => 'News & Blogs',
            'albums' => 'Gallery albums',
            'clients' => 'Clients / Partners',
            'sections' => 'Website sections',
        ];

        foreach ($groupTitles as $groupKey => $title) {
            $items = $results[$groupKey] ?? [];
            if (empty($items)) {
                continue;
            }

            $groupLines = collect($items)->take(5)->map(function ($item) {
                $line = '- ' . ($item['title'] ?? 'Item');
                if (!empty($item['subtitle'])) {
                    $line .= ' :: ' . $item['subtitle'];
                }
                if (!empty($item['url'])) {
                    $line .= ' (' . $item['url'] . ')';
                }
                return $line;
            })->implode("\n");

            if ($groupLines !== '') {
                $lines[] = $title . ":\n{$groupLines}";
            }
        }

        if (count($lines) === 1) {
            return $this->buildFallbackAssistantAnswer($query, [
                'company' => ['name' => optional(Setting::first())->company_name ?? 'our company'],
            ]);
        }

        return implode("\n\n", $lines);
    }

    private function getAssistantKnowledgeBase(): array
    {
        return Cache::remember('assistant_full_site_knowledge_v1', 900, function () {
            $setting = Setting::first();

            $services = Service::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->with([
                    'whyNeeds' => function ($query) {
                        $query->where(function ($innerQuery) {
                            $innerQuery->where('status', true)->orWhere('status', 1);
                        })->latest();
                    },
                    'offeredService' => function ($query) {
                        $query->where(function ($innerQuery) {
                            $innerQuery->where('status', true)->orWhere('status', 1);
                        })->latest();
                    },
                    'developmentProcess' => function ($query) {
                        $query->where(function ($innerQuery) {
                            $innerQuery->where('status', true)->orWhere('status', 1);
                        })->latest();
                    },
                    'technologies' => function ($query) {
                        $query->where(function ($innerQuery) {
                            $innerQuery->where('status', true)->orWhere('status', 1);
                        })->latest();
                    },
                    'faqs' => function ($query) {
                        $query->where(function ($innerQuery) {
                            $innerQuery->where('status', true)->orWhere('status', 1);
                        })->latest();
                    },
                ])
                ->orderBy('service_name')
                ->get(['service_name', 'slug', 'service_details'])
                ->map(function ($service) {
                    $whyNeeds = collect($service->whyNeeds ?? [])->map(function ($item) {
                        return [
                            'title' => $item->keypoint_title,
                            'details' => mb_substr(trim(strip_tags((string) $item->keypoint_details)), 0, 200),
                        ];
                    })->values()->all();

                    $offeredServices = collect($service->offeredService ?? [])->map(function ($item) {
                        return [
                            'title' => $item->offered_service,
                        ];
                    })->values()->all();

                    $processes = collect($service->developmentProcess ?? [])->map(function ($item) {
                        return [
                            'title' => $item->process_title,
                            'details' => mb_substr(trim(strip_tags((string) $item->process_details)), 0, 200),
                        ];
                    })->values()->all();

                    $technologies = collect($service->technologies ?? [])->map(function ($item) {
                        return [
                            'title' => $item->technology_name,
                        ];
                    })->values()->all();

                    $faqs = collect($service->faqs ?? [])->map(function ($item) {
                        return [
                            'question' => $item->question,
                            'answer' => mb_substr(trim(strip_tags((string) $item->answer)), 0, 180),
                        ];
                    })->values()->all();

                    return [
                        'name' => $service->service_name,
                        'details' => mb_substr(trim(strip_tags((string) $service->service_details)), 0, 260),
                        'url' => !empty($service->slug) ? route('service.details', $service->slug) : route('service'),
                        'why_needs' => $whyNeeds,
                        'offered_services' => $offeredServices,
                        'processes' => $processes,
                        'technologies' => $technologies,
                        'faqs' => $faqs,
                    ];
                })
                ->values()
                ->all();

            $faqs = Faq::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->latest()
                ->get(['question', 'answer'])
                ->map(function ($faq) {
                    return [
                        'question' => $faq->question,
                        'answer' => mb_substr(trim(strip_tags((string) $faq->answer)), 0, 280),
                    ];
                })
                ->values()
                ->all();

            $blogs = Blog::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->latest()
                ->get(['title', 'slug', 'description', 'tags'])
                ->map(function ($blog) {
                    return [
                        'title' => $blog->title,
                        'description' => mb_substr(trim(strip_tags((string) $blog->description)), 0, 260),
                        'tags' => (string) $blog->tags,
                        'url' => !empty($blog->slug) ? route('blog.details', $blog->slug) : route('all.blogs'),
                    ];
                })
                ->values()
                ->all();

            $members = Member::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->orderBy('name')
                ->get(['name', 'designation', 'department'])
                ->map(function ($member) {
                    return [
                        'name' => $member->name,
                        'designation' => $member->designation,
                        'department' => $member->department,
                        'url' => route('powerhouse.team'),
                    ];
                })
                ->values()
                ->all();

            $albums = Album::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->latest()
                ->get(['id', 'name'])
                ->map(function ($album) {
                    return [
                        'name' => $album->name,
                        'url' => !empty($album->id) ? route('gallery.all', $album->id) : route('gallery.page'),
                    ];
                })
                ->values()
                ->all();

            $products = Product::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->latest()
                ->get(['name', 'link'])
                ->map(function ($product) {
                    return [
                        'name' => $product->name,
                        'url' => $product->link ?: route('products.page'),
                    ];
                })
                ->values()
                ->all();

            $careers = Career::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->latest()
                ->get(['title', 'location', 'deadline', 'description'])
                ->map(function ($career) {
                    return [
                        'title' => $career->title,
                        'location' => $career->location,
                        'deadline' => $career->deadline,
                        'description' => mb_substr(trim(strip_tags((string) $career->description)), 0, 220),
                        'url' => route('career.page'),
                    ];
                })
                ->values()
                ->all();

            $about = About::query()
                ->latest()
                ->take(1)
                ->get(['title', 'description'])
                ->map(function ($item) {
                    return [
                        'title' => $item->title,
                        'description' => mb_substr(trim(strip_tags((string) $item->description)), 0, 420),
                        'url' => route('about-us.page'),
                    ];
                })
                ->values()
                ->all();

            $contacts = Contact::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->latest()
                ->take(1)
                ->get(['contact_no', 'email', 'address'])
                ->map(function ($contact) {
                    return [
                        'phone' => $contact->contact_no,
                        'email' => $contact->email,
                        'address' => $contact->address,
                        'url' => route('contact-us.page'),
                    ];
                })
                ->values()
                ->all();

            $clients = Client::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->orderBy('name')
                ->get(['name', 'url', 'show_url'])
                ->map(function ($client) {
                    return [
                        'name' => $client->name,
                        'url' => !empty($client->url) && !empty($client->show_url) ? $client->url : route('home.page'),
                    ];
                })
                ->values()
                ->all();

            $testimonials = Testimonial::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->latest()
                ->get(['client_name', 'designation', 'organization', 'review'])
                ->map(function ($testimonial) {
                    return [
                        'client_name' => $testimonial->client_name,
                        'designation' => $testimonial->designation,
                        'organization' => $testimonial->organization,
                        'review' => mb_substr(trim(strip_tags((string) $testimonial->review)), 0, 240),
                    ];
                })
                ->values()
                ->all();

            $whyWork = WhyWork::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->latest()
                ->get(['title', 'details'])
                ->map(function ($item) {
                    return [
                        'title' => $item->title,
                        'details' => mb_substr(trim(strip_tags((string) $item->details)), 0, 240),
                    ];
                })
                ->values()
                ->all();

            $counters = MainCounter::query()
                ->where(function ($query) {
                    $query->where('status', true)
                        ->orWhere('status', 1);
                })
                ->latest()
                ->get(['counter_title', 'data_count', 'counter_symbol'])
                ->map(function ($counter) {
                    return [
                        'counter_title' => $counter->counter_title,
                        'data_count' => $counter->data_count,
                        'counter_symbol' => $counter->counter_symbol,
                    ];
                })
                ->values()
                ->all();

            return [
                'company' => [
                    'name' => optional($setting)->company_name ?? 'Our company',
                    'phone' => optional($setting)->contact_number ?? null,
                    'whatsapp' => optional($setting)->whatsapp_number ?? null,
                    'email' => optional($setting)->email ?? null,
                    'address' => optional($setting)->address ?? null,
                    'website' => optional($setting)->website ?? null,
                ],
                'about' => $about,
                'services' => $services,
                'faqs' => $faqs,
                'blogs' => $blogs,
                'members' => $members,
                'albums' => $albums,
                'products' => $products,
                'careers' => $careers,
                'contacts' => $contacts,
                'clients' => $clients,
                'testimonials' => $testimonials,
                'why_work' => $whyWork,
                'counters' => $counters,
            ];
        });
    }

    private function buildIntentAssistantAnswer(?string $intent, array $context): ?string
    {
        if (!$intent) {
            return null;
        }

        $companyName = $context['company']['name'] ?? 'our company';

        if ($intent === 'greeting') {
            return "Hello! Welcome to {$companyName}. You can ask me about services, team members, blogs/news, image albums, products, careers, or contact information.";
        }

        if ($intent === 'contact') {
            $contact = $context['contacts'][0] ?? [];
            $phones = collect([
                $contact['phone'] ?? null,
                $context['company']['phone'] ?? null,
                $context['company']['whatsapp'] ?? null,
            ])->filter()->unique()->values();

            $emails = collect([
                $contact['email'] ?? null,
                $context['company']['email'] ?? null,
            ])->filter()->unique()->values();

            $addresses = collect([
                $contact['address'] ?? null,
                $context['company']['address'] ?? null,
            ])->filter()->unique()->values();

            $lines = ["Here is how you can contact {$companyName}:"];
            if ($phones->isNotEmpty()) {
                $lines[] = '- Phone: ' . $phones->implode(', ');
            }
            if ($emails->isNotEmpty()) {
                $lines[] = '- Email: ' . $emails->implode(', ');
            }
            if ($addresses->isNotEmpty()) {
                $lines[] = '- Address: ' . $addresses->implode(', ');
            }
            $lines[] = '- Contact page: ' . route('contact-us.page');
            return implode("\n", $lines);
        }

        if ($intent === 'about') {
            $about = $context['about'][0] ?? null;
            if (!$about) {
                return "You can learn more about {$companyName} here: " . route('about-us.page');
            }

            $description = trim((string) ($about['description'] ?? ''));
            $title = trim((string) ($about['title'] ?? 'About us'));

            return $title . "\n" . ($description !== '' ? $description . "\n" : '') . 'Read more: ' . ($about['url'] ?? route('about-us.page'));
        }

        $map = [
            'services' => ['key' => 'services', 'title' => 'Here are our key services:', 'name' => 'name'],
            'members' => ['key' => 'members', 'title' => 'Here are some team members:', 'name' => 'name'],
            'blogs' => ['key' => 'blogs', 'title' => 'Here are recent blogs/news:', 'name' => 'title'],
            'albums' => ['key' => 'albums', 'title' => 'Here are image albums:', 'name' => 'name'],
            'products' => ['key' => 'products', 'title' => 'Here are available products:', 'name' => 'name'],
            'careers' => ['key' => 'careers', 'title' => 'Here are current career opportunities:', 'name' => 'title'],
        ];

        if (!isset($map[$intent])) {
            return null;
        }

        $config = $map[$intent];
        $items = $context[$config['key']] ?? [];
        if (empty($items)) {
            return null;
        }

        $lines = [$config['title']];
        foreach (array_slice($items, 0, 5) as $item) {
            $label = $item[$config['name']] ?? 'Item';
            $lines[] = '- ' . $label . (!empty($item['url']) ? ' (' . $item['url'] . ')' : '');
        }

        return implode("\n", $lines);
    }

    private function buildAssistantContext(string $query): array
    {
        $knowledge = $this->getAssistantKnowledgeBase();

        return [
            'company' => $knowledge['company'] ?? [],
            'about' => $this->filterItemsByQuery($knowledge['about'] ?? [], ['title', 'description'], $query, 1),
            'services' => $this->filterItemsByQuery($knowledge['services'] ?? [], ['name', 'details'], $query, 8),
            'faqs' => $this->filterItemsByQuery($knowledge['faqs'] ?? [], ['question', 'answer'], $query, 6),
            'blogs' => $this->filterItemsByQuery($knowledge['blogs'] ?? [], ['title', 'description', 'tags'], $query, 8),
            'members' => $this->filterItemsByQuery($knowledge['members'] ?? [], ['name', 'designation', 'department'], $query, 8),
            'albums' => $this->filterItemsByQuery($knowledge['albums'] ?? [], ['name'], $query, 8),
            'products' => $this->filterItemsByQuery($knowledge['products'] ?? [], ['name', 'url'], $query, 8),
            'careers' => $this->filterItemsByQuery($knowledge['careers'] ?? [], ['title', 'location', 'description'], $query, 8),
            'contacts' => $knowledge['contacts'] ?? [],
        ];
    }

    private function buildFallbackAssistantAnswer(string $query, array $context): string
    {
        $lines = [];
        $lines[] = "I searched the website knowledge base for: \"{$query}\".";

        if (!empty($context['services'])) {
            $serviceLines = collect($context['services'])->map(function ($item) {
                $line = '- ' . $item['name'];
                if (!empty($item['details'])) {
                    $line .= ' :: ' . $item['details'];
                }
                if (!empty($item['url'])) {
                    $line .= ' (' . $item['url'] . ')';
                }
                return $line;
            })->implode("\n");
            $lines[] = "Relevant services:\n{$serviceLines}";
        }

        if (!empty($context['service_profiles'])) {
            $profileLines = collect($context['service_profiles'])->map(function ($item) {
                $parts = ['- ' . $item['name']];
                if (!empty($item['details'])) {
                    $parts[] = $item['details'];
                }
                if (!empty($item['why_needs'])) {
                    $parts[] = 'Needs: ' . collect($item['why_needs'])->pluck('title')->implode(', ');
                }
                if (!empty($item['offered_services'])) {
                    $parts[] = 'Offered: ' . collect($item['offered_services'])->pluck('title')->implode(', ');
                }
                if (!empty($item['processes'])) {
                    $parts[] = 'Process: ' . collect($item['processes'])->pluck('title')->implode(', ');
                }
                if (!empty($item['technologies'])) {
                    $parts[] = 'Tech: ' . collect($item['technologies'])->pluck('title')->implode(', ');
                }
                if (!empty($item['url'])) {
                    $parts[] = $item['url'];
                }
                return implode(' | ', $parts);
            })->implode("\n");
            $lines[] = "Service details:\n{$profileLines}";
        }

        if (!empty($context['blogs'])) {
            $blogLines = collect($context['blogs'])->map(function ($item) {
                return '- ' . $item['title'] . ' (' . $item['url'] . ')';
            })->implode("\n");
            $lines[] = "Related news/blog posts:\n{$blogLines}";
        }

        if (!empty($context['albums'])) {
            $albumLines = collect($context['albums'])->map(function ($item) {
                return '- ' . $item['name'] . ' (' . $item['url'] . ')';
            })->implode("\n");
            $lines[] = "Matching image albums:\n{$albumLines}";
        }

        if (!empty($context['products'])) {
            $productLines = collect($context['products'])->map(function ($item) {
                return '- ' . $item['name'] . ' (' . $item['url'] . ')';
            })->implode("\n");
            $lines[] = "Matching products:\n{$productLines}";
        }

        if (!empty($context['careers'])) {
            $careerLines = collect($context['careers'])->map(function ($item) {
                $meta = trim(($item['location'] ?? '') . ($item['deadline'] ? ' | Deadline: ' . $item['deadline'] : ''));
                return '- ' . $item['title'] . ($meta ? ' (' . $meta . ')' : '') . ' (' . $item['url'] . ')';
            })->implode("\n");
            $lines[] = "Relevant career opportunities:\n{$careerLines}";
        }

        if (!empty($context['members'])) {
            $memberLines = collect($context['members'])->map(function ($item) {
                $role = trim(($item['designation'] ?? '') . ' ' . ($item['department'] ?? ''));
                return '- ' . $item['name'] . ($role ? ' (' . $role . ')' : '') . ' (' . $item['url'] . ')';
            })->implode("\n");
            $lines[] = "Team members related to your query:\n{$memberLines}";
        }

        if (!empty($context['faqs'])) {
            $faq = $context['faqs'][0];
            $lines[] = "FAQ insight: {$faq['question']}\n{$faq['answer']}";
        }

        if (!empty($context['about'])) {
            $about = $context['about'][0];
            $aboutTitle = $about['title'] ?? 'About us';
            $aboutDescription = $about['description'] ?? '';
            $aboutUrl = $about['url'] ?? route('about-us.page');
            $lines[] = "Company overview: {$aboutTitle}\n{$aboutDescription}\nRead more: {$aboutUrl}";
        }

        if (!empty($context['contacts'])) {
            $contact = $context['contacts'][0];
            $contactSummary = [];
            if (!empty($contact['phone'])) {
                $contactSummary[] = 'Phone: ' . $contact['phone'];
            }
            if (!empty($context['company']['whatsapp'])) {
                $contactSummary[] = 'WhatsApp: ' . $context['company']['whatsapp'];
            }
            if (!empty($contact['email'])) {
                $contactSummary[] = 'Email: ' . $contact['email'];
            }
            if (!empty($contact['address'])) {
                $contactSummary[] = 'Address: ' . $contact['address'];
            }
            if (!empty($contactSummary)) {
                $lines[] = "Contact info:\n- " . implode("\n- ", $contactSummary) . "\n- Link: " . $contact['url'];
            }
        }

        if (!empty($context['clients'])) {
            $clientLines = collect($context['clients'])->map(function ($item) {
                return '- ' . $item['name'];
            })->implode("\n");
            $lines[] = "Clients/partners:\n{$clientLines}";
        }

        if (!empty($context['testimonials'])) {
            $testimonialLines = collect($context['testimonials'])->map(function ($item) {
                $review = $item['review'] ?? '';
                $author = trim(($item['client_name'] ?? '') . ' ' . ($item['designation'] ?? '') . ' ' . ($item['organization'] ?? ''));
                return '- ' . ($author !== '' ? $author : 'Client') . ($review !== '' ? ': ' . $review : '');
            })->implode("\n");
            $lines[] = "Testimonials:\n{$testimonialLines}";
        }

        if (!empty($context['why_work'])) {
            $whyWorkLines = collect($context['why_work'])->map(function ($item) {
                return '- ' . $item['title'] . (!empty($item['details']) ? ': ' . $item['details'] : '');
            })->implode("\n");
            $lines[] = "Why work with us:\n{$whyWorkLines}";
        }

        if (!empty($context['counters'])) {
            $counterLines = collect($context['counters'])->map(function ($item) {
                return '- ' . $item['counter_title'] . ': ' . $item['data_count'] . (!empty($item['counter_symbol']) ? ' ' . $item['counter_symbol'] : '');
            })->implode("\n");
            $lines[] = "Company counters:\n{$counterLines}";
        }

        if (count($lines) === 1) {
            $companyName = $context['company']['name'] ?? 'our company';
            $contactPhone = $context['company']['phone'] ?? null;
            $contactEmail = $context['company']['email'] ?? null;

            $lines[] = "I could not find an exact match in {$companyName} website data. Please ask a more specific question about services, team members, blogs/news, albums, contact, or career.";

            if ($contactPhone || $contactEmail) {
                $lines[] = "You can also contact us directly" .
                    ($contactPhone ? " by phone: {$contactPhone}" : '') .
                    ($contactEmail ? ($contactPhone ? ' or' : ' by') . " email: {$contactEmail}" : '') .
                    '.';
            }
        }

        return implode("\n\n", $lines);
    }

    public function askAssistant(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|min:2|max:1000',
            'history' => 'nullable|array|max:10',
            'history.*.role' => 'required_with:history|string|in:user,assistant',
            'history.*.content' => 'required_with:history|string|max:20000',
        ]);

        $query = trim($validated['message']);
        $intent = $this->detectAssistantIntent($query);

        if ($intent === 'greeting') {
            $companyName = Setting::value('company_name') ?: 'our company';
            return response()->json([
                'answer' => "Hello! Welcome to {$companyName}. You can ask me about services, team members, blogs/news, image albums, products, careers, or contact information.",
                'source' => 'website-intent',
            ]);
        }

        if ($intent === 'services') {
            $serviceNames = Service::query()
                ->where('status', true)
                ->orWhere('status', 1)
                ->orderBy('service_name')
                ->pluck('service_name')
                ->filter()
                ->values()
                ->all();

            if (!empty($serviceNames)) {
                $lines = ["Here is our service list:"];
                foreach ($serviceNames as $index => $name) {
                    $lines[] = ($index + 1) . '. ' . $name;
                }
                $lines[] = '';
                $lines[] = 'Service page: ' . route('service');

                return response()->json([
                    'answer' => implode("\n", $lines),
                    'source' => 'website-intent',
                ]);
            }

            try {
                $context = $this->buildAssistantContext($query);
                $intentAnswer = $this->buildIntentAssistantAnswer($intent, $context);
                if ($intentAnswer) {
                    return response()->json([
                        'answer' => $intentAnswer,
                        'source' => 'website-intent',
                    ]);
                }
            } catch (\Throwable $exception) {
                // Fall through to safe message below.
            }

            return response()->json([
                'answer' => 'You can explore all our services here: ' . route('service'),
                'source' => 'website-intent',
            ]);
        }

        try {
            $context = $this->buildAssistantContext($query);
        } catch (\Throwable $exception) {
            return response()->json([
                'answer' => 'Here are our key services: ' . route('service') . '. You can also ask about team, blogs, gallery, products, careers, or contact info.',
                'source' => 'website-fallback',
            ]);
        }

        $history = collect($validated['history'] ?? [])
            ->take(-6)
            ->map(function ($item) {
                return [
                    'role' => $item['role'] === 'assistant' ? 'assistant' : 'user',
                    'content' => mb_substr(trim($item['content']), 0, 1200),
                ];
            })
            ->filter(function ($item) {
                return $item['content'] !== '';
            })
            ->values()
            ->all();

        $apiKey = config('services.openai.key');
        $model = config('services.openai.model', 'gpt-4o-mini');
        $knowledgeText = $this->buildAssistantKnowledgeText($context);

        if (!empty($apiKey)) {
            try {
                $messages = [
                    [
                        'role' => 'system',
                        'content' => 'You are a website customer support assistant. Answer from provided website context and recent conversation only. Be accurate, practical, and concise. If uncertain, say you do not have enough website data and provide the best relevant page link from context.',
                    ],
                ];

                foreach ($history as $item) {
                    $messages[] = [
                        'role' => $item['role'],
                        'content' => $item['content'],
                    ];
                }

                $messages[] = [
                    'role' => 'user',
                    'content' => "Question: {$query}\n\nWebsite knowledge:\n{$knowledgeText}\n\nAnswer using only the website knowledge above. If the user asks about a service, give the service name and the closest service details. If the exact answer is not present, give the closest helpful website-based answer and include a useful page link.",
                ];

                $response = Http::withToken($apiKey)
                    ->timeout(30)
                    ->post('https://api.openai.com/v1/chat/completions', [
                        'model' => $model,
                        'temperature' => 0.15,
                        'messages' => $messages,
                    ]);

                if ($response->successful()) {
                    $answer = data_get($response->json(), 'choices.0.message.content');
                    if (is_string($answer) && trim($answer) !== '') {
                        if ($this->assistantAnswerLooksUncertain($answer)) {
                            $searchResults = $this->getGlobalSearchResults($query, 5);
                            $fallbackAnswer = $this->buildLiveSearchFallbackAnswer($query, $searchResults);

                            return response()->json([
                                'answer' => $fallbackAnswer,
                                'source' => 'site-search-fallback',
                            ]);
                        }

                        return response()->json([
                            'answer' => trim($answer),
                            'source' => 'ai',
                        ]);
                    }
                }
            } catch (\Throwable $exception) {
                // Fall through to intent + website fallback answers.
            }
        }

        $searchResults = $this->getGlobalSearchResults($query, 5);
        if (!empty($searchResults['services']) || !empty($searchResults['members']) || !empty($searchResults['blogs']) || !empty($searchResults['albums']) || !empty($searchResults['sections'])) {
            return response()->json([
                'answer' => $this->buildLiveSearchFallbackAnswer($query, $searchResults),
                'source' => 'site-search-fallback',
            ]);
        }

        $intentAnswer = $this->buildIntentAssistantAnswer($intent, $context);
        if ($intentAnswer) {
            return response()->json([
                'answer' => $intentAnswer,
                'source' => 'website-intent',
            ]);
        }

        return response()->json([
            'answer' => $this->buildFallbackAssistantAnswer($query, $context),
            'source' => 'website',
        ]);
    }

    private function handleFileUpload($file, $path)
    {
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs('uploads/' . $path, $fileName, 'public');
    }

    private function handleFileDelete($filePath)
    {
        if ($filePath && Storage::exists('public/' . $filePath)) {
            Storage::delete('public/' . $filePath);
        }
    }

    private function getGlobalSearchResults(string $query, int $limit = 8): array
    {
        $safeQuery = trim($query);

        $services = Service::where('status', true)
            ->where(function ($search) use ($query) {
                $search->where('service_name', 'like', "%{$query}%")
                    ->orWhere('service_details', 'like', "%{$query}%");
            })
            ->latest()
            ->take($limit)
            ->get()
            ->map(function ($service) {
                return [
                    'title' => $service->service_name,
                    'subtitle' => trim('Service' . (!empty($service->service_details) ? ' :: ' . mb_substr(trim(strip_tags((string) $service->service_details)), 0, 80) : '')),
                    'url' => route('service.details', $service->slug),
                ];
            })
            ->values()
            ->all();

        $members = Member::where('status', true)
            ->where(function ($search) use ($query) {
                $search->where('name', 'like', "%{$query}%")
                    ->orWhere('designation', 'like', "%{$query}%")
                    ->orWhere('department', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->take($limit)
            ->get()
            ->map(function ($member) {
                return [
                    'title' => $member->name,
                    'subtitle' => trim(($member->designation ?? 'Team Member') . ' - ' . ($member->department ?? 'Team'), ' -'),
                    'url' => route('powerhouse.team'),
                ];
            })
            ->values()
            ->all();

        $blogs = Blog::where('status', true)
            ->where(function ($search) use ($query) {
                $search->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('tags', 'like', "%{$query}%");
            })
            ->latest()
            ->take($limit)
            ->get()
            ->map(function ($blog) {
                return [
                    'title' => $blog->title,
                    'subtitle' => 'News & Blog',
                    'url' => !empty($blog->slug) ? route('blog.details', $blog->slug) : route('all.blogs'),
                ];
            })
            ->values()
            ->all();

        $albums = Album::where('status', 1)
            ->where('name', 'like', "%{$query}%")
            ->latest()
            ->take($limit)
            ->get()
            ->map(function ($album) {
                return [
                    'title' => $album->name,
                    'subtitle' => 'Image Album',
                    'url' => !empty($album->id) ? route('gallery.all', $album->id) : route('gallery.page'),
                ];
            })
            ->values()
            ->all();

        $products = Product::where('status', true)
            ->where(function ($search) use ($query) {
                $search->where('name', 'like', "%{$query}%")
                    ->orWhere('link', 'like', "%{$query}%");
            })
            ->latest()
            ->take($limit)
            ->get()
            ->map(function ($product) {
                return [
                    'title' => $product->name,
                    'subtitle' => 'Product',
                    'url' => $product->link ?: route('products.page'),
                ];
            })
            ->values()
            ->all();

        $careers = Career::where('status', true)
            ->where(function ($search) use ($query) {
                $search->where('title', 'like', "%{$query}%")
                    ->orWhere('location', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->latest()
            ->take($limit)
            ->get()
            ->map(function ($career) {
                return [
                    'title' => $career->title,
                    'subtitle' => trim('Career' . (!empty($career->location) ? ' :: ' . $career->location : '')),
                    'url' => route('career.page'),
                ];
            })
            ->values()
            ->all();

        $faqs = Faq::where('status', true)
            ->where(function ($search) use ($query) {
                $search->where('question', 'like', "%{$query}%")
                    ->orWhere('answer', 'like', "%{$query}%");
            })
            ->latest()
            ->take($limit)
            ->get()
            ->map(function ($faq) {
                return [
                    'title' => $faq->question,
                    'subtitle' => 'FAQ',
                    'url' => route('contact-us.page'),
                ];
            })
            ->values()
            ->all();

        $clients = Client::where('status', true)
            ->where(function ($search) use ($query) {
                $search->where('name', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->take($limit)
            ->get()
            ->map(function ($client) {
                return [
                    'title' => $client->name,
                    'subtitle' => 'Client / Partner',
                    'url' => route('home.page') . '#clients_list',
                ];
            })
            ->values()
            ->all();

        $sections = collect([
            ['title' => 'Home', 'subtitle' => 'Section', 'url' => route('home.page'), 'keywords' => 'home start main'],
            ['title' => 'About Us', 'subtitle' => 'Section', 'url' => route('about-us.page'), 'keywords' => 'about company profile'],
            ['title' => 'Services', 'subtitle' => 'Section', 'url' => route('service'), 'keywords' => 'service solution'],
            ['title' => 'Products', 'subtitle' => 'Section', 'url' => route('products.page'), 'keywords' => 'product'],
            ['title' => 'News & Blogs', 'subtitle' => 'Section', 'url' => route('all.blogs'), 'keywords' => 'news blog article'],
            ['title' => 'Powerhouse Team', 'subtitle' => 'Section', 'url' => route('powerhouse.team'), 'keywords' => 'team member management'],
            ['title' => 'Gallery', 'subtitle' => 'Section', 'url' => route('gallery.page'), 'keywords' => 'gallery album image photo'],
            ['title' => 'Career', 'subtitle' => 'Section', 'url' => route('career.page'), 'keywords' => 'job career vacancy'],
            ['title' => 'Contact Us', 'subtitle' => 'Section', 'url' => route('contact-us.page'), 'keywords' => 'contact phone email'],
        ])->filter(function ($section) use ($query) {
            return str_contains(strtolower($section['title'] . ' ' . $section['keywords']), strtolower($query));
        })->take($limit)->map(function ($section) {
            return [
                'title' => $section['title'],
                'subtitle' => $section['subtitle'],
                'url' => $section['url'],
            ];
        })->values()->all();

        return [
            'services' => $services,
            'members' => $members,
            'blogs' => $blogs,
            'albums' => $albums,
            'products' => $products,
            'careers' => $careers,
            'faqs' => $faqs,
            'clients' => $clients,
            'sections' => $sections,
        ];
    }

    public function globalSearchSuggestions(Request $request)
    {
        $query = trim((string) $request->query('query', ''));

        if (mb_strlen($query) < 2) {
            return response()->json([]);
        }

        $groups = $this->getGlobalSearchResults($query, 5);

        $results = collect($groups)
            ->flatMap(function ($items, $groupName) {
                return collect($items)->map(function ($item) use ($groupName) {
                    $item['group'] = ucfirst($groupName);
                    return $item;
                });
            })
            ->take(20)
            ->values();

        return response()->json($results);
    }

    public function globalSearchPage(Request $request)
    {
        $query = trim((string) $request->query('query', ''));

        $results = [
            'services' => [],
            'members' => [],
            'blogs' => [],
            'albums' => [],
            'sections' => [],
        ];

        if (mb_strlen($query) >= 2) {
            $results = $this->getGlobalSearchResults($query, 20);
        }

        return view('frontend.search-results', [
            'query' => $query,
            'results' => $results,
        ]);
    }

    public function index()
    {
        $homePageData = Cache::remember('frontend.home.index', now()->addMinutes(10), function () {
            $sliders = Slider::where('status', true)->get();
            $sliderCounter = SliderCounter::where('status', true)->first();
            $about = About::where('status', true)->first();
            $action = CallToAction::where('status', true)->first();
            $applications = Application::where('status', true)
                ->latest()
                ->take(8)
                ->get();
            $counters = MainCounter::where('status', true)
                ->latest()
                ->take(4)
                ->get();
            $whyWorkImage = WhyWorkImage::where('status', true)->first();
            $whyWorks = WhyWork::where('status', true)->get();
            $chunks = $whyWorks->chunk(ceil($whyWorks->count() / 2));
            $firstHalf = $chunks->first();
            $secondHalf = $chunks->last();
            $testimonials = Testimonial::where('status', true)->get();
            $services = Service::where('status', true)->get();
            $clients = Client::where('status', true)->get();
            $blogs = Blog::with('blogCategory')
                ->where('status', true)
                ->latest()
                ->take(3)
                ->get();
            $faqs = Faq::where('status', true)->get();
            $contacts = Contact::where('status', true)
                ->latest()
                ->take(3)
                ->get();

            return [
                'sliders' => $sliders,
                'sliderCounter' => $sliderCounter,
                'about' => $about,
                'action' => $action,
                'applications' => $applications,
                'whyWorkImage' => $whyWorkImage,
                'whyWorks' => $whyWorks,
                'firstHalf' => $firstHalf,
                'secondHalf' => $secondHalf,
                'services' => $services,
                'counters' => $counters,
                'clients' => $clients,
                'testimonials' => $testimonials,
                'faqs' => $faqs,
                'blogs' => $blogs,
                'contacts' => $contacts,
            ];
        });

        return view('frontend.index', $homePageData);
    }
    public function aboutUs()
    {
        $about = About::where('status', true)->first();
        $clients = Client::where('status', true)->get();

        return view('frontend.about-us', [

            'about' => $about,
            'clients' => $clients,
        ]);
    }

    public function service()
    {
        $services = Service::where('status', true)->get();

        return view('frontend.services', [
            'services' => $services,
        ]);
    }


    public function serviceDetails($slug)
    {

        $service = Service::with([
            'whyNeeds',
            'offeredService',
            'faqs',
            'developmentProcess',
            'technologies',
            'clients' => function ($query) {
                $query->where('status', true);
            }
        ])->where('slug', $slug)->where('status', true)->firstOrFail();

        $clientCount = Client::where('status', true)->count();

        return view('frontend.service-details', [
            'service' => $service,
            'clientCount' => $clientCount,
        ]);
    }



    public function blogs()
    {
        return app(BlogController::class)->blogs();

    }
    public function blogDetails($slug)
    {
        return app(BlogController::class)->blogDetails($slug);

    }
    public function contactUs()
    {
        // $contacts = Contact::where('status', true)->get();
        $contact = Contact::where('status', true)->first();

        return view('frontend.contact', [

            'contact' => $contact,

        ]);
    }

    public function newsAndBlogs()
    {
        return app(BlogController::class)->newsAndBlogs();

    }
    public function blogTag(Request $request)
    {
        return app(BlogController::class)->blogTag($request);
    }
    public function blogCategory(Request $request)
    {
        return app(BlogController::class)->blogCategory($request);
    }
    public function searchBlogs(Request $request)
    {
        return app(BlogController::class)->searchBlogs($request);
    }



    public function sendContactMessage(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Insert into database
        $contact = ContactMessage::create([
            'service_id' => $validated['service_id'] ?? null,
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'status' => true,
        ]);

        return response()->json([
            'message' => 'Your message send successfully.',
            'data' => $contact
        ], 201);

    }


    public function powerhouseTeam(){

        $managements = Member::where('status', true)->where('department', 'Management')->orderBy('created_at', 'asc')->get();
        $members = Member::where('status', true)->where('department', '!=', 'Management')->orderBy('created_at', 'asc')->get();
        return view('frontend.team',compact('managements','members'));
    }

    public function gallery()
    {
        $albums = Album::where('status', 1)->orderBy('id', 'desc')->get();
        return view('frontend.gallery',compact('albums'));
    }

    public function images($number)
    {
        $media = AlbumImageVideo::query(); // start query builder without status

        if ($number) {
            $media->where('album_id', $number);
        } else {
            abort(404); // invalid type
        }

        $album = Album::where('id', $number)->first();

        $mediaItems = $media->orderBy('id', 'desc')->get();

        return view('frontend.gallery-all', compact('mediaItems', 'album'));
    }

    public function products(){
        $categories = ProductCategory::where('status', true)->get();
        $products = Product::where('status', true)->get();
        return view('frontend.products',compact('categories', 'products'));
    }

    public function career()
    {
        // dd(Carbon::today());
        $careers = Career::where('status', true)->where('deadline', '>=', Carbon::today())->get();
        return view('frontend.career',compact('careers'));
    }

    public function apply(Request $request)
    {
        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cover_letter' => 'nullable|string',
            'cv' => 'required|mimes:pdf,doc,docx|max:5120',
        ]);


        if ($request->hasFile('cv')) {
            $cvPath = $this->handleFileUpload($request->cv, 'cv_files');
        }


        JobApplication::create([
            'career_id' => $request->career_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cover_letter' => $request->cover_letter,
            'cv' => $cvPath,
        ]);

        return response()->json([
                'success' => 'Your application has been submitted successfully!'
                ]);
    }

}
