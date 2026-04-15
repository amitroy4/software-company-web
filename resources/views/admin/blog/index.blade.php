@extends('layouts.admin')
@section('title', 'Blog')
@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="row">
      <div class="col-md-4">
      <div class="card card-round">
        <div class="card-header project-details-card-header">
        <div class="d-flex align-items-center">
          <h4 class="project-details-card-header-title"><i class='bx bx-news bx-tada'></i>Blog Category</h4>
          <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal"
          data-bs-target="#create-blog-category-modal"><i class='bx bx-message-square-add bx-tada'></i>Add
          Category</a>
        </div>
        </div>
        <!--create category modal-->
        @include('admin.blog.blog-category.create-blog-category-modal')
        <!--create blog modal-->
        <div class="card-body">
        <div class="table-responsive">
          <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
          <div class="row">
            <div class="col-sm-12">
            <table id="add-row" class="display table table-striped table-hover basic-datatables" role="grid"
              aria-describedby="add-row_info">
              <thead class="">
              <tr role="row">
                <th>Sl</th>
                <th>Category Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($blogCategory as $category)
            <tr role="row" class="odd">
              <td class="sorting_1">0{{$loop->iteration}}</td>
              <td>{{$category->name}}</td>
              <td>
              @if($category->status)
          <a href="{{ route('blog-category.toggle-status', $category->id) }}"
            class="badge badge-success">Active</a>
          @else
          <a href="{{ route('blog-category.toggle-status', $category->id) }}"
            class="badge badge-danger">Inactive</a>
          @endif
              <td>
              <div class="form-button-action">
              <a href="#" data-bs-toggle="modal"
              data-bs-target="#edit_blog_category_{{ $category->id }}" title="edit"
              class="btn btn-link btn-success btn-lg">
              <i class='bx bxs-edit '></i>
              </a>
              <a href="#" id="delete-blog-link" data-blog-id="{{ $category->id }}" title="delete"
              class="btn btn-link btn-danger btn-lg" data-original-title="Remove">
              <i class='bx bx-trash-alt'></i> </a>
              <form id="delete-blog-form-{{ $category->id }}"
              action="{{ route('blog-category.destroy', $category->id) }}" method="POST"
              style="display: none;">
              @csrf
              @method('DELETE')
              </form>
              </div>

              </td>
            </tr>
            @include('admin.blog.blog-category.edit-blog-category-modal')

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
      <div class="col-md-8">
      <div class="card card-round">
        <div class="card-header project-details-card-header">
        <div class="d-flex align-items-center">
          <h4 class="project-details-card-header-title"><i class='bx bx-news bx-tada'></i>Blog</h4>
          <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal" data-bs-target="#create-blog-modal"><i
            class='bx bx-message-square-add bx-tada'></i>Add Blog</a>
        </div>
        </div>
        <!--create ngo activities modal-->
        @include('admin.blog.create-blog-modal')
        <!--create blog modal-->
        <div class="card-body">
        <div class="table-responsive">
          <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
          <div class="row">
            <div class="col-sm-12">
            <table id="add-row" class="display table table-striped table-hover basic-datatables" role="grid"
              aria-describedby="add-row_info">
              <thead class="">
              <tr role="row">
                <th>Sl</th>
                <th>Title</th>
                <th>Date</th>
                {{-- <th>Description</th> --}}
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($allBlog as $blog)
            <tr role="row" class="odd">
              <td class="sorting_1">0{{$loop->iteration}}</td>
              <td>
              <a href="#" data-bs-toggle="modal" data-bs-target="#view_blog_{{ $blog->id }}">
              {{ $blog->title ?? ''}}
              </a>
              <br>
              {{ $blog?->blogCategory?->name ?? '' }}
              </td>

              <td>{{$blog->date ?? ''}}</td>
              {{-- <td>{!!$blog->description!!}</td> --}}
              <td>
              @if($blog->image)
          <img src="  {{ asset($blog->image ?? 'frontend/assets/images/no_img.jpeg')  }}" width="96px"
            height="72px" alt="image">
          @endif
              </td>

              <td>
              @if($blog->status)
          <a href="{{ route('blog.toggle-status', $blog->id) }}"
            class="badge badge-success">Active</a>
          @else
          <a href="{{ route('blog.toggle-status', $blog->id) }}"
            class="badge badge-danger">Inactive</a>
          @endif
              <td>
              <div class="form-button-action">
              <a href="#" data-bs-toggle="modal" data-bs-target="#view_blog_{{ $blog->id }}"
              title="view" class="btn btn-link btn-info btn-lg">
              <i class='bx bx-show-alt'></i>
              </a>

              <a href="#" data-bs-toggle="modal" data-bs-target="#edit_blog_{{ $blog->id }}"
              title="edit" class="btn btn-link btn-success btn-lg">
              <i class='bx bxs-edit '></i>
              </a>
              <a href="#" id="delete-blog-link" data-blog-id="{{ $blog->id }}" title="delete"
              class="btn btn-link btn-danger btn-lg" data-original-title="Remove">
              <i class='bx bx-trash-alt'></i> </a>
              <form id="delete-blog-form-{{ $blog->id }}"
              action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display: none;">
              @csrf
              @method('DELETE')
              </form>
              </div>

              </td>
            </tr>
            @include('admin.blog.edit-blog-modal')
        @endforeach


              </tbody>

            </table>
            @foreach ($allBlog as $blog)
        @include('admin.blog.view-blog-modal')
        @endforeach
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
    document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('[id^="delete-blog-link"]');

    deleteLinks.forEach(function (deleteLink) {
      deleteLink.addEventListener('click', function (e) {
      e.preventDefault();
      const blogId = this.getAttribute('data-blog-id');
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
        document.getElementById('delete-blog-form-' + blogId).submit();
        }
      });
      });
    });
    });
  </script>
@endpush