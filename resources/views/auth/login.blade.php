<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{$setting->company_name}}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('storage/' . $setting->favicon) }}" type="image/x-icon" />
    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['assets/css/fonts.min.css']
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });

    </script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/plugins.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/kaiadmin.creative.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/onebiterp.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/demo.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/task-board.scss">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/drag.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/dragula.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/smarthr.css">
</head>

<body class="bg-white">
    <div id="global-loader" style="display: none;">
        <div class="page-loader"></div>
    </div>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="container-fuild">
            <div class="w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
                <div class="row">
                    <div class="col-lg-6">
                        <div
                            class="login-background position-relative d-lg-flex align-items-center justify-content-center d-none flex-wrap vh-100">
                            <div class="authentication-card w-100 p-0">
                                <div
                                    class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap">
                                    <div class="col-md-8 m-auto">
                                        <div class="authen-overlay-item border w-100">

                                            <h1 class="text-white display-1 text-center mt-2 mb-5">{{$setting->company_name}}
                                            </h1>
                                            <div class="authen-overlay-img mx-auto text-center mb-3">
                                                <img src="{{ asset('admin') }}/assets/img/login-page.jpg"
                                                    style="width: 80%;" alt="Img">
                                            </div>
                                            <div class="text-center mx-auto mt-4">
                                                <p class="text-white expense-title-1">{{$setting->short_description}}</p>
                                            </div>
                                            <div class="mt-3 text-center">
                                                <p class="mb-0 text-white fs-13">{{$setting->footer_text}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap">
                            <div class="col-md-8 m-auto">
                                <div class="card shadow-1 flex-fill mb-0">
                                    <div class=" mx-auto mt-4 mb-4 text-center">
                                        <img src="{{ asset('storage/' . $setting->logo) }}"
                                            class="img-fluid" width="150px" alt="Logo">
                                    </div>
                                    <div class="text-center mb-4 pb-3 pt-3 border-top border-bottom">
                                        <h2 class="fs-30 mb-2 project-details-card-header-title">Sign In</h2>
                                        <p class="mb-0">Please Enter Your Details to Sign In</p>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-tabs tab-style-1 nav-justified d-sm-flex d-block p-0 mb-3"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link fw-medium active" data-bs-toggle="tab"
                                                    data-bs-target="#openings" aria-current="page" href="#openings"
                                                    aria-selected="true" role="tab">{{$setting->company_name}} User</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="openings">
                                                <form method="POST" action="{{ route('admin-login') }}">
                                                    @csrf
                                                    <div class=" d-flex flex-column justify-content-between p-4 pt-2">
                                                        <div class="">
                                                            <div class="form-group">
                                                                <label class="small-label-text">Username</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="username" id="username"
                                                                        value="{{ old('username') }}" placeholder="Username"
                                                                        class="form-control custom-input">
                                                                    <span
                                                                        class="input-group-text custom-input border-start-0">
                                                                        <i class='bx bx-envelope'></i>
                                                                    </span>
                                                                </div>
                                                                @error('username')<span
                                                                    class="text-danger">{{ $message }}</span>@enderror
                                                            </div>
                                                             <div class="form-group">
                                                                <label class="small-label-text">Password</label>
                                                                <div class="input-group">
                                                                    <input type="password" name="password"  class="form-control custom-input password" placeholder="Password" required>
                                                                    <span class="input-group-text custom-input border-start-0 toggle-password" >
                                                                        <i class="bx bx-low-vision hide-icon" ></i>
                                                                        <i class="bx bx-show-alt show-icon"  style="display: none;"></i>
                                                                    </span>
                                                                </div>
                                                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                                            </div>
                                                            @if ($errors->any())
                                                            <span class="text-danger">{{$errors->first('login') }} </span>
                                                            @endif
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-4">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check form-check-md mb-0 p-0">
                                                                        <input class="form-check-input" id="remember_me" type="checkbox">
                                                                        <label for="remember_me" class="form-check-label mt-0">Remember Me</label>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end">
                                                                    <a href="#" class="link-danger">Forgot Password?</a>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="submit"
                                                                class="btn btn-primary w-100">Sign In</button>
                                                                {{-- <a href="admin-dashboard.php" type="submit"
                                                                    class="btn btn-primary w-100">Sign In</a> --}}
                                                            </div>
                                                            {{-- <div class="text-center">
                                                                <h6 class="fw-normal text-dark mb-0">Don’t have an  account?
                                                                    <a href="register.html" class="hover-a"> Create Account</a>
                                                                </h6>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->
    <!-- end auth-page-wrapper -->
    <!--   Core JS Files   -->
    <script src="{{ asset('admin') }}/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/core/bootstrap.min.js"></script>
    <!-- jQuery Validation -->
    <script src="{{ asset('admin') }}/assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="{{ asset('admin') }}/assets/js/kaiadmin.creative.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('admin') }}/assets/js/setting-demo.js"></script>
    <!-- <script src="assets/js/demo.js"></script> -->
    <script>
        $(document).ready(function() {
            $('.toggle-password').on('click', function() {
                var passwordField = $('.password');
                var hideIcon = $('.hide-icon');
                var showIcon = $('.show-icon');
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    hideIcon.hide();
                    showIcon.show();
                } else {
                    passwordField.attr('type', 'password');
                    hideIcon.show();
                    showIcon.hide();
                }
            });
        });
    </script>
</body>

</html>
