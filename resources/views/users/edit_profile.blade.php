@extends('layouts.admin.default')
@section('page-style')
<link href="{{ asset('css/admin/company.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ asset('css/admin/user_profile.css') }}" rel="stylesheet" type="text/css" /> 
@endsection

@section('page-content')
	<div class="row profile cus-pro">
		<div class="col-md-3">
    	   @include('elements.admin.user_profile_navigation')
        </div>

        <div class="col-md-9"> 
        	<div class="portlet light ">
                <div class="portlet-title">
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
					{!! Form::open(['route' => ['user.update.profile', 'domain' => app('request')->route()->parameter('company')], 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}                    
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend class="blue-color">Human Resource Details</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-sort-numeric-asc blue-color"></i></span>
                                                        {!! Form::text('name',$user->person->first_name,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Employee Name']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-sort-numeric-asc blue-color"></i></span>
                                                        <input type="text" name="employee-code" class="form-control" placeholder="Employee Code">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                                        {!! Form::text('email',$user->email,['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-sort-numeric-asc blue-color"></i></span>
                                                        {!! Form::text('department',$companyUser->settings['department'], ['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Department']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-sort-numeric-asc blue-color"></i></span>
                                                        {!! Form::text('designation',isset($companyUser->settings['designation']) ? $companyUser->settings['designation'] : null,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Designation']) !!}
                                                    </div>
                                                </div>
                                            </div>                                           
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('joining_date', isset($companyUser->settings['doj']) ? $companyUser->settings['doj'] : null , ['class' => 'form-control form-control-inline date-picker datepicker', 'size' => '16', 'placeholder' => 'DOJ']) !!}
					                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
				                                <div class="input-group select2-bootstrap-prepend">
				                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
				                                    {!! Form::select('job_type', config('config-variables.user_job_types'), array('class' =>'select2-allow-clear select2-hide-search-box form-control', 'placeholder' => 'Select job type')) !!}
				                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend class="blue-color">Account Details</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-sort-numeric-asc blue-color"></i></span>
                                                        {!! Form::text('bank_account_no',isset($companyUser->settings['bank_account_no']) ? $companyUser->settings['bank_account_no'] : null,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Bank Acc. No']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-sort-numeric-asc blue-color"></i></span>
                                                        {!! Form::text('branch',isset($companyUser->settings['branch']) ? $companyUser->settings['branch'] : null,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Branch']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-sort-numeric-asc blue-color"></i></span>
                                                        {!! Form::text('ifsc_code',isset($companyUser->settings['ifsc']) ? $companyUser->settings['ifsc'] : null,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'IFSC Code']) !!}
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-sort-numeric-asc blue-color"></i></span>
                                                        {!! Form::text('pf_no',isset($companyUser->settings['pf_no']) ? $companyUser->settings['pf_no'] : null,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'PF Number']) !!}
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-sort-numeric-asc blue-color"></i></span>
                                                        {!! Form::text('esi_no',isset($companyUser->settings['esi_no']) ? $companyUser->settings['esi_no'] : null,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'ESI No']) !!}
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-sort-numeric-asc blue-color"></i></span>
                                                        {!! Form::text('annual_ctc',isset($companyUser->settings['ctc']) ? $companyUser->settings['ctc'] : null,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Annual CTC']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
				                                <div class="input-group select2-bootstrap-prepend">
				                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
				                                    {!! Form::select('incremental_duration', config('config-variables.incremental_durations'), array('class' =>'select2-allow-clear select2-hide-search-box form-control', 'placeholder' => 'Select incremental duration')) !!}
				                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
				                                <div class="input-group select2-bootstrap-prepend">
				                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
				                                    {!! Form::select('salary_mode', config('config-variables.salary_modes'), array('class' =>'select2-allow-clear select2-hide-search-box form-control', 'placeholder' => 'Select salary mode')) !!}
				                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend class="blue-color">Personal Details</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="input-group">
                                                            <span class="input-group-addon no-bg"><i class="fa fa-upload blue-color"></i></span>
                                                            <div class="form-control uneditable-input input-fixed" data-trigger="fileinput">
                                                                <span class="fileinput-filename">Profile Photo </span>
                                                            </div>
                                                            <span class="input-group-addon btn light btn-file">
                                                                <span class="fileinput-new"> Select file </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="user_avatar"> </span>
                                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('dob', $user->person->dob, ['class' => 'form-control form-control-inline date-picker datepicker', 'size' => '16', 'placeholder' => 'Date of birth']) !!}
					                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('blood_group',$user->person->blood_group,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Blood Group']) !!}
					                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('personal_email',$user->person->secondary_email,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Personal Email']) !!}
					                                </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('mobile_no',$user->person->mobile_number,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Mobile No']) !!}
					                                </div>
                                                </div>
                                            </div>  
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('emergency_contact_no',$user->person->extra_info['emergency_contact_no'],['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Emergency contact no']) !!}
					                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('pan_no',$user->person->extra_info['pan_no'],['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'PAN']) !!}
					                                </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('aadhar_no',$user->person->aadhar_card_number,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Aadhar Card No.']) !!}
					                                </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('passport_no',$user->person->extra_info['passport_no'],['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Passport No.']) !!}
					                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('marital_status',$user->person->extra_info['marital_status'],['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Marital Status']) !!}
					                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('spouse_name',$user->person->extra_info['spouse_name'],['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Spouse Name']) !!}
					                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::text('phone_no',$user->person->home_phone,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'Phone No.']) !!}
					                                </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
					                                <div class="input-group">
					                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    {!! Form::textarea('about_me',$user->person->bio,['class' => 'form-control', 'id' => 'general_first_name', 'placeholder' => 'About Me', 'rows' => '1']) !!}
					                                </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-6 col-lg-6">
                                                <fieldset>
                                                    <legend class="blue-color">Current Address</legend>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="input-group">
																	<span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
					                                    			{!! Form::textarea('current_address',$user->person->address['current_address'],['class' => 'form-control', 'placeholder' => 'Current Adress', 'rows' => '1']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
			                                            <div class="col-md-6">
			                                                <div class="form-group">
								                                <div class="input-group">
								                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
								                                    {!! Form::text('country',$user->person->address['country'],['class' => 'form-control', 'placeholder' => 'Country']) !!}
								                                </div>
			                                                </div>
			                                            </div> 
			                                            <div class="col-md-6">
			                                                <div class="form-group">
								                                <div class="input-group">
								                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
								                                    {!! Form::text('state',$user->person->address['state'],['class' => 'form-control', 'placeholder' => 'State']) !!}
								                                </div>
			                                                </div>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <div class="form-group">
								                                <div class="input-group">
								                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
								                                    {!! Form::text('city',$user->person->address['city'],['class' => 'form-control', 'placeholder' => 'City']) !!}
								                                </div>
			                                                </div>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <div class="form-group">
								                                <div class="input-group">
								                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
								                                    {!! Form::text('pincode',$user->person->address['pincode'],['class' => 'form-control', 'placeholder' => 'Pincode']) !!}
								                                </div>
			                                                </div>
			                                            </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="mt-checkbox blue-color" style="font-size: 13px;">
                                                                    <input type="checkbox"> Parmanent Address is same as Current Address
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <fieldset>
                                                    <legend class="blue-color">Parmanent Address</legend>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon no-bg"><i class="fa fa-map-marker blue-color"></i></span>
                                                                    {!! Form::textarea('permanent_address',$user->person->permanent_address,['class' => 'form-control', 'placeholder' => 'Permanent Adress', 'rows' => '1']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
			                                            <div class="col-md-6">
			                                                <div class="form-group">
								                                <div class="input-group">
								                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
								                                    {!! Form::text('country',null,['class' => 'form-control', 'placeholder' => 'Country']) !!}
								                                </div>
			                                                </div>
			                                            </div> 
			                                            <div class="col-md-6">
			                                                <div class="form-group">
								                                <div class="input-group">
								                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
								                                    {!! Form::text('state',null,['class' => 'form-control', 'placeholder' => 'State']) !!}
								                                </div>
			                                                </div>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <div class="form-group">
								                                <div class="input-group">
								                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
								                                    {!! Form::text('city',null,['class' => 'form-control', 'placeholder' => 'City']) !!}
								                                </div>
			                                                </div>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <div class="form-group">
								                                <div class="input-group">
								                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
								                                    {!! Form::text('pincode',null,['class' => 'form-control', 'placeholder' => 'Pincode']) !!}
								                                </div>
			                                                </div>
			                                            </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-9">
                                    <button type="submit" class="btn blue">Update</button>
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