@extends('layouts.admin')
@section('title','Career')
@section('content')
<div class="container">
    <div class="page-inner">
       <div class="row">
          <div class="col-md-12">
             <div class="card card-round">
                <div class="card-header project-details-card-header">
                   <div class="d-flex align-items-center">
                      <h4 class="project-details-card-header-title"><i class='bx bx-message-alt-edit bx-tada' ></i> Career</h4>
                      <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal" data-bs-target="#create-career-modal"><i class='bx bx-message-square-add bx-tada' ></i> Add New Career</a>
                   </div>
                </div>
                <!--create Career modal-->
                @include('admin.career.create-modal')
                <!--create Career modal-->
                <div class="card-body">
                   <div class="table-responsive">
                      <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                         <div class="row">
                            <div class="col-sm-12">
                               <table id="add-row" class="display table table-striped table-hover basic-datatables" role="grid" aria-describedby="add-row_info">
                                  <thead class="">
                                     <tr role="row">
                                        <th>Sl</th>
                                        <th>Career Title</th>
                                        <!-- <th>Details</th>
                                        <th>Key Features</th> -->
                                        <th>Applied</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($careers as $career)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">0{{ $loop->iteration }}</td>
                                        <td>{{$career->title}}</td>
                                        {{--
                                        <td>{!!$service->description!!}</td>
                                        <td>
                                            <ul>
                                                @if($service->key_features)
                                                    @foreach(json_decode($service->key_features, true) as $feature)
                                                        <li>{{ $feature }}</li>
                                                    @endforeach
                                                @else
                                                    <li>No features available</li>
                                                @endif
                                            </ul>
                                        </td>
                                        --}}
                                        <td>{{ $career->applications->count() }}</td>
                                       <td>
                                            @if($career->status == 1)
                                                <a href="{{ route('career.toggle-status', $career->id) }}"
                                                class="badge badge-success">Active</a>
                                            @elseif($career->status == 0)
                                                <a href="{{ route('career.toggle-status', $career->id) }}"
                                                class="badge badge-danger">Inactive</a>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="form-button-action">
                                                <a href="#"
                                                class="btn btn-link btn-success btn-lg edit-career-btn" title="Edit"
                                                data-id="{{ $career->id }}"
                                                data-title="{{ $career->title }}"
                                                data-description="{{ $career->description }}"
                                                data-vacancy="{{ $career->vacancy }}"
                                                data-location="{{ $career->location }}"
                                                data-publish_date="{{ $career->publish_date }}"
                                                data-deadline="{{ $career->deadline }}"
                                                data-company_name="{{ $career->company_name }}"
                                                data-email="{{ $career->email }}"
                                                data-phone="{{ $career->phone }}"
                                                data-responsibilities='@json($career->responsibilities ? json_decode($career->responsibilities) : [])'
                                                data-requirements='@json($career->requirements ? json_decode($career->requirements) : [])'
                                                data-image='{{ $career->image }}'
                                                data-logo="{{ $career->logo }}">
                                                    <i class="bx bxs-edit"></i>
                                                </a>

                                                <a href="#" id="delete-career-link"
                                                data-career-id="{{ $career->id }}" title="delete"
                                                class="btn btn-link btn-danger btn-lg"
                                                data-original-title="Remove">
                                                    <i class='bx bx-trash-alt'></i>
                                                </a>
                                                <form id="delete-career-form-{{ $career->id }}"
                                                    action="{{ route('career.destroy', $career->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>


                                                <a class="btn btn-link btn-warning btn-lg" title="Applicants" href="{{ route('career.applications', $career->id) }}"><i class='bx bx-list-ul'></i></a>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                  </tbody>
                               </table>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

 @include('admin.career.edit-modal')
@endsection






@push('script')


<script>
$(document).on("click", ".edit-career-btn", function(e){
    e.preventDefault();

    let id            = $(this).data("id");
    let title         = $(this).data("title");
    let description   = $(this).data("description");
    let vacancy       = $(this).data("vacancy");
    let location      = $(this).data("location");
    let publish_date  = $(this).data("publish_date");
    let deadline      = $(this).data("deadline");
    let company_name  = $(this).data("company_name");
    let email         = $(this).data("email");
    let phone         = $(this).data("phone");
    let responsibilities = $(this).data("responsibilities"); // JSON array
    let requirements     = $(this).data("requirements");     // JSON array
    let image         = $(this).data("image");
    let logo          = $(this).data("logo");

    // form action
    $("#editCareerForm").attr("action", "/dashboard/career/update/" + id);

    // input fields
    $("#edit_title").val(title);
    $("#edit_vacancy").val(vacancy);
    $("#edit_location").val(location);
    $("#edit_publish_date").val(publish_date);
    $("#edit_deadline").val(deadline);
    $("#edit_company_name").val(company_name);
    $("#edit_email").val(email);
    $("#edit_phone").val(phone);

    // Image preview
    if(image){
        $("#edit_image_preview").attr("src", "/storage/" + image);
    }

    // Logo preview
    if(logo){
        $("#edit_logo_preview").attr("src", "/storage/" + logo);
    }

    // Responsibilities
    $("#edit_item-wrapper1").html('');
    if(responsibilities && responsibilities.length > 0){
        responsibilities.forEach(function(item){
            let html = `<div class="edit_item-input1 d-flex gap-2 mb-2">
                            <input type="text" name="responsibilities[]" class="form-control custom-input" value="${item}" required>
                            <button type="button" class="btn btn-danger btn-sm edit_remove-btn">Remove</button>
                        </div>`;
            $("#edit_item-wrapper1").append(html);
        });
    }

    // Requirements
    $("#edit_item-wrapper2").html('');
    if(requirements && requirements.length > 0){
        requirements.forEach(function(item){
            let html = `<div class="edit_item-input2 d-flex gap-2 mb-2">
                            <input type="text" name="requirements[]" class="form-control custom-input" value="${item}" required>
                            <button type="button" class="btn btn-danger btn-sm edit_remove-btn2">Remove</button>
                        </div>`;
            $("#edit_item-wrapper2").append(html);
        });
    }

    // Summernote initialize & set description
    $('#edit_description').summernote({
        height: 200
    });
    $('#edit_description').summernote('code', description);

    // modal show
    $("#edit-career-modal").modal("show");
});

// Add responsibility dynamically
$(document).on('click', '#edit_add-item1', function(){
    let html = `<div class="edit_item-input1 d-flex gap-2 mb-2">
                    <input type="text" name="responsibilities[]" class="form-control custom-input" placeholder="Enter item" required>
                    <button type="button" class="btn btn-danger btn-sm edit_remove-btn">Remove</button>
                </div>`;
    $("#edit_item-wrapper1").append(html);
});

// Add requirement dynamically
$(document).on('click', '#edit_add-item2', function(){
    let html = `<div class="edit_item-input2 d-flex gap-2 mb-2">
                    <input type="text" name="requirements[]" class="form-control custom-input" placeholder="Enter item" required>
                    <button type="button" class="btn btn-danger btn-sm edit_remove-btn2">Remove</button>
                </div>`;
    $("#edit_item-wrapper2").append(html);
});

// Remove responsibility
$(document).on('click', '.edit_remove-btn', function(){
    $(this).closest('.edit_item-input1').remove();
});

// Remove requirement
$(document).on('click', '.edit_remove-btn2', function(){
    $(this).closest('.edit_item-input2').remove();
});

// Preview new image before upload
$('#edit_image').on('change', function(){
    let file = this.files[0];
    if(file){
        let reader = new FileReader();
        reader.onload = function(e){
            $('#edit_image_preview').attr("src", e.target.result);
        }
        reader.readAsDataURL(file);
    }
});

// Preview new logo before upload
$('#edit_logo').on('change', function(){
    let file = this.files[0];
    if(file){
        let reader = new FileReader();
        reader.onload = function(e){
            $('#edit_logo_preview').attr("src", e.target.result);
        }
        reader.readAsDataURL(file);
    }
});
</script>



<script>
    // Use event delegation to handle click events for all delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('[id^="delete-career-link"]');

        deleteLinks.forEach(function(deleteLink) {
            deleteLink.addEventListener('click', function(e) {
                e.preventDefault();
                const careerId = this.getAttribute('data-career-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this action!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, find the form and submit it
                        document.getElementById('delete-career-form-' + careerId).submit();
                    }
                });
            });
        });
    });
</script>

@endpush
