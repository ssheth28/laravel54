@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content white-placeholder">
        <h3 class="text-white text-center">Reset Password</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ __(session('status')) }}
            </div>
        @endif

        @if ($errors->has('email'))
            <label class="error">{{ __($errors->first('email')) }}</label>
        @endif

        <form class="login-form js-reset-password-frm" role="form" method="POST" action="{{ route('password.request', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ app('request')->route()->parameter('token') }}">
            <input type="hidden" value="{{ $email or old('email') }}" name="email" />
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" id="reset_password" autocomplete="off" placeholder="{{ __("Enter new password") }}" name="password" />
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="{{ __("Re-Enter new password") }}" name="password_confirmation" />
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-del btn-5 btn-5a fa fa-lock"><span>{{ __("Reset") }}</span></button>
            </div>
        </form>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/auth.js') }}" type="text/javascript"></script>
@endsection
