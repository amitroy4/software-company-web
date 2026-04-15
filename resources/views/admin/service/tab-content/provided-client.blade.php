<div class="row d-flex">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header text-center">
                <h5>Provided Client</h5>
            </div>

            <form id="serviceForm"
                action="{{ isset($providedClient) ? route('provided-client.update', $providedClient->id) : route('provided-client.store', $service->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($providedClient))
                @method("PUT")
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Client Name<span class="text-danger">
                                        *</span></label>
                                <input type="text" class="form-control" name="service_client" id="service-client"
                                    required value="{{ $providedClient->service_client ?? '' }}"
                                    placeholder="Enter Title" required />
                                @error('service_client') <span class="text-danger">{{ $message
                                    }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">URL</label>
                                <input type="text" class="form-control" name="url" id="url" required
                                    value="{{ $service->url ?? '' }}" placeholder="Enter Title"  />
                                @error('url') <span class="text-danger">{{ $message
                                    }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label">Logo<span class="text-danger">
                                *</span></label>
                            <input type="file" class="form-control" id="image" name="logo"
                                onchange="previewImage(event)" />
                            @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!-- Image Preview -->
                        <div class="col-md-6 mb-7">
                            <img class="border" id="image_preview"
                                src="{{ isset($service->logo) ? asset('storage/'.$service->logo) : asset('admin/assets/media/gallery.jpg') }}"
                                width="150px" height="150px" alt="image">
                        </div>
                    </div>
                </div>
                <div class="card-footer mx-auto">
                    <button type="submit" class="btn btn-light me-2 px-4" id="serviceResetFormBtn">Cancel</button>
                    <button type="submit" id="serviceSubmitBtn" class="btn btn-primary px-4">
                        {{ isset($providedClient) ? 'Update' : 'Save' }}
                    </button>

                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h3>Provided Client Table</h3>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" id="serviceResetFormBtn" class="btn btn-success" style="display: none;">
                    Add New
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>Sl</th>
                            <th>Organaization/Client Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($service->clients as $client)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $client->service_client }}</td>
                            <td>
                                @if($client->url)
                                <div class="d-flex align-items-center">
                                    <span>{{ $client->url }}</span>
                                    <form action="{{ route('provided-client.showUrl', $client->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" style="background: none; border: none; padding: 0;">
                                            <i class="ms-3 bx bx-toggle-{{ $client->show_url ? 'right' : 'left' }} text-{{ $client->show_url ? 'success' : 'danger' }} bx-sm"></i>
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </td>
                            <td>
                                <img src="{{ asset('storage/' . $client->logo) }}" width="70px" height="70px"
                                    alt="image" class=" me-2">
                            </td>
                            <td>
                                @if($client->status)
                                <a href="{{ route('provided-client.toggle-status', $client->id) }}"
                                    class="badge badge-success">Active</a>
                                @else
                                <a href="{{ route('provided-client.toggle-status', $client->id) }}"
                                    class="badge badge-danger">Inactive</a>
                                @endif
                            <td>
                            <td>
                                <div class="d-inline-flex aligh-items-center">
                                    <a href="#" class="serviceedit me-3"
                                    data-id="{{ $client->id }}"
                                    data-title="{{ $client->service_client }}"
                                    data-details="{{ $client->url }}"
                                    data-image="{{ asset('storage/' . $client->logo) }}">
                                    <i class='bx bxs-edit'></i>
                                 </a>

                                 <a href="#" id="delete-client-link"
                                 data-client-id="{{ $client->id }}" title="delete"
                                 class="btn btn-link btn-danger btn-lg"
                                 data-original-title="Remove">
                                 <i class='bx bx-trash-alt'></i> </a>
                             <form id="delete-client-form-{{ $client->id }}"
                                 action="{{ route('provided-client.destroy', $client->id) }}"
                                 method="POST" style="display: none;">
                                 @csrf
                                 @method('DELETE')
                             </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    $(document).ready(function () {
    // Image Preview Handler
    function handleImagePreview(inputSelector, previewSelector) {
        $(inputSelector).on("change", function (event) {
            let reader = new FileReader();
            reader.onload = function () {
                $(previewSelector).attr("src", reader.result);
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    }
    handleImagePreview('#image', '#image_preview');

    $(".serviceedit").click(function () {
    let id = $(this).data("id");
    let title = $(this).data("title");
    let details = $(this).data("details");
    let image = $(this).data("image");

    // Update form action
    $("#serviceForm").attr("action", `/dashboard/service/provided-client/update/${id}`);
    $("input[name='_method']").remove();
    $("#serviceForm").append('<input type="hidden" name="_method" value="PUT">');

    // Fill input fields
    $("#service-client").val(title || "");
    $("#url").val(details || "");

    // Preview image
    $("#image_preview").attr("src", image || "{{ asset('admin/assets/media/gallery.jpg') }}");

    // Update UI
    $("#serviceSubmitBtn").text("Update");
    $("#serviceResetFormBtn").show();
});

    // Reset Button Click Handler
    $("#serviceResetFormBtn").click(function (e) {
        e.preventDefault();

        $("#serviceForm").attr("action", "/dashboard/service/provided-client/store");
        $("#service-client").val("");
        $("#service_details").val("");
        $("#image").val("");
        $("input[name='_method']").remove();
        $("#serviceSubmitBtn").text("Save");

        // Reset image preview
        $("#image_preview").attr("src", "{{ asset('admin/assets/media/gallery.jpg') }}").show();
    });
});
</script>
<script>
    // Use event delegation to handle click events for all delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('[id^="delete-client-link"]');

        deleteLinks.forEach(function(deleteLink) {
            deleteLink.addEventListener('click', function(e) {
                e.preventDefault();
                const clientId = this.getAttribute('data-client-id');
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
                        document.getElementById('delete-client-form-' + clientId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
