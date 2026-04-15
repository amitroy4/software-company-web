@extends('layouts.admin')
@section('title','Album')
@section('content')
<div class="container">

   <div class="page-inner">
      <div class="card card-round shadow-sm">
         <div class="card-header project-details-card-header p-3">
            <div class="d-flex align-items-center pb-2">
               <h4 class="project-details-card-header-title mb-0"><i class='bx bxs-buildings bx-tada'></i> Manage Albums</h4>
               <div class="ms-auto d-flex align-items-center table-top-head">
                  <button type="button" class="purchase-button ms-auto border-0" data-bs-toggle="modal" data-bs-target="#addAlbumModal">
                  <i class='bx bx-plus-circle bx-tada me-1'></i> Add New Album
                  </button>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table id="albums-table" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Album Name</th>
                        <th>Cover Image</th>
                        <th>Images</th>
                        <th>Videos</th>
                        <th class="text-center">Image/Video</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                </table>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="addAlbumModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add New Album</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form id="albumForm" enctype="multipart/form-data">
                @csrf
               <input type="hidden" name="album_id">
               <div class="mb-3">
                    <label class="form-label">Album Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control custom-input" name="name" placeholder="Enter Album name" required>
                    <div class="text-danger" id="nameError"></div>
               </div>
               <div class="mb-3">
                    <label class="form-label">Cover Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control custom-input" name="cover_image" id="cover_image" accept="image/*" required>
                    <div class="text-danger" id="cover_imageError"></div>
                    <div id="cover_image_preview" class="mt-2"></div>
                </div>
               <div class="mb-3">
                  <label class="form-label">Status</label>
                  <select class="form-select custom-input" name="status">
                     <option value="1">Active</option>
                     <option value="0">Inactive</option>
                  </select>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="cancel-button-1 btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="button" class="submit-button-1 btn btn-primary" id="createAlbum">Create Album</button>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="editAlbumModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Album</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form id="editAlbumForm" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="album_id" id="editAlbumId">
               <div class="mb-3">
                  <label class="form-label">Album Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="name" id="editName" required>
                  <div class="text-danger" id="editNameError"></div>
               </div>
               <div class="mb-3">
                  <label class="form-label">Cover Image</label>
                  <input type="file" class="form-control" name="cover_image" id="edit_cover_image" accept="image/*">
                  <div class="text-danger" id="editCoverImageError"></div>
                  <div id="edit_cover_image_preview" class="mt-2"></div>
               </div>
               <div class="mb-3">
                  <label class="form-label">Status</label>
                  <select class="form-select" name="status" id="editStatus">
                     <option value="1">Active</option>
                     <option value="0">Inactive</option>
                  </select>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="cancel-button-1 btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="button" class="submit-button-1 btn btn-primary" id="updateAlbum">Update Album</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="addImageVideoModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add Images</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form id="imageVideoForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="album_id" id="imageVideoAlbum_id">

                <div class="row">

                    <div id="existing_image_video_preview" class="row mt-3 g-2"></div>
                    <div id="image_video_preview" class="row mt-3 g-2"></div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Image/Video <span class="text-danger">*</span></label>
                        <input type="file" class="form-control custom-input" name="image_video[]" id="image_video" accept="image/*,video/*" multiple required>
                        <div class="text-danger" id="image_videoError"></div>
                    </div>

                </div>
            </form>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="addImageVideo">Add</button>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script>
   $(document).ready(function() {
      $('#cover_image').on('change', function(event) {
         const input = event.target;
         const preview = $('#cover_image_preview');
         preview.html(''); // clear previous preview

         if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileType = file.type;

            if (fileType.startsWith('image/')) {
               const reader = new FileReader();
               reader.onload = function(e) {
                  const img = $('<img>', {
                     src: e.target.result,
                     class: 'img-thumbnail',
                     width: 200
                  });
                  preview.append(img);
               };
               reader.readAsDataURL(file);
            } else {
               preview.html('<small class="text-danger">Selected file is not an image.</small>');
            }
         }
      });
   });
</script>


<script>
$(document).ready(function () {
    // Submit album form
    $('#createAlbum').click(function (e) {
        e.preventDefault();

        // Clear previous errors
        $('#nameError').text('');
        $('#cover_imageError').text('');

        let formData = new FormData($('#albumForm')[0]);

        $.ajax({
            url: "{{ route('album.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#createAlbum').prop('disabled', true).text('Creating...');
            },
            success: function (response) {
                $('#createAlbum').prop('disabled', false).text('Create Album');
                $('#albumForm')[0].reset();
                $('#cover_image_preview').html('');
                $('#addAlbumModal').modal('hide');

                $('#albums-table').DataTable().ajax.reload(null, false);

                // SweetAlert success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Album created successfully!',
                    confirmButtonColor: '#3085d6',
                });

                // Optional: refresh album list with AJAX here
            },
            error: function (xhr) {
                $('#createAlbum').prop('disabled', false).text('Create Album');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    if (errors.name) {
                        $('#nameError').text(errors.name[0]);
                    }
                    if (errors.cover_image) {
                        $('#cover_imageError').text(errors.cover_image[0]);
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please fix the form errors and try again.',
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again later.',
                    });
                }
            }
        });
    });

    // Live image preview
    $('#cover_image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#cover_image_preview').html(`<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 150px;">`);
            };
            reader.readAsDataURL(file);
        } else {
            $('#cover_image_preview').html('');
        }
    });
});
</script>

<script>
$(document).ready(function () {
    $('#albums-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('album.datatable') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'cover_image', name: 'cover_image', orderable: false, searchable: false },
            { data: 'images', name: 'images', orderable: false, searchable: false },
            { data: 'videos', name: 'videos', orderable: false, searchable: false },
            { data: 'status', name: 'status', orderable: false, searchable: false, className: 'text-center' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' },
        ]
    });

});
</script>

<script>
$(document).on('change', '.toggle-status', function (e) {
    e.preventDefault();

    const checkbox = $(this);
    const albumId = checkbox.data('id');
    const wasChecked = checkbox.prop('checked'); // true = INACTIVE, false = ACTIVE

    // Revert immediately before confirmation
    checkbox.prop('checked', !wasChecked);

    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to change the album status.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, change it',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/dashboard/album/toggle-status/${albumId}`,
                type: 'GET',
                success: function (response) {
                    // Reflect the inverted logic in checkbox
                    checkbox.prop('checked', response.status == 0); // status == 0 → checked
                    Swal.fire('Updated!', response.message, 'success');
                },
                error: function () {
                    Swal.fire('Error!', 'Failed to update status.', 'error');
                }
            });
        } else {
            // If cancelled, restore previous state
            checkbox.prop('checked', wasChecked);
        }
    });
});


$(document).on('click', '.delete-album', function (e) {
    e.preventDefault();

    let albumId = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "This album will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/dashboard/album/destroy/${albumId}`,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire('Deleted!', response.message, 'success');
                    $('#albums-table').DataTable().ajax.reload(null, false); // reload without reset pagination
                },
                error: function (xhr) {
                    if (xhr.status === 403 || xhr.status === 409) {
                        Swal.fire('Blocked', xhr.responseJSON.message, 'error');
                    } else {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                }
            });
        }
    });
});




$(document).on('click', '.edit-album', function (e) {
    e.preventDefault();
    let albumId = $(this).data('id');

    $.ajax({
        url: `/dashboard/album/${albumId}/edit`,
        type: 'GET',
        success: function (response) {
            // Set values in the modal form
            $('#editAlbumId').val(response.id);
            $('#editName').val(response.name);
            $('#editStatus').val(response.status);

            if (response.cover_image_url) {
                $('#edit_cover_image_preview').html(`
                    <img src="${response.cover_image_url}" class="img-fluid rounded" style="max-height: 150px;">
                `);
            } else {
                $('#edit_cover_image_preview').html('');
            }

            // Show the modal
            $('#editAlbumModal').modal('show');
        },
        error: function (xhr) {
            alert('Failed to fetch album data.');
        }
    });
});


$(document).ready(function () {
    $('#edit_cover_image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#edit_cover_image_preview').html(`<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 150px;">`);
            };
            reader.readAsDataURL(file);
        } else {
            $('#edit_cover_image_preview').html('');
        }
    });

});


$(document).on('click', '#updateAlbum', function () {
    let form = $('#editAlbumForm')[0];
    let formData = new FormData(form);

    // Get album ID from hidden input
    let albumId = $('#editAlbumId').val();

    // Clear previous errors
    $('#editNameError').text('');
    $('#editCoverImageError').text('');

    $.ajax({
        url: `/dashboard/album/update/${albumId}`,  // use PUT route with ID
        method: 'POST',   // We'll spoof PUT via form data
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        beforeSend: function () {
            // Spoof PUT method for Laravel
            formData.append('_method', 'PUT');
        },
        success: function (response) {
            $.notify(response.message, 'success');
            $('#editAlbumModal').modal('hide');
            $('#albums-table').DataTable().ajax.reload(null, false);
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                if (errors.name) $('#editNameError').text(errors.name[0]);
                if (errors.cover_image) $('#editCoverImageError').text(errors.cover_image[0]);
            } else {
                $.notify('Something went wrong. Please try again.', 'error');
                // alert('Something went wrong. Please try again.');
            }
        }
    });
});

</script>

<script>
let selectedFiles = [];

// Open modal: reset input & preview
$(document).on('click', '.add-image-video', function (e) {
    e.preventDefault();
    let albumId = $(this).data('id');
    $('#imageVideoAlbum_id').val(albumId);

    // Reset input & preview
    $('#image_video').val('');
    $('#image_video_preview').html('');
    selectedFiles = [];

    // Clear errors
    $('#yearError').text('');
    $('#batchError').text('');
    $('#image_videoError').text('');

    $.ajax({
        url: `/dashboard/album/get/image-video/${albumId}`,
        type: 'GET',
        success: function (response) {
            $('#addImageVideoModal').modal('show');
            $('#existing_image_video_preview').html(''); // Clear old previews

            if (response.files && Array.isArray(response.files)) {
                const latestFile = response.files[response.files.length - 1]; // get the last (latest) file

                if (latestFile.year) {
                    $('#year').val(latestFile.year);
                }

                if (latestFile.batch) {
                    $('#batch').val(latestFile.batch);
                }

                response.files.forEach((file) => {
                    const fileUrl = "{{ asset('storage') }}/" + file.file_path; // should be a full URL or relative path
                    const isImage = file.type === 'image';
                    const isVideo = file.type === 'video';

                    const preview = `
                        <div class="col-md-3 file-preview">
                            <div class="card position-relative">
                                ${isImage ? `<img src="${fileUrl}" class="card-img-top" alt="Image">` : ''}
                                ${isVideo ? `<video src="${fileUrl}" class="card-img-top" controls muted></video>` : ''}
                                <button type="button" class="btn-close position-absolute top-0 end-0 m-1 delete-preview" aria-label="Remove" data-id="${file.id}"></button>
                            </div>
                        </div>
                    `;

                    $('#existing_image_video_preview').append(preview);
                });
            }else{
                $('#year').val('');
                $('#batch').val('');
            }
        },
        error: function (xhr) {
            alert('Failed to fetch album data.');
        }

    });



});

// File selection: accumulate new files into selectedFiles[]
$('#image_video').on('change', function (e) {
    const newFiles = Array.from(e.target.files);

    // Add new files to existing
    newFiles.forEach(file => selectedFiles.push(file));

    const previewContainer = $('#image_video_preview');
    previewContainer.html(''); // Clear and re-render everything

    selectedFiles.forEach((file, index) => {
        const fileURL = URL.createObjectURL(file);
        const isImage = file.type.startsWith('image/');
        const isVideo = file.type.startsWith('video/');

        let preview = `
            <div class="col-md-3">
                <div class="card position-relative">
                    ${isImage ? `<img src="${fileURL}" class="card-img-top" alt="Image">` : ''}
                    ${isVideo ? `<video src="${fileURL}" class="card-img-top" controls muted></video>` : ''}
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-1 remove-preview" aria-label="Remove" data-index="${index}"></button>
                </div>
            </div>
        `;
        previewContainer.append(preview);
    });

    // Rebuild file input with updated file list
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    $('#image_video')[0].files = dataTransfer.files;
});

// Remove file from selectedFiles[] and re-render preview
$(document).on('click', '.remove-preview', function () {
    const indexToRemove = $(this).data('index');

    selectedFiles.splice(indexToRemove, 1);

    const previewContainer = $('#image_video_preview');
    previewContainer.html('');

    selectedFiles.forEach((file, index) => {
        const fileURL = URL.createObjectURL(file);
        const isImage = file.type.startsWith('image/');
        const isVideo = file.type.startsWith('video/');

        let preview = `
            <div class="col-md-3">
                <div class="card position-relative">
                    ${isImage ? `<img src="${fileURL}" class="card-img-top" alt="Image">` : ''}
                    ${isVideo ? `<video src="${fileURL}" class="card-img-top" controls muted></video>` : ''}
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-1 remove-preview" aria-label="Remove" data-index="${index}"></button>
                </div>
            </div>
        `;
        previewContainer.append(preview);
    });



    // Rebuild file input after removal
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    $('#image_video')[0].files = dataTransfer.files;
});
</script>


<script>
$('#addImageVideo').on('click', function (e) {
    e.preventDefault();

    // Clear previous error messages
    $('#yearError').text('');
    $('#batchError').text('');
    $('#image_videoError').text('');

    let form = $('#imageVideoForm')[0];
    let formData = new FormData(form);

    $.ajax({
        url: "{{ route('album.imageVideo.store') }}",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#addImageVideo').prop('disabled', true).text('Uploading...');
        },
        success: function (response) {
            $('#addImageVideo').prop('disabled', false).text('Add');
            $('#addImageVideoModal').modal('hide');
            $('#imageVideoForm')[0].reset();
            $('#image_video_preview').html('');
            selectedFiles = [];
            $('#albums-table').DataTable().ajax.reload(null, false);
            $.notify(response.message, 'success');

            $('#yearError').text('');
            $('#batchError').text('');
            $('#image_videoError').text('');
        },
        error: function (xhr) {
            $('#addImageVideo').prop('disabled', false).text('Add');

            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;

                if (errors.year) {
                    $('#yearError').text(errors.year[0]);
                }
                if (errors.batch) {
                    $('#batchError').text(errors.batch[0]);
                }
                if (errors['image_video.0']) {
                    $('#image_videoError').text(errors['image_video.0'][0]);
                }
            }else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again later.',
                });
            }
        }
    });
});

</script>


<script>

$(document).on('click', '.delete-preview', function (e) {
    e.preventDefault();

    let button = $(this);
    let fileId = button.data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/dashboard/album/image-video/delete/${fileId}`,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        $('#albums-table').DataTable().ajax.reload(null, false);
                        // Remove the preview card
                        button.closest('.file-preview').remove();

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Failed!',
                            response.message || 'Something went wrong.',
                            'error'
                        );
                    }
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Failed to delete. Please try again.',
                        'error'
                    );
                }
            });
        }
    });
});

</script>

@endpush
