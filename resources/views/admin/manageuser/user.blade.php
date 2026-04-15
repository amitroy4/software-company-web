@extends('layouts.admin')
@section('title', 'users')
@section('content')
<style>
    .select2-container{
        z-index: 99999 !important;
    }
</style>
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Manage User</h4>
                            @can('Create User')
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#adduser">
                                    <i class="fa fa-plus"></i>
                                    New User
                                </button>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal for Adding user -->
                        <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info border-0">
                                        <h5 class="modal-title">Add New user</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('manageuser.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Name <span
                                                                class="required-label">*</span></label>
                                                        <input id="name" type="text" class="form-control"
                                                            name="name" required placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">User Name</label>
                                                        <input id="username" type="text" class="form-control"
                                                            name="username" placeholder="User Name">
                                                    </div>
                                                </div>
                                                {{-- <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Phone Number</label>
                                                        <input id="phone" type="text" class="form-control"
                                                            name="phone" placeholder="Phone Number">
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Email</label>
                                                        <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                                                            required>
                                                    </div>
                                                </div> --}}
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Password</label>
                                                        <input id="password" type="password" class="form-control"
                                                            name="password" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Role</label>
                                                        <select id="role" class="form-control" name="roles[]" multiple>
                                                            <option value="">Select A Role...</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role }}">{{ $role }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label class="form-label">Status</label>
                                                        <select id="status" class="form-control" name="status">
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-danger btn-round"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-round">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal for Editing user -->
                        <div class="modal fade" id="updateuserModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info border-0">
                                        <h5 class="modal-title">Edit user</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST" id="edituserForm">
                                        @csrf
                                        @method('PUT')
                                        <!-- Use PUT for updates -->
                                        <div class="modal-body">
                                            <input type="hidden" id="edit_username" name="username" value="">
                                            <div class="form-group">
                                                <label class="form-label">Name <span
                                                        class="required-label">*</span></label>
                                                <input id="edit_name" type="text" class="form-control" name="name" placeholder="Name"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">User Name</label>
                                                <input id="edit_user_nameid" type="text" class="form-control"
                                                    name="username" placeholder="User Name">
                                            </div>
                                            {{-- <div class="form-group">
                                                <label class="form-label">Phone Number</label>
                                                <input id="edit_phone" type="text" class="form-control"
                                                    name="phone" placeholder="Phone Number">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <input id="edit_email" type="email" class="form-control" name="email" placeholder="Email" required>
                                            </div> --}}
                                            <div class="form-group">
                                                <label class="form-label">Password</label>
                                                <input id="edit_password" type="text" class="form-control"
                                                    name="password" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Role</label>
                                                <select id="edit_role" class="form-control" name="roles[]" multiple>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role }}">{{ $role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select id="edit_status" class="form-control" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div> --}}
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


                        <div class="table-responsive">
                            @can('View User')
                            <table  class="display table table-striped table-hover basic-datatables">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Roles</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username}}</td>

                                        <td>
                                            @if (!@empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $rolename)
                                                    <label class="badge badge-warning  text-white mx-1"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="{{$rolename}}">{{$rolename}}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                @if ($user->status)
                                            <a href="{{route('status.manageuser',$user->id)}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Deactive"
                                                class="btn btn-link btn-success btn-lg" >
                                                <i class='bx bxs-lock-open-alt'></i>
                                            </a>
                                            @else
                                            <a href="{{route('status.manageuser',$user->id)}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Active"
                                                class="btn btn-link btn-danger btn-lg" >
                                                <i class='bx bxs-lock-alt'></i>
                                            </a>
                                            @endif
                                            @can('Update User')
                                            <span
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Edit">
                                                <a href="#" id="edit" class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#updateuserModal" data-user-id="{{ $user->id }}"
                                                data-user-name="{{ $user->name }}"
                                                data-user-nameid="{{ $user->username }}"
                                                data-role="{{ $user->getRoleNames() }}">
                                                <i class='bx bxs-edit'></i>
                                                </a>
                                            </span>
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

@endsection

@push('scripts')
<script>

    $(document).on('click', '#edit', function () {
        const username = $(this).data('user-id');
        const userName = $(this).data('user-name');
        const userNameId = $(this).data('user-nameid');
        const userPassword = $(this).data('password');
        // const mobileNumber = $(this).data('mobile-number');
        // const whatsappNumber = $(this).data('whatsapp-number');
        // const email = $(this).data('email');
        // const status = $(this).data('status');
        const role = $(this).data('role');
        console.log(status);


        // Populate the fields in the edit modal
        $('#edit_username').val(username);
        $('#edit_name').val(userName);
        $('#edit_user_nameid').val(userNameId);
        $('#edit_password').val(userPassword);
        // $('#edit_phone').val(mobileNumber);
        // $('#edit_email').val(email);
        // $('#edit_status').val(status); // Ensure the status dropdown is correctly set
        $('#edit_role').val(role); // Ensure the status dropdown is correctly set
    });

    $('#edituserForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        // Get the form data
        const formData = $(this).serialize(); // Serializes the form's elements
        const username = $('#edit_username').val(); // Get the user ID for the URL

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `/dashboard/manageuser/${username}`,
            type: 'PUT',
            data: formData,
            success: function (response) {
                $('#updateuserModal').modal('hide');
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
                'An error occurred while updating the user. Please try again.'); // Optional user notification
            }
        });
    });

    function confirmDelete(form) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            icon: "warning",
            buttons: ["Cancel", "Yes, delete it!"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
                swal("Deleted!", "user been deleted.", "success");
            } else {
                swal("Your data is safe!");
            }
        });
    }

</script>
@endpush
