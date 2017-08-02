<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Company Admin Theme</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for " name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('css/admin/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('css/admin/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ asset('css/admin/login-5.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link href="{{ asset('css/admin/custom.css') }}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <!-- END HEAD -->

    <body class="login">
    	<div class="login-view-block">
            <div class="container">
                <div class="full-login-screen">
                    <div class="col-md-6 leftbar-login">
                        <div class="login-logo">
                            <img class="" src="{{ asset('img/logo.png') }}" />
                        </div>
                        <div class="login-description">
                            <h2><span>Zwaluw</span> Comfortsanitair</h2>
                            <h3>ver Zwaluw Comfortsanitair de specialist op het gebied van comfortsanitair.</h3>
                        </div>
                        <p class="leftside-para">Het aanpassen van uw badkamer naar een comfortabele omgeving is onze passie.</p>
                    </div>
                    <div class="col-md-6 rightbar-login">   
                        <div class="content-log">
                            <div class="login-logo logoicon">
                                <img src="{{ asset('img/wazir-logo.png') }}">
                            </div>
                            @yield('auth-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

     	<!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
        <link href="{{ asset('css/admin/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->        
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('js/admin/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        {{-- <script src="{{ asset('js/admin/login-5.min.js') }}" type="text/javascript"></script> --}}
        @yield("page-script")
        <!-- END PAGE LEVEL SCRIPTS -->
    </body>