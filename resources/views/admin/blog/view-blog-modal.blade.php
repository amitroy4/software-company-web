<!-- View Blog Modal -->
<div class="modal fade" id="view_blog_{{ $blog->id }}" tabindex="-1" aria-labelledby="viewBlogModalLabel{{ $blog->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewBlogModalLabel{{ $blog->id }}">
                    <i class="bx bx-news"></i> Blog Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6><strong>Title:</strong> {{ $blog->title }}</h6>
                        <p><strong>Date:</strong> {{ $blog->date }}</p>
                        <p><strong>Category:</strong> {{ $blog->blogCategory?->name ?? 'N/A' }}</p>
                        <p><strong>Status:</strong>
                            @if($blog->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 text-center">
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid rounded border"
                                alt="Blog Image" style="max-height: 200px;">
                        @endif
                    </div>
                </div>
                <hr>
                <div>
                    <h6><strong>Description:</strong></h6>
                    <div>{!! $blog->description !!}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>