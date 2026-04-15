<div id="create-slider-modal" class="modal fade"  tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-dialog-centered " role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="project-details-card-header-title"><i class="bx bx-user-pin bx-tada bx-flip-horizontal"></i> Create FAQ</h4>
             <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('faq.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                               <label for="question">Question<span class="text-danger"> *</span></label>
                               <input type="text" class="form-control custom-input" id="question" name="question" placeholder="Enter Question" required>
                            </div>
                         </div>
                         <div class="col-sm-12">
                           <div class="form-group">
                              <label for="description">Answer<span class="text-danger"> *</span></label>
                              <textarea type="text" class="form-control" id="answer" cols="5" rows="5" name="answer" placeholder="Write Here" required></textarea>
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
