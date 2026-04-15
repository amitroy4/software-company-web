@extends('layouts.admin')
@section('title','Application')
@section('content')
<div class="container">
    <div class="page-inner">
       <div class="row">
          <div class="col-md-12">
             <div class="card card-round">
                <div class="card-header project-details-card-header">
                   <div class="d-flex align-items-center">
                      <h4 class="project-details-card-header-title"><i class='bx bx-data bx-tada' ></i>Application</h4>
                      <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal" data-bs-target="#create-application-modal"><i class='bx bx-message-square-add bx-tada' ></i> Add New Application</a>
                   </div>
                </div>
                <!--create application modal-->
                @include('admin.application.create-application-modal')
                <!--create application modal-->
                <div class="card-body">
                   <div class="table-responsive">
                      <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                         <div class="row">
                            <div class="col-sm-12">
                               <table id="add-row" class="display table table-striped table-hover basic-datatables" role="grid" aria-describedby="add-row_info">
                                  <thead class="">
                                     <tr role="row">
                                        <th>Sl</th>
                                        <th>Application Title</th>
                                        <th>Website Url</th>
                                        <th>Icon</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($applications as $application)
                                     <tr role="row" class="odd">
                                        <td class="sorting_1">0{{$loop->iteration}}</td>
                                        <td>{{$application->title}}</td>
                                        <td>
                                            @if($application->icon)
                                            <img src="{{ asset('storage/' . $application->icon) }}" width="96px"
                                                height="72px" alt="image">
                                            @endif
                                        </td>
                                        <td>
                                            @if($application->url)
                                            <div class="d-flex align-items-center">
                                                <span>{{ $application->url }}</span>
                                                <form action="{{ route('application.showUrl', $application->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" style="background: none; border: none; padding: 0;">
                                                        <i class="ms-3 bx bx-toggle-{{ $application->show_url ? 'right' : 'left' }} text-{{ $application->show_url ? 'success' : 'danger' }} bx-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($application->status)
                                            <a href="{{ route('application.toggle-status', $application->id) }}"
                                                class="badge badge-success">Active</a>
                                            @else
                                            <a href="{{ route('application.toggle-status', $application->id) }}"
                                                class="badge badge-danger">Inactive</a>
                                            @endif
                                        <td>
                                            <div class="form-button-action">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit_application_{{ $application->id }}"
                                                    title="edit" class="btn btn-link btn-success btn-lg">
                                                    <i class='bx bxs-edit '></i>
                                                </a>
                                                <a href="#" id="delete-application-link"
                                                    data-application-id="{{ $application->id }}" title="delete"
                                                    class="btn btn-link btn-danger btn-lg"
                                                    data-original-title="Remove">
                                                    <i class='bx bx-trash-alt'></i> </a>
                                                <form id="delete-application-form-{{ $application->id }}"
                                                    action="{{ route('application.destroy', $application->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>

                                        </td>
                                     </tr>
                                     @include('admin.application.edit-application-modal')

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
@endsection
@push('script')
<script>
    // Use event delegation to handle click events for all delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('[id^="delete-application-link"]');

        deleteLinks.forEach(function(deleteLink) {
            deleteLink.addEventListener('click', function(e) {
                e.preventDefault();
                const applicationId = this.getAttribute('data-application-id');
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
                        document.getElementById('delete-application-form-' + applicationId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
