 <div class="modal-body">
    <div class="portlet light" style="margin: 0; padding: 0;">
        <div class="portlet-title">
            <div class="note note-success">
                <p style="font-size: 18px; text-align: center">
                    <b style="color: #259DA7;">Login Successfully</b> &nbsp;
                    <i class="fa fa-check-circle greeg-color" style="color: #26c281;"></i><br>
                    <span>Please Select Your Company</span>
                </p>
            </div>
        </div>
        <div class="portlet-body">
            <div class="mt-element-card mt-card-round mt-element-overlay">
                <div class="row">
                    @foreach($companies as $company)
                        <div class="col-lg-4 col-md-4 col-sm-6">                        
                            <div class="mt-card-item">
                                <div class="mt-card-avatar mt-overlay-1">
                                    <img src="http://htmlwazir.peppyemails.com/img/comapny-logo.png">
                                    <div class="mt-overlay">
                                        <ul class="mt-info">
                                            <li>
                                                <a class="btn default btn-outline">
                                                    <i class="icon-link"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mt-card-content">
                                    <h3 class="mt-card-name">{{ $company->name }}</h3>
                                </div>
                                <div class="mt-select row" style="margin-top: 15px;">
                                    <div class="pull-left select-box" style="width: 55%;">
                                        <select class="form-control" name="user_company_roles[]" id="user_company_roles_{{ $company->id }}">
                                        @foreach($userCompanyRoles[$company->id] as $userCompanyRole)
                                            <option value="{{ $userCompanyRole->id }}">{{ $userCompanyRole->display_name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn uie-btn uie-btn-primary pull-right btn-select-company" data-company-slug="{{ $company->slug }}" data-company-id="{{ $company->id }}">{{ __("Select") }}</a>
                                    </div>  
                                </div>
                            </div>                    
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
 </div>