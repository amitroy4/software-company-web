<div id="edit-member-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bxs-hand-right bx-tada"></i> Edit Member</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-member-form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_member_id" name="id">
                <div class="modal-body">
                    <div class="card-body">

                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs mb-3" id="memberTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#edit_modal_personal" type="button" role="tab">Basic Information</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#edit_modal_contact" type="button" role="tab">Contact Information</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#edit_modal_about" type="button" role="tab">About</button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="memberTabContent">
                        <!-- Personal Information Tab -->
                        <div class="tab-pane fade show active" id="edit_modal_personal" role="tabpanel">
                            <div class="row  rounded  custom-border-primary-1 custom-bg-primary-100 p-2">
                                <div class="col-md-6">
                                    <div class="form-group p-0 pb-2">
                                        <label for="edit_name">Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control custom-input" id="edit_name" name="name" placeholder="Member Name">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="edit_member_code">ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="edit_member_code" name="member_code" placeholder="Member ID">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="edit_department">Department</label>
                                            <select type="text" class="form-control custom-input" id="edit_department" name="department" placeholder="Department">
                                                <option value="Management">Management</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="edit_designation">Designation</label>
                                            <input type="text" class="form-control custom-input" id="edit_designation" name="designation" placeholder="Designation">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group p-0 pb-2">
                                            <label for="edit_dob">Date of Birth</label>
                                            <input type="date" class="form-control custom-input" id="edit_dob" name="dob" placeholder="Date of Birth">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group p-0 pb-2">
                                            <label for="edit_joining_date">Joining Date</label>
                                            <input type="date" class="form-control custom-input" id="edit_joining_date" name="joining_date" placeholder="Joining Date">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group p-0 pb-2">
                                            <label for="edit_gender">Gender</label>
                                            <select class="form-control custom-input" id="edit_gender" name="gender">
                                                <option value="">--Select Please --</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                <div class="col-md-3">
                                    <div class="form-group p-0 pb-2">
                                        <label for="edit_blood_group">Blood Group</label>
                                        <select class="form-control custom-input" id="edit_blood_group" name="blood_group">
                                            <option value="">--Select Please --</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-0 pb-2">
                                        <label for="edit_phone">Phone Number</label>
                                        <input type="text" class="form-control custom-input" id="edit_phone" name="phone" placeholder="Phone">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-0 pb-2">
                                        <label for="edit_email">Email</label>
                                        <input type="text" class="form-control custom-input" id="edit_email" name="email" placeholder="Email Address">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 image">
                                    <label for="edit_image" class="form-label">Image</label>
                                    <input type="file" class="form-control custom-input mb-3" id="edit_image" name="image">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                                <div class="col-md-6 mb-3 image">
                                    <img id="edit_image_preview" class="border mt-2" src="{{ asset('admin/assets/img/gallery.jpg') }}" width="96" height="72" alt="Preview">
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Tab -->
                        <div class="tab-pane fade" id="edit_modal_contact" role="tabpanel">
                            <div class="row  rounded  custom-border-primary-1 custom-bg-primary-100 p-2">
                                <div class="col-md-6">
                                    <div class="form-group p-0 pb-2">
                                        <label for="edit_whatsapp">Whatsapp Number</label>
                                        <input type="text" class="form-control custom-input" id="edit_whatsapp" name="whatsapp" placeholder="Whatsapp">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-0 pb-2">
                                        <label for="edit_facebook">Facebook Url</label>
                                        <input type="text" class="form-control custom-input" id="edit_facebook" name="facebook" placeholder="Facebook Url">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-0 pb-2">
                                        <label for="edit_linkedin">LinkedIn Url</label>
                                        <input type="text" class="form-control custom-input" id="edit_linkedin" name="linkedin" placeholder="LinkedIn Url">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-0 pb-2">
                                        <label for="edit_github">Github</label>
                                        <input type="text" class="form-control custom-input" id="edit_github" name="github" placeholder="Github">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group p-0 pb-2">
                                        <label for="edit_address">Address</label>
                                        <input type="text" class="form-control custom-input" id="edit_address" name="address" placeholder="Address">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- About Tab -->
                        <div class="tab-pane fade" id="edit_modal_about" role="tabpanel">
                            <div class="row  rounded  custom-border-primary-1 custom-bg-primary-100 p-2">
                                <div class="col-md-12">
                                    <div class="form-group p-0 pb-2">
                                        <label for="edit_about">About</label>
                                        <textarea class="form-control custom-input" name="about" id="edit_about" cols="30" rows="5"></textarea>
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="modal-button-box">
                        <button type="button" class="cancel-button-1 btn btn-danger" data-bs-dismiss="modal"><i class='bx bx-x bx-flashing'></i> Cancel</button>
                        <button type="submit" id="edit-submit-btn" class="submit-button-1 btn btn-primary"><i class='bx bx-upload bx-flashing'></i> Update Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
