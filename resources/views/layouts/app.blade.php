<!DOCTYPE html>
<html lang="en">
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
        <link href="{{ asset('plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
        <link href="{{ asset('plugins/fontawesome-iconpicker/fontawesome-iconpicker.min.css') }}" rel="stylesheet" type="text/css" />
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
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    </head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
    <div id="app">
        {{-- <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">{{ __("Toggle Navigation") }}</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ __(config('app.name', 'Laravel')) }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ LaravelLocalization::getCurrentLocaleNative() }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode, $url = null, $attributes = [], $forceDefaultLocation = true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login', ['domain' => app('request')->route()->parameter('company')]) }}">{{ __("Login") }}</a></li>
                            <li><a href="{{ route('register', ['domain' => app('request')->route()->parameter('company')]) }}">{{ __("Register") }}</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout', ['domain' => app('request')->route()->parameter('company')]) }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __("Logout") }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout', ['domain' => app('request')->route()->parameter('company')]) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav> --}}

        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="http://test.rishab-base.dev.aecortech.com/admin/home">
                        <img src="http://test.rishab-base.dev.aecortech.com/img/logo.png" alt="logo" class="logo-default"> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <div class="page-top">
                    
                    <div class="top-menu pull-left lang-box lang-translation">
                        <div class="lang-box-inner">
                            <ul style="list-style-type: none;">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <span class="flag">
                                            <img src="/img/admin/flag.png" width="20">
                                        </span>
                                        English <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                <a rel="alternate" hreflang="id" href="http://test.rishab-base.dev.aecortech.com/id/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    Bahasa Indonesia
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="da" href="http://test.rishab-base.dev.aecortech.com/da/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    dansk
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="de" href="http://test.rishab-base.dev.aecortech.com/de/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    Deutsch
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="en" href="http://test.rishab-base.dev.aecortech.com/en/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    English
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="es" href="http://test.rishab-base.dev.aecortech.com/es/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    español
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="fr" href="http://test.rishab-base.dev.aecortech.com/fr/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    français
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="it" href="http://test.rishab-base.dev.aecortech.com/it/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    italiano
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="nl" href="http://test.rishab-base.dev.aecortech.com/nl/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    Nederlands
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="sv" href="http://test.rishab-base.dev.aecortech.com/sv/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    svenska
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="el" href="http://test.rishab-base.dev.aecortech.com/el/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    Ελληνικά
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="ar" href="http://test.rishab-base.dev.aecortech.com/ar/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    العربية
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="hi" href="http://test.rishab-base.dev.aecortech.com/hi/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    हिन्दी
                                                </a>
                                            </li>
                                                                            <li>
                                                <a rel="alternate" hreflang="th" href="http://test.rishab-base.dev.aecortech.com/th/admin/home">
                                                    <span class="flag">
                                                        <img src="/img/admin/flag.png" width="20">
                                                    </span>
                                                    ไทย
                                                </a>
                                            </li>
                                                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="top-menu pull-left lang-text">
                        <p>Selected language is English </p>
                        
                    </div>
                    
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>

        @yield('content')

        <div class="page-footer">
            <div class="trial-reminder">
                <a href="#">Go Pro</a>
                <div class="pro-bar">
                    <div style="width: 50%;" class="bar"></div>
                    <span><b>15</b> days left</span>
                </div>
            </div>
            <div class="page-footer-inner"> 2017 © Company Theme By
                <a target="_blank" href="#">Company</a>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>

            <!-- BEGIN QUICK NAV -->
            <nav class="quick-nav">
                <a class="quick-nav-trigger" href="#0">
                    <span aria-hidden="true"></span>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            <span>Customer Reviews</span>
                            <i class="icon-users"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Showcase</span>
                            <i class="icon-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Changelog</span>
                            <i class="icon-graph"></i>
                        </a>
                    </li>
                </ul>
                <span aria-hidden="true" class="quick-nav-bg"></span>
            </nav>
            <div class="quick-nav-overlay"></div>
            <!-- END QUICK NAV -->

            <!-- END FOOTER -->

            <div class="widget-setting">
                <span class="overlay"></span>
                <a href="javascript:;" class="fa fa-info info icon-hidden" data-toggle="modal" data-target="#info-popup"><span>Info</span></a>
                <a href="javascript:;" class="fa fa-tags label-tag icon-hidden" data-toggle="modal" data-target="#change-label-popup"><span>Change Label</span></a>
                <a href="javascript:;" class="fa fa fa-trash-o delete icon-hidden"><span>Delete</span></a>
                <a href="javascript:;" class="fa fa-plus add icon-hidden" data-toggle="modal" data-target="#add-widget-popup"><span>Add</span></a>
                <a href="javascript:;" class="fa fa-cog setting"><span>Widget<br>setting</span></a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @include('scripts.app')
    @yield('beforeScript')
<script src="{{ asset('plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="http://htmlwazir.peppyemails.com/js/bootstrap-fileinput.js" type="text/javascript"></script>
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
        <script src="{{ asset('plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

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
    @yield('afterScript')
</body>
</html>
