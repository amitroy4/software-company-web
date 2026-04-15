@extends('layouts.admin')
@section('title','Why Work With Us')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-header project-details-card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="project-details-card-header-title"><i class='bx bx-image bx-tada'></i>Why Work With Us Image</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="add-row"
                                            class="display table table-striped table-hover basic-datatables" role="grid"
                                            aria-describedby="add-row_info">
                                            <thead class="">
                                                <tr role="row">
                                                    <th>Sl</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">01</td>
                                                    <td>
                                                        @if($image->image)
                                                        <div style="margin-top: 15px;">
                                                            <img src="{{ asset('storage/' . $image->image) }}"
                                                                 width="60" height="60" alt="icon" style="border-radius: 8px;">
                                                        </div>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if($image->status)
                                                        <a href="{{ route('image.toggle-status', $image->id) }}"
                                                            class="badge badge-success">Active</a>
                                                        @else
                                                        <a href="{{ route('image.toggle-status', $image->id) }}"
                                                            class="badge badge-danger">Inactive</a>
                                                        @endif
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#edit-image_{{ $image->id }}"
                                                                title="edit" class="btn btn-link btn-success btn-lg">
                                                                <i class='bx bxs-edit'></i>
                                                            </a>
                                                        </div>

                                                    </td>
                                                </tr>
                                                @include('admin.why-work.partial.edit-image-modal')
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header project-details-card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="project-details-card-header-title"><i class='bx bx-carousel bx-tada'></i>Why Work With Us</h4>
                            <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal"
                                data-bs-target="#create-keypoint"><i class='bx bx-message-square-add bx-tada'></i>
                                Add Keypoint</a>
                        </div>
                    </div>
                    <!--create whyWork modal-->
                    @include('admin.why-work.partial.create-keypoint-modal')
                    <!--create whyWork modal-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="add-row"
                                            class="display table table-striped table-hover basic-datatables" role="grid"
                                            aria-describedby="add-row_info">
                                            <thead class="">
                                                <tr role="row">
                                                    <th>Sl</th>
                                                    <th>Title</th>
                                                    <th>Details</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($whyWorks as $whyWork)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">0{{ $loop->iteration }}</td>
                                                    <td>{{ $whyWork->title }}</td>
                                                    <td class="w-25">{{ $whyWork->details }}</td>
                                    
                                                    <td>
                                                        @if($whyWork->status)
                                                        <a href="{{ route('why-work.toggle-status', $whyWork->id) }}"
                                                            class="badge badge-success">Active</a>
                                                        @else
                                                        <a href="{{ route('why-work.toggle-status', $whyWork->id) }}"
                                                            class="badge badge-danger">Inactive</a>
                                                        @endif
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#edit_whyWork_{{ $whyWork->id }}"
                                                                title="edit" class="btn btn-link btn-success btn-lg">
                                                                <i class='bx bxs-edit'></i>
                                                            </a>
                                                            <a href="#" id="delete-whyWork-link"
                                                                data-whyWork-id="{{ $whyWork->id }}" title="delete"
                                                                class="btn btn-link btn-danger btn-lg"
                                                                data-original-title="Remove">
                                                                <i class='bx bx-trash-alt'></i> </a>
                                                            <form id="delete-whyWork-form-{{ $whyWork->id }}"
                                                                action="{{ route('why-work.destroy', $whyWork->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>

                                                    </td>
                                                </tr>
                                                @include('admin.why-work.partial.edit-keypoint-modal')

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
        const deleteLinks = document.querySelectorAll('[id^="delete-whyWork-link"]');

        deleteLinks.forEach(function(deleteLink) {
            deleteLink.addEventListener('click', function(e) {
                e.preventDefault();
                const whyWorkId = this.getAttribute('data-whyWork-id');
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
                        document.getElementById('delete-whyWork-form-' + whyWorkId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
