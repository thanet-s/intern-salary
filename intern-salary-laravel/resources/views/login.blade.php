<!DOCTYPE html>
<!-- 
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.0.0
Author: Sunnyat Ahmmed
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>
        Login - {{ config('app.name') }}
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <!-- Place favicon.ico in the root directory -->
    <!-- Optional: page related CSS-->
    <link rel="stylesheet" media="screen, print" href="css/page-login.css">
</head>

<body>
    <div class="page-wrapper">
        <div class="page-inner bg-brand-gradient">
            <div class="page-content-wrapper bg-transparent m-0">
                <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                    <div class="d-flex align-items-center container p-0">
                        <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                            <a href="/" class="page-logo-link press-scale-down d-flex align-items-center">
                                <span class="page-logo-text mr-1">ระบบจัดการนักศึกษาฝึกงาน</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="blankpage-form-field">
                            <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
                                Login
                            </h1>
                            <div class="card p-4 rounded-plus bg-faded">
                                @error('email')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                @if( request()->get('logout_message') )
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ request()->get('logout_message') }}</strong>
                                </div>
                                @endif
                                <form id="js-login" novalidate="" action="/login" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="username">Email</label>
                                        <input type="email" id="username" class="form-control form-control-lg" placeholder="email@mail.com" name="email" required>
                                        <div class="invalid-feedback">กรุณากรอกให้ถูกต้อง</div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" class="form-control form-control-lg" placeholder="Password" name="password" required>
                                        <div class="invalid-feedback">กรุณากรอกให้ถูกต้อง</div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-lg-6 pl-lg-1 my-2">
                                            <button id="js-login-btn" type="submit" class="btn btn-info btn-block btn-lg">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                        2019 © CopyRight
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
    <script src="js/vendors.bundle.js"></script>
    <script src="js/app.bundle.js"></script>
    <script>
        $("#js-login-btn").click(function(event) {

            // Fetch form to apply custom Bootstrap validation
            var form = $("#js-login")

            if (form[0].checkValidity() === false) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.addClass('was-validated');
            // Perform ajax submit here...
        });
    </script>
</body>

</html>