@extends('layouts.admin.default')
@section('page-style')
	<link href="{{ asset('css/admin/company.css') }}" rel="stylesheet" type="text/css" id="style_color" />
@endsection

@section('page-content')

<div class="row">
	<div class="col-md-3">
		@include('elements.admin.company_profile_navigation')			
	</div>

	<div class="col-md-9">
		<div class="portlet light">
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
                <form action="#" id="form_sample_2" class="">
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
                                                    <input type="password" name="current-password" class="form-control" placeholder="Current Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon no-bg"><i class="fa fa-lock blue-color"></i></span>
                                                    <input type="password" name="new-password" class="form-control" placeholder="New Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon no-bg"><i class="fa fa-lock blue-color"></i></span>
                                                    <input type="password" name="conf-password" class="form-control" placeholder="Re-type New Password">
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
                </form>
                <!-- END FORM-->
            </div>
		</div>
	</div>
</div>
	
@endsection