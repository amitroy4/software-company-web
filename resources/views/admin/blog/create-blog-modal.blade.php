<div id="create-blog-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="card modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-user-pin bx-tada bx-flip-horizontal"></i>
                    Create Blog</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" id="createBlogForm">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="title">Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input" name="title" id="title"
                                        placeholder="Title">
                                </div>
                            </div>
                            <!-- Category Select input -->
                            <div class="col-md-6 mb-7">
                                <div class="form-group">
                                    <label for="blog_category_id" class="form-label">Blog Category<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="blog_category_id" name="blog_category_id" required>
                                        <option value="">Select a Category</option>
                                        @foreach($blogCategories as $blogCategory)
                                            @if($blogCategory->name)
                                                <option value="{{ $blogCategory->id }}">{{ $blogCategory->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('blog_category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control custom-input" id="author" name="author"
                                        placeholder="Author">
                                    @error('author') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control custom-input" id="date" name="date"
                                        placeholder="Date">
                                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="blog_url">Blog Link</label>
                                    <input type="url" class="form-control custom-input" id="blog_url" name="blog_url"
                                        placeholder="Date">
                                    @error('blog_url') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tag">Tag</label>
                                    <input type="text" class="form-control custom-input tagsinput" name="tags" id="tag"
                                        placeholder="Enter new tag">
                                    @error('tags') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="description">Description<span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control summernote" name="description"
                                        id="description" placeholder="Write Here" required></textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 image">
                                <div class="form-group">
                                    <label for="image">Image<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control mb-5" id="image" name="image" required
                                        accept="image/png, image/jpeg, image/jpg, image/gif">
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    <br>
                                    <div class="image-preview-wrapper position-relative d-inline-block"
                                        style="width: 96px; height: 72px;">
                                        <img class="border" id="image_preview"
                                            src="{{ asset('admin/assets/gallery.jpg') }}" width="96px" height="72px"
                                            alt="image">

                                        <button type="button" class="btn btn-sm btn-danger remove-image-btn"
                                            title="Remove Image">
                                            &times;
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="modal-button-box">
                        <button type="button" class="cancel-button-1" data-bs-dismiss="modal">
                            <i class='bx bx-x bx-flashing'></i> Cancel
                        </button>
                        <button type="button" id="submitCreateBlog" class="submit-button-1">
                            <i class='bx bx-upload bx-flashing'></i> Save
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@push('script')
    <script>
        $(document).ready(function () {
            $('#submitCreateBlog').on('click', function (e) {
                e.preventDefault(); // prevent default form submission
                let isValid = true;
                let firstInvalidField = null;
                $('#createBlogForm .is-invalid').removeClass('is-invalid');
                $('#description-error').addClass('d-none');
                $('.note-editor').removeClass('is-invalid');
                const requiredFields = [
                    '#title',
                    '#blog_category_id',
                    '#date'
                ];
                requiredFields.forEach(function (selector) {
                    const field = $(selector);
                    if (!field.val().trim()) {
                        field.addClass('is-invalid');
                        if (!firstInvalidField) firstInvalidField = field;
                        isValid = false;
                    }
                });
                const descriptionContent = $('#description').summernote('code').replace(/<[^>]*>/g, '').trim();
                if (descriptionContent === '') {
                    $('.note-editor').addClass('is-invalid');
                    $('#description-error').removeClass('d-none');
                    if (!firstInvalidField) firstInvalidField = $('.note-editor');
                    isValid = false;
                }
                if (!isValid) {
                    $('html, body').animate({
                        scrollTop: firstInvalidField.offset().top - 100
                    }, 400);
                    if (firstInvalidField.hasClass('note-editor')) {
                        $('.note-editable').focus();
                    } else {
                        firstInvalidField.focus();
                    }
                    return false; // prevent form submission
                }
                $('#createBlogForm').submit();
            });
            $('#createBlogForm').on('input change', 'input, select', function () {
                if ($(this).val().trim() !== '') {
                    $(this).removeClass('is-invalid');
                }
            });
            $('#description').on('summernote.change', function () {
                const content = $('#description').summernote('code').replace(/<[^>]*>/g, '').trim();
                if (content !== '') {
                    $('.note-editor').removeClass('is-invalid');
                    $('#description-error').addClass('d-none');
                }
            });
        });
        // Handle image removal
        $('.remove-image-btn').on('click', function () {
            $('#image_preview').attr('src', "{{ asset('admin/assets/gallery.jpg') }}");
            $('#image').val('');
        });

    </script>
@endpush
@push('styles')
    <style>
        /* for validation */
        .is-invalid {
            border: 1px solid #dc3545 !important;
            background-color: #fff0f0;
        }

        /* for image */
        .image-preview-wrapper {
            position: relative;
        }

        .remove-image-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 14px;
            width: 24px;
            height: 24px;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 0;
            z-index: 10;
        }

        .image-preview-wrapper:hover .remove-image-btn {
            display: flex;
            cursor: pointer;
        }
    </style>
@endpush