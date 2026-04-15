<div id="create-client-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog-centered modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-user-pin bx-tada bx-flip-horizontal"></i>
                    Create Client</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Organization/Client name<span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control custom-input" id="name" name="name"
                                        placeholder="Organization/Client name" required>
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
                                    <label for="image">Logo<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control mb-5" id="logo" name="logo" required>
                                    @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                                    <br><img class="border" id="logo_preview"
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
