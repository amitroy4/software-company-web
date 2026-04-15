<div id="create-testimonial-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class=" modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-user-pin bx-tada bx-flip-horizontal"></i>
                    Create Testimonial</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="client_name">Client Name<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="client_name" name="client_name"
                                        placeholder="Client Name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="designation">Client Designation</label>
                                    <input type="text" class="form-control custom-input" id="designation" name="designation"
                                        placeholder="Client Designation" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="designation">Organaization Name</label>
                                    <input type="text" class="form-control custom-input" id="organization" name="organization"
                                        placeholder="Organaization Name" >
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                   <label for="review">Details Review<span class="text-danger"> *</span></label>
                                   <textarea type="text" class="form-control" id="review" name="review" cols="5" rows="5" placeholder="Write Here" required></textarea>
                                </div>
                             </div>
                            <div class="col-sm-6 image ">
                                <div class="form-group">
                                    <label for="image">Image<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control mb-2" id="image" name="image" required >
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    <br><img class="border" id="image_preview"
                                        src="{{ asset('admin/assets/gallery.jpg') }}" width="96px" height="80px"
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
