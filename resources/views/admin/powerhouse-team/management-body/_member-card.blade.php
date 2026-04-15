<div class="row m-0 p-0">
    @foreach($members as $member)
    <div class="col-md-4 p-2" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
        <div class="rounded custom-border-danger-1 custom-bg-danger-100">
            <div class="card-body">
                <a class="align-items-center d-block" role="button" aria-expanded="true" aria-controls="member{{ $member->id }}">
                    <div class="w-100 d-flex align-items-center overflow-hidden w-100">
                        @if ($member->image)
                        <img src="{{ asset('storage/'.$member->image) }}" class="rounded border-0 avatar avatar-sm me-2" alt="img">
                        @else
                        <img src="{{ asset('frontend/assets/images/member-1.jpg') }}" class="rounded border-0 avatar avatar-sm me-2" alt="img">
                        @endif
                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="title-lg fs-18 fw-600 mb-2" data-bs-toggle="collapse" href="#member{{ $member->id }}">{{ $member->name }}</p>
                                <div class="form-button-action">
                                    <div class="form-check form-switch pt-0 pb-0">
                                        <input class="p-0 form-check-input status-toggle" type="checkbox" role="switch" data-id="{{ $member->id }}" {{ $member->status ? 'checked' : '' }}>
                                    </div>
                                    <a href="#" data-id="{{ $member->id }}" title="edit" class="action-btn-info me-2 edit-member"><i class="bx bxs-edit bx-tada"></i></a>
                                    <a href="#" id="delete-member-{{ $member->id }}" data-id="{{ $member->id }}" title="delete" class="action-btn-danger delete-member" data-original-title="Remove"><i class="bx bx-trash-alt"></i></a>
                                </div>
                            </div>
                            <div class="events-six-content-top pb-1 mb-1">
                                <h3 class="title-sm">{{ $member->designation??' ' }}</h3>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                @if ($member->member_code)
                                <h3 class="title-sm">Member ID: <i>{{ $member->member_code }}</i></h3>
                                @endif
                                @if ($member->joining_date)
                                <h3 class="title-sm">Joining date: <i>{{ \Carbon\Carbon::parse($member->joining_date)->format('d M, Y') }}</i></h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="collapse bg-white" id="member{{ $member->id }}">
                <div class="pt-2 pb-2 p-3">
                    @if ($member->department)
                    <div class="d-flex align-items-center justify-content-between pt-2 client-details-inner">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bx-category me-1"></i>
                            Department
                        </span>
                        <p class="w-60 link-xs text-dark">{{ $member->department }}</p>
                    </div>
                    @endif
                    @if ($member->designation)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bx-briefcase me-1"></i>
                            Designation
                        </span>
                        <p class="w-60 link-xs text-dark">{{ $member->designation }}</p>
                    </div>
                    @endif
                    @if ($member->dob)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bx-id-card me-1"></i>
                            Date Of Birth
                        </span>
                        <p class="w-60 link-xs text-dark">{{ \Carbon\Carbon::parse($member->dob)->format('d M, Y') }}</p>
                    </div>
                    @endif
                    @if ($member->gender)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bx-barcode me-1"></i>
                            Gender
                        </span>
                        <p class="w-60 link-xs text-dark">{{ ucfirst($member->gender) }}</p>
                    </div>
                    @endif
                    @if ($member->blood_group)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class='bx bxs-droplet me-1'></i>
                            Blood Group
                        </span>
                        <a href="tel:{{ $member->blood_group }}" class="w-60 link-xs text-dark">{{ $member->blood_group }}</a>
                    </div>
                    @endif
                    @if ($member->phone)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bx-phone me-1"></i>
                            Phone Number
                        </span>
                        <a href="tel:{{ $member->phone }}" class="w-60 link-xs text-dark">{{ $member->phone }}</a>
                    </div>
                    @endif
                    @if ($member->whatsapp)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bxl-whatsapp me-1"></i>
                            WhatsApp
                        </span>
                        <a href="https://wa.me/{{ $member->whatsapp }}" class="w-60 link-xs text-dark">{{ $member->whatsapp }}</a>
                    </div>
                    @endif
                    @if ($member->email)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bx-envelope me-1"></i>
                            Email
                        </span>
                        <a href="mailto:{{ $member->email }}" class="w-60 link-sm text-dark">{{ $member->email }}</a>
                    </div>
                    @endif
                    @if ($member->facebook)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bxl-facebook me-1"></i>
                            Facebook
                        </span>
                        <a href="{{ $member->facebook }}" target="_blank" class="w-60 link-xs text-dark">{{ $member->facebook }}</a>
                    </div>
                    @endif
                    @if ($member->linkedin)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bxl-linkedin me-1"></i>
                            LinkedIn
                        </span>
                        <a href="{{ $member->linkedin }}" target="_blank" class="w-60 link-xs text-dark">{{ $member->linkedin }}</a>
                    </div>
                    @endif
                    @if ($member->github)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bx-globe me-1"></i>
                            Github
                        </span>
                        <a href="{{ $member->github }}" target="_blank" class="w-60 link-xs text-dark">{{ $member->github }}</a>
                    </div>
                    @endif
                    @if ($member->address)
                    <div class="d-flex align-items-center justify-content-between pt-2">
                        <span class="link-sm d-inline-flex align-items-center">
                            <i class="bx bx-map me-1"></i>
                            Address
                        </span>
                        <p class="w-60 link-xs text-dark">{{ $member->address }}</p>
                    </div>
                    @endif
                    @if ($member->about)
                    <div class="cm-group client-details-inner pt-1 mt-3">
                        <h2 class="pb-1 fs-16 lh-1 sidebar-title text-start events-six-content-top">About Me</h2>
                        <p class="sub-title-lg fs-13 pt-2">{!! $member->about !!}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if ($members->hasPages())
<div class="col-md-12">
    <div class="d-flex justify-content-center">
        <ul class="pagination">

            {{-- Previous Page Link --}}
            @if ($members->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $members->previousPageUrl() }}" rel="prev">Previous</a></li>
            @endif

            {{-- Page Number Links --}}
            @php
                $start = max(1, $members->currentPage() - 2);
                $end = min($members->lastPage(), $members->currentPage() + 2);
            @endphp

            {{-- First Page --}}
            @if ($start > 1)
                <li class="page-item"><a class="page-link" href="{{ $members->url(1) }}">1</a></li>
                @if ($start > 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endif

            {{-- Pages Around Current --}}
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $members->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $members->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            {{-- Last Page --}}
            @if ($end < $members->lastPage())
                @if ($end < $members->lastPage() - 1)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                <li class="page-item"><a class="page-link" href="{{ $members->url($members->lastPage()) }}">{{ $members->lastPage() }}</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($members->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $members->nextPageUrl() }}" rel="next">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif

        </ul>
    </div>
</div>
@endif

