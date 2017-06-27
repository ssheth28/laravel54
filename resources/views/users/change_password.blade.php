@extends('layouts.admin.default')
@section('page-style')

@endsection
<link href="{{ asset('css/admin/company.css') }}" rel="stylesheet" type="text/css" />

@section('page-content')
 <div class="row profile cus-pro">
  <div class="col-md-3">
        @include('elements.admin.user_profile_navigation')
        </div>

        <div class="col-md-9"> 
         <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">User Information</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a class="btn btn-icon-only btn-default" href="#">
                            <i class="fa fa-info"></i>
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                   {!! Form::open(['route' => ['users.change.password', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-save-change-password', 'id' => 'js-frm-save-change-password', 'role' => 'form']) !!}
                        <input type="hidden" name="change_password_user_id" value="{{ $user->id }}">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend class="blue-color">Change Password</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-lock blue-color"></i></span>
                                                         {!! Form::password('change_password_current_password', ['class' => 'form-control', 'id' => 'change_password_current_password', 'placeholder' => 'Current Password']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-lock blue-color"></i></span>
                                                        {!! Form::password('change_password_new_password', ['class' => 'form-control', 'id' => 'change_password_new_password', 'placeholder' => 'New Password']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-lock blue-color"></i></span>
                                                         {!! Form::password('change_password_retype_new_password',['class' => 'form-control', 'id' => 'change_password_retype_new_password', 'placeholder' => 'Re-Type Password']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-9">
                                    <button type="submit" class="btn blue">Change Password</button>
                                    <button type="reset" class="btn default">Reset</button>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                    <!-- END FORM-->
                </div>
            </div>
        </div>
 </div>
@endsection