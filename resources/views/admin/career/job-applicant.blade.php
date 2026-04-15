@extends('layouts.admin')
@section('title','Job Applications')
@section('content')
<div class="container">
    <div class="page-inner">
       <div class="row">
          <div class="col-md-12">
             <div class="card card-round">
                <div class="card-header project-details-card-header">
                   <div class="d-flex align-items-center">
                      <h4 class="project-details-card-header-title"><i class='bx bx-message-alt-edit bx-tada' ></i> Career</h4>
                      <a href="#" class=" ms-auto" ><h1>{{ $career->title }}</h1> </a>
                   </div>
                </div>

                <div class="card-body">
                   <div class="table-responsive">
                      <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                         <div class="row">
                            <div class="col-sm-12">
                               <table id="add-row" class="display table table-striped table-hover basic-datatables" role="grid" aria-describedby="add-row_info">
                                  <thead class="">
                                     <tr role="row">
                                        <th>Sl</th>
                                        <th>Applicant Name</th>
                                        <th width="50%">Cover Letter</th>
                                        <th>Phone</th>
                                        <th>CV</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($career->applications as $application)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">0{{ $loop->iteration }}</td>
                                        <td>{{$application->name}}</td>

                                       <td>{{$application->cover_letter}}</td>
                                        <td>{{$application->phone?? ''}} <br>
                                        {{$application->email?? ''}}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $application->cv) }}" title="View CV"
                                                class=""
                                                target="_blank"> <i class="bx bx-show"></i>
                                            </a>

                                            <a href="{{ asset('storage/' . $application->cv) }}" title="Download CV"
                                            class="ms-2"
                                            download="{{ $application->name }}_CV"><i class="bx bx-download text-warning"></i>
                                            </a>


                                        </td>

                                        <td>
                                            <div class="form-button-action">


                                                <a href="#" id="delete-application-link"
                                                data-application-id="{{ $application->id }}" title="Delete"
                                                class="btn btn-link btn-danger btn-lg"
                                                data-original-title="Remove">
                                                    <i class='bx bx-trash-alt'></i>
                                                </a>
                                                <form id="delete-application-form-{{ $application->id }}"
                                                    action="{{ route('career.application.destroy', [$application->id, $career->id]) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
