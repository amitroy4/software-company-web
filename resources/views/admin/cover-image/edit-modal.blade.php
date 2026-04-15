<div class="modal fade" id="updateCoverImageModal" tabindex="-1" aria-labelledby="updateCoverImageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateCoverImageModalLabel">Update Cover Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateImageForm"  method="POST" enctype="multipart/form-data">
          
          <input type="hidden" name="hiddenId" id="hiddenId">
          <div class="mb-3">
            <label for="coverImageFile" class="form-label">Choose New Image</label>
            <input class="form-control" type="file" id="coverImageFile" name="cover_image" required>
          </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="updateImageForm" class="btn btn-success">Update</button>
      </div>
    </div>
  </div>
</div>