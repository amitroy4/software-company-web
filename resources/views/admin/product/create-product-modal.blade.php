<div id="create-product-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> <!-- এখানে centered class যুক্ত -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="project-details-card-header-title">
                    <i class="bx bx-user-pin bx-tada bx-flip-horizontal"></i>
                    Create Product
                </h4>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">

                        {{-- Product Category --}}
                        <div class="form-group mb-3">
                            <label for="product_category_id">Select Category <span class="text-danger">*</span></label>
                            <select class="form-control" id="product_category_id" name="product_category_id" required>
                                <option value="" disabled selected>-- Choose Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Product Name --}}
                        <div class="form-group mb-3">
                            <label for="name">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   placeholder="Enter product name" required>
                        </div>

                        {{-- Product Link --}}
                        <div class="form-group mb-3">
                            <label for="link">Product Link</label>
                            <input type="url" class="form-control" id="link" name="link" 
                                   placeholder="https://example.com">
                        </div>

                        

                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-upload"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
