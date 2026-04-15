<div id="edit_application_{{ $application->id }}" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-edit bx-tada"></i> Edit Application</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('application.update', $application->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="title">Application Title<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ old('title', $application->title) }}" placeholder="Enter title Here"
                                        required />
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="url">Website Url</label>
                                    <input type="text" class="form-control" name="url"
                                        value="{{ old('url', $application->url) }}" />
                                    @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 image ">
                                <div class="form-group">
                                    <label for="image">Icon<span
                                        class="text-danger">*</span></label>
                                    <input type="file" class="form-control mb-3 edit_image" name="icon"
                                        accept="image/*">
                                    @if($application->icon)
                                    <img class="edit_image_preview mt-2" id="edit_image_preview"
                                        src="{{ asset('storage/' . $application->icon) }}" alt="Old Image" width="96"
                                        height="72">
                                    @else
                                    <img class="edit_image_preview d-none mt-2" src="" alt="Preview Image" width="96"
                                        height="72">
                                    @endif
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
