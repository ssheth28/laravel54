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
                                {!! Form::text('person_name', $from == 'edit' ? $recruitment->person_name : null, ['class' => 'form-control', 'id' => 'person_name', 'placeholder' => 'Person Name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-file-code-o blue-color"></i></span>
                                {!! Form::select('position', config('config-variables.positions'), $from == 'edit' ? $recruitment->position : null, ['class' =>'form-control selectpicker', 'placeholder' => '-- Applied For Position --']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
                                {!! Form::text('date_of_interview', $from == 'edit' ? Carbon\Carbon::parse($recruitment->date_of_interview)->format('d-m-Y') : null, ['class' => 'form-control form-control-inline date-picker datepicker', 'size' => '16', 'placeholder' => 'Date Of Interview']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-clock-o blue-color"></i></span>
                                {!! Form::text('time_of_interview', $from == 'edit' ? Carbon\Carbon::parse($recruitment->time_of_interview)->format('d-m-Y') : null, ['class' => 'form-control timepicker timepicker-default', 'size' => '16', 'placeholder' => 'Time Of Interview']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                {!! Form::select('assigned_to', $users, $from == 'edit' ? $recruitment->assign_to : null, ['class' =>'form-control selectpicker', 'placeholder' => '-- Assigned To --']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-random blue-color"></i></span>
                                {!! Form::select('last_status', config('config-variables.last_status'), $from == 'edit' ? $recruitment->last_status : null, ['class' =>'form-control selectpicker', 'placeholder' => '-- Last Status --']) !!}
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
                                {!! Form::textarea('area_of_interest', $from == 'edit' ? $recruitment->area_of_interest : null, ['class' => 'form-control', 'id' => 'area_of_interest', 'placeholder' => 'Technical Area Of Interest', 'rows' => '1']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-info blue-color"></i></span>
                                {!! Form::textarea('source_of_info_about_company', $from == 'edit' ? $recruitment->source_of_info_about_company : null, ['class' => 'form-control', 'id' => 'how_did_you', 'placeholder' => 'How Did You Get Information About Company', 'rows' => '1']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-info blue-color"></i></span>
                                {!! Form::textarea('remarks', $from == 'edit' ? $recruitment->remarks : null, ['class' => 'form-control', 'id' => 'remarks', 'placeholder' => 'Remarks', 'rows' => '1']) !!}
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
                                {!! Form::text('contact_no', $from == 'edit' ? $recruitment->contact_no : null, ['class' => 'form-control', 'placeholder' => 'Contact No.', 'id' => 'contact_no']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-money blue-color"></i></span>
                                {!! Form::text('current_salary', $from == 'edit' ? $recruitment->current_salary : null, ['class' => 'form-control', 'placeholder' => 'Current Salary', 'id' => 'current_salary']) !!}
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-money blue-color"></i></span>
                                {!! Form::text('expected_salary', $from == 'edit' ? $recruitment->expected_salary : null, ['class' => 'form-control', 'placeholder' => 'Expected Salary', 'id' => 'expected_salary']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-twitch blue-color"></i></span>
                                {!! Form::text('notice_period', $from == 'edit' ? $recruitment->notice_period : null, ['class' => 'form-control', 'placeholder' => 'Notice Period', 'id' => 'notice_period']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
                                {!! Form::text('date_of_joining', $from == 'edit' ? Carbon\Carbon::parse($recruitment->date_of_joining)->format('d-m-Y') : null, ['class' => 'form-control form-control-inline date-picker datepicker', 'size' => '16', 'placeholder' => 'Your Expected Date Of Joining']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-location-arrow blue-color"></i></span>
                                {!! Form::text('preferred_location', $from == 'edit' ? $recruitment->preferred_location : null, ['class' => 'form-control', 'placeholder' => 'Your Preferred Location', 'id' => 'preferred_location']) !!}
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