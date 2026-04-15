<div id="create-counter" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog-centered modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-money bx-tada"></i>
                    Create Counter</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('counter.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Counter Title<span class=" text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input" name="counter_title"
                                        placeholder="Enter Title Here" required />
                                    @error('counter_title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Data Count<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control custom-input" name="data_count"
                                        placeholder="Enter Data Count" min="0" required />
                                    @error('data_count') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Counter Symbol</label>
                                    <input type="text" class="form-control custom-input" name="counter_symbol"
                                        placeholder="Enter Counter Symbol Here" />
                                    @error('counter_symbol') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 image">
                                <div class="form-group">
                                    <label for="image" class="form-label">Icon</label>
                                    <input type="file" class="form-control custom-input mb-5" id="logo"
                                        name="counter_icon">
                                    @error('counter_icon') <span class="text-danger">{{ $message }}</span> @enderror
                                    <br><img class="border" id="logo_preview"
                                        src="{{ asset('admin/assets/media/gallery.jpg') }}" width="96px" height="72px"
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
