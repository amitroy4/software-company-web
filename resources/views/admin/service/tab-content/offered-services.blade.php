
<form id="offered-service-form" action="{{ route('offered-services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div class="row">
        <div class="col-4">
            <div class="mt-4" id="service-entries">
                @foreach($service->offeredService as $index => $keypoint)
                <div class="row service-entry mb-3" id="service-entry-existing-{{ $keypoint->id }}">
                    <h5 class="text-info">Edit Key Point {{ $index + 1 }}</h5>

                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="offered_service_{{ $keypoint->id }}">Offered Service Name<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" value="{{ $keypoint->offered_service }}" name="offered_services[]"
                        id="offered_service_{{ $keypoint->id }}" required>

                    </div>
                    <div class="col-md-12 mb-3 image">
                        <input type="hidden" name="service_ids[]" value="{{ $keypoint->id }}">
                        <label class="form-label" for="service_image_{{ $keypoint->id }}">Keypoint Icon<span class="text-danger">*</span></label>
                        <input type="file" class="form-control mb-3 edit_image" name="service_image[{{ $keypoint->id }}]" accept="image/*">

                        @if($keypoint->service_image)
                        <img class="edit_image_preview mt-2" id="edit_image_preview" src="{{ asset('storage/' . $keypoint->service_image) }}" alt="Old Image" width="96" height="72">
                        @else
                        <img class="edit_image_preview mt-2" src="{{ asset('admin/assets/media/gallery.jpg') }}" alt="Preview Image" width="96" height="72">
                        @endif

                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeExistingService({{ $keypoint->id }})">
                            <i class="fa fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>



    
    <div class="d-flex align-items-center ">
        <a href="javascript:void(0)" class="btn btn-info btn-round ms-auto"
            onclick="addService()">
            <i class="fa fa-plus"></i>
            Add Service
        </a>
    </div>
    <div class="modal-footer border-0">
        <div class="modal-button-box">
            <button type="button" class="cancel-button-1" data-bs-dismiss="modal">
                <i class='bx bx-x bx-flashing'></i> Cancel
            </button>
            <button type="submit" class="submit-button-1">
                <i class='bx bx-upload bx-flashing'></i> Update
            </button>
        </div>

    </div>
</form>




<script>
    $(document).ready(function() {
        $('#offered-service-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_method', 'PUT');  // Add method spoofing for PUT

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('Offered Services updated successfully!');
                },
                error: function(xhr) {
                    // handle validation errors as before
                }
            });
        });

    });

</script>






@push('script')
<script>
    // Add new keypoint dynamically
    function addService() {
        const entryCount = document.querySelectorAll('.service-entry').length + 1;

        const newEntry = `
            <div class="row service-entry mb-3" id="service-entry-${entryCount}">
                <h5 class="text-info">New Key Point</h5>

                <div class="col-md-12 mb-3">
                    <label class="form-label" for="offered_service_${entryCount}">Offered Service Name<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="new_offered_services[]" id="offered_service_${entryCount}" placeholder="Enter Service Name" required>

                </div>
                 <div class="col-md-12 mb-3 image">
                    <label class="form-label" for="service_image_${entryCount}">Service Image<span class="text-danger">*</span></label>
                    <input type="file" class="form-control mb-3 new_image" name="new_service_images[]" accept="image/*" onchange="previewNewImage(this, '${entryCount}')" required>
                    <img class="new_image_preview mt-2" id="new_image_preview_${entryCount}" src="{{ asset('admin/assets/media/gallery.jpg') }}" alt="" width="96" height="72">

                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeServiceEntry('service-entry-${entryCount}')">
                        <i class="fa fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        `;
        document.querySelector('#service-entries').insertAdjacentHTML('beforeend', newEntry);
    }
    // Preview new image upload
    function previewNewImage(input, id) {
        const preview = document.getElementById(`new_image_preview_${id}`);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    // Remove newly added keypoints
    function removeServiceEntry(entryId) {
        const entry = document.getElementById(entryId);
        if (entry) {
            entry.remove();
        }
    }

    // Remove existing keypoints
    function removeExistingService(keypointId) {

        const entry = document.getElementById(`service-entry-existing-${keypointId}`);
        if (entry) {
            entry.remove();
            // Add a hidden input to mark this keypoint for deletion
            const input = `<input type="hidden" name="removed_service_ids[]" value="${keypointId}">`;
            document.querySelector('#service-entries').insertAdjacentHTML('beforeend', input);
        }
    }
</script>
@endpush
