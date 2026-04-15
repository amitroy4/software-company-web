<div id="edit_contact_{{ $contact->id }}" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-edit bx-tada"></i> Edit Contact</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="address">Address<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="address" name="address" value="{{ old('address', $contact->address) }}"
                                        placeholder="Enter Address" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="branch">Branch<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="branch" name="branch" value="{{ old('branch', $contact->branch) }}"
                                        placeholder="Enter Branch" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control custom-input" id="phone" name="phone" value="{{ old('phone', $contact->phone) }}"
                                        placeholder="Phone Number" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="whatsapp">Whatsapp</label>
                                    <input type="text" class="form-control custom-input" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $contact->whatsapp) }}"
                                        placeholder="Whatsapp Number" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control custom-input" id="email" name="email" value="{{ old('email', $contact->email) }}"
                                        placeholder="Enter Email" >
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                   <label for="map">Map Url</label>
                                   <textarea type="text" class="form-control " id="map" name="map"  cols="5" rows="5" placeholder="Write Here">{{$contact->map}}</textarea>
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
