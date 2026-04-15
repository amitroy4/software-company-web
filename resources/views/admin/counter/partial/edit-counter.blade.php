
<div id="edit-counter_{{ $counter->id }}" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog-centered modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-edit bx-tada"></i>
                    Edit Counter</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('counter.update', $counter->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Counter Title<span class=" text-danger">*</span></label>
                                    <input type="text" class="form-control" name="counter_title" value="{{ old('counter_title', $counter->counter_title) }}" required />
                                    @error('counter_title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Data Count<span class=" text-danger">*</span></label>
                                    <input type="number" class="form-control custom-input" name="data_count" min="0" value="{{ old('data_count', $counter->data_count) }}" required />
                                    @error('data_count') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Counter Symbol</label>
                                    <input type="text" class="form-control custom-input" name="counter_symbol" value="{{ old('counter_symbol', $counter->counter_symbol) }}"  />
                                    @error('counter_symbol') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 image">
                                <div class="form-group">
                                    <label for="edit_image" class="form-label">Icon<span class="text-danger"> *</span></label>
                                    <input type="file" class="form-control custom-input mb-5 edit_image" id="logo" name="counter_icon" accept="image/*" >
                                    @if($counter->counter_icon)
                                    <img class="edit_image_preview mt-2"  src="{{ asset('storage/' . $counter->counter_icon) }}" alt="Old Image" width="96" height="72">
                                    @else
                                    <img class="edit_image_preview d-none mt-2" src="" alt="Preview Image" width="96" height="72">
                                    @endif
                                    @error('counter_icon') <span class="text-danger">{{ $message }}</span> @enderror
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
