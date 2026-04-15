
<!-- Stylish View Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title fw-bold" id="messageModalLabel">
          <i class='bx bx-envelope'></i> Message Details
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-4 bg-light">
        <div class="row mb-3">
          <div class="col-md-6">
            <h6 class="text-muted mb-1">Sender Name</h6>
            <p class="fw-semibold fs-6 text-dark" id="modalName"></p>
          </div>
          <div class="col-md-6">
            <h6 class="text-muted mb-1">Phone</h6>
            <p class="fw-semibold fs-6 text-dark" id="modalPhone"></p>
          </div>
          <div class="col-md-6">
            <h6 class="text-muted mb-1">Email</h6>
            <p class="fw-semibold fs-6 text-dark" id="modalEmail"></p>
          </div>
          <div class="col-md-6">
            <h6 class="text-muted mb-1">Service</h6>
            <p class="fw-semibold fs-6 text-dark" id="modalService"></p>
          </div>
          <div class="col-md-6">
            <h6 class="text-muted mb-1">Subject</h6>
            <p class="fw-semibold fs-6 text-dark" id="modalSubject"></p>
          </div>
        </div>

        <div>
          <h6 class="text-muted mb-1">Message</h6>
          <div class="p-3 bg-white rounded-3 border border-secondary-subtle">
            <p class="text-dark" id="modalMessage" style="white-space: pre-wrap;"></p>
          </div>
        </div>
      </div>

      <div class="modal-footer bg-light border-0 rounded-bottom-4">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class='bx bx-x'></i> Close
        </button>
      </div>
    </div>
  </div>
</div>

