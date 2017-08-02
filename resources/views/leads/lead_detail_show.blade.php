<div class="portlet light" style="margin: 0; padding: 0;">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-file-text" aria-hidden="true"></i> View Details</span>
        </div>
        <div class="tools">
            <a href="javascript:;" data-dismiss="modal">×</a>
        </div>
        <div class="actions">
            <a class="btn btn-icon-only btn-default" href="{{ url('admin/leads') }}/{{ $lead->id }}/edit">
                <i class="fa fa-pencil-square-o"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row form-horizontal">
            <div class="col-md-12">
                <fieldset>
                    <legend class="blue-color">Basic Information</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Lead Name</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $lead->lead_name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Email Id</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $lead->email }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Country</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $lead->country_id }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Contact No.</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $lead->contact_no }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Skype Id</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $lead->skype_id }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Reference</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $lead->reference }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Last Update Status</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $lead->last_update_status }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label> Point Of Contact From VC</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">Prakash Bhatt</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Industry / Interested In </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $lead->industry }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="margin-top-10">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="col-md-4 col-sm-4 text-right">
                                    <label>Other </label>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <label class="blue-color">{{ $lead->other_detail }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>