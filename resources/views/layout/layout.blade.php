<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <title>KASIR</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta content="A premium admin dashboard template by themesbrand" name="description" />
            <meta content="Themesbrand" name="author" />
            <meta http-equiv='cache-control' content='no-cache'>
            <meta http-equiv='expires' content='0'>
            <meta http-equiv='pragma' content='no-cache'>
            <meta name="_token" content="{{csrf_token()}}" />
            <link rel="shortcut icon" href="">
            <link href="/assets_vlight/plugins/animate/animate.css" rel="stylesheet" type="text/css">
            <!-- App css -->
            <link href="/assets_vlight/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="/assets_vlight/plugins/morris/morris.css">
            <link href="/assets_vlight/css/icons.css" rel="stylesheet" type="text/css" />
            <link href="/assets_vlight/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
            <link href="/assets_vlight/css/metismenu.min.css" rel="stylesheet" type="text/css" />
            <link href="/assets_vlight/plugins/metro/MetroJs.min.css" rel="stylesheet" >
            <link href="/assets_vlight/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
            <link href="/assets_vlight/plugins/tagsinput/jquery.tagsinput.css" rel="stylesheet" />
            <link href="/assets_vlight/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">
            <link href="/assets_vlight/plugins/dropify/css/dropify.min.css" rel="stylesheet">

            <!-- App css -->
            <link href="/assets_vlight/css/style.css" rel="stylesheet" type="text/css" />
            <link href="/assets_vlight/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
            <style>
                .square{
                    transition: transform .2s;
                    margin:1px;
                    text-align:left;
                    display:inline-block;    
                    margin: 0 auto;
                    font-family:Arial;
                    margin-bottom:20px;
                }

                .square:hover {
                    transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
                }
                .circle_div { 
                    width: 20px;
                    height:20px;
                    padding-top:2px;
                    background: #e600ac; 
                    -moz-border-radius: 10px; 
                    -webkit-border-radius: 10px; 
                    border-radius: 10px;
                    text-align:center;
                    font-size:12px;
                    color:#fff;
                    font-family:Arial;
                }
                .circle_div_bill { 
                    width: 20px;
                    height:20px;
                    padding-top:1px;
                    background: #0000ff; 
                    -moz-border-radius: 10px; 
                    -webkit-border-radius: 10px; 
                    border-radius: 10px;
                    text-align:center;
                    font-size:12px;
                    color:#fff;
                    font-family:Arial;
                }
            </style>
        </head>

        <body>

            <!-- Top Bar Start -->
            <div class="topbar" style="background-color: #000">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="#" class="logo">
                    </a>
                </div>

                <!-- Navbar -->
                <nav class="navbar-custom">

                    <!-- Search input -->
                    <div class="search-wrap" id="search-wrap">
                        <div class="search-bar">
                            <input class="search-input" type="search" placeholder="Search here.." />
                            <a href="javascript:void(0);" class="close-search search-btn" data-target="#search-wrap">
                                <i class="mdi mdi-close-circle"></i>
                            </a>
                        </div>
                    </div>
        
                    <ul class="list-unstyled topbar-nav float-right mb-0">
                        <li>
                            <a class="nav-link waves-effect waves-light search-btn" href="javascript:void(0);" data-target="#search-wrap">
                                <i class="mdi mdi-magnify nav-icon"></i>
                            </a>
                        </li>

                        

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-bell-outline nav-icon"></i>
                                <span class="badge badge-danger badge-pill noti-icon-badge">1</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                                <!-- item-->
                                <h6 class="dropdown-item-text">
                                    Notifications (1)
                                </h6>
                                <div class="slimscroll notification-list">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-lumx"></i></div>
                                        <p class="notify-details">Update Aplikasi<small class="text-muted">E-RM Medis dan Perawatan Poliklinik Rawat Jalan Telah Diupdate</small></p>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon bg-danger"><i class="mdi mdi-lumx"></i></div>
                                        <p class="notify-details">Update Aplikasi<small class="text-muted">E-RM Medis dan Perawatan Poliklinik Rawat Jalan Telah Diupdate</small></p>
                                    </a>
                                    
                                </div>
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                    View all <i class="fi-arrow-right"></i>
                                </a>
                            </div>
                        </li>

                        <li class="hidden-sm">
                            <a class="nav-link waves-effect waves-light" href="javascript:void(0);" id="btn-fullscreen">
                                <i class="mdi mdi-fullscreen nav-icon"></i>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <img src="" class="rounded-circle" /> 
                                <span class="ml-1 nav-user-name hidden-sm"> <i class="mdi mdi-chevron-down"></i> </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="user_profile.php"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
                                <a class="dropdown-item" href="user_setting.php"><i class="dripicons-gear text-muted mr-2"></i> Settings</a>
                                <a class="dropdown-item" href="user_activity.php"><i class="dripicons-wallet text-muted mr-2"></i> My Activity</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
        
                    <ul class="list-unstyled topbar-nav mb-0">
                            
                        <li>
                            <button id="BtnMenu" class="button-menu-mobile nav-link waves-effect waves-light">
                                <i class="mdi mdi-menu nav-icon"></i>
                            </button>
                        </li>
                        
                        <li class="hidden-sm">
                            @include('layout.menu_dropdown')
                        </li>
                        
                    </ul>

                </nav>
                <!-- end navbar-->
            </div>
            <!-- Top Bar End -->

            <div class="page-wrapper">
                <!-- Left Sidenav -->
                @include('layout.menu')
                <!-- end left-sidenav-->

                <!-- Page Content-->
                <div class="page-content p-0">
                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                    <footer class="footer text-center text-sm-left">
                    © 2022<span class="text-muted d-none d-sm-inline-block float-right"><i class="mdi mdi-heart text-danger"></i></span>
                    </footer>
                </div>
                <!-- end page content -->
            </div>
            <!-- end page-wrapper -->


            <!-- jQuery  -->
            <script src="/assets_vlight/js/jquery.min.js"></script>
            <script src="/assets_vlight/js/bootstrap.bundle.min.js"></script>
            <script src="/assets_vlight/js/metisMenu.min.js"></script>
            <script src="/assets_vlight/js/waves.min.js"></script>
            <script src="/assets_vlight/js/jquery.slimscroll.min.js"></script>
            <script src="/assets_vlight/plugins/morris/morris.min.js"></script>
            <script src="/assets_vlight/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="/assets_vlight/plugins/datatables/dataTables.bootstrap4.min.js"></script> 
            
            <script src="/assets_vlight/plugins/dropzone/dist/dropzone.js"></script>
            <script src="/assets_vlight/plugins/dropify/js/dropify.min.js"></script>
            <script src="/assets_vlight/pages/jquery.dropzone.init.js"></script> 
            <script src="/assets_vlight/plugins/sweet-alert2/sweetalert2.min.js"></script>
            <script src="/assets_vlight/pages/jquery.sweet-alert.init.js"></script>  
            <script src="/assets/js/jquery-dateformat.min.js"></script>  
            <script src="/assets/js/jquery-dateformat.js"></script> 
            <script src="/assets_vlight/js/app.js"></script>
            <script src="/assets_vlight/js/jquery-dateformat.min.js"></script>  
            <script src="/assets_vlight/js/jquery-dateformat.js"></script> 

            <script>
                $(document).ready(function() {
                    // $(".left-sidenav").css("display", "none");
                    $('#BtnMenu').on("click", function (e) {
                        if($('.left-sidenav').css('display') == 'none')
                            $(".left-sidenav").css("display", "block");
                        else
                            $(".left-sidenav").css("display", "none");
                    });
                });
            </script>
            @yield('page-js-script')
        </body>
    </html>