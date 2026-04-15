@extends('layouts.admin')

@section('title', 'Cover Image')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card card-round">
            <div class="card-header">
                <h4><i class="bx bx-carousel bx-tada"></i> Cover Image</h4>
            </div>
            <div class="card-body">
                <div id="coverImageTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="coverImageTable_length"><label>Show <select name="coverImageTable_length" aria-controls="coverImageTable" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="coverImageTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="coverImageTable"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="coverImageTable" class="table table-bordered dataTable no-footer" role="grid" aria-describedby="coverImageTable_info" style="width: 1358px;">
                    <thead>
                        <tr role="row"><th class="sorting_asc" rowspan="1" colspan="1" aria-label="SL" style="width: 69.0943px;">SL</th><th class="sorting" tabindex="0" aria-controls="coverImageTable" rowspan="1" colspan="1" aria-label="Menu Name: activate to sort column ascending" style="width: 264.094px;">Menu Name</th><th class="text-center w-50 sorting_disabled" rowspan="1" colspan="1" aria-label="Cover Image" style="width: 657.094px;">Cover Image</th><th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Status" style="width: 135.094px;">Status</th><th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 129px;">Action</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($coverImages as $index => $item)
                            <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                <td class="sorting_1">{{ $index + 1 }}</td>
                                <td>{{ ucwords(str_replace('_', ' ', $item->page_name)) }}</td>
                                <td>
                                    @if ($item->cover_image)
                                        <img src="{{ asset('storage/' . $item->cover_image) }}" width="100%" height="90px" class="border border-1 border-black rounded" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-center">
                                        <a href="javascript:void(0)" class="badge {{ $item->status ? 'badge-success' : 'badge-danger' }} toggle-status" data-id="{{ $item->id }}">
                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-info btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#updateCoverImageModal" data-id="{{ $item->id }}" title="Edit">
                                            <i class="bx bxs-edit"></i>
                                        </a>

                                    </div>


                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>



                                </table><div id="coverImageTable_processing" class="dataTables_processing card" style="display: none;">Processing...</div></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="coverImageTable_info" role="status" aria-live="polite">Showing 1 to 9 of 9 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="coverImageTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="coverImageTable_previous"><a href="#" aria-controls="coverImageTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="coverImageTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="coverImageTable_next"><a href="#" aria-controls="coverImageTable" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

@include('admin.cover-image.edit-modal')




<script>
console.log("Ahasan");

</script>
<!-- jQuery (add this before your scripts) -->
<!-- jQuery (first) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js (for Bootstrap dropdowns/modals) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>






<script>
$(document).ready(function () {
    $('#updateCoverImageModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            console.log(`Modal triggered with ID: ${id}`);
            $('#hiddenId').val(id);
    });




    $('#updateImageForm').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this); // Get form with file and hidden ID

        $.ajax({
            url: "/dashboard/cover-image/update",
            type: 'POST',
            data: formData,
            processData: false, // Required for FormData
            contentType: false, // Required for FormData
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#updateCoverImageModal').modal('hide');
                // Clear form fields
                $('#updateImageForm')[0].reset();  // Resets all form fields
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Cover image updated successfully!',
                    timer: 2000,
                    showConfirmButton: false,
                }).then(() => {
                    location.reload();
                });
            },
            error: function (xhr) {
                // Handle error
                alert('Failed to update cover image.');
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

@endsection


