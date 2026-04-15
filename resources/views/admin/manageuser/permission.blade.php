@extends('layouts.admin')
@section('title', 'permissions')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">

                <!-- Modal for Editing permission -->
                <div class="modal fade" id="updatepermissionModal" tabindex="-1" permission="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" permission="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info border-0">
                                <h5 class="modal-title">Edit Permission</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="POST" id="editpermissionForm">
                                @csrf
                                @method('PUT')
                                <!-- Use PUT for updates -->
                                <div class="modal-body">
                                    <input type="hidden" id="edit_permission_id" name="permission_id" value="">
                                    <div class="form-group">
                                        <label class="form-label">Name <span class="required-label">*</span></label>
                                        <input id="edit_name" type="text" class="form-control" name="name"
                                            placeholder="permission Name" required>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-danger btn-round"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-round">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addpermissionModal" tabindex="-1" permission="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" permission="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info border-0">
                                <h5 class="modal-title">Add Permission</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('permission.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Permission Name <span
                                                        class="required-label">*</span></label>
                                                <input id="name" type="text" class="form-control" name="name"
                                                    placeholder="Permission Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="submit" class="btn btn-success btn-round">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-around align-items-center">

                    <div class="col-6">
                        <div class="card">
                            <h5 class="card-header d-flex justify-content-between">
                                <div>Manage Permission</div>

                                @can('Create Permission')
                                <a href="#" id="edit" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#addpermissionModal">
                                    Add Permission
                                </a>
                                @endcan
                            </h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @can('View Permission')
                                    <table id="datatable"
                                        class="display table table-striped table-hover basic-datatables">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>permission</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($permissions as $index => $permission)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td style="width: 100px;">
                                                    <div class="form-button-action">

                                                        @can('Update Permission')
                                                        <a href="#" id="edit" class="btn btn-link btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updatepermissionModal"
                                                            data-permission-id="{{ $permission->id }}"
                                                            data-permission-name="{{ $permission->name }}"
                                                            data-bs-toggle="tooltip" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        @endcan
                                                        @can('Delete Permission')
                                                        <form
                                                            action="{{ route('permission.destroy', $permission->id) }}"
                                                            method="POST" style="display: inline-block;"
                                                            onsubmit="event.preventDefault(); confirmDelete(this);">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link btn-danger"
                                                                data-bs-toggle="tooltip" title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endcan
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

@push('scripts')
<script>
    $(document).on('click', '#edit', function () {
        const permissionId = $(this).data('permission-id');
        const permissionName = $(this).data('permission-name');
        console.log(status);


        // Populate the fields in the edit modal
        $('#edit_permission_id').val(permissionId);
        $('#edit_name').val(permissionName);
    });

    $('#editpermissionForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Get the form data
        const formData = $(this).serialize(); // Serializes the form's elements

        const permissionId = $('#edit_permission_id').val(); // Get the permission ID for the URL

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: `/dashboard/permission/${permissionId}`,
            type: 'PUT',
            data: formData,
            success: function (response) {
                $('#updatepermissionModal').modal('hide');
                location.reload();
                $.notify({
                    // Options
                    message: '{{ session('
                    success ') }}'
                });
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert(
                    'An error occurred while updating the permission. Please try again.'
                ); // Optional permission notification
            }
        });
    });

    function confirmDelete(form) {
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire("Deleted!", "Permission has been deleted.", "success");
            } else {
                Swal.fire("Cancelled", "Your data is safe!", "info");
            }
        });
    }

</script>
@endpush
