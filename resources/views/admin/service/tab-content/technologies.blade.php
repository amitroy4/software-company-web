
<form action="{{ route('technology.update', $service->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div class="mt-4" id="technology-entries">
        @foreach($service->technologies as $index => $technology)
        <div class="row technology-entry mb-3" id="technology-entry-existing-{{ $technology->id }}">
            <h5 class="text-info">Edit Technology {{ $index + 1 }}</h5>

            <div class="col-md-12 mb-3">
                <label class="form-label" for="technology_name_{{ $technology->id }}">Technology Name<span class="text-danger">*</span></label>
                <input class="form-control" type="text" value="{{ $technology->technology_name }}" name="technology_names[]" required
                id="technology_name_{{ $technology->id }}">
            </div>
            <div class="col-md-12 mb-3 image">
                <input type="hidden" name="technology_ids[]" value="{{ $technology->id }}">
                <label class="form-label" for="technology_image_{{ $technology->id }}">Keypoint Icon</label>
                <input type="file" class="form-control mb-3 edit_image" name="technology_image[{{ $technology->id }}]" accept="image/*">

                @if($technology->technology_image)
                <img class="edit_image_preview mt-2" id="edit_image_preview" src="{{ asset('storage/' . $technology->technology_image) }}" alt="Old Image" width="96" height="72">
                @else
                <img class="edit_image_preview mt-2" src="{{ asset('admin/assets/media/gallery.jpg') }}" alt="Preview Image" width="96" height="72">
                @endif

            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeExistingTechnology({{ $technology->id }})">
                    <i class="fa fa-trash"></i> Remove
                </button>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex align-items-center ">
        <a href="javascript:void(0)" class="btn btn-info btn-round ms-auto"
            onclick="addTechnology()">
            <i class="fa fa-plus"></i>
            Add Technology
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

@push('script')
<script>
    // Add new technology dynamically
    function addTechnology() {
        const entryCount = document.querySelectorAll('.technology-entry').length + 1;

        const newEntry = `
            <div class="row technology-entry mb-3" id="technology-entry-${entryCount}">
                <h5 class="text-info">New Technology</h5>

                <div class="col-md-12 mb-3">
                    <label class="form-label" for="technology_name_${entryCount}">Technology Name<span class="text-danger">*</span></label>
<input class="form-control" type="text" name="new_technology_names[]" id="technology_name_${entryCount}" placeholder="Enter Technology Name" required>

                </div>
                 <div class="col-md-12 mb-3 image">
                    <label class="form-label" for="technology_image_${entryCount}">Technology Image<span class="text-danger">*</span></label>
                    <input type="file" class="form-control mb-3 new_image" name="new_technology_images[]" accept="image/*" onchange="previewNewImage(this, '${entryCount}')">
                    <img class="new_image_preview mt-2" id="new_image_preview_${entryCount}" src="{{ asset('admin/assets/media/gallery.jpg') }}" alt="Preview Image" width="96" height="72" required>

                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeTechnologyEntry('technology-entry-${entryCount}')">
                        <i class="fa fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        `;
        document.querySelector('#technology-entries').insertAdjacentHTML('beforeend', newEntry);
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


    // Remove newly added technologys
    function removeTechnologyEntry(entryId) {
        const entry = document.getElementById(entryId);
        if (entry) {
            entry.remove();
        }
    }

    // Remove existing technologys
    function removeExistingTechnology(technologyId) {

        const entry = document.getElementById(`technology-entry-existing-${technologyId}`);
        if (entry) {
            entry.remove();
            // Add a hidden input to mark this technology for deletion
            const input = `<input type="hidden" name="removed_technology_ids[]" value="${technologyId}">`;
            document.querySelector('#technology-entries').insertAdjacentHTML('beforeend', input);
        }
    }
</script>
@endpush
