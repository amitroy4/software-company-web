@extends('layouts.admin')
@section('title','Client')
@section('content')
<div class="container">
    <div class="page-inner">
       <div class="row">
          <div class="col-md-12">
             <div class="card card-round">
                <div class="card-header project-details-card-header">
                   <div class="d-flex align-items-center">
                      <h4 class="project-details-card-header-title"><i class='bx bxs-carousel bx-tada' ></i> Client</h4>
                      <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal" data-bs-target="#create-client-modal"><i class='bx bx-message-square-add bx-tada' ></i> Add New Client</a>
                   </div>
                </div>
                <!--create client modal-->
                @include('admin.client.create-client-modal')
                <!--create client modal-->
                <div class="card-body">
                   <div class="table-responsive">
                      <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                         <div class="row">
                            <div class="col-sm-12">
                               <table id="add-row" class="display table table-striped table-hover basic-datatables" role="grid" aria-describedby="add-row_info">
                                  <thead class="">
                                     <tr role="row">
                                        <th>Sl</th>
                                        <th>Client Name</th>
                                        <th>Website Url</th>
                                        <th>logo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($clients as $client)
                                     <tr role="row" class="odd">
                                        <td class="sorting_1">0{{$loop->iteration}}</td>
                                        <td>{{$client->name}}</td>
                                        <td>
                                            @if($client->logo)
                                            <img src="{{ asset('storage/' . $client->logo) }}" width="96px"
                                                height="72px" alt="image">
                                            @endif
                                        </td>
                                        <td>
                                            @if($client->url)
                                            <div class="d-flex align-items-center">
                                                <span>{{ $client->url }}</span>
                                                <form action="{{ route('client.showUrl', $client->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" style="background: none; border: none; padding: 0;">
                                                        <i class="ms-3 bx bx-toggle-{{ $client->show_url ? 'right' : 'left' }} text-{{ $client->show_url ? 'success' : 'danger' }} bx-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($client->status)
                                            <a href="{{ route('client.toggle-status', $client->id) }}"
                                                class="badge badge-success">Active</a>
                                            @else
                                            <a href="{{ route('client.toggle-status', $client->id) }}"
                                                class="badge badge-danger">Inactive</a>
                                            @endif
                                        <td>
                                            <div class="form-button-action">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit_client_{{ $client->id }}"
                                                    title="edit" class="btn btn-link btn-success btn-lg">
                                                    <i class='bx bxs-edit '></i>
                                                </a>
                                                <a href="#" id="delete-client-link"
                                                    data-client-id="{{ $client->id }}" title="delete"
                                                    class="btn btn-link btn-danger btn-lg"
                                                    data-original-title="Remove">
                                                    <i class='bx bx-trash-alt'></i> </a>
                                                <form id="delete-client-form-{{ $client->id }}"
                                                    action="{{ route('client.destroy', $client->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>

                                        </td>
                                     </tr>
                                     @include('admin.client.edit-client-modal')

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
        const deleteLinks = document.querySelectorAll('[id^="delete-client-link"]');

        deleteLinks.forEach(function(deleteLink) {
            deleteLink.addEventListener('click', function(e) {
                e.preventDefault();
                const clientId = this.getAttribute('data-client-id');
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
                        document.getElementById('delete-client-form-' + clientId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
