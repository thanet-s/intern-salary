<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>
        @yield('title') - ระบบบริหารการจัดการนักศึกษาฝึกงานของบริษัท ยูนิมิต เอนจิเนียริ่ง จำกัด(มหาชน)
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="_token" content="{{ csrf_token() }}">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="/css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="/css/app.bundle.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="icon" href="/img/logo.png" type="image/png" sizes="32x32">
    <!-- Optional: page related CSS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen, print" href="/css/datagrid/datatables/datatables.bundle.css">
    <link rel="stylesheet" media="screen, print" href="/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css">
</head>

<body class="mod-bg-1 " style="font-family: 'Sarabun', sans-serif;">
    <!-- DOC: script to save and load page settings -->
    <script>
        /**
         *	This script should be placed right after the body tag for fast execution 
         *	Note: the script is written in pure javascript and does not depend on thirdparty library
         **/
        'use strict';

        var classHolder = document.getElementsByTagName("BODY")[0],
            /** 
             * Load from localstorage
             **/
            themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
            themeURL = themeSettings.themeURL || '',
            themeOptions = themeSettings.themeOptions || '';
        /** 
         * Load theme options
         **/
        if (themeSettings.themeOptions) {
            classHolder.className = themeSettings.themeOptions;
            console.log("%c✔ Theme settings loaded", "color: #148f32");
        } else {
            console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
        }
        if (themeSettings.themeURL && !document.getElementById('mytheme')) {
            var cssfile = document.createElement('link');
            cssfile.id = 'mytheme';
            cssfile.rel = 'stylesheet';
            cssfile.href = themeURL;
            document.getElementsByTagName('head')[0].appendChild(cssfile);
        }
        /** 
         * Save to localstorage 
         **/
        var saveSettings = function() {
            themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
                return /^(nav|header|mod|display)-/i.test(item);
            }).join(' ');
            if (document.getElementById('mytheme')) {
                themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
            };
            localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
        }
        /** 
         * Reset settings
         **/
        var resetSettings = function() {
            localStorage.setItem("themeSettings", "");
        }
    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            <aside class="page-sidebar">
                <div class="page-logo">
                    <a href="/dashboard" class="page-logo-link press-scale-down d-flex align-items-center position-relative" style="justify-content: center;">
                        <img src="/img/logo.png" alt="logo" aria-roledescription="logo" height="50px" width="50px">
                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
                <nav id="js-primary-nav" class="primary-nav" role="navigation">
                    <ul id="js-nav-menu" class="nav-menu">
                        <li class="nav-title">Navigation</li>
                        <li>
                            <a href="/dashboard">
                                <i class="fal fa-window"></i>
                                <span class="nav-link-text">นักศึกษา</span>
                            </a>
                        </li>
                        <li>
                            <a href="/salary-calculator">
                                <i class="fal fa-calculator"></i>
                                <span class="nav-link-text">สรุปยอดเบี้ยเลี้ยง</span>
                            </a>
                        </li>
                        <li>
                            <a href="/add-student">
                                <i class="fal fa-user-plus"></i>
                                <span class="nav-link-text">เพิ่มนักศึกษา</span>
                            </a>
                        </li>
                        <li>
                            <a href="/add-admin">
                                <i class="fal fa-user-plus"></i>
                                <span class="nav-link-text">เพิ่มแอดมิน</span>
                            </a>
                        </li>
                        <li>
                            <a href="/department">
                                <i class="fal fa-users"></i>
                                <span class="nav-link-text">จัดการแผนก</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admins">
                                <i class="fal fa-user-secret"></i>
                                <span class="nav-link-text">จัดการแอดมิน</span>
                            </a>
                        </li>
                        <li>
                            <a href="/import-data">
                                <i class="fal fa-upload"></i>
                                <span class="nav-link-text">นำเข้าข้อมูล</span>
                            </a>
                        </li>
                    </ul>
                    <div class="filter-message js-filter-message bg-success-600"></div>
                </nav>
                <!-- END PRIMARY NAVIGATION -->
            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <header class="page-header" role="banner">
                    <!-- we need this logo when user switches to nav-function-top -->
                    <!-- <div class="page-logo">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                            <span class="page-logo-text mr-1">{{ config('app.name') }}</span>
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div> -->
                    <!-- DOC: nav menu layout change shortcut -->
                    <div class="hidden-md-down dropdown-icon-menu position-relative">
                        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                            <i class="ni ni-menu"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                    <i class="ni ni-minify-nav"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                    <i class="ni ni-lock-nav"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- DOC: mobile button appears during mobile width -->
                    <div class="hidden-lg-up">
                        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="/dashboard">
                            <h3 class="text-secondary hidden-xs-down" style="margin-top: auto; margin-bottom: auto;">ระบบบริหารการจัดการนักศึกษาฝึกงานของบริษัท ยูนิมิต เอนจิเนียริ่ง จำกัด(มหาชน)</h3>
                        </a>
                    </div>
                    <div class="ml-auto d-flex">
                        <!-- app user menu -->
                        <div>
                            <a href="#" data-toggle="dropdown" title="User Setting" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                <img src="/img/user.png" class="bg-primary-50 profile-image rounded-circle" alt="user">
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                        <div class="info-card-text">
                                            <div class="fs-lg text-truncate text-truncate-lg">{{ auth()->user()->name }}</div>
                                            <span class="text-truncate text-truncate-md opacity-80">{{ auth()->user()->email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                                <a href="#" class="dropdown-item" data-action="app-reset">
                                    <span data-i18n="drpdwn.reset_layout">รีเซตเลเอาท์</span>
                                </a>
                                <a href="/user" class="dropdown-item">
                                    <span data-i18n="drpdwn.settings">ตั้งค่าบัญชีผู้ใช้</span>
                                </a>
                                <div class="dropdown-divider m-0"></div>
                                <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                    <span data-i18n="drpdwn.fullscreen">เต็มจอ</span>
                                    <i class="float-right text-muted fw-n">F11</i>
                                </a>
                                <a href="#" class="dropdown-item" data-action="app-print">
                                    <span data-i18n="drpdwn.print">พิมพ์</span>
                                    <i class="float-right text-muted fw-n">Ctrl + P</i>
                                </a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item fw-500 pt-3 pb-3" href="/logout">
                                    <span data-i18n="drpdwn.page-logout">ออกจากระบบ</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- END Page Header -->
                <!-- BEGIN Page Content -->
                <!-- the #js-page-content id is needed for some plugins to initialize -->
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-clipboard-list'></i> @yield('subtitle')
                            <small>
                            </small>
                        </h1>
                    </div>
                    @yield('content')
                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <footer class="page-footer" role="contentinfo">
                    <div class="d-flex align-items-center flex-1 text-muted">
                        <span class="hidden-md-down fw-700">2021 © CopyRight</span>
                    </div>
                </footer>
                <!-- END Page Footer -->
            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->

    <script src="/js/vendors.bundle.js"></script>
    <script src="/js/app.bundle.js"></script>
    <script type="text/javascript">
        /* Activate smart panels */
        $('#js-page-content').smartPanel();
    </script>
    <!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    @yield('tableSetting')
</body>

</html>