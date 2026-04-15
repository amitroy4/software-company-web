{{-- <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="service_name">Service Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control custom-input" id="service_name" name="service_name"
                    value="{{ old('service_name', $service->service_name) }}" placeholder="Service Name" required>
                @error('service_name') <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                <label for="service_details">Service Details <span class="text-danger">*</span></label>
                <textarea class="form-control summernote" id="service_details" name="service_details" rows="5"
                    placeholder="Write Here" required>{{ old('service_details', $service->service_details) }}</textarea>
                @error('service_details') <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-4 image">
            <div class="form-group">
                <label for="edit_image" class="form-label">Image<span class="text-danger">*</span></label>
                <input type="file" class="form-control mb-3 edit_image" name="image" accept="image/*">
                @if($service->image)
                <img class="edit_image_preview mt-2" src="{{ asset('storage/' . $service->image) }}" alt="Old Image"
                    width="96" height="72">
                @endif
                @error('image') <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm">
                    <h2 class="">Service Keypoints </h2>
                    <hr>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Service Keypoint 1 </label>
                        <input type="text" class="form-control custom-input" name="service_keypoint_1"
                            value="{{ old('service_keypoint_1', $service->service_keypoint_1) }}">
                        @error('service_keypoint_1') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Service Keypoint 2 </label>
                        <input type="text" class="form-control custom-input" name="service_keypoint_2"
                            value="{{ old('service_keypoint_2', $service->service_keypoint_2) }}">
                        @error('service_keypoint_2') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Service Keypoint 3 </label>
                        <input type="text" class="form-control custom-input" name="service_keypoint_3"
                            value="{{ old('service_keypoint_3', $service->service_keypoint_3) }}">
                        @error('service_keypoint_3') <span class="text-danger">{{ $message }}</span> @enderror
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
</form> --}}


<form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="service_name">Service Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control custom-input-s" id="service_name" name="service_name"
                    value="{{ old('service_name', $service->service_name) }}" required>
                @error('service_name') <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                <label for="service_details">Service Details <span class="text-danger">*</span></label>
                <textarea class="form-control custom-input-s" id="service_details" name="service_details" rows="8"
                    required>{{ old('service_details', strip_tags($service->service_details)) }}</textarea>
                @error('service_details') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="edit_image" class="form-label">Image <span class="text-danger">*</span></label>
                <input type="file" class="form-control custom-input-s" name="image" accept="image/*">
                @if($service->image)
                    <img class="img-thumbnail mt-2" src="{{ asset('storage/' . $service->image) }}" alt="Old Image"
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
                        <input type="text" class="form-control custom-input-s" name="service_keypoint_1"
                            value="{{ old('service_keypoint_1', $service->service_keypoint_1) }}">
                        @error('service_keypoint_1') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Keypoint 2</label>
                        <input type="text" class="form-control custom-input-s" name="service_keypoint_2"
                            value="{{ old('service_keypoint_2', $service->service_keypoint_2) }}">
                        @error('service_keypoint_2') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Keypoint 3</label>
                        <input type="text" class="form-control custom-input-s" name="service_keypoint_3"
                            value="{{ old('service_keypoint_3', $service->service_keypoint_3) }}">
                        @error('service_keypoint_3') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>