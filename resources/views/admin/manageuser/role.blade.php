@extends('layouts.admin')
@section('title', 'Roles')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">

                <!-- Modal for Editing role -->
                <div class="modal fade" id="updateroleModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info border-0">
                                <h5 class="modal-title">Edit Role</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="POST" id="editroleForm">
                                @csrf
                                @method('PUT')
                                <!-- Use PUT for updates -->
                                <div class="modal-body">
                                    <input type="hidden" id="edit_role_id" name="role_id" value="">
                                    <div class="form-group">
                                        <label class="form-label">Name <span class="required-label">*</span></label>
                                        <input id="edit_name" type="text" class="form-control" name="name"
                                            placeholder="Role Name" required>
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

                <div class="modal fade" id="addroleModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info border-0">
                                <h5 class="modal-title">Add Role</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('manageuserrole.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Role Name <span
                                                        class="required-label">*</span></label>
                                                <input id="name" type="text" class="form-control" name="name"
                                                    placeholder="Role Name" required>
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
                                <div>Manage Role</div>
                                @can('Create Role')
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addroleModal"> Add Role </a>
                                @endcan
                            </h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @can('View Role')
                                    <table id="datatable"
                                        class="display table table-striped table-hover basic-datatables">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Role</th>
                                                <th>Permission</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $index => $role)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td class=" text-center">
                                                    @can('Update Role')
                                                    <a href="{{ route('manageuserrole.addPermissionToRole', $role->id) }}"><i
                                                            class="fas fa-cogs"></i></a>
                                                    @endcan
                                                </td>
                                                <td style="width: 100px;">
                                                    <div class="form-button-action">

                                                        @can('Update Role')
                                                        <a href="#" id="edit" class="btn btn-link btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#updateroleModal"
                                                            data-role-id="{{ $role->id }}"
                                                            data-role-name="{{ $role->name }}" data-bs-toggle="tooltip"
                                                            title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        @endcan
                                                        @can('Delete Role')
                                                        <form action="{{ route('manageuserrole.destroy', $role->id) }}"
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
        const roleId = $(this).data('role-id');
        const roleName = $(this).data('role-name');
        console.log(status);


        // Populate the fields in the edit modal
        $('#edit_role_id').val(roleId);
        $('#edit_name').val(roleName);
    });

    $('#editroleForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Get the form data
        const formData = $(this).serialize(); // Serializes the form's elements

        const roleId = $('#edit_role_id').val(); // Get the role ID for the URL

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: `/dashboard/manageuserrole/${roleId}`,
            type: 'PUT',
            data: formData,
            success: function (response) {
                $('#updateroleModal').modal('hide');
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
                    'An error occurred while updating the role. Please try again.'
                ); // Optional role notification
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
                Swal.fire("Deleted!", "Role has been deleted.", "success");
            } else {
                Swal.fire("Cancelled", "Your data is safe!", "info");
            }
        });
    }

</script>
@endpush
