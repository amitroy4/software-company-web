@extends('layouts.admin')

@push('styles')
<!-- Toastr CSS -->
<link href="https://cdn.jsdelivr.net/npm/toastr/build/toastr.min.css" rel="stylesheet"/>
<style>
.setting-card-1 {
    height: 100%;
    transition: all 0.3s ease;
    cursor: pointer;
}

.setting-card-1:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.logo-content {
    min-height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.setting-button-1 {
    transition: all 0.3s ease;
}

.setting-button-1:hover {
    background-color: #79AC78;
    color: white;
}

img.img-fluid.preview-img {
    cursor: pointer;
    max-width: 150px;
    max-height: 150px;
    user-select: none;
    pointer-events: auto;
}
</style>
@endpush

@section('content')
<div class="container">
   <div class="page-inner">
      <div class="row">
         <div class="col-md-12">
            @if($setting)
            <form id="settingsForm" action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')

               <div class="card">
                  <div class="card-header project-details-card-header" style="background-color: #79AC78;">
                     <div class="d-flex align-items-center">
                        <h4 class="project-details-card-header-title" style="color: white;">
                           <i class='bx bx-edit bx-tada'></i> Company Information
                        </h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-lg-5">
                           <div class="form-group">
                              <label>Company Name</label>
                              <input type="text" name="company_name" class="form-control custom-input" value="{{ $setting->company_name ?? '' }}" placeholder="Account Name">
                           </div>
                        </div>
                        <div class="col-lg-7">
                           <div class="form-group">
                              <label>Copywrite Text</label>
                              <input type="text" name="copyright_text" class="form-control custom-input" value="{{ $setting->copyright_text ?? '' }}" placeholder="Copyright Text">
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="description">Short Description</label>
                              <textarea class="form-control custom-input-s" name="description" rows="3" placeholder="Company Description">{{ $setting->description ?? '' }}</textarea>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>Company Registration Number</label>
                              <input type="text" name="registration_number" class="form-control custom-input" value="{{ $setting->registration_number ?? '' }}" placeholder="Registration Number">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>Trade License Number</label>
                              <input type="text" name="trade_license" class="form-control custom-input" value="{{ $setting->trade_license ?? '' }}" placeholder="Trade License">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>BIN/VAT Number</label>
                              <input type="text" name="vat_number" class="form-control custom-input" value="{{ $setting->vat_number ?? '' }}" placeholder="VAT Number">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="card mt-3">
                  <div class="card-header project-details-card-header" style="background-color: #79AC78;">
                     <div class="d-flex align-items-center">
                        <h4 class="project-details-card-header-title" style="color: white;">
                           <i class='bx bx-edit bx-tada'></i> Contact Information
                        </h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>Official Contact Number</label>
                              <input type="text" name="contact_number" class="form-control custom-input" value="{{ $setting->contact_number ?? '' }}" placeholder="Contact Number">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>WhatsApp Number</label>
                              <input type="text" name="whatsapp_number" class="form-control custom-input" value="{{ $setting->whatsapp_number ?? '' }}" placeholder="WhatsApp Number">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>Hotline Number</label>
                              <input type="text" name="hotline_number" class="form-control custom-input" value="{{ $setting->hotline_number ?? '' }}" placeholder="Hotline Number">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>Email Address</label>
                              <input type="email" name="email" class="form-control custom-input" value="{{ $setting->email ?? '' }}" placeholder="Email Address">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>Alternate Email</label>
                              <input type="email" name="alt_email" class="form-control custom-input" value="{{ $setting->alt_email ?? '' }}" placeholder="Alternate Email">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>Website Address</label>
                              <input type="text" name="website" class="form-control custom-input" value="{{ $setting->website ?? '' }}" placeholder="Website URL">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>LinkedIn</label>
                              <input type="text" name="linkedin" class="form-control custom-input" value="{{ $setting->linkedin ?? '' }}" placeholder="LinkedIn URL">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>Facebook URL</label>
                              <input type="text" name="facebook" class="form-control custom-input" value="{{ $setting->facebook ?? '' }}" placeholder="Facebook URL">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label>Landing Page</label>
                              <input type="text" name="landing_page" class="form-control custom-input" value="{{ $setting->landing_page ?? '' }}" placeholder="Landing Page URL">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label>Google Map iFrame</label>
                              <textarea name="google_map" class="form-control custom-input-s" rows="3" placeholder="Google Map Embed Code">{{ $setting->google_map ?? '' }}</textarea>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label>Address</label>
                              <input type="text" name="address" class="form-control custom-input-s" rows="3" value="{{ $setting->address ?? '' }}" placeholder="Address">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               {{-- Company Branding Section --}}
               <div class="card mt-3">
                  <div class="card-header project-details-card-header" style="background-color: #79AC78;">
                     <div class="d-flex align-items-center">
                        <h4 class="project-details-card-header-title" style="color: white;">
                           <i class='bx bx-edit bx-tada'></i> Company Branding
                        </h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        @foreach([
                            'logo_dark' => 'Company Logo (Dark)',
                            'logo_light' => 'Company Logo (Light)',
                            'favicon' => 'Favicon'
                        ] as $field => $title)
                        <div class="col-lg-4 col-sm-6 col-md-6">
                           <div class="card setting-card-1 h-100">
                              <div class="card-header">
                                 <h5 class="setting-title-s">{{ $title }}</h5>
                              </div>
                              <div class="card-body d-flex flex-column">
                                 <div class="logo-content text-center mt-3 flex-grow-1 d-flex align-items-center justify-content-center" style="min-height: 150px;">
                                    @if(!empty($setting->$field))
                                       <img src="{{ asset('storage/'.$setting->$field) }}" class="img-fluid preview-img preview-{{ $field }}" alt="{{ $title }}">
                                    @else
                                       <p class="text-muted no-image-{{ $field }}">No Image Uploaded</p>
                                    @endif
                                 </div>
                                 <div class="text-center mt-3">
                                    <label class="w-100">
                                       <div class="setting-button-1 logo-update-btn">
                                          <i class='bx bx-cloud-upload'></i> Choose file here
                                       </div>
                                       <input type="file" name="{{ $field }}" class="d-none file-upload" data-field="{{ $field }}" accept=".jpeg,.jpg,.png,.ico">
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>

               <div class="col-lg-12 mt-4">
                  <div class="hstack gap-2 justify-content-center pt-4 pb-3">
                     <a href="{{ url()->previous() }}" class="cancel-button-1"><i class='bx bx-x bx-flashing'></i> Cancel</a>
                        <button type="submit" class="submit-button-1"><i class='bx bx-upload bx-flashing'></i> Submit</button>

                  </div>
               </div>
            </form>
            @else
               <p>No settings found. Please create a setting record in the database.</p>
            @endif
         </div>
      </div>
   </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="imagePreview" class="img-fluid" alt="Image Preview" style="max-height: 80vh;">
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr/build/toastr.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview image on file select
    document.querySelectorAll('.file-upload').forEach(input => {
        input.addEventListener('change', function() {
            const field = this.getAttribute('data-field');
            const file = this.files[0];

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewArea = document.querySelector(`.preview-${field}`);
                    const noImageText = document.querySelector(`.no-image-${field}`);

                    if (noImageText) noImageText.remove();

                    if (!previewArea) {
                        const logoContent = document.querySelector(`.logo-content`);
                        logoContent.innerHTML = `<img src="${e.target.result}" style="max-width: 150px; max-height: 150px;" class="img-fluid preview-${field} preview-img" alt="Preview Image">`;
                    } else {
                        previewArea.src = e.target.result;
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    });

    // Click card to open file dialog except when clicking image
    document.querySelectorAll('.setting-card-1').forEach(card => {
        const fileInput = card.querySelector('input[type="file"]');
        card.addEventListener('click', (e) => {
            if (e.target.tagName.toLowerCase() !== 'img') {
                fileInput.click();
            }
        });
    });

    // Click image to open modal preview
    document.querySelectorAll('img.preview-img').forEach(img => {
        img.style.cursor = 'pointer';
        img.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent card click event
            const src = this.src;
            const modalImg = document.getElementById('imagePreview');
            modalImg.src = src;

            const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
            modal.show();
        });
    });

    // AJAX form submit with file upload
    const form = document.getElementById('settingsForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="bx bx-loader bx-spin"></i> Processing...';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(async response => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;

            if (response.ok) {
                const data = await response.json();
                if(data.success) {
                    toastr.success(data.message || 'Settings updated successfully!');
                } else {
                    toastr.error(data.message || 'Error updating settings.');
                }
            } else {
                const data = await response.json();
                if(data.errors) {
                    const firstError = Object.values(data.errors)[0][0];
                    toastr.error(firstError);
                } else if(data.message) {
                    toastr.error(data.message);
                } else {
                    toastr.error('Error updating settings');
                }
            }
        })
        .catch(error => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
            toastr.error('An unexpected error occurred.');
            console.error('Error:', error);
        });
    });
});
</script>
@endpush
