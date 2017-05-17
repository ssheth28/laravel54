@extends('layouts.admin.default')

@section('page-style')

@endsection
@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-newspaper-o"></i>
                <span class="caption-subject bold uppercase font-dark">Add Users
                    <span class="step-title"></span>
                </span>                
            </div>
            <div class="tools">
                &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
            </div>
            <div class="actions">
                <a class="btn btn-icon-only btn-default" href="#">
                    <i class="fa fa-info"></i>
                </a>
                <a class="btn btn-icon-only btn-default" href="#">
                    <i class="icon-wrench"></i>
                </a>
                <a class="btn btn-icon-only btn-default" href="#">
                    <i class="icon-trash"></i>
                </a>
                <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form" id="user_form_wizard">
       		{!! Form::open(['route' => ['users.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-user form-horizontal', 'role' => 'form', 'id' => 'submit_user_form']) !!}
                <div class="form-wizard forms-grid cus-form-wizard">
    		    	<div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <li>
                                <a href="#account_setup" data-toggle="tab" class="step step1">
                                    <span class="number"> 
                                        <i class="fa fa-cogs"></i>
                                    </span>
                                    
                                    <span class="desc">
                                        <span class="name">Account Setup</span>
                                        <span class="short-des">Lorem ipsum dolar site amet<br>consecteure adipiscing</span>
                                    </span>
                                    <span class="count-step">1</span>
                                </a>
                            </li>
                            <li>
                                <a href="#profile_setup" data-toggle="tab" class="step step2">
                                    <span class="number"> 
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <span class="desc">
                                        <span class="name">Profile Setup</span>
                                        <span class="short-des">Lorem ipsum dolar site amet<br>consecteure adipiscing</span>
                                    </span>
                                    <span class="count-step">2</span>
                                </a>
                            </li>
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success"> </div>
                        </div>
                        <div class="tab-content">
                            <div class="alert alert-danger display-none">
                                <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. 
                            </div>
                            <div class="alert alert-success display-none">
                                <button class="close" data-dismiss="alert"></button> Your form validation is successful! 
                            </div>
                            <div class="tab-pane js-tab-pane active" id="account_setup">
                                <div class="note note-info">
                                    <p style="font-size: 18px;">Provide your account details</p>
                                </div>
                                <!-- <h3 class="block">Provide your account details</h3> -->
                                <div class="panel-grid-main">
                                    <div class="form-group">
                                        <div class="scroll-wrapper">
                                            <div class="form-row col-md-7 col-lg-6 clearfix">
                                                <div class="row">
                                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                                        <span class="number-lbl">1</span>
                                                        <label class="label">Email </label>
                                                    </div>
                                                    <div class="col-md-7 col-lg-7 col-sm-7">
                                                        {!! Form::email('email', app('request')->get('email'), ['class' => 'form-control', 'id' => 'email']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="scroll-wrapper">
                                            <div class="form-row col-md-7 col-lg-6 clearfix">
                                                <div class="row">
                                                    <div class="col-md-5 col-lg-5 col-sm-5">
                                                        <span class="number-lbl">2</span>
                                                        <label class="label">Roles </label>
                                                    </div>
                                                    <div class="col-md-7 col-lg-7 col-sm-7">
                                                        <div class="row">
                                                            <div class="col-md-12">                                                    
                                                                {!! Form::select('roles[]', $roles, null, array('class' =>'js-select2-multiselect form-control', 'multiple' => true)) !!}
                                                            </div>                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row col-md-6 clearfix demo" style="display: none;">
                                            <p>test</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane js-tab-pane" id="profile_setup">
                                <div class="js-profile-details">
                                    <div class="note note-info">
                                        <p style="font-size: 18px;">Provide your account details</p>
                                    </div>
                                    <div class="panel-grid-main">
                                        <div class="form-group">
                                            <div class="scroll-wrapper">
                                                <div class="form-row col-md-7 col-lg-6 clearfix">
                                                    <div class="row">
                                                        <div class="col-md-5 col-lg-5 col-sm-5">
                                                            <span class="number-lbl">1</span>
                                                            <label class="label">Name </label>
                                                        </div>
                                                        <div class="col-md-7 col-lg-7 col-sm-7">
                                                            {!! Form::text('first_name', null,['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-wrapper">
                                                <div class="form-row col-md-7 col-lg-6 clearfix">
                                                    <div class="row">
                                                        <div class="col-md-5 col-lg-5 col-sm-5">
                                                            <span class="number-lbl">2</span>
                                                            <label class="label">Last Name </label>
                                                        </div>
                                                        <div class="col-md-7 col-lg-7 col-sm-7">
                                                            {!! Form::text('last_name', null,['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-wrapper">
                                                <div class="form-row col-md-7 col-lg-6 clearfix">
                                                    <div class="row">
                                                        <div class="col-md-5 col-lg-5 col-sm-5">
                                                            <span class="number-lbl">3</span>
                                                            <label class="label">Username </label>
                                                        </div>
                                                        <div class="col-md-7 col-lg-7 col-sm-7">
                                                            {!! Form::text('username', null,['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-wrapper">
                                                <div class="form-row col-md-7 col-lg-6 clearfix">
                                                    <div class="row">
                                                        <div class="col-md-5 col-lg-5 col-sm-5">
                                                            <span class="number-lbl">4</span>
                                                            <label class="label">Created at </label>
                                                        </div>
                                                        <div class="col-md-7 col-lg-7 col-sm-7">
                                                            <div class='input-group date js-form-datetimepicker'>
                                                                {!! Form::text('banned_at', null,
                                                                ['class' => 'form-control', 'id' => 'banned_at', 'readonly' => 'readonly']) !!}
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="js-send-invitation">
                                    <h3>Send invitation to join</h3> 
                                    <p>User already exist. Do you want to send invitation?</p>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:;" class="btn default button-previous js-btn-back" style="display: none">
                                    <i class="fa fa-angle-left"></i> Back </a>
                                <a class="uie-btn uie-btn-primary button-next js-continue js-btn-continue"> Continue
                                    <i class="fa fa-angle-right"></i>
                                </a>                                
                                <button type="submit" class="uie-btn uie-btn-primary button-next button-submit js-btn-send" style="display: none"> Send <i class="fa fa-check"></i></button>
                                <button type="submit" class="uie-btn uie-btn-primary button-next js-btn-submit" style="display: none"> Submit <i class="fa fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
			{{ Form::close() }}
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('js/admin/users.js') }}" type="text/javascript"></script>
@endsection