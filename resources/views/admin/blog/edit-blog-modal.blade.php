<div id="edit_blog_{{ $blog->id }}" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog-centered modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title"><i class="bx bx-edit bx-tada"></i> Edit Blog</h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control custom-input" id="title" name="title"
                                        value="{{ old('title', $blog->title) }}" placeholder="Title">
                                </div>
                            </div>
                            <!-- Category Select input -->
                            <div class="col-md-6 mb-7">
                                <div class="form-group">
                                    <label for="blog_category_id" class="form-label">Blog Category<span class="text-danger">*</span></label>
                                    <select class="form-control" id="blog_category_id" name="blog_category_id" required>
                                        <option value="">Select a Category</option>
                                        @foreach($blogCategories as $category)
                                        <option value="{{ $category->id }}" {{ old('blog_category_id',$blog->blog_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('blog_category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control custom-input" id="author" name="author" value="{{ old('author', $blog->author) }}"
                                        placeholder="Author">
                                    @error('author') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control custom-input" id="date" name="date"
                                        value="{{ old('date', $blog->date) }}" placeholder="Date">
                                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="blog_url">Blog Link</label>
                                    <input type="url" class="form-control custom-input" id="blog_url" name="blog_url"
                                        value="{{ old('blog_url', $blog->blog_url) }}" placeholder="Blog link">
                                    @error('blog_url') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tag">Tag</label>
                                    <input type="text" class="form-control custom-input tagsinput" value="{{ old('tags', $blog->tags) }}" name="tags" id="tag"
                                        placeholder="Enter new tag">
                                    @error('tags') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="description">Description<span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control summernote" id="description"
                                        name="description" placeholder="Write Here" required>{{$blog->description}} </textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 image">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control mb-3 edit_image" name="image"
                                            accept="image/*">
                                        @if($blog->image)
                                        <img class="edit_image_preview mt-2" id="edit_image_preview"
                                            src="{{ asset('storage/' . $blog->image) }}" alt="Old Image" width="96"
                                            height="72">
                                        @else
                                        <img class="edit_image_preview d-none mt-2" src="" alt="Preview Image"
                                            width="96" height="72">
                                        @endif
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
                        <button type="submit" class="submit-button-1">
                            <i class='bx bx-upload bx-flashing'></i> Update
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
