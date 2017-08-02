<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <legend class="blue-color">Client Basic Details</legend>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                {!! Form::text('client_name', $from == 'edit' ? $client->name : null, ['class' => 'form-control', 'id' => 'client_name', 'placeholder' => 'Client Name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                {!! Form::text('client_email', $from == 'edit' ? $client->email : null,['class' => 'form-control', 'placeholder' => 'Client Email Address']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group select2-bootstrap-prepend">
                                <span class="input-group-addon no-bg"><i class="fa fa-globe blue-color"></i></span>
                                {!! Form::select('client_country', $countries,  $from == 'edit' ? $client->country_id : null, ['class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' => '-- Select Client Country --']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
                                {!! Form::text('client_dob', $from == 'edit' ? Carbon\Carbon::parse($client->dob)->format('d-m-Y') : null, ['class' => 'form-control form-control-inline date-picker datepicker', 'size' => '16', 'placeholder' => 'Client Birthdate']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-6">
            <fieldset>
                <legend class="blue-color">Generic Details</legend>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-building blue-color"></i></span>
                                {!! Form::text('client_company_name',  $from == 'edit' ? $client->client_company_name : null, ['class' => 'form-control', 'id' => 'client_company_name', 'placeholder' => 'Client Company Name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-external-link blue-color"></i></span>
                                {!! Form::text('client_website_url', $from == 'edit' ? $client->website : null, ['class' => 'form-control', 'id' => 'client_website_url', 'placeholder' => 'Client Website URL']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-industry blue-color"></i></span>
                                {!! Form::text('client_industry', $from == 'edit' ? $client->industry : null, ['class' => 'form-control', 'id' => 'client_industry', 'placeholder' => 'Client Industry']) !!}
                            </div>
                        </div>
                    </div>                                            
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-info blue-color"></i></span>
                                {!! Form::textarea('other_details', $from == 'edit' ? $client->other_details : null, ['class' => 'form-control', 'id' => 'other_details', 'placeholder' => 'Other Details', 'rows' => '1']) !!}
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-map-marker blue-color"></i></span>
                                {!! Form::textarea('client_company_address', $from == 'edit' ? $client->client_company_address : null, ['class' => 'form-control', 'id' => 'client_company_address', 'placeholder' => 'Client Company Address', 'rows' => '1']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-6 col-lg-6">
            <fieldset>
                <legend class="blue-color">Client Contact Details</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-phone blue-color"></i></span>
                                {!! Form::text('client_contact_number', $from == 'edit' ? $client->contact_no : null, ['class' => 'form-control', 'placeholder' => 'Client Contact No.', 'id' => 'client_contact_number']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-skype blue-color"></i></span>
                                {!! Form::text('client_skype', $from == 'edit' ? $client->skype_address : null, ['class' => 'form-control', 'placeholder' => 'Client Skype Address']) !!}
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                {!! Form::email('client_company_email', $from == 'edit' ? $client->company_email : null, ['class' => 'form-control', 'placeholder' => "Client's Company Email Address"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-map-marker blue-color"></i></span>
                                {!! Form::textarea('client_residence_address', $from == 'edit' ? $client->client_residence_address : null, ['class' => 'form-control', 'id' => 'client_residence_address', 'placeholder' => 'Client Residence Address', 'rows' => '1']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-6 col-lg-6">
            <fieldset>
                <legend class="blue-color">Client Social Details</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-facebook blue-color"></i></span>
                                {!! Form::text('client_fb_id', $from == 'edit' ? $client->fb_id : null, ['class' => 'form-control', 'placeholder' => 'Client FB Id', 'id' => 'client_fb_id']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-linkedin blue-color"></i></span>
                                {!! Form::text('client_linkedin_id', $from == 'edit' ? $client->linkedin_id : null, ['class' => 'form-control', 'placeholder' => 'Client Linkedin Id', 'id' => 'client_linkedin_id']) !!}
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-twitter blue-color"></i></span>
                                {!! Form::text('client_twitter_id', $from == 'edit' ? $client->twitter_id : null, ['class' => 'form-control', 'placeholder' => 'Client Twitter Id', 'id' => 'client_twitter_id']) !!}
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
            <button type="submit" class="btn blue">Submit</button>
            <button type="reset" class="btn default">Reset</button>
        </div>
    </div>
</div>