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
        นักศึกษาทั้งหมด - {{ config('app.name') }}
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
    <link rel="stylesheet" media="screen, print" href="css/datagrid/datatables/datatables.bundle.css">
</head>

<body class="mod-bg-1 ">
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
                    <a href="/" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                        <span class="page-logo-text mr-1">{{ config('app.name') }}</span>
                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
                <nav id="js-primary-nav" class="primary-nav" role="navigation">
                    <ul id="js-nav-menu" class="nav-menu">
                        <li class="nav-title">Navigation</li>
                        <li>
                            <a href="/">
                                <i class="fal fa-window"></i>
                                <span class="nav-link-text">หน้าแรก</span>
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
                            <a href="admins">
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
                    <div class="page-logo">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                            <span class="page-logo-text mr-1">{{ config('app.name') }}</span>
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div>
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
                    <div class="ml-auto d-flex">
                        <!-- app user menu -->
                        <div>
                            <a href="#" data-toggle="dropdown" title="User Setting" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                <img src="img/user.png" class="bg-primary-50 profile-image rounded-circle" alt="user">
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
                            <i class='subheader-icon fal fa-chart-area'></i> นักศึกษาทั้งหมด
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
                                                    <th>CustomerID</th>
                                                    <th>Name</th>
                                                    <th>PurchaseDate</th>
                                                    <th>CustomerEmail</th>
                                                    <th>CustomerCVV</th>
                                                    <th>Country</th>
                                                    <th>InvoiceAmount</th>
                                                    <th>Controls</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>CustomerID</th>
                                                    <th>Name</th>
                                                    <th>PurchaseDate</th>
                                                    <th>CustomerEmail</th>
                                                    <th>CustomerCVV</th>
                                                    <th>Country</th>
                                                    <th>InvoiceAmount</th>
                                                    <th>Controls</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>268410636</td>
                                                    <td>Cooley, Walker J.</td>
                                                    <td>03-13-19</td>
                                                    <td>odio.auctor@orcilobortis.edu</td>
                                                    <td>717</td>
                                                    <td>Timor-Leste</td>
                                                    <td>$7,007</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>077610947</td>
                                                    <td>Wise, Ruby R.</td>
                                                    <td>04-10-19</td>
                                                    <td>mi.Aliquam@afeugiat.edu</td>
                                                    <td>715</td>
                                                    <td>Burkina Faso</td>
                                                    <td>$7,052</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>025865486</td>
                                                    <td>Rasmussen, Piper C.</td>
                                                    <td>01-18-19</td>
                                                    <td>blandit@molestiesodales.com</td>
                                                    <td>496</td>
                                                    <td>Slovakia</td>
                                                    <td>$8,843</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>602908154</td>
                                                    <td>Kinney, Laurel N.</td>
                                                    <td>01-27-20</td>
                                                    <td>neque.Nullam@penatibuset.org</td>
                                                    <td>718</td>
                                                    <td>Norfolk Island</td>
                                                    <td>$8,374</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>103910519</td>
                                                    <td>Hess, Oren I.</td>
                                                    <td>10-29-19</td>
                                                    <td>tincidunt.pede.ac@tellusNunclectus.edu</td>
                                                    <td>804</td>
                                                    <td>Mauritius</td>
                                                    <td>$5,009</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>053136990</td>
                                                    <td>Baldwin, Beau W.</td>
                                                    <td>03-20-19</td>
                                                    <td>a.felis@nisiaodio.org</td>
                                                    <td>133</td>
                                                    <td>Saint Lucia</td>
                                                    <td>$8,786</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>554906412</td>
                                                    <td>Herrera, Lila R.</td>
                                                    <td>01-10-19</td>
                                                    <td>habitant.morbi.tristique@aptent.edu</td>
                                                    <td>441</td>
                                                    <td>Malawi</td>
                                                    <td>$7,422</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>813289717</td>
                                                    <td>Rowland, Jameson U.</td>
                                                    <td>10-19-19</td>
                                                    <td>est.vitae@molestieorcitincidunt.com</td>
                                                    <td>224</td>
                                                    <td>Bouvet Island</td>
                                                    <td>$7,380</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>552262891</td>
                                                    <td>Burks, Tanya X.</td>
                                                    <td>03-26-19</td>
                                                    <td>nunc.risus@leo.co.uk</td>
                                                    <td>168</td>
                                                    <td>Australia</td>
                                                    <td>$9,070</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>925675126</td>
                                                    <td>Santana, Knox B.</td>
                                                    <td>06-05-20</td>
                                                    <td>at.libero@molestie.org</td>
                                                    <td>288</td>
                                                    <td>Armenia</td>
                                                    <td>$7,205</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>042657015</td>
                                                    <td>Russell, Ima J.</td>
                                                    <td>10-06-18</td>
                                                    <td>egestas.lacinia.Sed@risusDonec.com</td>
                                                    <td>588</td>
                                                    <td>New Caledonia</td>
                                                    <td>$7,272</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>379067929</td>
                                                    <td>Knowles, Chanda J.</td>
                                                    <td>09-06-18</td>
                                                    <td>tristique@antedictum.co.uk</td>
                                                    <td>747</td>
                                                    <td>Lebanon</td>
                                                    <td>$8,249</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>322274499</td>
                                                    <td>Mcclain, Bree J.</td>
                                                    <td>03-12-20</td>
                                                    <td>ante@nislelementumpurus.org</td>
                                                    <td>224</td>
                                                    <td>Korea, South</td>
                                                    <td>$5,587</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>404718686</td>
                                                    <td>Bailey, Lani X.</td>
                                                    <td>08-07-19</td>
                                                    <td>Proin@massaMauris.ca</td>
                                                    <td>761</td>
                                                    <td>Australia</td>
                                                    <td>$6,092</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>359926938</td>
                                                    <td>Sloan, Keefe I.</td>
                                                    <td>10-14-18</td>
                                                    <td>Nullam@utaliquamiaculis.org</td>
                                                    <td>806</td>
                                                    <td>South Georgia and The South Sandwich Islands</td>
                                                    <td>$5,003</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>369436084</td>
                                                    <td>Stephenson, Lilah J.</td>
                                                    <td>07-13-19</td>
                                                    <td>nisl@metus.com</td>
                                                    <td>394</td>
                                                    <td>Zambia</td>
                                                    <td>$6,766</td>
                                                    <td>1</td>
                                                </tr>
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
    <script type="text/javascript">
        /* Activate smart panels */
        $('#js-page-content').smartPanel();
    </script>
    <!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
    <script src="js/datagrid/datatables/datatables.bundle.js"></script>
    <script>
        $(document).ready(function() {

            /* init datatables */
            $('#dt-basic-example').dataTable({
                order: [[ 0, "desc" ]],
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
                        className: 'btn-outline-default'
                    }

                ],
                columnDefs: [{
                        targets: -1,
                        title: 'Controls',
                        orderable: false,
                        render: function(data, type, full, meta) {

                            /*
                            -- ES6
                            -- convert using https://babeljs.io online transpiler
                            return `
                            <a href='javascript:void(0);' class='btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1' title='Delete Record'>
                            	<i class="fal fa-times"></i>
                            </a>
                            <div class='dropdown d-inline-block dropleft '>
                            	<a href='#'' class='btn btn-sm btn-icon btn-outline-primary rounded-circle shadow-0' data-toggle='dropdown' aria-expanded='true' title='More options'>
                            		<i class="fal fa-ellipsis-v"></i>
                            	</a>
                            	<div class='dropdown-menu'>
                            		<a class='dropdown-item' href='javascript:void(0);'>Change Status</a>
                            		<a class='dropdown-item' href='javascript:void(0);'>Generate Report</a>
                            	</div>
                            </div>`;
                            	
                            ES5 example below:	

                            */
                            return "\n\t\t\t\t\t\t<a href='javascript:void(0);' class='btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1' title='Delete Record'>\n\t\t\t\t\t\t\t<i class=\"fal fa-times\"></i>\n\t\t\t\t\t\t</a>\n\t\t\t\t\t\t<div class='dropdown d-inline-block dropleft'>\n\t\t\t\t\t\t\t<a href='#'' class='btn btn-sm btn-icon btn-outline-primary rounded-circle shadow-0' data-toggle='dropdown' aria-expanded='true' title='More options'>\n\t\t\t\t\t\t\t\t<i class=\"fal fa-ellipsis-v\"></i>\n\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t<div class='dropdown-menu'>\n\t\t\t\t\t\t\t\t<a class='dropdown-item' href='javascript:void(0);'>Change Status</a>\n\t\t\t\t\t\t\t\t<a class='dropdown-item' href='javascript:void(0);'>Generate Report</a>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>";
                        },
                    },

                ]

            });

        });
    </script>
</body>

</html>