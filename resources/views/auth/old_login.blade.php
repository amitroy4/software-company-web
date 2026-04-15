<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>OneBit-ERP Solution</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('admin') }}/assets/img/onebiterp_logo_white_favicon.png" type="image/x-icon" />
    <!-- Fonts and icons -->
    <script src="{{ asset('admin') }}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('admin') }}/assets/css/fonts.min.css']
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
    <style>
        .footer {
            bottom: 0;
        }

        .footer .middle {
            margin: 0 auto;
        }

        .auth-page-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            /* Optional background color */
        }
    </style>
</head>

<body cz-shortcut-listen="true">
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row justify-content-center ">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card ">
                            <div class="card-body login-form-box ">

                                <div class="text-center">
                                    <a href="index.php" class="d-inline-block auth-logo">
                                        <img src="{{ asset('storage/'. $companyInformation->brandSetting->main_logo) }}"
                                            alt="" height="40">
                                    </a>
                                    <p class="login-tagline">One Platform, Endless Possibilities</p>
                                    <h5 class="text-primary">Welcome Back !</h5>
                                </div>
                                <div class="">
                                    <!-- Updated login page with role selection -->
                                    <form method="POST" action="{{ route('custom-login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="role">Login as</label>
                                            <select name="role" id="role" class="form-control" required onchange="toggleFields()">
                                                <option value="admin">Admin</option>
                                                <option value="employee">Employee</option>
                                            </select>
                                        </div>

                                        <!-- Username Field (Visible for Admin) -->
                                        <div class="form-group" id="usernameField">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
                                            @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <!-- Email Field (Visible for Employee) -->
                                        <div class="form-group" id="emailField" style="display: none;">
                                            <label for="user_email">Email</label>
                                            <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email" value="{{ old('user_email') }}">
                                            @error('user_email')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <!-- Password Field (Common for Both) -->
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                            @error('login')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>

                                    <script>
                                        function toggleFields() {
                                            const role = document.getElementById('role').value;
                                            const usernameField = document.getElementById('username');
                                            const emailField = document.getElementById('user_email');

                                            if (role === 'admin') {
                                                // Show username field and enable it
                                                usernameField.closest('.form-group').style.display = 'block';
                                                usernameField.disabled = false;

                                                // Hide email field and disable it
                                                emailField.closest('.form-group').style.display = 'none';
                                                emailField.disabled = true;
                                            } else if (role === 'employee') {
                                                // Hide username field and disable it
                                                usernameField.closest('.form-group').style.display = 'none';
                                                usernameField.disabled = true;

                                                // Show email field and enable it
                                                emailField.closest('.form-group').style.display = 'block';
                                                emailField.disabled = false;
                                            }
                                        }

                                        // Call the function on page load to set the initial state
                                        document.addEventListener('DOMContentLoaded', toggleFields);
                                    </script>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="middle">
                    <p class="mb-0 text-muted">
                        {{ $companyInformation->applicationSetting->copyright_text }}
                    </p>
                </div>
            </div>
        </footer>
    </div>
    <!-- end auth-page-wrapper -->
    <!-- Core JS Files -->
    <script src="{{ asset('admin') }}/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/kaiadmin.creative.min.js"></script>
</body>

</html>
