@extends('layouts.admin.auth')

@section('auth-content')
    <div class="login-content login-view-block white-placeholder">
        <h3 class="text-white text-center">Forgot Password ?</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ __(session('status')) }}
            </div>
        @endif
        
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="forget-form js-forgot-password-frm" role="form" method="POST" action="{{ route('password.email', ['domain' => app('request')->route()->parameter('company')]) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                    <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="{{ __("Email") }}" name="email" value="{{ old('email') }}" />
                </div>

                @if ($errors->has('email'))
                    <label class="error">{{ __($errors->first('email')) }}</label>
                @endif
            </div>
            <div class="form-actions row">
                <center>
                    <button type="button" onclick='javascript: location.href="{{ route('login', ['domain' => app('request')->route()->parameter('company')]) }}"' class="btn">{{ __("Back to login") }}</button>
                    <button type="submit" class="btn login-btn uppercase width-auto">{{ __("Submit") }}</button>
                </center>
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

    