@extends('layouts.admin.default')
@section('page-style')
	<link href="{{ asset('css/admin/company.css') }}" rel="stylesheet" type="text/css" id="style_color" />
@endsection

@section('page-content')
	<div class="row" id="company_profile">
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
                    <div class="row">
                        <div class="col-md-8 profile-info">
                            <h1 class="font-green sbold uppercase">{{ $currentCompany->name }}</h1>
                            <p> {{ $companyData->address }} <br> {{ $companyData->state }} {{ $companyData->pincode }} </p>
                            <p>
                                <b>{{ $companyData->user->person->first_name }} {{ $companyData->user->person->last_name }}, CTO</b><br>
                                <a href="javascript:;">{{ $companyData->user->email }}</a>
                            </p>
                            <ul class="list-inline">
                                <li><i class="fa fa-globe blue-color"></i> {{ $companyData->company_domain_url }}</li>
                                <li class="ms-hover"><i class="fa fa-phone blue-color"></i> {{ $companyData->contact_no }} </li>
                                <li><i class="fa fa-envelope blue-color"></i> {{ $companyData->email }} </li>
                                <li class="ms-hover"><i class="fa fa-calendar blue-color"></i> 18 Jan 1982</li>
                                <li class="ms-hover"><i class="fa fa-building-o blue-color"></i> Infrastructure </li>
                            </ul>
                        </div>
                        <!--end col-md-8-->
                        <div class="col-md-4">
                            <div class="portlet sale-summary">
                                <div class="portlet-title">
                                    <div class="caption font-red sbold"> Project Summary </div>
                                </div>
                                <div class="portlet-body">
                                    <ul class="list-unstyled">
                                        <li>
                                            <span class="sale-info"> TODAY SOLD
                                                <i class="fa fa-img-up"></i>
                                            </span>
                                            <span class="sale-num"> 23 </span>
                                        </li>
                                        <li>
                                            <span class="sale-info"> WEEKLY SALES
                                                <i class="fa fa-img-down"></i>
                                            </span>
                                            <span class="sale-num"> 87 </span>
                                        </li>
                                        <li>
                                            <span class="sale-info"> TOTAL SOLD </span>
                                            <span class="sale-num"> 2377 </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end col-md-4-->
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection