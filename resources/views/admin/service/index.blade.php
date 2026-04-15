@extends('layouts.admin')
@section('title','Service')
@section('content')
<div class="container">
    <div class="page-inner">
       <div class="row">
          <div class="col-md-12">
             <div class="card card-round">
                <div class="card-header project-details-card-header">
                   <div class="d-flex align-items-center">
                      <h4 class="project-details-card-header-title"><i class='bx bx-message-alt-edit bx-tada' ></i> Service</h4>
                      <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal" data-bs-target="#create-service-modal"><i class='bx bx-message-square-add bx-tada' ></i> Add New Service</a>
                   </div>
                </div>
                <!--create service modal-->
                @include('admin.service.create-service-modal')
                <!--create service modal-->
                <div class="card-body">
                   <div class="table-responsive">
                      <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                         <div class="row">
                            <div class="col-sm-12">
                               <table id="add-row" class="display table table-striped table-hover basic-datatables" role="grid" aria-describedby="add-row_info">
                                  <thead class="">
                                     <tr role="row">
                                        <th>Sl</th>
                                        <th>Service</th>
                                        <th>Details</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($services as $service)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">0{{ $loop->iteration }}</td>
                                        <td>{{$service->service_name}}</td>
                                        <td>{!!$service->service_details!!}</td>
                                        <td>
                                            @if($service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}"
                                                 alt="service Image"
                                                 width="72" height="72">
                                        @endif
                                        </td>
                                        <td>
                                            @if($service->status)
                                            <a href="{{ route('service.toggle-status', $service->id) }}"
                                                class="badge badge-success">Active</a>
                                            @else
                                            <a href="{{ route('service.toggle-status', $service->id) }}"
                                                class="badge badge-danger">Inactive</a>
                                            @endif
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{route('service.edit',$service->id)}}" title="edit" class="btn btn-link btn-success btn-lg">
                                                    <i class='bx bxs-edit'></i>
                                                </a>
                                                <a href="#" id="delete-service-link"
                                                    data-service-id="{{ $service->id }}" title="delete"
                                                    class="btn btn-link btn-danger btn-lg"
                                                    data-original-title="Remove">
                                                    <i class='bx bx-trash-alt'></i> </a>
                                                <form id="delete-service-form-{{ $service->id }}"
                                                    action="{{ route('service.destroy', $service->id) }}"
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
        const deleteLinks = document.querySelectorAll('[id^="delete-service-link"]');

        deleteLinks.forEach(function(deleteLink) {
            deleteLink.addEventListener('click', function(e) {
                e.preventDefault();
                const serviceId = this.getAttribute('data-service-id');
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
                        document.getElementById('delete-service-form-' + serviceId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
