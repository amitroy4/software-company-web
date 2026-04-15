<div id="create-service-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class=" modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-user-pin bx-tada bx-flip-horizontal"></i>
                    Create Service</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="service_name">Service Name<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="service_name"
                                        name="service_name" placeholder="Service Name" required>
                                    @error('service_name') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="service_details">Service Details<span class="text-danger">
                                            *</span></label>
                                    <textarea type="text" class="form-control summernote" id="service_details"
                                        name="service_details" cols="5" rows="5" placeholder="Write Here"
                                        required></textarea>
                                    @error('service_details') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 image ">
                                <div class="form-group">
                                    <label for="image">Image<span class="text-danger"> *</span></label>
                                    <input type="file" class="form-control mb-2" id="image" name="image" required>
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    <br><img class="border" id="image_preview"
                                        src="{{ asset('admin/assets/gallery.jpg') }}" width="96px" height="80px"
                                        alt="image">
                                    @error('image') <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    {{-- Service Keypoints --}}
                                    <div class="col-sm-12">
                                        <h2 class="">Service Keypoints </h2>
                                        <hr>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Service Keypoint 1 </label>
                                            <input type="text" class="form-control custom-input" name="service_keypoint_1"
                                                placeholder="Service Keypoint 1">
                                            @error('service_keypoint_1') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Service Keypoint 2 </label>
                                            <input type="text" class="form-control custom-input" name="service_keypoint_2"
                                                placeholder="Service Keypoint 2">
                                            @error('service_keypoint_2') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Service Keypoint 3 </label>
                                            <input type="text" class="form-control custom-input" name="service_keypoint_3"
                                                placeholder="Service Keypoint 3">
                                            @error('service_keypoint_3') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-sm-6">
                                <div class="row">
                                    <h2 class="">Counter</h2>
                                    <hr>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Counter Title</label>
                                            <input type="text" class="form-control custom-input" name="counter_title"  placeholder="Counter Title" />
                                            @error('counter_title') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Data Count</label>
                                            <input type="number" class="form-control custom-input" name="data_count"
                                                min="0"/>
                                            @error('data_count') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Counter Symbol</label>
                                            <input type="text" class="form-control custom-input"
                                                name="counter_symbol" placeholder="Counter Symbol" />
                                            @error('counter_symbol') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 image">
                                        <div class="form-group ">
                                            <div class="form-group">
                                                <label for="imagecounter_icon">Icon</label>
                                                <input type="file" class="form-control mb-2" id="logo"
                                                    name="counter_icon">
                                                @error('counter_icon') <span class="text-danger">{{ $message
                                                    }}</span> @enderror
                                                <br><img class="border" id="logo_preview"
                                                    src="{{ asset('admin/assets/gallery.jpg') }}" width="96px"
                                                    height="80px" alt="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                                    <!-- <h2 class="">Contact</h2>
                                    <hr>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control custom-input" name="contact_title"
                                                placeholder="Enter Title" />
                                            @error('contact_title') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Button Text</label>
                                            <input type="text" class="form-control custom-input" name="button_text"
                                                placeholder="Enter Button Text" />
                                            @error('button_text') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Button url</label>
                                            <input type="url" class="form-control custom-input" name="contact_url">
                                            @error('contact_url') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="modal-button-box">
                        <button type="button" class="cancel-button-1 border-0" data-bs-dismiss="modal">
                            <i class='bx bx-x bx-flashing'></i> Cancel
                        </button>
                        <button type="submit" class="submit-button-1 border-0">
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
