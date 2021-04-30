<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>
        นักศึกษาฝึกงาน - ระบบบริหารการจัดการนักศึกษาฝึกงานของบริษัท ยูนิมิต เอนจิเนียริ่ง จำกัด(มหาชน)
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
                    <a href="/" class="page-logo-link press-scale-down d-flex align-items-center position-relative" style="justify-content: center;">
                        <img src="/img/logo.png" alt="logo" aria-roledescription="logo" height="50px" width="50px">
                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
                <nav id="js-primary-nav" class="primary-nav" role="navigation">
                    <ul id="js-nav-menu" class="nav-menu">
                        <li class="nav-title">Navigation</li>
                        <li>
                            <a href="/">
                                <i class="fal fa-window"></i>
                                <span class="nav-link-text">นักศึกษา</span>
                            </a>
                        </li>
                        <li>
                            <a href="/salary">
                                <i class="fal fa-calculator"></i>
                                <span class="nav-link-text">สรุปยอดเบี้ยเลี้ยง</span>
                            </a>
                        </li>
                        <li>
                            <a href="/login">
                                <i class="fal fa-user-secret"></i>
                                <span class="nav-link-text">เข้าสู่ระบบจัดการ</span>
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
                        <a href="/">
                            <h3 class="text-secondary hidden-xs-down" style="margin-top: auto; margin-bottom: auto;">ระบบบริหารการจัดการนักศึกษาฝึกงานของบริษัท ยูนิมิต เอนจิเนียริ่ง จำกัด(มหาชน)</h3>
                        </a>
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
                            <i class='subheader-icon fal fa-clipboard-list'></i> นักศึกษาฝึกงาน
                            <small>
                            </small>
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="panel-4" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        นักศึกษา <span class="fw-300"><i>ทั้งหมด</i></span>
                                    </h2>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                            <thead class="bg-warning-200">
                                                <tr>
                                                    <th>รหัส</th>
                                                    <th>ชื่อ</th>
                                                    <th>แผนก</th>
                                                    <th>สถาบัน</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>เบอร์โทรศัพท์</th>
                                                    <th>สถานะ</th>
                                                    <th>รายละเอียด</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>รหัส</th>
                                                    <th>ชื่อ</th>
                                                    <th>แผนก</th>
                                                    <th>สถาบัน</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>เบอร์โทรศัพท์</th>
                                                    <th>สถานะ</th>
                                                    <th>รายละเอียด</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach ($interners as $i)
                                                <tr>
                                                    <td>{{ $i->id }}</td>
                                                    <td>{{ $i->name }}</td>
                                                    <td>{{ $i->department }}</td>
                                                    <td>{{ $i->institution }}</td>
                                                    <td>{{ $i->field }}</td>
                                                    <td>{{ $i->tel }}</td>
                                                    @if (!$i->pass)
                                                    <td>กำลังฝึกงาน</td>
                                                    @else
                                                    <td>ฝึกงานจบแล้ว</td>
                                                    @endif
                                                    <td>1</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script>
        $(document).ready(function() {

            /* init datatables */
            $('#dt-basic-example').dataTable({
                order: [
                    [0, "desc"]
                ],
                pageLength: 20,
                responsive: true,
                dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [{
                        extend: 'colvis',
                        text: 'เลือกคอลัมน์',
                        titleAttr: 'Col visibility',
                        className: 'btn-outline-default'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'ส่งออก CSV',
                        titleAttr: 'Generate CSV',
                        exportOptions: {
                            columns: ':visible(.export-col)'
                        },
                        className: 'btn-outline-default'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fal fa-print"></i>',
                        titleAttr: 'Print Table',
                        exportOptions: {
                            columns: ':visible(.export-col)'
                        },
                        className: 'btn-outline-default'
                    }

                ],
                columnDefs: [{
                        targets: -1,
                        title: 'รายละเอียด',
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                            <div class='dropdown d-inline-block dropleft'>
                                <a href="/interner/${row[0]}" target="_blank" class='btn btn-sm btn-icon btn-outline-primary rounded-circle shadow-0'>
                                    <i class=\"fal fa-ellipsis-v\"></i>
                                </a>
                            </div>
                        `;
                        },
                    },

                ]

            });

        });
    </script>
</body>

</html>