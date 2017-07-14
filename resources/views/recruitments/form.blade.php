<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <legend class="blue-color">Interview Details</legend>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                {!! Form::text('person_name', $from == 'edit' ? $client->name : null, ['class' => 'form-control', 'id' => 'person_name', 'placeholder' => 'Person Name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-file-code-o blue-color"></i></span>
                                {!! Form::select('position', config('config-variables.positions'), null, array('class' =>'form-control selectpicker', 'placeholder' => '-- Applied For Position --')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
                                {!! Form::text('date_of_interview', $from == 'edit' ? Carbon\Carbon::parse($client->dob)->format('d-m-Y') : null, ['class' => 'form-control form-control-inline date-picker datepicker', 'size' => '16', 'placeholder' => 'Date Of Interview']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-clock-o blue-color"></i></span>
                                {!! Form::text('time_of_interview', $from == 'edit' ? Carbon\Carbon::parse($client->dob)->format('d-m-Y') : null, ['class' => 'form-control timepicker timepicker-default', 'size' => '16', 'placeholder' => 'Time Of Interview']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                {!! Form::select('assigned_to', config('config-variables.assigned_to'), null, array('class' =>'form-control selectpicker', 'placeholder' => '-- Assigned To --')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-random blue-color"></i></span>
                                {!! Form::select('last_status', config('config-variables.last_status'), null, array('class' =>'form-control selectpicker', 'placeholder' => '-- Last Status --')) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-6">
            <fieldset>
                <legend class="blue-color">Other Details</legend>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-info blue-color"></i></span>
                                {!! Form::textarea('area_of_interest', $from == 'edit' ? $client->other_details : null, ['class' => 'form-control', 'id' => 'area_of_interest', 'placeholder' => 'Technical Area Of Interest', 'rows' => '1']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-info blue-color"></i></span>
                                {!! Form::textarea('how_did_you', $from == 'edit' ? $client->other_details : null, ['class' => 'form-control', 'id' => 'how_did_you', 'placeholder' => 'How Did You Get Information About ViitorCloud', 'rows' => '1']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-info blue-color"></i></span>
                                {!! Form::textarea('remarks', $from == 'edit' ? $client->other_details : null, ['class' => 'form-control', 'id' => 'remarks', 'placeholder' => 'Remarks', 'rows' => '1']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <fieldset>
                <legend class="blue-color">Interview Person Details</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-phone blue-color"></i></span>
                                {!! Form::text('contact_no', $from == 'edit' ? $client->fb_id : null, ['class' => 'form-control', 'placeholder' => 'Contact No.', 'id' => 'contact_no']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-money blue-color"></i></span>
                                {!! Form::text('current_salary', $from == 'edit' ? $client->linkedin_id : null, ['class' => 'form-control', 'placeholder' => 'Current Salary', 'id' => 'current_salary']) !!}
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-money blue-color"></i></span>
                                {!! Form::text('expected_salary', $from == 'edit' ? $client->twitter_id : null, ['class' => 'form-control', 'placeholder' => 'Expected Salary', 'id' => 'expected_salary']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-twitch blue-color"></i></span>
                                {!! Form::text('notice_period', $from == 'edit' ? $client->twitter_id : null, ['class' => 'form-control', 'placeholder' => 'Notice Period', 'id' => 'notice_period']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
                                {!! Form::text('date_of_joining', $from == 'edit' ? Carbon\Carbon::parse($client->dob)->format('d-m-Y') : null, ['class' => 'form-control form-control-inline date-picker datepicker', 'size' => '16', 'placeholder' => 'Your Expected Date Of Joining']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-location-arrow blue-color"></i></span>
                                {!! Form::text('preferred_location', $from == 'edit' ? $client->twitter_id : null, ['class' => 'form-control', 'placeholder' => 'Your Preferred Location', 'id' => 'preferred_location']) !!}
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