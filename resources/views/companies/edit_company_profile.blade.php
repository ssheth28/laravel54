@extends('layouts.admin.default')
@section('page-style')
	<link href="{{ asset('css/admin/company.css') }}" rel="stylesheet" type="text/css" id="style_color" />
@endsection

@section('page-content')
	<div class="row">
    @include('flash::message')
		<div class="col-md-3">
			@include('elements.admin.company_profile_navigation')			
		</div>
		<div class="col-md-9">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Company Information</span>
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
                    {!! Form::open(['route' => ['company.update.profile', 'domain' => app('request')->route()->parameter('company')], 'role' => 'form', 'id' => 'form_sample_2', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend class="blue-color">General Information</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-industry blue-color"></i></span>
                                                        {!! Form::text('name', $companyData->name,['class' => 'form-control', 'placeholder' => 'First Name', 'placeholder' => 'Company Name']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="input-group">
                                                            <span class="input-group-addon no-bg"><i class="fa fa-upload blue-color"></i></span>
                                                            <div class="form-control uneditable-input input-fixed" data-trigger="fileinput">
                                                                <span class="fileinput-filename">Company Logo </span>
                                                            </div>
                                                            <span class="input-group-addon btn light btn-file">
                                                                <span class="fileinput-new"> Select file </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="company_logo"> </span>
                                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-globe blue-color"></i></span>
                                                        {!! Form::text('company_domain_url', $companyData->company_domain_url, ['class' => 'form-control', 'placeholder' => 'Company Domain URL']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                                        {!! Form::text('admin_name', $companyData->user->person->first_name, ['class' => 'form-control', 'placeholder' => 'Admin Name']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                                        {!! Form::text('admin_email', $companyData->user->email,['class' => 'form-control', 'placeholder' => 'Admin Email']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend class="blue-color">Company Contact Details</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-phone blue-color"></i></span>
                                                        {!! Form::text('contact_no', $companyData->contact_no,['class' => 'form-control', 'placeholder' => 'Contact No']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                                        {!! Form::text('company_email', $companyData->email,['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                                        {!! Form::text('country', $companyData->country,['class' => 'form-control', 'placeholder' => 'Country']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-globe blue-color"></i></span>
                                                        {!! Form::text('state', $companyData->state,['class' => 'form-control', 'placeholder' => 'State']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-globe blue-color"></i></span>
                                                        {!! Form::text('city', $companyData->city,['class' => 'form-control', 'placeholder' => 'City']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa fa-map-o blue-color"></i></span>
                                                        {!! Form::text('pincode', $companyData->pincode,['class' => 'form-control', 'placeholder' => 'Pincode']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon no-bg"><i class="fa fa-map-marker blue-color"></i></span>
                                                        {!! Form::textarea('address', $companyData->address,['class' => 'form-control', 'placeholder' => 'Address']) !!}
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