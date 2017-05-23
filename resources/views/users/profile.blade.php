@extends('layouts.admin.default')
@section('page-style')

@endsection

@section('page-content')
	<div class="row">
		<div class="col-md-12">
			<div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="{{ $avatar }} " class="img-responsive" alt=""> </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{ Auth::user()->person->first_name . ' ' . Auth::user()->person->last_name }} </div>
                        <div class="profile-usertitle-job"> Developer </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                        <button type="button" class="btn btn-circle red btn-sm">Message</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li>
                                <a href="#">
                                    <i class="icon-home"></i> Overview </a>
                            </li>
                            <li class="active">
                                <a href="page_user_profile_1_account.html">
                                    <i class="icon-settings"></i> Account Settings </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-info"></i> Help </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
                <!-- END PORTLET MAIN -->
                <!-- PORTLET MAIN -->
                <div class="portlet light ">
                    <!-- STAT -->
                    <div class="row list-separated profile-stat">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title"> 37 </div>
                            <div class="uppercase profile-stat-text"> Projects </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title"> 51 </div>
                            <div class="uppercase profile-stat-text"> Tasks </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title"> 61 </div>
                            <div class="uppercase profile-stat-text"> Uploads </div>
                        </div>
                    </div>
                    <!-- END STAT -->
                    <div>
                        <h4 class="profile-desc-title">About Marcus Doe</h4>
                        <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
                        <div class="margin-top-20 profile-desc-link">
                            <i class="fa fa-globe"></i>
                            <a href="http://www.keenthemes.com">www.keenthemes.com</a>
                        </div>
                        <div class="margin-top-20 profile-desc-link">
                            <i class="fa fa-twitter"></i>
                            <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                        </div>
                        <div class="margin-top-20 profile-desc-link">
                            <i class="fa fa-facebook"></i>
                            <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET MAIN -->
            </div>

            <div class="profile-content">
            	<div class="row">
            		<div class="col-md-12">
            			<div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                    @include('flash::message')
                                </div>
                                <ul class="nav nav-tabs">
                                    @if($user->hasRole(Landlord::getTenants()['company']->id . '.Admin'))
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Company Profile</a>
                                    </li>
                                    @endif
                                    <li @if(!$user->hasRole(Landlord::getTenants()['company']->id . '.Admin')) class="active" @endif>
                                        <a href="#tab_1_2" data-toggle="tab">General</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_3" data-toggle="tab">Personal Info</a>
                                    </li>
                                    {{-- <li>
                                        <a href="#tab_1_4" data-toggle="tab">HR</a>
                                    </li> --}}
                                    <li>
                                        <a href="#tab_1_5" data-toggle="tab">Change Avatar</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_6" data-toggle="tab">Change Password</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_7" data-toggle="tab">Privacy Settings</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body forms-grid">
                                <div class="tab-content">
                                    @if($user->hasRole(Landlord::getTenants()['company']->id . '.Admin'))
                                    <!-- COMPANY INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div class="panel-grid-main element-sec clearfix" id="appendForm" novalidate="novalidate">
                                        	{{--<form name="addUser-87" id="addUser-87" method="POST" action="#" class="normal-form">
                                        		<div class="scroll-wrapper" data-class="">
                                        			<div class="form-row col-md-6 clearfix" data-element="company-name">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Company Name </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="company-name" tabindex="1" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="acronym-of-company-name">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Acronym of Company Name </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="acronym-of-company-name" tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="company-phone-no">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Company Phone No. </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="company-phone-no" tabindex="3" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="company-pan">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Company PAN </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="company-pan" tabindex="4" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="company-tan">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Company TAN </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="company-tan" tabindex="5" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="company_logo">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Company Logo </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<div class="input-group input-file">
                                        							<div class="form-control selected-file-name" data-name="company_logo" data-type="file" tabindex="6" data-validate="required">no_file_selected</div>
                                        							<span class="input-group-addon">
                                        								<a class="btn btn-primary" href="javascript:;" title="">choose_file
                                        									<input title="" name="company_logo" type="file" data-type="file" id="company_logo" data-validate="required" onchange="baseFunctions.setCustomFileData(this.id)" data-clubby="file-attach" data-accept="jpeg|jpg|png|doc|docx|xlsx|pdf|txt" data-size="5">
                                        								</a>
                                        							</span>
                                        						</div>
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="company-website-address">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Company Website address </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="company-website-address" tabindex="7" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="financial-year">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Financial Year </label>
                                        				</div>
	                                        			<div class="form-col-2">
	                                        				<div class="p-r-5 input-wrapper right">
	                                        					<input class="text-box" name="financial-year" tabindex="8" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
	                                        				</div>
	                                        			</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="leave-calendar-year">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Leave Calendar Year </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="leave-calendar-year" tabindex="9" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="contact-person-name">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Contact Person Name </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="contact-person-name" tabindex="10" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="contact-no">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Contact No </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="contact-no" tabindex="11" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="email-id">
                                        				<div class="form-col-1">
                                        					<label class="label">Email ID </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="email-id" tabindex="12" type="text" data-type="text" value="" data-validate="email" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="company-address">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Company Address </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<textarea class="textarea-box" name="company-address" tabindex="13" rows="15" type="textarea" data-type="textarea" data-validate="required" maxlength="1000" value="" data-init-value=""></textarea>
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="Cost_Center">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Cost Center </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="Cost_Center" tabindex="1" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="Annual_CTC">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Annual CTC </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="Annual_CTC" tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="FBP_Amount">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">FBP Amount </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="FBP_Amount" tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="Variablepay_Amount">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Variablepay Amount </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="Variablepay_Amount" tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="Admin_Bank">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Admin Bank </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="Admin_Bank" tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="Employee_Bank">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Employee Bank </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="Employee_Bank" tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="IFSC_code">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">IFSC code </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<input class="text-box" name="IFSC_code" tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="Salary_Payment_mode">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Salary Payment mode </label>
                                        				</div>
                                        				<div class="form-col-2">
                                        					<div class="p-r-5 input-wrapper right">
                                        						<div class="dropdown-list-menu" data-name="Salary_Payment_mode">
                                        							<div class="btn-group bootstrap-select">
                                        								<button type="button" class="btn dropdown-toggle bs-placeholder btn-default" data-toggle="dropdown" data-id="Salary_Payment_mode" tabindex="8" title="Salary Payment mode">
	                                        								<span class="filter-option pull-left"> Salary Payment mode</span>&nbsp;
	                                        								<span class="bs-caret"><span class="caret"></span></span>
                                        								</button>
                                        								<div class="dropdown-menu open">
                                        									<ul class="dropdown-menu inner" role="menu">
                                        										<li data-original-index="1">
                                        											<a tabindex="0" class="" style="" data-tokens="null">
                                        												<span class="text">Bank Transfer</span>
                                        												<span class="glyphicon glyphicon-ok check-mark"></span>
                                        											</a>
                                        										</li>
                                        										<li data-original-index="2">
                                        											<a tabindex="0" class="" style="" data-tokens="null">
                                        												<span class="text">cheque</span>
                                        												<span class="glyphicon glyphicon-ok check-mark"></span>
                                        											</a>
                                        										</li>
                                        										<li data-original-index="3">
                                        											<a tabindex="0" class="" style="" data-tokens="null">
                                        												<span class="text">Cash</span>
                                        												<span class="glyphicon glyphicon-ok check-mark"></span>
                                        											</a>
                                        										</li>
                                        									</ul>
                                        								</div>
                                        								<select class="selectpicker" title=" Salary Payment mode" name="Salary_Payment_mode" data-container="body" id="Salary_Payment_mode" data-type="select-one" tabindex="-98" data-validate="required">
                                        									<option class="bs-title-option" value=""> Salary Payment mode</option>
                                        									<option value="0">Bank Transfer</option>
                                        									<option value="1">cheque</option>
                                        									<option value="1">Cash</option>
                                        								</select>
                                        							</div>
                                        						</div>
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="form-row col-md-6 clearfix" data-element="Is_reporting_manager ">
                                        				<div class="form-col-1">
                                        					<label class="label label-bold">Is Reporting Manager  </label>
                                        				</div>
	                                        			<div class="form-col-2">
	                                        				<div class="p-r-5 input-wrapper right">
	                                        					<div class="dropdown-list-menu" data-name="Is_reporting_manager ">
	                                        						<div class="btn-group bootstrap-select">
	                                        							<button type="button" class="btn dropdown-toggle bs-placeholder btn-default" data-toggle="dropdown" data-id="Is_reporting_manager " tabindex="8" title="Is Reporting Manager">
	                                        								<span class="filter-option pull-left"> Is Reporting Manager </span>&nbsp;
	                                        								<span class="bs-caret"><span class="caret"></span>
	                                        								</span>
	                                        							</button>
	                                        							<div class="dropdown-menu open">
	                                        								<ul class="dropdown-menu inner" role="menu">
																			    <li data-original-index="1">
																			        <a tabindex="0" class="" style="" data-tokens="null"><span class="text">Vishal R</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
																			    <li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Vishal S</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
																			</ul>
																		</div>
																		<select class="selectpicker" title=" Is Reporting Manager " name="Is_reporting_manager " data-container="body" id="Is_reporting_manager " data-type="select-one" tabindex="-98" data-validate="required">
																		    <option class="bs-title-option" value=""> Is Reporting Manager </option>
																		    <option value="0">Vishal R</option>
																		    <option value="1">Vishal S</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="email-id">
													    <div class="form-col-1">
													        <label class="label">Email ID </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="email-id" tabindex="12" type="text" data-type="text" value="" data-validate="email" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="reporting_manager_email ">
													    <div class="form-col-1">
													        <label class="label label-bold">Reporting Manager email </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="reporting_manager_email " tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="Passport_no">
													    <div class="form-col-1">
													        <label class="label label-bold">Passport No </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="Passport_no" tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="Passport_expiry_date ">
													    <div class="form-col-1">
													        <label class="label label-bold">Passport Expiry Date </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="Passport_expiry_date " tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="Personal_email">
													    <div class="form-col-1">
													        <label class="label">Personal Email </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="Personal_email" tabindex="3" type="text" data-type="text" value="" data-validate="email" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="Blood_group">
													    <div class="form-col-1">
													        <label class="label label-bold">Blood Group </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="Blood_group" tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="marital_status">
													    <div class="form-col-1">
													        <label class="label label-bold">Marital Status </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="marital_status" tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="Salary_template">
													    <div class="form-col-1">
													        <label class="label label-bold">Salary Template </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="Salary_template" tabindex="3" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="Mobile ">
													    <div class="form-col-1">
													        <label class="label label-bold">Mobile </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="Mobile " tabindex="2" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="Phone">
													    <div class="form-col-1">
													        <label class="label label-bold">Phone </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="Phone" tabindex="3" type="text" data-type="text" value="" data-validate="required" maxlength="16" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="Spouse_name">
													    <div class="form-col-1">
													        <label class="label label-bold">Spouse Name </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="Spouse_name" tabindex="3" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
													<div class="form-row col-md-6 clearfix" data-element="Relationship">
													    <div class="form-col-1">
													        <label class="label label-bold">Relationship </label>
													    </div>
													    <div class="form-col-2">
													        <div class="p-r-5 input-wrapper right">
													            <input class="text-box" name="Relationship" tabindex="3" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
													        </div>
													    </div>
													</div>
												</div>
												<div class="center-btn col-md-12 clearfix">
												    <button class="uie-btn uie-btn-primary save-btn" type="submit" name="btnSave" data-type="submit" tabindex="11">Submit</button>
												    <button class="uie-btn uie-secondary-btn reset-btn" type="reset" name="btnReset" tabindex="12" data-url="">Cancel</button>
												</div>
												<!-- <div class="clearfix"></div>
												<div class="center-btn col-md-12 clearfix">
												    <button class="uie-btn uie-btn-primary save-btn" type="submit" name="btnSave" data-type="submit" tabindex="11">Submit</button>
												</div> -->
											</form>--}}
											<div class="clearfix"></div>
										</div>
                                    </div>
                                    @endif
                                    <!-- END COMPANY INFO TAB -->
                                    <!-- GENERAL INFO TAB -->
                                    <div class="tab-pane @if(!$user->hasRole(Landlord::getTenants()['company']->id . '.Admin')) active @endif" id="tab_1_2">
									    <div class="panel-grid-main element-sec clearfix" id="appendForm1" novalidate="novalidate">
                                            {!! Form::open(['route' => ['users.save.general.info', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-save-general-info form-horizontal', 'role' => 'form']) !!}
									            <div class="scroll-wrapper" data-class="">
									                <div class="form-row col-md-6 clearfix" data-element="code">
									                    <div class="form-col-1">
									                        <label class="label label-bold">First Name </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            {!! Form::text('general_first_name',$user->person->first_name,['class' => 'form-control', 'id' => 'general_first_name']) !!}
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Employee-name">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Last Name </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            {!! Form::text('general_last_name', $user->person->last_name,['class' => 'form-control', 'id' => 'general_last_name']) !!}
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Email">
									                    <div class="form-col-1">
									                        <label class="label">Primary Email </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            {!! Form::email('general_primary_email', $user->person->primary_email, ['class' => 'form-control', 'id' => 'primary_email']) !!}
									                        </div>
									                    </div>
									                </div>
                                                    <div class="form-row col-md-6 clearfix" data-element="Email">
                                                        <div class="form-col-1">
                                                            <label class="label">Secondary Email </label>
                                                        </div>
                                                        <div class="form-col-2">
                                                            <div class="p-r-5 input-wrapper right">
                                                                {!! Form::email('general_secondary_email', $user->person->secondary_email, ['class' => 'form-control', 'id' => 'secondary_email']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row col-md-6 clearfix" data-element="Address">
                                                        <div class="form-col-1">
                                                            <label class="label label-bold">Address </label>
                                                        </div>
                                                        <div class="form-col-2">
                                                            <div class="p-r-5 input-wrapper right">
                                                                {!! Form::textarea('general_address1', $user->person->address()->address1, ['class' => 'form-control', 'rows' => '15', 'class' => 'textarea-box']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
									                <div class="form-row col-md-6 clearfix" data-element="City">
									                    <div class="form-col-1">
									                        <label class="label label-bold">City </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            {!! Form::text('general_city', $user->person->address()->city, ['class' => 'form-control']) !!}
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="State">
									                    <div class="form-col-1">
									                        <label class="label label-bold">State </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            {!! Form::text('general_state', $user->person->address()->state, ['class' => 'form-control']) !!}
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Pin">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Pin </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            {!! Form::text('general_pin', $user->person->address()->pin, ['class' => 'form-control']) !!}
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Mobile-No">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Mobile No </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            {!! Form::text('general_mobile_number', $user->person->mobile_number, ['class' => 'form-control']) !!}
									                        </div>
									                    </div>
									                </div>
                                                    <div class="form-row col-md-6 clearfix" data-element="Home-Phone">
                                                        <div class="form-col-1">
                                                            <label class="label label-bold">Home Phone </label>
                                                        </div>
                                                        <div class="form-col-2">
                                                            <div class="p-r-5 input-wrapper right">
                                                                {!! Form::text('general_home_phone', $user->person->home_phone, ['class' => 'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row col-md-6 clearfix" data-element="Work-Phone">
                                                        <div class="form-col-1">
                                                            <label class="label label-bold">Work Phone </label>
                                                        </div>
                                                        <div class="form-col-2">
                                                            <div class="p-r-5 input-wrapper right">
                                                                {!! Form::text('general_work_phone', $user->person->work_phone, ['class' => 'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
									                <div class="form-row col-md-6 clearfix" data-element="Dateofbirth">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Date Of Birth </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <div class="datepicker-row">
									                                {!! Form::text('general_date_of_birth', Carbon\Carbon::parse($user->person->dob)->format('d/m/Y h:i A'),
                                                                    ['class' => 'form-control', 'id' => 'general_date_of_birth', 'readonly' => 'readonly']) !!}
									                            </div>
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Membership">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Gender </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <div class="radio-btn" data-validate="required" data-type="radio" data-name="Membership" tabindex="10">
									                                <input name="general_gender" type="radio" data-type="radio" value="m" id="Membership-0-1" data-init-value="1" {{ $user->person->gender == "m" ? 'checked="checked"' : '' }}>
									                                <label for="Membership-0-1">Male<span><span></span></span>
									                                </label>
									                                <input name="general_gender" type="radio" data-type="radio" value="f" id="Membership-1-2" {{ $user->person->gender == "f" ? 'checked="checked"' : ''}}>
									                                <label for="Membership-1-2">Female<span><span></span></span>
									                                </label>
									                            </div>
									                        </div>
									                    </div>
									                </div>
									            </div>
									            <div class="center-btn col-md-12 clearfix">
									                <button class="uie-btn uie-btn-primary save-btn" type="submit" name="btnSave" data-type="submit" tabindex="11">Submit</button>
									            </div>
									            <div class="clearfix"></div>
                                            {!! Form::close() !!}
									        <div class="clearfix"></div>
									    </div>
									</div>
                                    <!-- END GENERAL INFO TAB -->
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane" id="tab_1_3">
									    <div class="panel-grid-main element-sec clearfix" id="appendForm2" novalidate="novalidate">
									        <form name="addUser-2" id="addUser-2" method="POST" action="#" class="normal-form">
									            <div class="scroll-wrapper" data-class="">
									                <div class="form-row col-md-6 clearfix" data-element="DOJ">
									                    <div class="form-col-1">
									                        <label class="label label-bold">DOJ </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <div class="datepicker-row">
									                                <input class="text-box" name="DOJ" tabindex="5" type="text" data-format="YYYY/MM/DD" data-validate="required" data-type="text" id="DOJ-3" format="datetime" autocomplete="off">
									                            </div>
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Confirmation_period">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Confirmation period </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <input class="text-box" name="Confirmation_period" tabindex="4" type="text" data-type="text" value="" data-validate="required,mobileNumber" maxlength="16" autocomplete="on" data-init-value="">
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Job_type">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Job Type </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <div class="dropdown-list-menu" data-name="Job_type">
									                                <div class="btn-group bootstrap-select">
									                                    <button type="button" class="btn dropdown-toggle bs-placeholder btn-default" data-toggle="dropdown" data-id="Job_type" tabindex="8" title="Job Type"><span class="filter-option pull-left"> Job Type</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span>
									                                    </button>
									                                    <div class="dropdown-menu open">
									                                        <ul class="dropdown-menu inner" role="menu">
									                                            <li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Probation</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
									                                            <li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">contract</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
									                                            <li data-original-index="3"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Counsultant</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
									                                            <li data-original-index="4"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">All</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
									                                            <li data-original-index="5"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Permanent</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>
									                                        </ul>
									                                    </div>
									                                    <select class="selectpicker" title=" Job Type" name="Job_type" data-container="body" id="Job_type" data-type="select-one" tabindex="-98" data-validate="required">
									                                        <option class="bs-title-option" value=""> Job Type</option>
									                                        <option value="0">Probation</option>
									                                        <option value="1">contract</option>
									                                        <option value="1">Counsultant</option>
									                                        <option value="1">All</option>
									                                        <option value="1">Permanent</option>
									                                    </select>
									                                </div>
									                            </div>
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Branch">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Branch </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <input class="text-box" name="Branch" tabindex="1" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="PF_Number">
									                    <div class="form-col-1">
									                        <label class="label label-bold">PF Number </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <input class="text-box" name="PF_Number" tabindex="4" type="text" data-type="text" value="" data-validate="required" maxlength="16" autocomplete="on" data-init-value="">
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="PF_Date">
									                    <div class="form-col-1">
									                        <label class="label label-bold">PF Date </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <div class="datepicker-row">
									                                <input class="text-box" name="PF_Date" tabindex="5" type="text" data-format="YYYY/MM/DD" data-validate="required" data-type="text" id="PF_Date-4" format="datetime" autocomplete="off">
									                            </div>
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Bank_Ac_No">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Bank Ac No </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <input class="text-box" name="Bank_Ac_No" tabindex="4" type="text" data-type="text" value="" data-validate="required" maxlength="16" autocomplete="on" data-init-value="">
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Pan">
									                    <div class="form-col-1">
									                        <label class="label label-bold">PAN </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <input class="text-box" name="Pan" tabindex="4" type="text" data-type="text" value="" data-validate="required" maxlength="16" autocomplete="on" data-init-value="">
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Esi_no">
									                    <div class="form-col-1">
									                        <label class="label label-bold">ESI No </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <input class="text-box" name="Esi_no" tabindex="4" type="text" data-type="text" value="" data-validate="required" maxlength="16" autocomplete="on" data-init-value="">
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Department">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Department </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <input class="text-box" name="Department" tabindex="1" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Designation">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Designation </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <input class="text-box" name="Designation" tabindex="1" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
									                        </div>
									                    </div>
									                </div>
									                <div class="form-row col-md-6 clearfix" data-element="Level">
									                    <div class="form-col-1">
									                        <label class="label label-bold">Level </label>
									                    </div>
									                    <div class="form-col-2">
									                        <div class="p-r-5 input-wrapper right">
									                            <input class="text-box" name="Level" tabindex="1" type="text" data-type="text" value="" data-validate="required" maxlength="100" autocomplete="on" data-init-value="">
									                        </div>
									                    </div>
									                </div>
									            </div>
									            <div class="center-btn col-md-12 clearfix">
									                <button class="uie-btn uie-btn-primary save-btn" type="submit" name="btnSave" data-type="submit" tabindex="11">Submit</button>
									            </div>
									            <div class="clearfix"></div>
									        </form>
									        <div class="clearfix"></div>
									    </div>
									</div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <!-- HR INFO TAB -->
                                    {{-- <div class="tab-pane" id="tab_1_4">
									    <div class="panel-grid-main element-sec clearfix" id="appendForm3" novalidate="novalidate">
									        <form name="addUser-87" id="addUser-87" method="POST" action="#" class="normal-form">
									            <div class="scroll-wrapper" data-class=""></div>
									            <div class="clearfix"></div>
									        </form>
									        <div class="clearfix"></div>
									    </div>
									</div> --}}
                                    <!-- END HR INFO TAB -->
                                    <!-- CHANGE AVATAR TAB -->
                                    <div class="tab-pane" id="tab_1_5">
                                        <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                            eiusmod. </p>                                        
                                        {!! Form::open(['route' => ['users.update.avatar', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-save-user-avatar form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                                            <div class="">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img src="{{ $avatar }}" alt="">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                                                    </div>
                                                    <div>
                                                        <span class="btn default btn-file">
                                                            <span class="fileinput-new"> Select image </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="user_avatar" id="user_avatar"> </span>
                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                </div>
                                                <div class="clearfix margin-top-10">
                                                    <span class="label label-danger">NOTE! </span> &nbsp;
                                                    <span> Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                                </div>
                                            </div>
                                            <div class="margin-top-10">
                                                {{-- <a href="javascript:;" class="btn btn-primary"> Submit </a> --}}
                                                <button class="uie-btn uie-btn-primary save-btn" type="submit" name="btnSave" data-type="submit" tabindex="11">Submit</button>
                                                <a href="javascript:;" class="btn default"> Cancel </a>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- END CHANGE AVATAR TAB -->
                                    <!-- CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="tab_1_6">
                                        {{-- <form action="#"> --}}
                                        {!! Form::open(['route' => ['users.change.password', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-save-change-password', 'id' => 'js-frm-save-change-password', 'role' => 'form']) !!}
                                            <input type="hidden" name="change_password_user_id" value="{{ $user->id }}">
                                            <div class="form-group">
                                                <label class="control-label">Current Password</label>
                                                {{-- <input type="password" class="form-control"> --}}
                                                {!! Form::password('change_password_current_password', ['class' => 'form-control', 'id' => 'change_password_current_password']) !!}
                                                <p id="current_password_error_msg" style="color: red; display: none;"></p>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                {{-- <input type="password" class="form-control"> </div> --}}
                                                {!! Form::password('change_password_new_password', ['class' => 'form-control', 'id' => 'change_password_new_password']) !!}
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Re-type New Password</label>
                                                {{-- <input type="password" class="form-control"> </div> --}}
                                                {!! Form::password('change_password_retype_new_password',['class' => 'form-control', 'id' => 'change_password_retype_new_password']) !!}
                                            </div>
                                            <div class="margin-top-10">
                                                {{-- <a href="javascript:;" class="btn btn-primary"> Change Password </a> --}}
                                                <button class="btn btn-primary" type="submit" name="btnSavePassword" data-type="submit" tabindex="11">Change Password</button>
                                                <a href="javascript:;" class="btn default"> Cancel </a>
                                            </div>
                                        {!! Form::close() !!}
                                        {{-- </form> --}}
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                    <!-- PRIVACY SETTINGS TAB -->
                                    <div class="tab-pane" id="tab_1_7">
                                        <form action="#">
                                            <table class="table table-light table-hover">
                                                <tbody><tr>
                                                    <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="optionsRadios1" value="option1"> Yes
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="optionsRadios1" value="option2" checked=""> No
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="optionsRadios11" value="option1"> Yes
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="optionsRadios11" value="option2" checked=""> No
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="optionsRadios21" value="option1"> Yes
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="optionsRadios21" value="option2" checked=""> No
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="optionsRadios31" value="option1"> Yes
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="optionsRadios31" value="option2" checked=""> No
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                            <!--end profile-settings-->
                                            <div class="margin-top-10">
                                                <a href="javascript:;" class="btn btn-primary"> Save Changes </a>
                                                <a href="javascript:;" class="btn default"> Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PRIVACY SETTINGS TAB -->
                                </div>
                            </div>
                        </div>
            		</div>
            	</div>
            </div>
		</div>
	</div>
@endsection

@section('page-script')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
	<script src="{{ asset('js/admin/profile.js') }}" type="text/javascript"></script>
@endsection