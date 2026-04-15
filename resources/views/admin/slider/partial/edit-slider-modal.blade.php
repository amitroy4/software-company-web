<div id="edit_slider_{{ $slider->id }}" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-edit bx-tada"></i> Edit Slider</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="title">Title<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ old('title', $slider->title) }}" placeholder="Enter title" required />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="sub_title">Sub Title</label>
                                    <input type="text" class="form-control" name="sub_title"
                                        value="{{ old('sub_title', $slider->sub_title) }}"
                                        placeholder="Enter sub-title" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="button_text">Button Text</label>
                                    <input type="text" class="form-control" name="button_text"
                                        value="{{ old('button_text', $slider->button_text) }}"
                                        placeholder="Enter button text" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="button_url">Button Url</label>
                                    <input type="url" class="form-control" name="button_url"
                                        value="{{ old('button_url', $slider->button_url) }}"
                                        placeholder="Enter button url" />
                                </div>
                            </div>
                            <div class="col-sm-6 image ">
                                <div class="form-group">
                                    <label for="image">Image<span class="text-danger"> *</span></label>
                                    <input type="file" class="form-control mb-3 edit_image" name="image"
                                        accept="image/*">
                                    @if($slider->image)
                                    <img class="edit_image_preview mt-2" id="edit_image_preview"
                                        src="{{ asset('storage/' . $slider->image) }}" alt="Old Image" width="96"
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
