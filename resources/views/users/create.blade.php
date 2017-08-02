@extends('layouts.admin.default')

@section('page-style')

@endsection
@section('page-content')
	<div class="portlet light">
        <div class="portlet-title min-height">
            <div class="caption">
                <i class="fa fa-newspaper-o"></i>
                <span class="caption-subject bold uppercase font-dark">Add Users
                    <span class="step-title"></span>
                </span>                
            </div>
            <div class="tools">
                &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form" id="user_form_wizard">
       		{!! Form::open(['route' => ['users.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-user form-horizontal userfrm', 'role' => 'form', 'id' => 'submit_user_form', 'enctype' => 'multipart/form-data']) !!}
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
                                <div class="panel-grid-main">
                                    <div class="form-group">
                                        <div class="scroll-wrapper">
                                            <div class="form-row col-md-12 clearfix">
                                                <div class="">
                                                    <div class="col-lg-3 col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                                            {!! Form::email('email', app('request')->get('email'), ['class' => 'form-control', 'placeholder' => 'Email ID', 'id' => 'email']) !!}
                                                        </div>
                                                    </div>
                                                   <div class="col-lg-3 col-md-3">
                                                        <div class="input-group select2-bootstrap-prepend">
                                                            <span class="input-group-addon no-bg"><i class="fa fa-building blue-color"></i></span>
                                                            {!! Form::select('roles[]', $roles, null, array('class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' => '-- Select User Role --')) !!}
                                                        </div>
                                                    </div>   
                                                   <div class="col-lg-3 col-md-3">
                                                        <div class="input-group select2-bootstrap-prepend">
                                                            <span class="input-group-addon no-bg"><i class="fa fa-building blue-color"></i></span>
                                                            {!! Form::select('department', $departments,null, array('class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' => '-- Select Department --')) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
                                                            <input class="form-control form-control-inline date-picker datepicker" size="16" type="text" value="" placeholder="Date Of Joining" name="joining_date">
                                                        </div>
                                                    </div>                                                    
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane js-tab-pane" id="profile_setup">
                                <div class="js-profile-details">
                                    <div class="note note-info">
                                        <p style="font-size: 18px;">Basic Information</p>
                                    </div>
                                    <div class="panel-grid-main">
                                        <div class="form-group">
                                            <div class="scroll-wrapper">
                                                <div class="form-row col-md-12 clearfix">
                                                    <div class="">
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('first_name', null,['class' => 'form-control', 'placeholder' => 'First Name', 'id' => 'name']) !!}
                                                            </div> 
                                                        </div>
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('last_name', null,['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
                                                            </div> 
                                                        </div>
                                                       <div class="col-lg-3 col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('username', null,['class' => 'form-control', 'placeholder' => 'Username']) !!}
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-3 col-lg-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('middle_name', null,['class' => 'form-control', 'placeholder' => 'Middle Name']) !!}
                                                            </div>  
                                                        </div>                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-wrapper">
                                                <div class="form-row col-md-12 clearfix">
                                                    <div class="">
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon no-bg"><i class="fa fa-upload blue-color"></i></span>
                                                                    <div class="form-control uneditable-input input-fixed" data-trigger="fileinput">
                                                                        <span class="fileinput-filename">User Image</span>
                                                                    </div>
                                                                    <span class="input-group-addon btn light btn-file">
                                                                        <span class="fileinput-new"> Select file </span>
                                                                        <span class="fileinput-exists"> Change </span>
                                                                        <input type="hidden"><input type="file" name="user_image"> </span>
                                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                </div>
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
                                <div class="js-profile-details">
                                    <div class="note note-info">
                                        <p style="font-size: 18px;">Personal Information</p>
                                    </div>
                                    <div class="panel-grid-main">
                                        <div class="form-group">
                                            <div class="scroll-wrapper">
                                                <div class="form-row col-md-12 clearfix">
                                                    <div class="">
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('contact_no', null,['class' => 'form-control', 'placeholder' => 'Contact No']) !!}
                                                            </div> 
                                                        </div>
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('landline_no', null,['class' => 'form-control', 'placeholder' => 'Landline Number']) !!}
                                                            </div> 
                                                        </div>
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('parent_contact_no', null,['class' => 'form-control', 'placeholder' => 'Parents Contact Number' ]) !!}
                                                            </div> 
                                                        </div>
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('driving_licence_no', null,['class' => 'form-control', 'placeholder' => 'Driving Licence Number' ]) !!}
                                                            </div> 
                                                        </div>                            
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-wrapper">
                                                <div class="form-row col-md-12 clearfix">
                                                    <div class="">
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('aadhar_card_no', null,['class' => 'form-control', 'placeholder' => 'Aadhar Card Number']) !!}
                                                            </div> 
                                                        </div>
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('voter_id_no', null,['class' => 'form-control', 'placeholder' => 'Voter ID No']) !!}
                                                            </div> 
                                                        </div>
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                                {!! Form::text('blood_group', null,['class' => 'form-control', 'placeholder' => 'Blood Group']) !!}
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-3 col-lg-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
                                                                <input class="form-control form-control-inline date-picker datepicker" size="16" type="text" value="" placeholder="Date Of Birth" name="birth_date">
                                                            </div>
                                                        </div>               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-wrapper">
                                                <div class="form-row col-md-12 clearfix">
                                                    <div class="">
                                                        <div class="col-md-3 col-lg-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-map-marker blue-color"></i></span>
                                                                {!! Form::textarea('current_address', null,['class' => 'form-control', 'placeholder' => 'Current Address', 'rows' => '3' ]) !!}
                                                            </div>
                                                        </div>                                                      
                                                        <div class="col-md-3 col-lg-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-map-marker blue-color"></i></span>
                                                                {!! Form::textarea('permanent_address', null,['class' => 'form-control', 'placeholder' => 'Permanent Address', 'rows' => '3' ]) !!}
                                                            </div>
                                                        </div>
                                                       <div class="col-lg-3 col-md-3">
                                                            <div class="input-group select2-bootstrap-prepend">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-building blue-color"></i></span>
                                                                {!! Form::select('gender', config('config-variables.gender'), null, array('class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' => '-- Select Gender --')) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="input-group select2-bootstrap-prepend">
                                                                <span class="input-group-addon no-bg"><i class="fa fa-building blue-color"></i></span>
                                                                {!! Form::select('status', config('config-variables.user_status'), null, array('class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' => '-- Select Status --')) !!}
                                                            </div>
                                                        </div>                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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