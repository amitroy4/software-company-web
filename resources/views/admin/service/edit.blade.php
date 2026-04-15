

@extends('layouts.admin')
@section('title', 'Service')
@section('content')
<style>
   /* Custom styling for dynamically added items */
   .dynamic-item {
   background-color: #f8f9fa;
   border: 1px solid #dee2e6;
   border-radius: 0.375rem;
   padding: 1rem;
   margin-bottom: 1rem;
   position: relative;
   }
   .dynamic-item .remove-item-btn {
   position: absolute;
   top: 10px;
   right: 10px;
   }
   .active{
    background: none !important;
   }
</style>
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header project-details-card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="project-details-card-header-title"><i class="bx bx-edit bx-tada"></i> Edit
                                    Service</h4>
                            </div>
                            <ul class="nav nav-pills justify-content-center bg-transparent border-bottom nav-style-2 mb-3"
                                role="tablist">
                                <li class="nav-item flex-sm-fill text-sm-center submenu" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#overView" role="tab"
                                        aria-selected="true">Service Overview</a>
                                </li>
                                <li class="nav-item flex-sm-fill text-sm-center submenu" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#why-need" role="tab"
                                        aria-selected="false">Key
                                        Benefits</a>
                                </li>
                                <li class="nav-item flex-sm-fill text-sm-center submenu" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#offered-service" role="tab"
                                        aria-selected="false">Offered Service</a>
                                </li>
                                <li class="nav-item flex-sm-fill text-sm-center submenu" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#provide-client" role="tab"
                                        aria-selected="false">Provided Clients</a>
                                </li>
                                <li class="nav-item flex-sm-fill text-sm-center submenu" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#development-process" role="tab"
                                        aria-selected="false">Development Process</a>
                                </li>
                                <li class="nav-item flex-sm-fill text-sm-center submenu" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Technology" role="tab"
                                        aria-selected="false">Technologies</a>
                                </li>
                                <li class="nav-item flex-sm-fill text-sm-center submenu" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Faq" role="tab"
                                        aria-selected="false">FAQ's</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="overView" role="tabpanel">
                                    <form id="overviewForm" action="{{ route('service.update', $service->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="service_name">Service Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control custom-input-s" id="service_name"
                                                        name="service_name"
                                                        value="{{ old('service_name', $service->service_name) }}" required>
                                                    @error('service_name') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label for="service_details">Service Details <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control custom-input-s summernote" id="service_details"
                                                        name="service_details" rows="8"
                                                        required>{{ old('service_details', strip_tags($service->service_details)) }}</textarea>
                                                    @error('service_details') <span
                                                    class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="edit_image" class="form-label">Image <span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" class="form-control custom-input-s" name="image"
                                                        accept="image/*">
                                                    @if($service->image)
                                                        <img class="img-thumbnail mt-2"
                                                            src="{{ asset('storage/' . $service->image) }}" alt="Old Image"
                                                            width="120">
                                                    @endif
                                                    @error('image') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                                <h4 class="mb-3">Service Keypoints (3 points)</h4>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Keypoint 1</label>
                                                            <input type="text" class="form-control custom-input-s"
                                                                name="service_keypoint_1"
                                                                value="{{ old('service_keypoint_1', $service->service_keypoint_1) }}">
                                                            @error('service_keypoint_1') <span
                                                            class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Keypoint 2</label>
                                                            <input type="text" class="form-control custom-input-s"
                                                                name="service_keypoint_2"
                                                                value="{{ old('service_keypoint_2', $service->service_keypoint_2) }}">
                                                            @error('service_keypoint_2') <span
                                                            class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Keypoint 3</label>
                                                            <input type="text" class="form-control custom-input-s"
                                                                name="service_keypoint_3"
                                                                value="{{ old('service_keypoint_3', $service->service_keypoint_3) }}">
                                                            @error('service_keypoint_3') <span
                                                            class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="why-need" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="m-0">Key Benefits</h5>
                                        <button type="button" class="btn btn-primary btn-sm" id="add-key-benefit-btn"><i
                                                class='bx bx-plus me-1'></i> Add Benefit</button>
                                    </div>
                                    <form id="whyNeedForm" data-service-id="{{ $service->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div id="key-benefits-container" class="row">
                                            @if(!empty($benefits))
                                                @foreach($benefits as $benefit)
                                                    <div class="col-md-6">
                                                        <div class="dynamic-item">
                                                            <button type="button" class="btn-close remove-item-btn" data-id="{{ $benefit->id }}"
                                                                aria-label="Close"></button>
                                                            <input type="hidden" name="benefit_ids[]" value="{{ $benefit->id }}">
                                                            <div class="form-group">
                                                                <label>Benefit Title</label>
                                                                <input type="text" class="form-control custom-input-s"
                                                                    name="benefit_title[]" value="{{ $benefit->keypoint_title?? '' }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Benefit Details</label>
                                                                <textarea class="form-control custom-input-s"
                                                                    name="benefit_details[]"
                                                                    rows="3">{{ $benefit->keypoint_details?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="offered-service" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="m-0">Offered Services</h5>
                                        <button type="button" class="btn btn-primary btn-sm" id="add-offered-service-btn"><i
                                                class='bx bx-plus me-1'></i> Add Service</button>
                                    </div>
                                    <form id="offeredServiceForm"
                                        action="{{ route('offered-services.update', $service->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div id="offered-services-container" class="row">
                                            <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                                            @if(!empty($offeredServices))
                                                @foreach($offeredServices as $item)
                                                    <div class="col-md-6">
                                                        <div class="dynamic-item">
                                                            <button type="button" class="btn-close remove-item-btn" data-id="{{ $item->id }}"
                                                                aria-label="Close"></button>
                                                            <input type="hidden" name="offered_service_id[]" value="{{ $item->id }}">
                                                            <div class="form-group">
                                                                <label>Service Name</label>
                                                                <input type="text" class="form-control custom-input-s"
                                                                    name="offered_service_name[]" value="{{ $item->offered_service?? '' }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Service Thumbnil Image</label>
                                                                <input type="file"
                                                                    class="form-control custom-input-s image-input-with-preview"
                                                                    name="offered_service_icon[]" accept="image/*">
                                                                @if(!empty($item->service_image))
                                                                    <img src="{{ asset('storage/' . $item->service_image) }}"
                                                                        class="img-thumbnail mt-2" width="80" alt="Preview">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="provide-client" data-service-id="{{ $service->id }}" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="m-0">Service Provided</h5>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#taskDetailsModal" title="View"><i class='bx bx-plus me-1'></i>
                                            Add Clients</button>
                                    </div>
                                    <div class="row row-cols-lg-6 row-cols-md-4 row-cols-sm-3 row-cols-2 gutter-y-30 m-auto justify-content-center">
                                        @if(!empty($clients))
                                                @foreach($clients as $client)
                                                    <div class="col wow fadeInUp animated mt-0 mb-4 animated" data-wow-delay="00ms"
                                                        style="visibility: visible; animation-delay: 0ms; animation-name: fadeInUp;">
                                                        <div class="custom-bg-primary-100 featurer-six__item">
                                                            <div class="featurer-six__item__hover"
                                                                style="background-image: url({{ asset('storage/' . $client->logo) }});">
                                                            </div>
                                                            <div class="cta-eleven__image">
                                                                <img src="{{ asset('storage/' . $client->logo) }}" alt="Atripz Logo" style="width: 100%; height: 100px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="development-process" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="m-0">Development Process Steps</h5>
                                        <button type="button" class="btn btn-primary btn-sm" id="add-dev-process-btn"><i
                                                class='bx bx-plus me-1'></i> Add Step</button>
                                    </div>
                                    <form id="developmentProcessForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div id="dev-process-container" class="row">

                                            @if(!empty($developemntProcess))
                                                @foreach($developemntProcess as $process)
                                                    <div class="col-md-6">
                                                        <div class="dynamic-item">
                                                            <button type="button" class="btn-close remove-item-btn" data-id="{{ $process->id }}" aria-label="Close"></button>
                                                            <input type="hidden" name="process_ids[]" value="{{ $process->id }}">
                                                            <div class="form-group">
                                                                <label>Process Title</label>
                                                                <input type="text" class="form-control custom-input-s" name="process_title[]" value="{{ $process->process_title?? '' }}"
                                                                    placeholder="e.g., Step 1: Planning">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Process Details</label>
                                                                <textarea class="form-control custom-input-s" name="process_details[]" rows="3"
                                                                    placeholder="Describe the process step">{{ $process->process_details?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </form>

                                </div>
                                <div class="tab-pane fade" id="Technology" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="m-0">Technologies We Use</h5>
                                        <button type="button" class="btn btn-primary btn-sm" id="add-technology-btn"><i
                                                class='bx bx-plus me-1'></i> Add Technology</button>
                                    </div>
                                    <form id="technologyForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                        <div id="technologies-container" class="row">
                                            @if(!empty($technologies))
                                                @foreach($technologies as $technology)
                                                    <div class="col-md-3">
                                                        <div class="dynamic-item">
                                                            <button type="button" class="btn-close remove-item-btn" data-id="{{ $technology->id }}" aria-label="Close"></button>
                                                            <input type="hidden" name="technology_id[]" value="{{ $technology->id ?? '' }}">
                                                            <div class="form-group">
                                                                <label>Technology Name</label>
                                                                <input type="text" class="form-control custom-input-s" name="technology_name[]" value="{{ $technology->technology_name?? '' }}"
                                                                    placeholder="e.g., Laravel">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Technology Icon</label>
                                                                <input type="file" class="form-control custom-input-s image-input-with-preview"
                                                                    name="technology_image[]" accept="image/*">
                                                                @if(!empty($technology->technology_image))
                                                                    <img src="{{ asset('storage/' . $technology->technology_image) }}"
                                                                        class="img-thumbnail mt-2" width="80" alt="Preview">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="Faq" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="m-0">Frequently Asked Questions</h5>
                                        <button type="button" class="btn btn-primary btn-sm" id="add-faq-btn"><i
                                                class='bx bx-plus me-1'></i> Add FAQ</button>
                                    </div>
                                    <form id="faqForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                        <div id="faq-container" class="row">
                                            @if(!empty($faqs))
                                                @foreach($faqs as $faq)
                                                    <div class="col-md-6">
                                                        <div class="dynamic-item">
                                                            <button type="button" class="btn-close remove-item-btn" data-id="{{ $faq->id }}" aria-label="Close"></button>
                                                            <input type="hidden" name="faq_ids[]" value="{{ $faq->id ?? '' }}">
                                                            <div class="form-group">
                                                                <label>Question</label>
                                                                <input type="text" class="form-control custom-input-s" name="faq_question[]" value="{{ $faq->question?? '' }}"
                                                                    placeholder="Enter the question">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Answer</label>
                                                                <textarea class="form-control custom-input-s" name="faq_answer[]" rows="3"
                                                                    placeholder="Enter the answer"> {{ $faq->answer?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-success" id="submitAllFormsBtn">
                            <i class="bx bx-save me-1"></i> Update Service
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div id="hidden-templates" style="display: none;">
        <div id="key-benefit-template">
            <div class="col-md-6">
                <div class="dynamic-item">
                    <button type="button" class="btn-close remove-item-btn" aria-label="Close"></button>
                    <div class="form-group">
                        <label>Benefit Title</label>
                        <input type="text" class="form-control custom-input-s" name="benefit_title[]"
                            placeholder="Enter Benefit Title">
                    </div>
                    <div class="form-group">
                        <label>Benefit Details</label>
                        <textarea class="form-control custom-input-s" name="benefit_details[]" rows="3"
                            placeholder="Enter Benefit Details"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div id="offered-service-template">
            <div class="col-md-6">
                <div class="dynamic-item">
                    <button type="button" class="btn-close remove-item-btn" aria-label="Close"></button>
                    <div class="form-group">
                        <label>Service Name</label>
                        <input type="text" class="form-control custom-input-s" name="offered_service_name[]"
                            placeholder="Enter Service Name">
                    </div>
                    <div class="form-group">
                        <label>Service Thumbnil Image</label>
                        <input type="file" class="form-control custom-input-s image-input-with-preview"
                            name="offered_service_icon[]" accept="image/*">
                        <img src="" class="img-thumbnail mt-2" width="80" style="display: none;" alt="Preview">
                    </div>
                </div>
            </div>
        </div>
        <div id="dev-process-template">
            <div class="col-md-6">
                <div class="dynamic-item">
                    <button type="button" class="btn-close remove-item-btn" aria-label="Close"></button>
                    <div class="form-group">
                        <label>Process Title</label>
                        <input type="text" class="form-control custom-input-s" name="process_title[]"
                            placeholder="e.g., Step 1: Planning">
                    </div>
                    <div class="form-group">
                        <label>Process Details</label>
                        <textarea class="form-control custom-input-s" name="process_details[]" rows="3"
                            placeholder="Describe the process step"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div id="technology-template">
            <div class="col-md-3">
                <div class="dynamic-item">
                    <button type="button" class="btn-close remove-item-btn" aria-label="Close"></button>
                    <div class="form-group">
                        <label>Technology Name</label>
                        <input type="text" class="form-control custom-input-s" name="technology_name[]"
                            placeholder="e.g., Laravel">
                    </div>
                    <div class="form-group">
                        <label>Technology Icon</label>
                        <input type="file" class="form-control custom-input-s image-input-with-preview"
                            name="technology_image[]" accept="image/*">
                        <img src="" class="img-thumbnail mt-2" width="80" style="display: none;" alt="Preview">
                    </div>
                </div>
            </div>
        </div>
        <div id="faq-template">
            <div class="col-md-6">
                <div class="dynamic-item">
                    <button type="button" class="btn-close remove-item-btn" aria-label="Close"></button>
                    <div class="form-group">
                        <label>Question</label>
                        <input type="text" class="form-control custom-input-s" name="faq_question[]"
                            placeholder="Enter the question">
                    </div>
                    <div class="form-group">
                        <label>Answer</label>
                        <textarea class="form-control custom-input-s" name="faq_answer[]" rows="3"
                            placeholder="Enter the answer"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="taskDetailsModal" tabindex="-1" aria-labelledby="taskDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskDetailsModalLabel">
                        <span id="modalTaskTitle">Select Client<i class="bx bx-badge-check text-success ms-1"></i></span>
                        <span id="modalTaskStatus" class="badge bg-primary ms-2"></span>
                    </h5>
                    <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                        <h6 class="fs-12 fw-400 text-dark">Trusted by Ambitious Brands/Organization</h6>
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="form-check form-check-md form-switch me-2">
                                <label class="form-check-label mt-0">
                                    <input class="form-check-input me-2 enable-all-modules" type="checkbox" role="switch"
                                        id="enable_all_module_157" data-project-id="157">
                                    Select All Clients
                                </label>
                            </div>

                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-0">
                    <div class="mt-4 custom-border-success-1 custom-bg-purple-100 rounded">
                        <div class="row" id="clientRows">
                            <!-- Dynamic rows will be appended here -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {

        /**
         * Generic function to add a new item by cloning a template.
         * @param {string} templateId - The ID of the template element.
         * @param {string} containerId - The ID of the container to append the new item to.
         */
        function addItem(templateId, containerId) {
            const newItemHtml = $(templateId).html();
            $(containerId).append(newItemHtml);
        }
        // Add Key Benefit
        $('#add-key-benefit-btn').on('click', function () {
            addItem('#key-benefit-template', '#key-benefits-container');
        });
        // Add Offered Service
        $('#add-offered-service-btn').on('click', function () {
            addItem('#offered-service-template', '#offered-services-container');
        });
        // Add Development Process Step
        $('#add-dev-process-btn').on('click', function () {
            addItem('#dev-process-template', '#dev-process-container');
        });
        // Add Technology
        $('#add-technology-btn').on('click', function () {
            addItem('#technology-template', '#technologies-container');
        });
        // Add FAQ
        $('#add-faq-btn').on('click', function () {
            addItem('#faq-template', '#faq-container');
        });
        $(document).on('click', '.remove-item-btn', function () {
            $(this).closest('.dynamic-item').parent().remove();
        });
        $(document).on('change', '.image-input-with-preview', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                const previewImage = $(this).siblings('img.img-thumbnail');

                reader.onload = function (e) {
                    previewImage.attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        });

    });
</script>
<script>
$(document).ready(function () {
  $('#taskDetailsModal').one('show.bs.modal', function () {

    $('#provide-client .row').html('');


    var serviceId = $('#provide-client').data('service-id') || 0;

    var csrfToken = $('#csrf_token').val();

    $.ajax({
      url: '{{ route("active.clients") }}',
      method: 'GET',
      data: { status: 1, service_id: serviceId },
      headers: { 'X-CSRF-TOKEN': csrfToken },
      success: function (clients) {
        var modalBody = $('#clientRows');
        modalBody.empty();

        var rows = Math.ceil(clients.length / 3);
        for (var i = 0; i < rows; i++) {
          var clientRow = `<div class="row">`;
          for (var j = i * 3; j < (i + 1) * 3 && j < clients.length; j++) {
            var c = clients[j];
            clientRow += `
              <div class="col-sm-4">
                <div class="d-flex align-items-center ms-3">
                  <div class="form-check form-switch me-2">
                    <input type="checkbox" class="form-check-input client-toggle"
                      name="selected_clients[]"
                      value="${c.id}"
                      data-client-id="${c.id}"
                      data-client-name="${c.name}"
                      data-client-image="/storage/${c.logo || 'default.jpg'}"
                      ${c.is_linked ? 'checked' : ''}>
                  </div>
                  <label class="form-check-label mt-0 me-2 text-dark">${c.name}</label>
                </div>
              </div>`;
          }
          clientRow += `</div>`;
          modalBody.append(clientRow);
        }

        // Handle individual toggles
        $('.client-toggle').on('change', function () {
          var id = $(this).data('client-id'),
              name = $(this).data('client-name'),
              img = $(this).data('client-image'),
              target = $('#provide-client .row');

          if ($(this).is(':checked')) {
            if (!target.find(`.client-box[data-client-id="${id}"]`).length) {
              target.append(`
                <div class="col client-box" data-client-id="${id}" style="padding: 20px 20px;">
                  <div class="custom-bg-primary-100 featurer-six__item">
                    <div class="featurer-six__item__hover" style="background-image: url(${img});"></div>
                    <div class="cta-eleven__image">
                      <img src="${img}" alt="${name} Logo" style="width: 100%; height: 100px;">
                    </div>
                  </div>
                </div>
              `);
            }
          } else {
            target.find(`.client-box[data-client-id="${id}"]`).remove();
          }
        });

        // Master checkbox select/deselect
        $('#enable_all_module_157').on('change', function () {
          var checked = $(this).prop('checked');
          $('.client-toggle').prop('checked', checked).trigger('change');
        });

        // Initialize checked ones in UI
        $('.client-toggle:checked').trigger('change');

        // Force "Select All" checkbox to be unchecked initially
        $('#enable_all_module_157').prop('checked', false);
      },
      error: function (xhr, status, error) {
        console.error("Error fetching clients: " + error);
      }
    });
  });
});
</script>




<script>
    $(document).ready(function () {
        $('#submitAllFormsBtn').click(function () {
            var $btn = $(this);

            // Disable the button
            $btn.prop('disabled', true);

            // Change button content to show loading
            $btn.html('<i class="bx bx-loader bx-spin me-1"></i> Updating...');

            // Get form data
            const csrfToken = $('#csrf_token').val();
            const overviewData = new FormData($('#overviewForm')[0]);
            const benefitsData = new FormData($('#whyNeedForm')[0]);
            const offeredData = new FormData($('#offeredServiceForm')[0]);
            const devProcessData = new FormData($('#developmentProcessForm')[0]);
            const technologyData = new FormData($('#technologyForm')[0]);
            const faqData = new FormData($('#faqForm')[0]);
            const providedClientsData = new FormData($('#providedClientsForm')[0]);

            // Fix: Store client IDs in an array, not an object
            const selectedClients = [];
            $('.client-toggle:checked').each(function () {
                const clientId = $(this).data('client-id');
                selectedClients.push(clientId);  // Push client IDs directly into the array
            });

            // Append selected clients as a JSON string to FormData
            providedClientsData.append('selected_clients', JSON.stringify(selectedClients));

            // Append CSRF tokens to each FormData
            overviewData.append('_token', csrfToken);
            benefitsData.append('_token', csrfToken);
            offeredData.append('_token', csrfToken);
            devProcessData.append('_token', csrfToken);
            technologyData.append('_token', csrfToken);
            faqData.append('_token', csrfToken);
            providedClientsData.append('_token', csrfToken);

            // Perform AJAX calls for each form submission
           let requests = [
    $.ajax({
        url: "{{ route('service.update', $service->id) }}",
        method: "POST",
        data: overviewData,
        processData: false,
        contentType: false
    }),
    $.ajax({
        url: "{{ route('why-need.update', $service->id) }}",
        method: "POST",
        data: benefitsData,
        processData: false,
        contentType: false
    }),
    $.ajax({
        url: "{{ route('offered-services.update', $service->id) }}",
        method: "POST",
        data: offeredData,
        processData: false,
        contentType: false
    }),
    $.ajax({
        url: "{{ route('development-process.update', $service->id) }}",
        method: "POST",
        data: devProcessData,
        processData: false,
        contentType: false
    }),
    $.ajax({
        url: "{{ route('technology.update', $service->id) }}",
        method: "POST",
        data: technologyData,
        processData: false,
        contentType: false
    }),
    $.ajax({
        url: "{{ route('service-faq.update', $service->id) }}",
        method: "POST",
        data: faqData,
        processData: false,
        contentType: false
    }),
    $.ajax({
        url: "{{ route('provided-client.update', $service->id) }}",
        method: "POST",
        data: providedClientsData,
        processData: false,
        contentType: false
    })
];

Promise.all(requests)
    .then(() => {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'All service data updated successfully!',
            confirmButtonColor: '#3085d6'
        });
        window.location.reload();

    })
    .catch(() => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong while updating!',
            confirmButtonColor: '#d33'
        });
        window.location.reload();
    });

        });
    });
</script>

<script>
$(document).ready(function () {
    $(document).on('click', '#key-benefits-container .remove-item-btn', function () {
        var $button = $(this);
        var dataId = $button.data('id');
        var $itemContainer = $button.closest('.col-md-6');

        if (dataId !== undefined && dataId !== '') {
            // AJAX call to delete from server
            $.ajax({
                url: '/dashboard/service/benefits/' + dataId, // Replace with real endpoint
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $itemContainer.remove();
                    $.notify(response.message, "success"); // Use the message from the server
                },
                error: function (xhr) {
                    // Safely get the error message from the server response
                    let errorMessage = xhr.responseJSON?.message || "Failed to remove Item.";
                    $.notify(errorMessage, "error");
                }
            });
        } else {
            // No ID, just remove from DOM
            $itemContainer.remove();
        }
    });
});


$(document).ready(function () {
    $(document).on('click', '#offered-services-container .remove-item-btn', function () {
        var $button = $(this);
        var dataId = $button.data('id');
        var $itemContainer = $button.closest('.col-md-6');

        if (dataId !== undefined && dataId !== '') {
            // AJAX call to delete from server
            $.ajax({
                url: '/dashboard/service/offered-services/' + dataId, // Replace with real endpoint
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $itemContainer.remove();
                    $.notify(response.message, "success"); // Use the message from the server
                },
                error: function (xhr) {
                    // Safely get the error message from the server response
                    let errorMessage = xhr.responseJSON?.message || "Failed to remove Item.";
                    $.notify(errorMessage, "error");
                }
            });
        } else {
            // No ID, just remove from DOM
            $itemContainer.remove();
        }
    });
});


$(document).ready(function () {
    $(document).on('click', '#dev-process-container .remove-item-btn', function () {
        var $button = $(this);
        var dataId = $button.data('id');
        var $itemContainer = $button.closest('.col-md-6');

        if (dataId !== undefined && dataId !== '') {
            // AJAX call to delete from server
            $.ajax({
                url: '/dashboard/service/development-process/' + dataId, // Replace with real endpoint
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $itemContainer.remove();
                    $.notify(response.message, "success"); // Use the message from the server
                },
                error: function (xhr) {
                    // Safely get the error message from the server response
                    let errorMessage = xhr.responseJSON?.message || "Failed to remove Item.";
                    $.notify(errorMessage, "error");
                }
            });
        } else {
            // No ID, just remove from DOM
            $itemContainer.remove();
        }
    });
});

$(document).ready(function () {
    $(document).on('click', '#technologies-container .remove-item-btn', function () {
        var $button = $(this);
        var dataId = $button.data('id');
        var $itemContainer = $button.closest('.col-md-6');

        if (dataId !== undefined && dataId !== '') {
            // AJAX call to delete from server
            $.ajax({
                url: '/dashboard/service/technology/' + dataId, // Replace with real endpoint
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $itemContainer.remove();
                    $.notify(response.message, "success"); // Use the message from the server
                },
                error: function (xhr) {
                    // Safely get the error message from the server response
                    let errorMessage = xhr.responseJSON?.message || "Failed to remove Item.";
                    $.notify(errorMessage, "error");
                }
            });
        } else {
            // No ID, just remove from DOM
            $itemContainer.remove();
        }
    });
});

$(document).ready(function () {
    $(document).on('click', '#faq-container .remove-item-btn', function () {
        var $button = $(this);
        var dataId = $button.data('id');
        var $itemContainer = $button.closest('.col-md-6');

        if (dataId !== undefined && dataId !== '') {
            // AJAX call to delete from server
            $.ajax({
                url: '/dashboard/service/faq/' + dataId, // Replace with real endpoint
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $itemContainer.remove();
                    $.notify(response.message, "success"); // Use the message from the server
                },
                error: function (xhr) {
                    // Safely get the error message from the server response
                    let errorMessage = xhr.responseJSON?.message || "Failed to remove Item.";
                    $.notify(errorMessage, "error");
                }
            });
        } else {
            // No ID, just remove from DOM
            $itemContainer.remove();
        }
    });
});
</script>

