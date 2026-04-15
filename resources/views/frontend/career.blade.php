@extends('layouts.frontend')
@section('title','Carrer')
@section('content')


<!--banner section start -->
    <section class="hero aos-init aos-animate pb-5" data-aos="fade">
        <div class="hero-bg">
            @foreach ($allCoverImages as $coverImage)
                @if ($coverImage->page_name == 'career')
                    <img src="{{ asset('storage/' . $coverImage->cover_image) }}" alt="Contact InfyraSoft">
                @endif
            @endforeach
        </div>
        <div class="bg-content container">
            <div class="hero-page-title">
                <h1 class="page-header__title">
                    Career Opportunities
                </h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.page') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carrer</li>
                </ol>
            </nav>
        </div>
    </section>
<!-- banner section end -->
<!-- Event area Start -->
<!-- Career Section Start -->
<section id="careerSection" class="event-eight-area position-relative z-1 pt-120 pb-120">
   <div class="container">
      <div class="sec-title-four text-center">
         <h6 class="sec-title-three__tagline"><span class="sec-title-three__tagline__left-border"></span>Career &amp;
               Job<span class="sec-title-three__tagline__right-border"></span></h6>
         <h3 class="sec-title-two__title">Career Opportunities <span>&amp; Job Applications</span></h3>
      </div>
      <div class="row">
         <!-- Job Post 1 -->
          @foreach ($careers as $career)
         <div class="col-12 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
            <div class="border shadow-sm rounded-4 ribbon-box right">
               <div class="card-body p-2">
                  <a class="align-items-center d-block" data-bs-toggle="modal" data-bs-target="#jobDetailsModal1" title="View Details" style="cursor: pointer;">
                     <div class="d-flex align-items-center overflow-hidden w-100">
                        <div class="career-logo-box d-flex align-items-center justify-content-center rounded-3 bg-white">
                           <img src="/storage/{{$career->image}}" class="rounded-3 " alt="Company Logo">
                        </div>
                        <div class="ps-3 w-100">
                           <p class=" title-lg fs-18 fw-600 mb-2 lh-sm pb-1">{{$career->title}}</p>
                           <!-- <p class="events-six-content-top sub-title-lg fs-13 ">{!! $career->description !!}</p> -->
                            <p class="events-six-content-top sub-title-lg fs-13">
                              {{ \Illuminate\Support\Str::limit(strip_tags($career->description), 240, ' ...') }}
                           </p>

                           <div class="pt-1 d-flex align-items-center justify-content-between pb-1 client-details-inner">
                              <h-3 class="title-sm">Vacancy: <i>{{$career->vacancy}}</i></h-3>
                              <h-3 class="title-sm">Location: <i>{{$career->location}}</i></h-3>
                           </div>
                           <div class="d-flex align-items-center justify-content-between pb-3">
                              <h3 class="title-sm">Published:
                                 <i>
                                 {{ \Carbon\Carbon::parse($career->publish_date)->format('d M Y') }}
                                 </i>
                              </h3>
                              <h3 class="title-sm text-danger">Deadline:
                                 <i>
                                 {{ \Carbon\Carbon::parse($career->deadline)->format('d M Y') }}
                                 </i>
                              </h3>
                           </div>
                           <!-- <button class="select-btn-success w-45 m-0" data-bs-toggle="modal" data-bs-target="#job-view-modal">View JOB Details</button> -->
                           <button
                              class="select-btn-success w-45 m-0 view-job-btn"
                              data-bs-toggle="modal"
                              data-bs-target="#job-view-modal"
                              data-id="{{ $career->id }}"
                              data-title="{{ $career->title }}"
                              data-company="{{ $career->company_name }}"
                              data-email="{{ $career->email }}"
                              data-phone="{{ $career->phone }}"
                              data-location="{{ $career->location }}"
                              data-vacancy="{{ $career->vacancy }}"
                              data-publish="{{ \Carbon\Carbon::parse($career->publish_date)->format('d M Y') }}"
                              data-deadline="{{ \Carbon\Carbon::parse($career->deadline)->format('d M Y') }}"
                              data-description="{{ strip_tags($career->description) }}"
                              data-logo="/storage/{{ $career->logo }}"
                              data-image="/storage/{{ $career->image }}"
                              data-responsibilities='@json(json_decode($career->responsibilities, true))'
                              data-requirements='@json(json_decode($career->requirements, true))'
                           >
                              View JOB Details
                           </button>


                              <button class="apply-btn select-btn-warning w-50 m-0" data-bs-toggle="modal" data-bs-target="#jobApplyModal"
                              data-id="{{ $career->id }}"
                              data-title="{{ $career->title }}">
                              Apply Now</button>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="collapse client-details-inner " id="member2" style="">
                  <div class="p-3">
                     <div class="cm-group">
                        <p class="fs-14 lh-sm">Charity and Donation is a categorys that involves giving financial category that involves
                           giving financial or material support various causes organizations. It allows individuals
                           towards the a addressing social category that involves giving financial or material support
                           various causes of organizations. It allows individuals towards addressing social
                        </p>
                        <div class="about-six-list-wrap">
                           <div class="about-six-list w-50">
                              <ul>
                                 <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Specialized Company</li>
                                 <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Dependable Services</li>
                                 <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Licensed &amp; Insured</li>
                              </ul>
                           </div>
                           <div class="about-six-list w-50">
                              <ul>
                                 <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Licensed &amp; Insured</li>
                                 <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Day Scheduling</li>
                                 <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Licensed &amp; Insured</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="p-2 mt-3 mx-0 row team-details-stats bg-white rounded border custom-bg-success-100">
                        <div class="col">
                           <div class="d-flex align-items-center overflow-hidden w-100">
                              <a href="#" class="avatar avatar-md bg-light me-2">
                              <img src="https://smarthr.dreamstechnologies.com/laravel/template/public/build/img/icons/file-02.svg" class="w-auto h-auto" alt="img">
                              </a>
                              <div>
                                 <a href="#" class="title-sm mb-1">Project details</a>
                                 <br>
                                 <small class="sub-title-xs fw-500 text-muted">PDF  |  0.14 MB</small>
                              </div>
                           </div>
                        </div>
                        <div class="col text-center">
                           <div class="title-md lh-1 mb-1">Published On</div>
                           <div class="sub-title-md text-dark lh-1 mb-1">2nd February 25</div>
                        </div>
                        <div class="col d-flex align-items-center">
                           <a href="#" class="ms-auto export-btn-info fs-12">
                           <i class="bx bx-cloud-download me-1"></i> Download
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

          @endforeach
         <!-- Job Post 2 -->

      </div>

   </div>
</section>

<!-- Career Section End -->
<div class="modal fade" id="job-view-modal" tabindex="-1" aria-labelledby="job-view-modal" style="display: none;" aria-modal="true" role="dialog">
   <div class="modal-dialog modal modal-lg modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header p-3">
            <h5 class="title-lg fs-20 fw-600" id="clientDetailsModalLabel">Client Details: <span id="modalClientNameDisplay"></span></h5>
         </div>
         <div class="modal-body p-0">
            <div class="card-body p-0 px-3 ">
               <div class="d-flex align-items-center overflow-hidden w-100">
                  <div class="career-logo-box d-flex align-items-center justify-content-center rounded-3 p-3 bg-white">
                     <img src="assets/images/OXO Logo Black.png" id="jobLogo" class="rounded-3" alt="img">
                  </div>
                  <div class="px-3 p-0 w-100">
                     <p class="title-lg pb-1 lh-1 fs-18"><i>Company:</i> <span id="jobCompany"></span></p>
                     <div class="d-flex align-items-center justify-content-between pt-2">
                        <a href="needhelp@company.com" id="jobEmail" class="link-lg">Email: ceo@qbit-tech.com</a>
                        <a href="tel:9200368090" id="jobPhone" class="link-lg">Phone: +8801844674502</a>
                     </div>
                     <div class="d-flex align-items-center justify-content-between pt-2">
                        <p class="link-lg" id="jobAddress">Address: 522/B, North Shahjahanpur, Dhaka-1217</p>
                        <button data-bs-toggle="modal" data-id="" data-bs-target="#jobApplyModal" class="badge-2 w-40 m-0 apply-btn2">
                        Apply Now</button>
                     </div>
                  </div>
               </div>
               <div class="cm-group pt-4">
                  <h2 class="pb-1 fs-16 lh-1 sidebar-title text-start border-bottom events-six-content-top">Job Context</h2>
                  <p class="sub-title-lg fs-13  pt-2 pb-3" id="jobDescription">We are looking for a skilled Full Stack Web Developer to join our team.
                     The ideal candidate will be proficient in both front-end and back-end development, capable of building scalable
                     web applications from the ground up. You will work closely with our design and product teams to deliver
                     high-quality, user-friendly solutions.
                  </p>
                  <h2 class="pb-1 fs-16 lh-1 sidebar-title text-start border-bottom events-six-content-top">Responsibilities</h2>
                  <div class="about-six-list-wrap">
                     <div class="about-six-list">
                        <ul id="jobResponsibilities">
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Develop and maintain dynamic web applications.</li>
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Ensure clean, secure, optimized, maintainable, and well-documented code.s</li>
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Work independently with minimal supervision.</li>
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Collaborate with designers to implement UI/UX improvements.</li>
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Optimize applications for speed, security, and scalability.</li>
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Troubleshoot, debug, and upgrade existing systems.</li>
                        </ul>
                     </div>
                  </div>
                  <h2 class="pb-1 fs-16 lh-1 sidebar-title text-start border-bottom events-six-content-top">Requirements</h2>
                  <div class="about-six-list-wrap">
                     <div class="about-six-list">
                        <ul id="jobRequirements">
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Bachelor of Science (BSc) in Computer Science & Engineering</li>
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> At least 4 years Working Experience</li>
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> The applicants should have experience in the following business area(s): Software Company,IT Enabled Service</li>
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Age 25 to 30 years</li>
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Experience with modern frameworks like React.js, Angular, or Vue.js</li>
                           <li><span><i class="bx bx-log-in-circle bx-tada"></i></span> Knowledge of responsive design and cross-browser compatibility</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Job Application Modal -->
<div class="modal fade" id="jobApplyModal" tabindex="-1" aria-labelledby="jobApplyModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="jobApplyModalLabel">Apply for Position <span id="jobTitle"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form id="jobApplyForm" enctype="multipart/form-data">
               <input type="hidden" name="career_id" id="applyCareerId">
               <div class="form-group">
                  <label for="fullName" class="form-label">Full Name</label>
                  <input type="text" class="form-control custom-input" name="name" id="fullName" required>
               </div>
               <div class="form-group">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control custom-input" name="email" id="email" required>
               </div>
               <div class="form-group">
                  <label for="phone" class="form-label">Phone Number</label>
                  <input type="tel" class="form-control custom-input" name="phone" id="phone" required>
               </div>
               <!-- <div class="form-group">
                  <label for="position" class="form-label">Applying for Position</label>
                  <select class="form-select" id="position">
                    <option selected>Select Position...</option>
                    <option value="Site Engineer (Civil)">Site Engineer (Civil)</option>
                    <option value="Project Manager">Project Manager</option>
                  </select>
               </div> -->
               <div class="form-group">
                  <label for="coverLetter" class="form-label">Cover Letter</label>
                  <textarea class="form-control custom-input" name="cover_letter" id="coverLetter" rows="4"></textarea>
               </div>
               <div class="form-group">
                  <label for="resume" class="form-label">Upload CV/Resume (PDF, DOC, DOCX)</label>
                  <input class="form-control custom-input" type="file" name="cv" id="resume" accept=".pdf,.doc,.docx" required>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit Application</button>
               </div>
            </form>
         </div>

      </div>
   </div>
</div>

@endsection

@push('scripts')

<script>

    // Apply Now button click - set career id in form
    $('.apply-btn').on('click', function() {
        let careerId = $(this).data('id');
        let jobTitle = $(this).data('title');
        $('#applyCareerId').val(careerId);
         $('#jobTitle').text(jobTitle);
        $('#jobApplyModal').modal('show');
    });

    // Details modal-এর Apply Now
    $(document).on('click', '.apply-btn2', function() {
        // যেহেতু ওপরের দিকে .data() দিয়ে সেট করেছি, এখানে .data() দিয়েই পড়ি
        const careerId = $(this).data('id');
        const jobTitle = $(this).data('title');
        $('#applyCareerId').val(careerId);
        $('#jobTitle').text(jobTitle);
        $('#job-view-modal').modal('hide');
        $('#jobApplyModal').modal('show');
    });

    // Form submit with AJAX
    $('#jobApplyForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
         console.log(formData);
        $.ajax({
            url: "{{ route('job.apply') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                  $('#jobApplyForm')[0].reset();
                  $('#jobApplyModal').modal('hide');
                  Swal.fire({
                        icon: 'success',          // success icon
                        title: 'Success',          // title
                        text: response.success,    // message from your response
                    });
            },
            error: function(xhr) {
                  console.log(xhr.responseText);
                  Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
            }
         });
    });


    $(".view-job-btn").on("click", function () {
        let $this = $(this);

        // Basic Info
        $("#jobCompany").text($this.data("company"));
        $("#jobEmail").text("Email: " + $this.data("email")).attr("href", "mailto:" + $this.data("email"));
        $("#jobPhone").text("Phone: " + $this.data("phone")).attr("href", "tel:" + $this.data("phone"));
        $("#jobAddress").text("Location: " + $this.data("location"));
        $("#jobDescription").text($this.data("description"));

        // Modal এর ভেতরের Apply Now button এ career id এবং title সেট করো
        const $applyBtn2 = $("#job-view-modal .apply-btn2");
        $applyBtn2.removeData('id').removeData('title');   // পুরনো cache ক্লিয়ার
        $applyBtn2
            .data('id', $this.data('id'))
            .data('title', $this.data('title'))
            // (inspect করার সুবিধার জন্য attribute-ও আপডেট করা হল, optional)
            .attr('data-id', $this.data('id'))
            .attr('data-title', $this.data('title'));

        // Logo & Image
        $("#jobLogo").attr("src", $this.data("logo"));

        // Responsibilities
        let responsibilities = $this.data("responsibilities") || [];
        $("#jobResponsibilities").empty();
        $.each(responsibilities, function (i, item) {
            $("#jobResponsibilities").append(`<li><i class="bx bx-log-in-circle bx-tada"></i> ${item}</li>`);
        });

        // Requirements
        let requirements = $this.data("requirements") || [];
        $("#jobRequirements").empty();
        $.each(requirements, function (i, item) {
            $("#jobRequirements").append(`<li><i class="bx bx-log-in-circle bx-tada"></i> ${item}</li>`);
        });
    });

</script>

@endpush


@push('styles')
<style>
      /*
      * ===================================================================
      * Aggregated CSS for Career Page
      * Extracted from career_main.css and career_custom.css
      * ===================================================================
      */

      /* ==== Root Variables & Base Styles ==== */
      :root {
         --nunito: "Nunito", sans-serif;
         --kumbh: "Kumbh Sans", sans-serif;
         --template-font: var(--nunito);
         --template-bg: #ffffff;
         --template-color: #667471;
         --white: #ffffff;
         --black: #000000;
         --primary-color: #046a58;
         --secondary-color: #122f2a;
         --hover-color: #6b5103;
         --transition: all 0.5s ease;
         --shadow: 0px 10px 25px 0px rgba(37, 42, 52, 0.08);
         --primary-six-title: #0B3D19;
         --apece-base: #FE4F2D;
         --apece-primary: #f7891e;
         --apece-title: #A62C2C;
      }

      * {
         margin: 0px;
         padding: 0px;
         box-sizing: border-box;
      }

      html {
         scroll-behavior: smooth;
         overflow-x: clip;
      }

      body {
         font-family: var(--template-font);
         font-size: 16px;
         line-height: 26px;
         font-weight: 400;
         color: var(--template-color);
         background-color: var(--template-bg);
         overflow-x: clip;
         text-transform: capitalize;
      }

      button {
         background-color: transparent;
         border: 0px;
         outline: 0px;
         cursor: pointer;
      }

      a, button {
         text-decoration: none;
         display: inline-flex;
         align-items: center;
         gap: 8px;
         outline: 0px;
         border: 0px;
         transition: var(--transition);
         cursor: pointer;
         color: var(--template-color);
      }
      a:hover, button:hover {
         text-decoration: none;
      }
      a:focus, button:focus {
         box-shadow: none;
      }

      ul, ol {
         list-style-type: none;
         margin: 0px;
         padding: 0px;
      }

      input, textarea {
         border: 0px;
         outline: 0px;
      }

      h1, h2, h3, h4, h5, h6, p {
         padding: 0px;
         margin: 0px;
         color: var(--template-color);
         font-family: var(--nunito);
      }

      p {
         font-size: 16px;
         line-height: 29px;
         font-weight: 400;
         color: #414042;
         text-align: justify;
         margin-bottom: 20px;
      }

      img {
         max-width: 100% !important;
         height: auto !important;
         object-fit: cover !important;
      }

      i {
         display: inline-flex;
         align-items: center;
         justify-content: center;
      }

      span {
         display: inline-block;
      }

      /* ==== Hero Banner & Breadcrumb ==== */
      .hero {
         margin-top: 0px;
         padding: 0px 0px;
         position: relative;
         overflow: hidden;
         z-index: 1;
         display: flex;
         align-items: center;
         justify-content: center;
      }
      .hero-bg {
         position: absolute;
         inset: 0px;
         z-index: -1;
         overflow: hidden;
      }
      .hero-bg img {
         width: 100%;
         height: 100%;
         object-fit: cover;
      }
      .bg-content {
         position: relative;
         z-index: 1;
         text-align: center;
      }
      .hero-page-title {
         margin-bottom: 12px;
      }
      
      .page-header__title {
         font-weight: 800;
         color: var(--white);
      }
      .breadcrumb {
         margin-bottom: 0px;
         display: flex;
         align-items: center;
         gap: 12px;
         flex-wrap: wrap;
         justify-content: center;
      }
      .breadcrumb .breadcrumb-item, .breadcrumb a {
         color: #ffffff;
      }
      .breadcrumb a:hover {
         color: var(--white);
      }
      .breadcrumb .breadcrumb-item + .breadcrumb-item::before {
         padding-inline-end: 12px;
         font-size: 20px;
         content: "::";
         font-weight: 700;
         color: #ffffff;
      }
      .breadcrumb .active {
         color: var(--white) !important;
      }

      /* ==== Career Section Layout & Titles ==== */
      .event-eight-area {
         padding: 100px 0;
      }
      .section-eight-wrapper {
         margin-bottom: 50px;
      }
      .career-logo-box {
         width: 50%;
         /* height: 100px;  */
      }
      .career-logo-box img {
         max-width: 100%;
         max-height: 100%;
         object-fit: contain;
      }
      .sub-title-main {
         display: inline-flex;
         align-items: center;
         gap: 10px;
         color: var(--apece-primary);
         font-size: 15px;
         font-family: var(--kumbh);
         font-weight: 500;
         text-transform: uppercase;
         line-height: 25px;
      }
      .title-animation {
         text-transform: none !important;
         font-weight: 800;
         color: var(--apece-title);
         margin: 0 0 30px;
         font-size: 35px;
         line-height: 50px;
      }
      .ribbon-box {
         position: relative;
      }

      /* ==== Typography & Utility Classes ==== */
      .title-lg {
         font-size: 14px;
         font-weight: 500;
         color: #640D5F;
         line-height: 15px;
         margin: 0;
      }
      .sub-title-lg {
         font-size: 14px;
         font-weight: 400;
         color: #414042;
         line-height: 20px;
         margin: 0;
      }
      .title-sm {
         font-size: 13px;
         font-weight: 500;
         color: #640D5F;
         line-height: 15px;
         margin: 0;
      }
      .link-lg {
         font-size:14px;
         font-weight: 400;
         color: #640D5F;
         line-height: 15px;
         margin: 0;
         transition: all 0.2s ease-in-out;
      }
      .link-lg:hover {
         color: #000;
         transform: translateY(-2px);
      }
      .fs-13 { font-size: 13px !important; }
      .fs-16 { font-size: 16px !important; }
      .fs-18 { font-size: 18px !important; }
      .fs-20 { font-size: 20px !important; }
      .fw-600 { font-weight: 600 !important; }
      .text-danger { color: #E70D0D !important; }

      /* ==== Buttons ==== */
      .select-btn-success {
         display: inline-flex;
         text-align: center;
         border-radius: 50px 25px 50px 25px;
         transition: all 0.2s ease-in-out;
         font-size: 13px;
         align-items: center;
         justify-content: center;
         background-color: rgba(52, 129, 1, 0.2);
         color: rgba(52, 129, 1, 0.9);
         padding: 4px 15px;
         box-shadow: 0 0px 8px rgba(0, 0, 0, 0.1);
      }
      .select-btn-success:hover {
         background-color: rgba(52, 129, 1, 1);
         transform: translateY(-2px);
         box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);
         color: #fff;
      }
      .select-btn-warning {
         display: inline-flex;
         text-align: center;
         border-radius: 50px 25px 50px 25px;
         transition: all 0.2s ease-in-out;
         font-size: 13px;
         align-items: center;
         justify-content: center;
         color: rgba(166, 44, 44, 0.9);
         background: rgba(242, 146, 32, 0.2);
         padding: 4px 15px;
         box-shadow: 0 0px 8px rgba(0, 0, 0, 0.1);
      }
      .select-btn-warning:hover {
         background-color: rgba(242, 146, 32, 1);
         transform: translateY(-2px);
         box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);
         color: #fff;
      }
      .badge-2 {
         display: flex;
         height: 19px;
         line-height: 34px;
         text-align: center;
         transition: all 0.2s ease-in-out;
         font-size: 10px;
         align-items: center;
         justify-content: center;
         background-color: #E9F5BE;
         margin: auto;
         border-radius: 50px 25px 50px 25px;
         color: #686D76;
         border: 1px dashed #686D76 !important;
         padding: 4px 20px;
      }

      /* ==== Details & Lists ==== */
      .client-details-inner {
         border-top: 1px solid #B7E0FF !important;
      }
      .about-six-list-wrap {
         display: flex;
         gap: 1rem; /* Adjusted for better spacing */
      }
      .about-six-list ul {
         display: flex;
         flex-direction: column;
      }
      .about-six-list ul li {
         font-weight: 400;
         font-size: 12.5px;
         color: var(--apece-title);
         display: inline-flex;
         align-items: center;
         gap: 7px;
         line-height: 25px;
      }
      .about-six-list ul li span {
         line-height: 1;
         color: var(--apece-primary);
      }

      /* ==== Modal & Form ==== */
      .modal-header {
         border-bottom: 1px solid #dee2e6;
      }
      .modal-footer {
         border-top: 1px solid #dee2e6;
      }
      .sidebar-title {
         font-weight: 700;
         color: var(--apece-title);
         font-size: 20px;
         line-height: 25px;
      }
      .events-six-content-top {
         border-bottom: 1px dashed rgba(102, 116, 113, .4);
      }
      .form-group {
         width: 100%;
      }
      .form-group label, .form-label {
         margin-bottom: 5px;
         color: #3B1C32 !important;
         font-size: 14px !important;
         white-space: nowrap;
         font-weight: 600;
         line-height: 15px;
         margin-top: 15px;
      }
      .custom-input {
         font-size: 15px !important;
         padding: 5px 13px !important;
         line-height: 30px;
         color: #414042 !important;
         border-radius: 5px !important;
         border: 1px solid #B7E0FF !important;
         font-weight: 300 !important;
         display: block;
         width: 100%;
      }
      .form-control {
         display: block;
         width: 100%;
         padding: .375rem .75rem;
         font-size: 1rem;
         font-weight: 400;
         line-height: 1.5;
         color: #212529;
         background-color: #fff;
         background-clip: padding-box;
         border: 1px solid #ced4da;
         border-radius: .25rem;
         transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
      }
      .btn {
         display: inline-block;
         font-weight: 400;
         line-height: 1.5;
         text-align: center;
         text-decoration: none;
         vertical-align: middle;
         cursor: pointer;
         user-select: none;
         background-color: transparent;
         border: 1px solid transparent;
         padding: .375rem .75rem;
         font-size: 1rem;
         border-radius: .25rem;
         transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
      }
      .btn-primary {
         color: #fff;
         background-color: #0d6efd;
         border-color: #0d6efd;
      }
      .btn-secondary {
         color: #fff;
         background-color: #6c757d;
         border-color: #6c757d;
      }

      
   
</style>

@endpush
