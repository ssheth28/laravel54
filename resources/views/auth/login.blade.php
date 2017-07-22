@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content">
        <h3 class="text-white text-center">Login to your account</h3>
        
        <form class="login-form js-login-frm" role="form" method="POST" action="{{ route('login', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}

            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>{{ __("Enter any username and password.") }} </span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <input class="form-control" type="text" id="email_address" placeholder="{{ __("Enter Email Address") }}" name="login"/>
                        </div>
                    </div>

                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input class="form-control" id="password" type="password" placeholder="{{ __(" Enter Password") }}" name="password"/>
                        </div>
                    </div>

                </div>
                <div class="col-xs-6">
                    @if ($errors->has('login'))
                        <span class="help-block">
                            <strong>{{ __($errors->first('login')) }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-actions row">
                <div class="col-xs-12">
                    <label class="rememberme mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/> {{ __("Remember me") }}
                        <span></span>
                    </label>
                    <a href="javascript:;" id="forget-password" class="forget-password" href="{{ route('password.request', ['domain' => app('request')->route()->parameter('company')]) }}">Forgot Password?</a>
                </div>
                <p class="js-login-error-message" style="color:red"></p>
                <div class="col-xs-12">
                    <button class="btn btn-del btn-5 btn-5a fa fa-lock login-btn" type="submit" id="login_btn">
                        <span>{{ __("Login") }}</span>
                    </button>
                </div>
            </div>
        </form>
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="forget-form" role="form" method="POST" action="{{ route('password.email', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}
            <h3 class="text-white">{{ __("Forgot Password?") }}</h3>
            <p class="text-white"> {{ __("Enter your e-mail address below to reset your password.") }} </p>
            <div class="form-group">
                <input class="form-control placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="{{ __("Email") }}" name="email" value="{{ old('email') }}" required/>
            </div>
            <div class="form-actions row">
                <div class="col-md-12">
                    <button type="button" id="back-btn" class="btn login-btn btn-outline pull-left width-auto">{{ __("Back") }}</button>
                    <button type="submit" class="btn login-btn uppercase pull-right width-auto">{{ __("Submit") }}</button>
                </div>
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->
        <div class="modal" id="select-company-modal" role="dialog">
           <div class="modal-dialog">
              <div class="modal-content popup-action dashboard-modal js-companies-modal-content">
                    {{-- modal body render from modal/select_company.blade.php --}}
              </div>
           </div>
        </div>
        <div class="overlay fade in"></div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/auth.js') }}" type="text/javascript"></script>
@endsection

    