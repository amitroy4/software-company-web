<div id="edit-career-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title">
                    <i class="bx bx-user-pin bx-tada bx-flip-horizontal"></i> Edit Career
                </h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCareerForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="company_name">Company Name <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="edit_company_name" name="company_name"
                                        placeholder="company name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="edit_email" name="email"
                                        placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Phone <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="edit_phone" name="phone"
                                        placeholder="phone" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="edit_title" name="title"
                                        placeholder="Title" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="description">Description<span class="text-danger">
                                            *</span></label>
                                    <textarea type="text" class="form-control summernote" id="edit_description"
                                        name="description" cols="5" rows="5" placeholder="Write Here"
                                        ></textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="vacancy">Vacancy <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="edit_vacancy" name="vacancy"
                                        placeholder="Vacancy" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="location">Location <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="edit_location" name="location"
                                        placeholder="Location" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="publish_date" class="form-label">Publish Date</label>
                                <input type="date" name="publish_date" class="form-control" id="edit_publish_date" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="date" name="deadline" class="form-control" id="edit_deadline" required>
                            </div>

                            <div class="col-sm-6 image ">
                                <div class="form-group">
                                    <label for="image">Image<span class="text-danger"></span></label>
                                    <input type="file" class="form-control mb-2" id="edit_image" name="image" >
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    <br><img class="border" id="edit_image_preview"
                                        src="{{ asset('admin/assets/gallery.jpg') }}" width="96px" height="80px"
                                        alt="image">
                                </div>
                            </div>
                            <div class="col-sm-6 image ">
                                <div class="form-group">
                                    <label for="logo">Company Logo<span class="text-danger"></span></label>
                                    <input type="file" class="form-control mb-2" id="edit_logo" name="logo" >
                                    @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                                    <br><img class="border" id="edit_logo_preview"
                                        src="{{ asset('admin/assets/gallery.jpg') }}" width="96px" height="80px"
                                        alt="logo">
                                </div>
                            </div>
 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Responsibilities <span
                                            class=" text-danger"></span></label>

                                        <div id="edit_item-wrapper1">
                                            <div class="edit_item-input1 d-flex gap-2 mb-2">
                                                <input type="text" name="responsibilities[]"  class="form-control custom-input" placeholder="Enter item" required>
                                                <button type="button" class="btn btn-danger btn-sm edit_remove-btn">Remove</button>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-secondary mt-2" id="edit_add-item1">Add Responsibilities </button>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Requirements <span
                                            class=" text-danger"></span></label>

                                        <div id="edit_item-wrapper2">
                                            <div class="edit_item-input2 d-flex gap-2 mb-2">
                                                <input type="text" name="requirements[]"  class="form-control custom-input" placeholder="Enter item" required>
                                                <button type="button" class="btn btn-danger btn-sm edit_remove-btn2">Remove</button>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-secondary mt-2" id="edit_add-item2">Add Requirements </button>
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






