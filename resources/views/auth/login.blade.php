@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content white-placeholder">
        <form class="login-form js-login-frm" role="form" method="POST" action="{{ route('login', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}

            @include('flash::message')
        
            @if (session('status'))
                <div class="alert alert-success">
                    {{ __(session('status')) }}
                </div>
            @endif

            <h3 class="form-title">Login to your account</h3>

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
            <div class="form-actions">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="remember_me"/> {{ __("Remember me") }}
                    <span></span>
                </label>
                <a id="forget-password" class="forget-password" href="{{ route('password.request', ['domain' => app('request')->route()->parameter('company')]) }}">Forgot Password?</a>
                <p class="js-login-error-message text-center col-xs-12" style="color:red; display:none;"></p>
                <button class="btn-del btn-5 btn-5a fa fa-lock login-btn" type="submit" id="login_btn">
                    <span>{{ __("Login") }}</span>
                </button>
            </div>
        </form>
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

    