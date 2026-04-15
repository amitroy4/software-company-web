@extends('layouts.admin')
@section('title','Contact')
@section('content')
<div class="container">
    <div class="page-inner">
       <div class="row">
          <div class="col-md-12">
             <div class="card card-round">
                <div class="card-header project-details-card-header">
                   <div class="d-flex align-items-center">
                      <h4 class="project-details-card-header-title"><i class='bx bx-message-alt-edit bx-tada' ></i> Contact</h4>
                      <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal" data-bs-target="#create-contact-modal"><i class='bx bx-message-square-add bx-tada' ></i> Add New Contact</a>
                   </div>
                </div>
                <!--create contact modal-->
                @include('admin.contact.create-contact-modal')
                <!--create contact modal-->
                <div class="card-body">
                   <div class="table-responsive">
                      <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                         <div class="row">
                            <div class="col-sm-12">
                               <table id="add-row" class="display table table-striped table-hover basic-datatables" role="grid" aria-describedby="add-row_info">
                                  <thead class="">
                                     <tr role="row">
                                        <th>Sl</th>
                                        <th>Address</th>
                                        <th>Contact Information</th>
                                        <th>Map</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($contacts as $contact)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">0{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="fw-bold">{{ $contact->branch }}</div>
                                                    <div class="text-muted">{{ $contact->address }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled mb-0">
                                                <li><i class="bi bi-telephone-fill me-2 text-primary"></i>{{ $contact->phone }}</li>
                                                <li><i class="bi bi-whatsapp me-2 text-success"></i>{{ $contact->whatsapp }}</li>
                                                <li><i class="bi bi-envelope-fill me-2 text-danger"></i>{{ $contact->email }}</li>
                                            </ul>
                                        </td>

                                        <td>
                                            <div>{!!$contact->map!!}</div>
                                        </td>
                                        <td>
                                            @if($contact->status)
                                            <a href="{{ route('contact.toggle-status', $contact->id) }}"
                                                class="badge badge-success">Active</a>
                                            @else
                                            <a href="{{ route('contact.toggle-status', $contact->id) }}"
                                                class="badge badge-danger">Inactive</a>
                                            @endif
                                        <td>
                                            <div class="form-button-action">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit_contact_{{ $contact->id }}"
                                                    title="edit" class="btn btn-link btn-success btn-lg">
                                                    <i class='bx bxs-edit'></i>
                                                </a>
                                                <a href="#" id="delete-contact-link"
                                                    data-contact-id="{{ $contact->id }}" title="delete"
                                                    class="btn btn-link btn-danger btn-lg"
                                                    data-original-title="Remove">
                                                    <i class='bx bx-trash-alt'></i> </a>
                                                <form id="delete-contact-form-{{ $contact->id }}"
                                                    action="{{ route('contact.destroy', $contact->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                    @include('admin.contact.edit-contact-modal')

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
        const deleteLinks = document.querySelectorAll('[id^="delete-contact-link"]');

        deleteLinks.forEach(function(deleteLink) {
            deleteLink.addEventListener('click', function(e) {
                e.preventDefault();
                const contactId = this.getAttribute('data-contact-id');
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
                        document.getElementById('delete-contact-form-' + contactId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
