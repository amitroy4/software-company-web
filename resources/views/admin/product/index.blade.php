@extends('layouts.admin')
@section('title', 'Product')
@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="row">
      <div class="col-md-4">
      <div class="card card-round">
        <div class="card-header project-details-card-header">
        <div class="d-flex align-items-center">
          <h4 class="project-details-card-header-title"><i class='bx bx-news bx-tada'></i>Product Category</h4>
          <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal"
          data-bs-target="#create-product-category-modal"><i class='bx bx-message-square-add bx-tada'></i>Add
          Category</a>
        </div>
        </div>
        <!--create category modal-->
        @include('admin.product.product-category.create-modal')
        <!--create product  modal-->
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
              @foreach ($categories as $category)
            <tr role="row" class="odd">
              <td class="sorting_1">0{{$loop->iteration}}</td>
              <td>{{$category->name}}</td>
              <td>
              @if($category->status)
          <a href="{{ route('product-category.toggle-status', $category->id) }}"
            class="badge badge-success">Active</a>
          @else
          <a href="{{ route('product-category.toggle-status', $category->id) }}"
            class="badge badge-danger">Inactive</a>
          @endif
            <td>
              <div class="form-button-action">
                <!-- <a href="#" data-bs-toggle="modal"
                    data-bs-target="#edit_product_category_{{ $category->id }}" title="edit"
                    class="btn btn-link btn-success btn-lg">
                    <i class='bx bxs-edit '></i>
                </a> -->
                <a href="#" 
                    class="btn btn-link btn-success btn-lg edit-category-btn"
                    data-id="{{ $category->id }}"
                    data-name="{{ $category->name }}"
                    data-status="{{ $category->status }}"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_product_category_modal">
                    <i class='bx bxs-edit'></i>
                </a>


                <a href="#" id="delete-product-link" data-product-id="{{ $category->id }}" title="delete"
                    class="btn btn-link btn-danger btn-lg" data-original-title="Remove">
                    <i class='bx bx-trash-alt'></i> 
                </a>
                <form id="delete-product-form-{{ $category->id }}"
                    action="{{ route('product-category.destroy', $category->id) }}" method="POST"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
              </div>

              </td>
            </tr>
        @endforeach
        @include('admin.product.product-category.edit-modal')
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
          <h4 class="project-details-card-header-title"><i class='bx bx-news bx-tada'></i>Product</h4>
          <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal" data-bs-target="#create-product-modal"><i
            class='bx bx-message-square-add bx-tada'></i>Add Product</a>
        </div>
        </div>
        <!--create ngo activities modal-->
        @include('admin.product.create-product-modal')
        <!--create product modal-->
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
                <th>Product Name</th>
                
                <th>Link</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($products as $product)
                <tr role="row" class="odd">
                    <td class="sorting_1">0{{$loop->iteration}}</td>
                    <td>
                            {{$product->name ?? ''}}
                    </td>

                    <td>{{$product->link ?? ''}}</td>

                    <td>
                        @if($product->status)
                            <a href="{{ route('product.toggle-status', $product->id) }}"
                                class="badge badge-success">Active</a>
                        @else
                            <a href="{{ route('product.toggle-status', $product->id) }}"
                                class="badge badge-danger">Inactive</a>
                        @endif
                    <td>
                        <div class="form-button-action">
                            <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#edit_product_{{ $product->id }}"
                                title="edit" class="btn btn-link btn-success btn-lg">
                                <i class='bx bxs-edit '></i>
                            </a> -->
                            <a href="#"
                                class="btn btn-link btn-success btn-lg edit-product-btn"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-link="{{ $product->link }}"
                                data-status="{{ $product->status }}"
                                data-category="{{ $product->product_category_id }}"
                                data-bs-toggle="modal"
                                data-bs-target="#edit-product-modal"
                                title="Edit">
                                    <i class='bx bxs-edit'></i>
                            </a>



                            <a href="#" id="delete-product-link" data-product-id="{{ $product->id }}" title="delete"
                                class="btn btn-link btn-danger btn-lg" data-original-title="Remove">
                                <i class='bx bx-trash-alt'></i> 
                            </a>

                            <form id="delete-product-form-{{ $product->id }}"
                                action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>

                    </td>
                </tr>
                
                @endforeach

                @include('admin.product.edit-product-modal')

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
$(document).on('click', '.edit-category-btn', function () {
    let id = $(this).data('id');
    let name = $(this).data('name');

    $('#edit_name').val(name);

    $('#editCategoryForm').attr('action', '/dashboard/product/category/update/' + id);
});


$(document).on('click', '.edit-product-btn', function () {
    let id = $(this).data('id');
    let product_name = $(this).data('name'); 
    let link = $(this).data('link');
    let status = $(this).data('status');
    let category = $(this).data('category');

    $('#editProductForm').attr('action', '/dashboard/product/update/' + id);
    $('#edit_product_name').val(product_name);
    $('#edit_link').val(link);
    $('#edit_status').val(status);
    $('#edit_product_category_id').val(category);
});

</script>


  <script>
    // Use event delegation to handle click events for all delete buttons
    document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('[id^="delete-product-link"]');

    deleteLinks.forEach(function (deleteLink) {
      deleteLink.addEventListener('click', function (e) {
      e.preventDefault();
      const productId = this.getAttribute('data-product-id');
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
        document.getElementById('delete-product-form-' + productId).submit();
        }
      });
      });
    });
    });
  </script>
@endpush