<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Company</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Company" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Signika+Negative:400,600,700" rel="stylesheet">
        <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/bootstrap-tour.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
        <link href="{{ asset('css/admin/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/fontawesome-iconpicker/fontawesome-iconpicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
        @yield('page-core-style')
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('css/admin/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('css/admin/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('css/admin/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/themes/blue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />        

        @yield('page-style')

        <link href="{{ asset('css/admin/custom.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/form.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/profile.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/grid.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />        
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        <!-- BEGIN HEADER -->
        @include('elements.admin.header')
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            @include('elements.admin.sidebar')
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <div class="page-content-body">
                        @include('elements.admin.delete_modal')
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <span>{{ $title }}</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
                                <div class="date-time clearfix">
                                    <div id="myTime" class="show-date"></div>
                                    <div id="myTimeData" class="show-time"></div>
                                </div>
                            </div>
                        </div>
                        @yield('page-content')
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        @include('elements.admin.footer')
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
        <script src="../assets/global/plugins/respond.min.js"></script>
        <script src="../assets/global/plugins/excanvas.min.js"></script> 
        <script src="../assets/global/plugins/ie8.fix.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/bootstrap-fileinput.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.6/vue.js"></script>
        <script src="{{ asset('js/admin/jquery.twbsPagination.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap-datetimepicker/js/moment-with-locales.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
        <script src="{{ asset('js/admin/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('js/admin/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('plugins/fontawesome-iconpicker/fontawesome-iconpicker.min.js') }}" type="text/javascript"></script>
        @yield("page-core-scripts")
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{ asset('js/admin/layout.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/demo.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/quick-sidebar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/quick-nav.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/form-wizard.min.js') }}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script src="{{ asset('js/admin/common.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/owl.carousel.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/bootstrap-tour.min.js') }}" type="text/javascript"></script>
        @yield("page-script")
    </body>
</html>