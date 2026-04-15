<div id="create-application-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog-centered modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-user-pin bx-tada bx-flip-horizontal"></i>
                    Create Application</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('application.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="title">Application Title<span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control custom-input" id="title" name="title"
                                        placeholder="Application Title" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Website Url</label>
                                    <input type="url" class="form-control" name="url" placeholder="Enter URL" />
                                    @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 image">
                                <div class="form-group">
                                    <label for="image">Icon<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control mb-2" id="image" name="icon" required>
                                    @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
                                    <br><img class="border" id="image_preview"
                                        src="{{ asset('admin/assets/gallery.jpg') }}" width="96px" height="72px"
                                        alt="image">
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
                            <i class='bx bx-upload bx-flashing'></i> Save
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
