@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content white-placeholder">
        <h3 class="text-white text-center">Registration</h3>
        <form class="login-form registration-form js-register-frm" role="form" method="POST" action="{{ route('register', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}

            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>{{ __("Please fill up required fields.") }}</span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" type="text" id="first_name" autocomplete="off" placeholder="{{ __("First Name") }}" name="first_name" value="{{ old('first_name') }}" required/>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" type="text" id="last_name" autocomplete="off" placeholder="{{ __("Last Name") }}" name="last_name" value="{{ old('last_name') }}" required/>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                            <input class="form-control" type="text" id="company_name" autocomplete="off" placeholder="{{ __("Company Name") }}" name="company_name" value="{{ old('company_name') }}" required/>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="company-name">.Wazirapp.com</span>
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <input class="form-control" type="text" id="company_slug" autocomplete="off" placeholder="{{ __("Company URL") }}" name="company_slug" value="{{ old('company_slug') }}"/>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                            <input class="form-control" id="username" type="text" autocomplete="off" value="{{ old('username') }}" placeholder="{{ __("Username") }}" name="username" required/>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <input class="form-control" id="email" type="email" autocomplete="off" value="{{ old('email') }}" placeholder="{{ __("Email") }}" name="email" required/>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                             <input class="form-control" type="password" id="password" autocomplete="off" id="password" placeholder="{{ __("Password") }}" name="password" required/>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                             <input class="form-control" id="password-confirm" type="password" autocomplete="off" placeholder="{{ __("Confirm Password") }}" name="password_confirmation" required/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="g-recaptcha" data-sitekey="6Lf13CkUAAAAAB_RAC38RqKQXtFt8eL_vePtHvW3"></div>
            <p id="recaptcha-error" class="text-center" style="display: none; color: red">Please ensure that you are a human!</p>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    {{-- <div class="col-xs-12 check-field">
                        <label class="mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" name="terms_condition" id="remember_me"/> {{ __("I agree to all statements included in") }}
                            <span></span>
                            <a href="#" title="terms of service">TERMS OF SERVICE</a>
                        </label>
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <button class="btn-del btn-5 btn-5a fa fa-angle-double-right" type="submit">
                        <span>{{ __("Register") }}</span>
                        </button>
                    </div>
                    <div class="login-register">
                        <a href="{{ route('login', ['domain' => app('request')->route()->parameter('company')]) }}">{{ __("Login") }}</a>
                    </div>
                </div>
            </div>
        </form>        
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/auth.js') }}" type="text/javascript"></script>
@endsection
