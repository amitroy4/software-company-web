@extends('layouts.admin')
@section('title', 'permissions')
@section('content')
<div class="container">
    <div class="page-inner">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Role : {{$role->name}}</h4>
                    <a href="{{route('manageuserrole.index')}}" class="btn btn-danger me-2">Back</a>
                </div>
            </div>
            <form action="{{ route('manageuserrole.givePermissionToRole',$role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row d-flex">
                        @foreach ($categories as $category)
                        <div class="col-3">
                            <div class="card bg-secondary-subtle mb-3">
                                <div class="card-header d-flex justify-content-between align-content-center bg-secondary rounded-top-3 text-light">
                                    <h3>{{$category}}</h3>
                                    <!-- Add a checkbox to control "Check All" functionality -->
                                    <div class="mt-2">
                                        <input type="checkbox" class="check-all" id="check-all-{{$category}}">
                                        <label class="text-light" for="check-all-{{$category}}">Check All</label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-sm-12">
                                        <div class="form-group p-0">
                                            @foreach ($permissions as $permission)
                                            @if (Str::contains($permission->name, $category))
                                                <div class="form-check">
                                                    <input class="form-check-input permission-checkbox" type="checkbox" id="{{$permission->id}}"
                                                        name="permission[]" value="{{$permission->name}}"
                                                        {{in_array($permission->id, $rolePermissions)? 'checked': ''}}>
                                                    <label class="form-check-label" for="{{$permission->id}}">
                                                        {{$permission->name}}
                                                    </label>
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-success btn-round me-5">Update</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // When the "Check All" checkbox is clicked
        $('.check-all').on('change', function() {
            // Get the ID of the current category checkbox
            var categoryId = $(this).attr('id');

            // Select all checkboxes inside the card body corresponding to the current category
            if ($(this).prop('checked')) {
                // Check all checkboxes inside this card's body
                $('#'+categoryId).closest('.card').find('.permission-checkbox').prop('checked', true);
            } else {
                // Uncheck all checkboxes inside this card's body
                $('#'+categoryId).closest('.card').find('.permission-checkbox').prop('checked', false);
            }
        });
    });


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
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            icon: "warning",
            buttons: ["Cancel", "Yes, delete it!"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
                swal("Deleted!", "permission been deleted.", "success");
            } else {
                swal("Your data is safe!");
            }
        });
    }

</script>
@endpush
