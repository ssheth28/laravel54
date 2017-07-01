<div class="portlet light" style="margin: 0; padding: 0;">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-file-text" aria-hidden="true"></i> View Details</span>
        </div>
        <div class="tools">
            &nbsp;<a href="" class="collapse"> </a>
            <a href="javascript:;" data-dismiss="modal">&times;</a>
        </div>
        <div class="actions">
            <a class="btn btn-icon-only btn-default" href="{{ url('admin/clients') }}/{{ $client->id }}/edit">
                <i class="fa fa-pencil-square-o"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row form-horizontal">
            <div class="col-md-12">
                <fieldset>
                    <legend class="blue-color" align="">Client Basic Details</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Name</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Email Address</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->email }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Country </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->country->name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Birth Date </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ Carbon\Carbon::parse($client->dob)->format('d-m-Y') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <legend class="blue-color" align="">Client Basic Details</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Contact No.</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->contact_no }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Skype Address</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->skype_address }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client's Company Email Address </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->company_email }}</label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <hr class="margin-top-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-4 col-sm-4 text-right">
                                    <label>Client Residence Address </label>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <label class="blue-color">{{ $client->client_residence_address }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <legend class="blue-color" align="">Generic Details</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Company Name</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->client_company_name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Website URL</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->website }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Industry </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->industry }}</label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <hr class="margin-top-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-4 col-sm-4 text-right">
                                    <label>Other Details </label>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <label class="blue-color">{{ $client->other_details }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-4 col-sm-4 text-right">
                                    <label>Client Company Address </label>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <label class="blue-color">{{ $client->client_company_address }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <legend class="blue-color" align="">Client Social Details</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client FB Id</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->fb_id }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Linkedin Id</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->linkedin_id }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Twitter Id </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $client->twitter_id }}</label>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>