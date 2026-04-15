<form action="{{ route('development-process.update', $service->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div class="row">
        <div class="col-sm-6 border-end pe-4">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="process_counter_title">Counter Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control custom-input" name="process_counter_title"
                            value="{{ old('process_counter_title', $service->developmentProcess->process_counter_title ?? '') }}" placeholder="Enter Counter Title"
                            required />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="process_counter_symbol">Counter Symbol</label>
                        <input type="text" class="form-control custom-input" name="process_counter_symbol"
                            value="{{ old('process_counter_symbol', $service->developmentProcess->process_counter_symbol ?? '') }}" placeholder="Enter Counter Title"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="process_data_count">Data Count<span class="text-danger"> *</span></label>
                        <input type="number" class="form-control custom-input" name="process_data_count"
                            value="{{ old('process_data_count', $service->developmentProcess->process_data_count ?? '') }}" placeholder="Enter Data Count" />
                    </div>
                </div>
                <div class="col-sm-12 image ">
                    <div class="form-group">
                        <label for="image">Image<span class="text-danger">*</span></label>
                        <input type="file" class="form-control custom-input mb-3 edit_image" name="process_counter_image"
                            accept="image/*">
                        @if($service->developmentProcess && $service->developmentProcess->process_counter_image)
                        <img class="edit_image_preview" src="{{ asset('storage/' . $service->developmentProcess->process_counter_image) }}" width="96" height="72">
                        @else
                        <img class="edit_image_preview" src="{{ asset('admin/assets/gallery.jpg') }}" width="96" height="72">
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">

            <!-- Add development process button -->
            <div class="mb-3 text-start">
                <button type="button" class="btn btn-sm btn-primary" id="addDevelopmentProcessButton">
                    + Add a New Development Process
                </button>
            </div>

            {{-- Keypoint Section --}}
            <div class="row" id="developmentProcessContainer">
                {{-- <h2 class="">Keypoint</h2>
                <hr> --}}
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="development_title_1"> Title 1</label>
                        <input type="text" class="form-control custom-input" name="development_title_1"
                            value="{{ old('development_title_1', $service->developmentProcess->development_title_1 ?? '') }}"
                            placeholder="Enter  Title 1" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="development_details_1"> Details 1</label>
                        <textarea name="development_details_1" class="form-control custom-input" id="development_details_1"
                            cols="3"
                            rows="6">{{ old('development_details_1', $service->developmentProcess->development_details_1 ?? '') }}</textarea>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

    <div class="modal-footer border-">
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


<script>
    let developementProcessIndex = 2;

    document.getElementById('addDevelopmentProcessButton').addEventListener('click', function () {
        const container = document.getElementById('developmentProcessContainer');

        const processGroup = document.createElement('div');
        processGroup.classList.add('development-process-group', 'position-relative', 'border', 'p-3', 'm-3', 'rounded');

        processGroup.innerHTML = `
            <div class="form-group">
                <label for="development_title_${developementProcessIndex}">Title ${developementProcessIndex}</label>
                <input type="text" class="form-control custom-input"
                    name="development_title_${developementProcessIndex}"
                    placeholder="Enter Title ${developementProcessIndex}" />
            </div>
            <div class="form-group mt-2">
                <label for="development_details_${developementProcessIndex}">Details ${developementProcessIndex}</label>
                <textarea name="development_details_${developementProcessIndex}"
                        class="form-control custom-input"
                        id="development_details_${developementProcessIndex}"
                        cols="3" rows="6"
                        placeholder="Enter Details ${developementProcessIndex}"></textarea>
            </div>
            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 delete-process-btn">
                <i class="fa fa-trash"></i> Remove
            </button>
        `;

        // Add delete functionality
        processGroup.querySelector('.delete-process-btn').addEventListener('click', function () {
            container.removeChild(processGroup);
        });

        container.appendChild(processGroup);
        developementProcessIndex++;
    });
</script>
