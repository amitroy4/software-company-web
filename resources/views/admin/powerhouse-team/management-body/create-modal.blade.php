<div id="create-member-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bxs-hand-right bx-tada"></i> Create New Member</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create-member-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs mb-3" id="memberTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Basic Information</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">Contact Information</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="about_me-tab" data-bs-toggle="tab" data-bs-target="#about_me" type="button" role="tab">About</button>
                            </li>
                        </ul>

                        <!-- Tab Contents -->
                        <div class="tab-content" id="memberTabContent">
                            <!-- Personal Information Tab -->
                            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                <div class="row rounded  custom-border-primary-1 custom-bg-primary-100 p-2">
                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_name">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="create_name" name="name" placeholder="Member Name">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_member_code">ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="create_member_code" name="member_code" placeholder="Member ID">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_department">Department</label>
                                            <select type="text" class="form-control custom-input" id="create_department" name="department" placeholder="Department">
                                                <option value="Management">Management</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_designation">Designation</label>
                                            <input type="text" class="form-control custom-input" id="create_designation" name="designation" placeholder="Designation">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_dob">Date of Birth</label>
                                            <input type="date" class="form-control custom-input" id="create_dob" name="dob" placeholder="Date of Birth">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_joining_date">Joining Date</label>
                                            <input type="date" class="form-control custom-input" id="create_joining_date" name="joining_date" placeholder="Joining Date">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_gender">Gender</label>
                                            <select class="form-control custom-input" id="create_gender" name="gender" placeholder="Gender">
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
                                            <label for="create_blood_group">Blood Group</label>
                                            <select class="form-control custom-input" id="create_blood_group" name="blood_group">
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
                                            <label for="create_phone">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="create_phone" name="phone" placeholder="Phone" required>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_email">Email <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control custom-input" id="create_email" name="email" placeholder="Email Address" required>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 image">
                                        <label for="create_image" class="form-label">Image</label>
                                        <input type="file" class="form-control custom-input mb-3" id="create_image" name="image">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                    <div class="col-md-6 mb-3 image">
                                        <img id="create_image_preview" class="border mt-2" src="{{ asset('admin/assets/img/gallery.jpg') }}" width="96" height="72" alt="Preview">
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information Tab -->
                            <div class="tab-pane fade" id="contact" role="tabpanel">
                                <div class="row rounded  custom-border-primary-1 custom-bg-primary-100 p-2">

                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_whatsapp">Whatsapp Number</label>
                                            <input type="text" class="form-control custom-input" id="create_whatsapp" name="whatsapp" placeholder="Whatsapp">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_facebook">Facebook Url</label>
                                            <input type="text" class="form-control custom-input" id="create_facebook" name="facebook" placeholder="Facebook Url">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_linkedin">LinkedIn Url</label>
                                            <input type="text" class="form-control custom-input" id="create_linkedin" name="linkedin" placeholder="LinkedIn Url">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_github">Github</label>
                                            <input type="text" class="form-control custom-input" id="create_github" name="github" placeholder="Github">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_address">Address</label>
                                            <input type="text" class="form-control custom-input" id="create_address" name="address" placeholder="Address">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- About Tab -->
                            <div class="tab-pane fade" id="about_me" role="tabpanel">
                                <div class="row rounded  custom-border-primary-1 custom-bg-primary-100 p-2">
                                    <div class="col-md-12">
                                        <div class="form-group p-0 pb-2">
                                            <label for="create_about">About</label>
                                            <textarea class="form-control custom-input" name="about" id="create_about" cols="30" rows="5"></textarea>
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
                        <button type="submit" id="create-submit-btn" class="submit-button-1 btn btn-primary"><i class='bx bx-upload bx-flashing'></i> Create Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
