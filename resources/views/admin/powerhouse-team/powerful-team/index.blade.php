
@extends('layouts.admin')
@section('title','Member')
@push('styles')
<style>
    .rte-modern.rte-desktop.rte-toolbar-default{
            min-width: auto !important;
        }

    .title-sm {
        font-size: 13px;
        font-weight: 500;
        color: #640D5F;
        line-height: 15px;
        margin: 0;
    }

    .title-lg {
        font-size: 14px;
        font-weight: 500;
        color: #640D5F;
        line-height: 15px;
        margin: 0;
    }

    .action-btn-warning {
        display: inline-flex;
        width: 22px;
        height: 22px;
        line-height: 34px;
        text-align: center;
        border-radius: 3px;
        transition: all 0.2s ease-in-out;
        font-size: 16px;
        border: none;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 193, 7, 0.1);
        color: rgba(255, 193, 7, 0.8);
    }

    .action-btn-info {
        display: inline-flex;
        width: 22px;
        height: 22px;
        line-height: 34px;
        text-align: center;
        border-radius: 3px;
        transition: all 0.2s ease-in-out;
        font-size: 16px;
        border: none;
        align-items: center;
        justify-content: center;
        background-color: rgba(27, 132, 255, 0.1);
        color: rgba(27, 132, 255, 0.8);
    }

    .action-btn-danger {
        display: inline-flex;
        width: 22px;
        height: 22px;
        line-height: 34px;
        text-align: center;
        border-radius: 3px;
        transition: all 0.2s ease-in-out;
        font-size: 15px;
        border: none;
        align-items: center;
        justify-content: center;
        background-color: rgba(231, 13, 13, 0.1);
        color: rgba(231, 13, 13, 0.6);
    }

    .link-sm {
        font-size: 12.5px;
        font-weight: 400;
        color: #640D5F;
        line-height: 15px;
        margin: 0;
        transition: all 0.2s ease-in-out;
    }
    .link-xs {
    font-size: 12px;
    font-weight: 400;
    color: #640D5F;
    line-height: 15px;
    margin: 0;
    transition: all 0.2s ease-in-out;
}
</style>
@endpush
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                 <div class="card card-round">
                    <div class="card-header project-details-card-header p-3">
                        <div class="d-flex align-items-center pb-2">
                            <h4 class="project-details-card-header-title mb-0"><i class='bx bxs-user-check'></i>Manage Member</h4>
                            <div class="ms-auto d-flex align-items-center table-top-head">
                                <button type="button" class="purchase-button ms-auto border-0" data-bs-toggle="modal"
                                    data-bs-target="#create-member-modal">
                                    <i class="bx bxs-hand-right bx-tada me-1"></i> Add Member
                                </button>
                            </div>
                        </div>
                    </div>
                    @include('admin.powerhouse-team.powerful-team.create-modal')
                    @include('admin.powerhouse-team.powerful-team.edit-modal')
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row d-flex justify-content-end">
                                    {{-- <div class="col-md-2 mb-3">
                                        <button id="sendResetEmailsBtn" class="create-btn-info me-2">Reset Emails to All</button>
                                    </div> --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="search-member" placeholder="Search members...">
                                            <button class="btn btn-primary" id="search-btn" type="button">
                                                <i class="bx bx-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="members-container">
                                    <!-- Members will be loaded here via AJAX -->
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <ul class="pagination" id="pagination-links">
                                                <!-- Pagination links will be loaded here via AJAX -->
                                            </ul>
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
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
    // Image preview for create form
    $('#create_image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#create_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    // Image preview for edit form
    $('#edit_image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#edit_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    // Initialize form validation for create form
    $("#create-member-form").validate({
        rules: {
            name: "required",
            member_type: "required",
            member_code: "required",
            // batch: "required",
            // session: "required",
            // member_type: "required",
            // phone: "required",
            // image: "required"
        },
        messages: {
            name: "Please enter member name",
            member_type: "Please Select member Type",
            member_code: "Please enter member Id",
            // batch: "Please enter batch",
            // session: "Please enter session",
            // member_type: "Please select member type",
            // phone: "Please enter phone number",
            // image: "Please select an image"
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            submitCreateForm();
        }
    });

    // Initialize form validation for edit form
    $("#edit-member-form").validate({
        rules: {
            name: "required",
            member_type: "required",
            member_code: "required",
            // session: "required",
            // member_type: "required",
            // phone: "required"
        },
        messages: {
            name: "Please enter member name",
            member_type: "Please Select member Type",
            member_code: "Please enter member Id",
            // session: "Please enter session",
            // member_type: "Please select member type",
            // phone: "Please enter phone number"
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            submitEditForm();
        }
    });

    // Load members via AJAX
    function loadMembers(page = 1, search = '') {
        $.ajax({
            url: "{{ route('member.get') }}",
            type: 'GET',
            data: {
                page: page,
                search: search
            },
            success: function(response) {
                $('#members-container').html(response);
            }
        });
    }

    // Submit create form
    function submitCreateForm() {
        const form = $('#create-member-form')[0];
        const formData = new FormData(form);

        $.ajax({
            url: "{{ route('member.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#create-submit-btn').prop('disabled', true).html('<i class="bx bx-loader bx-spin"></i> Processing...');
            },
            complete: function() {
                $('#create-submit-btn').prop('disabled', false).html('<i class="bx bx-upload bx-flashing"></i> Create Member');
            },
            success: function(response) {
                if (response.success) {
                    $('#create-member-modal').modal('hide');
                    $('#create-member-form')[0].reset();
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        loadMembers();
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        const element = $('#create_' + key);
                        element.addClass('is-invalid');
                        element.next('.invalid-feedback').remove();
                        element.after('<span class="invalid-feedback">' + value[0] + '</span>');
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    }

    // Submit edit form
    function submitEditForm() {
        const form = $('#edit-member-form')[0];
        const formData = new FormData(form);
        const memberId = $('#edit_member_id').val();

        $.ajax({
            url: "{{ route('member.update', '') }}/" + memberId,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PUT'
            },
            beforeSend: function() {
                $('#edit-submit-btn').prop('disabled', true).html('<i class="bx bx-loader bx-spin"></i> Processing...');
            },
            complete: function() {
                $('#edit-submit-btn').prop('disabled', false).html('<i class="bx bx-upload bx-flashing"></i> Update Member');
            },
            success: function(response) {
                if (response.success) {
                    $('#edit-member-modal').modal('hide');
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        loadMembers();
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        const element = $('#edit_' + key);
                        element.addClass('is-invalid');
                        element.next('.invalid-feedback').remove();
                        element.after('<span class="invalid-feedback">' + value[0] + '</span>');
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    }

    // Edit member
    $(document).on('click', '.edit-member', function() {
        const memberId = $(this).data('id');

        $.ajax({
            url: "{{ route('member.edit', '') }}/" + memberId,
            type: 'GET',
            success: function(response) {

                $('#edit_member_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_member_code').val(response.member_code);
                $('#edit_department').val(response.department);
                $('#edit_designation').val(response.designation);
                $('#edit_dob').val(response.dob);
                $('#edit_joining_date').val(response.joining_date);
                $('#edit_gender').val(response.gender);
                $('#edit_blood_group').val(response.blood_group);
                $('#edit_phone').val(response.phone);
                $('#edit_email').val(response.email);
                $('#edit_whatsapp').val(response.whatsapp);
                $('#edit_facebook').val(response.facebook);
                $('#edit_linkedin').val(response.linkedin);
                $('#edit_github').val(response.github);
                $('#edit_address').val(response.address);
                $('#edit_about').val(response.about);
                $('#edit_image').val('');

                if (response.image) {
                    $('#edit_image_preview').attr('src', "/storage/" + response.image);
                }

                $('#edit-member-modal').modal('show');
            }
        });
    });

    // Delete member
    $(document).on('click', '.delete-member', function(e) {
        e.preventDefault();
        const memberId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('member.destroy', '') }}/" + memberId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            ).then(() => {
                                loadMembers();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Something went wrong.',
                            'error'
                        );
                    }
                });
            }
        });
    });

    // Toggle status
    $(document).on('change', '.status-toggle', function() {
        const memberId = $(this).data('id');
        const isChecked = $(this).is(':checked');

        $.ajax({
            url: "{{ route('member.status', '') }}/" + memberId,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire(
                    'Error!',
                    'Something went wrong.',
                    'error'
                );
                // Revert the toggle
                $(this).prop('checked', !isChecked);
            }
        });
    });

    // Trigger search on keyup
    $('#search-member').on('keyup', function() {
        const searchTerm = $(this).val();
        loadMembers(1, searchTerm);
    });

    // Pagination click handler
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const page = $(this).attr('href').split('page=')[1];
        const searchTerm = $('#search-member').val();
        loadMembers(page, searchTerm);
    });

    // Initial load
    loadMembers();
});
</script>
{{-- text editor start --}}
<script>
    $(document).ready(function() {
        var createEditor = null;
        var editEditor = null;

        // Initialize editor for create modal
        $('#create-member-modal').on('shown.bs.modal', function () {
            if (!createEditor) {
                setTimeout(() => {
                    createEditor = new RichTextEditor("#create_about");
                }, 100);
            }
        });

        // Destroy editor when create modal closes
        $('#create-member-modal').on('hidden.bs.modal', function () {
            if (createEditor) {
                createEditor.destroy();
                createEditor = null;
            }
        });

        // Initialize editor for edit modal
        $('#edit-member-modal').on('shown.bs.modal', function () {
            if (!editEditor) {
                setTimeout(() => {
                    editEditor = new RichTextEditor("#edit_about", {
                        height: "350px",
                        maxHeight: "400px",
                        minHeight: "200px",
                        onEditorLoad: function() {
                            // Set the content after editor is fully loaded
                            editEditor.setHTMLCode($('#edit_about').val());
                        }
                    });
                }, 100);
            } else {
                // If editor exists but modal is reopened, reset content
                editEditor.setHTMLCode($('#edit_about').val());
            }
        });

        // Destroy editor when edit modal closes
        $('#edit-member-modal').on('hidden.bs.modal', function () {
            if (editEditor) {
                editEditor.destroy();
                editEditor = null;
            }
        });

        // Before submitting the edit form, update the textarea with editor content
        $('#edit-member-form').on('submit', function() {
            if (editEditor) {
                $('#edit_about').val(editEditor.getHTMLCode());
            }
        });

        // Before submitting the create form, update the textarea with editor content
        $('#create-member-form').on('submit', function() {
            if (createEditor) {
                $('#create_about').val(createEditor.getHTMLCode());
            }
        });
    });
</script>

{{-- text editor start --}}

@endpush
