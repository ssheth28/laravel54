<div class="form-body">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                    {!! Form::text('lead_name', $from == 'edit' ? $lead->lead_name : null, ['class' => 'form-control', 'placeholder' => 'Lead Name']) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                    {!! Form::text('email', $from == 'edit' ? $lead->email : null, ['class' => 'form-control', 'placeholder' => 'Email Id']) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                    {!! Form::select('country', $countries,  $from == 'edit' ? $lead->country_id : null, ['class' =>'selectpicker', 'placeholder' => '-- Select Country --']) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                    {!! Form::text('contact_no', $from == 'edit' ? $lead->contact_no : null, ['class' => 'form-control', 'placeholder' => 'Contact No']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                    {!! Form::text('skype_id', $from == 'edit' ? $lead->skype_id : null, ['class' => 'form-control', 'placeholder' => 'Skype Id']) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                    {!! Form::text('reference', $from == 'edit' ? $lead->reference : null, ['class' => 'form-control', 'placeholder' => 'Reference']) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                    {!! Form::select('last_update_status', config('config-variables.leads_last_update_status'),  $from == 'edit' ? $lead->last_update_status : null, ['class' =>'selectpicker', 'placeholder' => '-- Select Last Update Status --']) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                    {!! Form::select('poc', $users,  $from == 'edit' ? $lead->poc_id : null, ['class' =>'selectpicker', 'placeholder' => '-- Select POC --']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                    {!! Form::text('industry', $from == 'edit' ? $lead->industry : null, ['class' => 'form-control', 'placeholder' => 'Industry']) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                    {!! Form::text('other_detail', $from == 'edit' ? $lead->other_detail : null, ['class' => 'form-control', 'placeholder' => 'Other']) !!}
                </div>
            </div>
        </div>        
    </div>
    
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
                <div action="#" class="dropzone dropzone-file-area dz-clickable" id="my-dropzone">
                    <h3 class="sbold">Drop files here or click to upload</h3><br>
                    <p> Selected files are not actually uploaded. </p><br>
                <div class="dz-default dz-message"><span></span></div></div>
            </div>
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