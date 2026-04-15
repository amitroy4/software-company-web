@extends('layouts.admin')
@section('title','About Us')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header project-details-card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="project-details-card-header-title"><i class='bx bx-edit bx-tada'></i>Edit About
                                Us</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('about-us.update', $about->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="title">Title<span class="text-danger">
                                                                *</span></label>
                                                        <input type="text" class="form-control custom-input"
                                                            name="title" value="{{ old('title', $about->title) }}"
                                                            placeholder="Enter title" required />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="sub_title">Sub Title<span class="text-danger">
                                                                *</span></label>
                                                        <input type="text" class="form-control custom-input"
                                                            name="sub_title"
                                                            value="{{ old('sub_title', $about->sub_title) }}"
                                                            placeholder="Enter sub-title" required />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="quote">Quote</label>
                                                        <input type="text" class="form-control custom-input"
                                                            name="quote" value="{{ old('quote', $about->quote) }}"
                                                            placeholder="Enter Quote" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="description">Description<span
                                                                class=" text-danger">*</span></label>
                                                        <textarea type="text"
                                                            class="form-control custom-input summernote"
                                                            id="description" name="description"
                                                            value="{{ old('description', $about->description) }}"
                                                            placeholder="Write Here"
                                                            required>{{$about->description}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 image ">
                                                    <div class="form-group">
                                                        <label for="image">Image<span
                                                                class="text-danger">*</span></label>
                                                        <input type="file"
                                                            class="form-control custom-input mb-3 edit_image"
                                                            name="image" accept="image/*">
                                                        @if($about->image)
                                                        <img class="edit_image_preview mt-2" id="edit_image_preview"
                                                            src="{{ asset('storage/' . $about->image) }}"
                                                            alt="Old Image" width="96" height="72">
                                                        @else
                                                        <img class="edit_image_preview mt-2"
                                                            src="{{ asset('admin/assets/gallery.jpg') }}"
                                                            alt="Preview Image" width="96" height="72">

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h2 class="">Counter</h2>
                                            <hr>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Counter Title<span
                                                            class=" text-danger">*</span></label>
                                                    <input type="text" class="form-control custom-input"
                                                        name="counter_title"
                                                        value="{{ old('counter_title', $about->counter_title) }}"
                                                        required />
                                                    @error('counter_title') <span class="text-danger">{{ $message
                                                        }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Data Count<span
                                                            class=" text-danger">*</span></label>
                                                    <input type="number" class="form-control custom-input"
                                                        name="data_count" min="0"
                                                        value="{{ old('data_count', $about->data_count) }}" required />
                                                    @error('data_count') <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Counter Symbol</label>
                                                    <input type="text" class="form-control custom-input"
                                                        name="counter_symbol"
                                                        value="{{ old('counter_symbol', $about->counter_symbol) }}" />
                                                    @error('counter_symbol') <span class="text-danger">{{ $message
                                                        }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-6 image">
                                                <div class="form-group ">
                                                    <label for="edit_image" class="form-label">Icon</label>
                                                    <input type="file" class="form-control custom-input mb-5 edit_image"
                                                        id="logo" name="counter_icon" accept="image/*">
                                                    @if($about->counter_icon)
                                                    <img class="edit_image_preview mt-2"
                                                        src="{{ asset('storage/' . $about->counter_icon) }}"
                                                        alt="Old Image" width="96" height="72">
                                                    @else
                                                    <img class="edit_image_preview mt-2"
                                                        src="{{ asset('admin/assets/gallery.jpg') }}"
                                                        alt="Preview Image" width="96" height="72">

                                                    @endif
                                                    @error('counter_icon') <span class="text-danger">{{ $message
                                                        }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <h2 class="">Keypoint</h2>
                                            <hr>

                                            <div class="mt-4" id="keypoints">
                                                @foreach($about->keypoints as $index => $keypoint)
                                                <div class="row keypoint mb-3"
                                                    id="keypoint-existing-{{ $keypoint->id }}">
                                                    <h5 class="text-info">Edit Key Point {{ $index + 1 }}</h5>
                                                    <div class="col-md-12 mb-3">
                                                        <input type="hidden" name="keypoint_ids[]" value="{{ $keypoint->id }}">

                                                        <label class="form-label"
                                                            for="keypoint_{{ $keypoint->id }}">Keypoint</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ $keypoint->keypoint }}" name="keypoints[]"
                                                            id="keypoint_{{ $keypoint->id }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="removeExistingKeypoint({{ $keypoint->id }})">
                                                            <i class="fa fa-trash"></i> Remove
                                                        </button>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="d-flex align-items-center ">
                                                <a href="javascript:void(0)" class="btn btn-info btn-round me-auto"
                                                    onclick="addKeyPoint()">
                                                    <i class="fa fa-plus"></i>
                                                    Add KeyPoint
                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    // Add new keypoint dynamically
    function addKeyPoint() {
        const entryCount = document.querySelectorAll('.keypoint').length + 1;

        const newEntry = `
            <div class="row keypoint mb-3" id="keypoint-${entryCount}">
                <h5 class="text-info">New Key Point</h5>
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="keypoint_${entryCount}">Keypoint</label>
                    <input class="form-control" type="text" name="keypoints[]" id="keypoint_${entryCount}" placeholder="Enter Keypoint">
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeFaqEntry('keypoint-${entryCount}')">
                        <i class="fa fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        `;
        document.querySelector('#keypoints').insertAdjacentHTML('beforeend', newEntry);
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
    function removeFaqEntry(entryId) {
        const entry = document.getElementById(entryId);
        if (entry) {
            entry.remove();
        }
    }

    // Remove existing keypoints
    function removeExistingKeypoint(keypointId) {
        const entry = document.getElementById(`keypoint-existing-${keypointId}`);
        if (entry) {
            entry.remove();
            // Add a hidden input to mark this keypoint for deletion
            const input = `<input type="hidden" name="removed_keypoint_ids[]" value="${keypointId}">`;
            document.querySelector('#keypoints').insertAdjacentHTML('beforeend', input);
        }
    }
</script>
