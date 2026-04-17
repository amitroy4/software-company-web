<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\CoverImage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $setting = Cache::remember('site:setting:first', now()->addMinutes(5), function () {
            return Setting::query()->first();
        });

        View::share('setting', $setting);

        View::composer(['layouts.frontend', 'frontend.*'], function ($view) {
            $allCoverImages = Cache::remember('site:cover-images:active', now()->addMinutes(5), function () {
                return CoverImage::query()->select('id', 'page_name', 'cover_image')->get();
            });

            $frontendservices = Cache::remember('site:frontend-services:active', now()->addMinutes(5), function () {
                return Service::query()
                    ->where('status', 1)
                    ->select('id', 'slug', 'service_name')
                    ->get();
            });

            $view->with('allCoverImages', $allCoverImages);
            $view->with('frontendservices', $frontendservices);
        });
    }
}
