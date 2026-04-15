<!-- Add Keypoint Button - Left Aligned -->
<div class="mb-3 text-start">
    <button type="button" class="btn btn-sm btn-primary px-3 py-2" id="addKeypointBtn">
        + Add a New Keypoint
    </button>
</div>

<!-- <form id="whyNeedForm" action="{{ route('why-need.update', $service->id) }}" method="POST" enctype="multipart/form-data"> -->
<form id="whyNeedForm" data-service-id="{{ $service->id }}"  method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div class="row">
        <div class="col-lg-5 col-md-12 m-4  ">
            <div class="row" id="keypointsContainer">
                <!-- Initial Keypoint -->
                <!-- <div class="keypoint-group position-relative border rounded bg-light p-4 mb-4">
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <label for="keypoint_title_1">Keypoint Title 1</label>
                            <input type="text" class="form-control custom-input" name="keypoint_title_1"
                                value="{{ old('keypoint_title_1', $service->whyneed->keypoint_title_1 ?? '') }}"
                                placeholder="Enter Keypoint Title 1" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="keypoint_details_1">Keypoint Details 1</label>
                            <textarea name="keypoint_details_1" class="form-control custom-input"
                                rows="6" placeholder="Enter Keypoint Details 1">{{ old('keypoint_details_1', $service->whyneed->keypoint_details_1 ?? '') }}</textarea>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="col-lg-5 col-md-12 m-4  ">
            <div class="row" id="keypointsContainer2">
                <!-- Dynamically added keypoints will go here -->
            </div>
        </div>
    </div>

    <div class="modal-footer border-0 px-0 mt-4">
        <div class="d-flex gap-2 justify-content-start w-100">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class='bx bx-x bx-flashing'></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary">
                <i class='bx bx-upload bx-flashing'></i> Update
            </button>
        </div>
    </div>
</form>



<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(function () {
    /* -------------------------------------------------------------- */
    /* 0.  Ajax defaults (CSRF + JSON)                                */
    /* -------------------------------------------------------------- */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json'
        }
    });

    /* -------------------------------------------------------------- */
    /* 1.  Submit the form (PUT)                                      */
    /* -------------------------------------------------------------- */
    $('#whyNeedForm').on('submit', function (e) {
        e.preventDefault();

        const ids     = $('input[name="keypoint_id[]"]').map((_, el) => $(el).val() || null).get();
        const titles  = $('input[name="keypoint_title[]"]').map((_, el) => $(el).val().trim()).get();
        const details = $('textarea[name="keypoint_details[]"]').map((_, el) => $(el).val().trim()).get();

        const payload = JSON.stringify({
            keypoint_id:      ids,
            keypoint_title:   titles,
            keypoint_details: details
        });

        const serviceId = $(this).data('service-id');

        $.ajax({
            url:  `/dashboard/api/services/why-need/update/${serviceId}`,
            type: 'PUT',
            data: payload,
            success: res => {
                console.log(res.message);     // "Keypoints saved"
                // toast / close modal here
            },
            error: xhr => {
                if (xhr.status === 422) {
                    console.error('Validation failed', xhr.responseJSON.errors);
                } else {
                    console.error('Save failed', xhr.responseText);
                }
            }
        });
    });

    /* -------------------------------------------------------------- */
    /* 2.  Delete helper (returns a jQuery promise)                   */
    /* -------------------------------------------------------------- */
    function deleteKeypoint(serviceId, keypointId) {
        if (!keypointId) return $.Deferred().resolve();   // unsaved row

        return $.ajax({
            url:  `/dashboard/api/services/${serviceId}/needs/${keypointId}`,
            type: 'DELETE'
        });
    }

    /* -------------------------------------------------------------- */
    /* 3.  Load existing keypoints                                    */
    /* -------------------------------------------------------------- */
    const $c1 = $('#keypointsContainer');
    const $c2 = $('#keypointsContainer2');
    let keypointIndex = 1;

    $.getJSON('/dashboard/api/services/1', res => {
        const needs = res.why_needs || [];

        if (!needs.length) {
            $c1.html('<p>No keypoints available.</p>');
            return;
        }

        needs.forEach((n, idx) => createCard(idx + 1, n, true));
        keypointIndex = needs.length + 1;
    });

    /* -------------------------------------------------------------- */
    /* 4.  Add‑new button                                             */
    /* -------------------------------------------------------------- */
    $('#addKeypointBtn').on('click', () => createCard(keypointIndex++));

    /* ==============================================================
       Helper: build a key‑point card
       ============================================================ */
    function createCard(num, data = {}, existing = false) {
        const $wrap = $(`
            <div class="keypoint-group position-relative border rounded bg-light p-4 mb-4">
                <input type="hidden" name="keypoint_id[]" value="${existing ? data.id : ''}">
                
                <div class="form-group mb-3">
                    <label>Keypoint Title ${num}</label>
                    <input type="text" class="form-control custom-input"
                           name="keypoint_title[]" value="${data.keypoint_title || ''}"
                           placeholder="Enter Keypoint Title ${num}">
                </div>

                <div class="form-group">
                    <label>Keypoint Details ${num}</label>
                    <textarea class="form-control custom-input"
                              name="keypoint_details[]"
                              rows="6"
                              placeholder="Enter Keypoint Details ${num}">${data.keypoint_details || ''}</textarea>
                </div>

                <button type="button"
                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 del-btn"
                        data-service="{{ $service->id }}"
                        data-keypoint="${existing ? data.id : ''}">
                    <i class="fa fa-trash"></i> Remove
                </button>
            </div>
        `);


        
        // attach delete handler
        $wrap.find('.del-btn').on('click', function () {
            const btn        = $(this);
            const serviceId  = btn.data('service');
            const keypointId = btn.data('keypoint');

            if (confirm('Delete this keypoint?')) {
                deleteKeypoint(serviceId, keypointId)
                    .then(() => $wrap.remove())
                    .fail(()  => alert('Failed to delete keypoint.'));
            }
        });

        // left / right column
        (num % 2 ? $c1 : $c2).append($wrap);
    }
});
</script>







