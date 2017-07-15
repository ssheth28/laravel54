<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <legend class="blue-color">Project Basic Information</legend>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                {!! Form::text('project_name', $from == 'edit' ? $project->name : null, ['class' => 'form-control', 'id' => 'project_name', 'placeholder' => 'Project Name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                {!! Form::select('project_tech', $technologies,  $from == 'edit' ? $project->technology_id : null, ['class' =>'selectpicker', 'placeholder' => '-- Select Project Technology --']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-globe blue-color"></i></span>
                                {!! Form::select('project_type', config('config-variables.project_types'),  $from == 'edit' ? $project->project_type : null, ['class' =>'selectpicker', 'placeholder' => '-- Select Project Type --']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
                                {!! Form::select('client_name', $clients,  $from == 'edit' ? $project->client_id : null, ['class' =>'selectpicker', 'placeholder' => '-- Select Client --']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
                                {!! Form::text('old_website', $from == 'edit' ? $project->old_website : null, ['class' => 'form-control', 'id' => 'old_website', 'placeholder' => 'Project Old Website']) !!}
                            </div>
                        </div>
                    </div>                    
                </div>
            </fieldset>
        </div>
        <div class="col-md-6">
            <fieldset>
                <legend class="blue-color">Project Manage Details</legend>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-building blue-color"></i></span>
                                {!! Form::select('project_member[]', $users,  $from == 'edit' ? $project->user_id : null, ['class' =>'form-control selectpicker', 'placeholder' => '-- Select Project Members --', 'multiple' => true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-external-link blue-color"></i></span>
                                {!! Form::select('project_priority', config('config-variables.project_priorities'),  $from == 'edit' ? $project->priority : null, ['class' =>'selectpicker', 'placeholder' => '-- Select Project Priority --']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-industry blue-color"></i></span>
                                {!! Form::select('project_status', config('config-variables.project_status'),  $from == 'edit' ? $project->status : null, ['class' =>'selectpicker', 'placeholder' => '-- Select Project Status --']) !!}
                            </div>
                        </div>
                    </div>                                            
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-info blue-color"></i></span>
                                {!! Form::textarea('other_info', $from == 'edit' ? $project->other_info : null, ['class' => 'form-control', 'id' => 'other_info', 'placeholder' => 'Other Information', 'rows' => '1']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="row">
        <div class="col-md-6 col-lg-6">
            <fieldset>
                <legend class="blue-color">Project Timeline</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-phone blue-color"></i></span>
                                {!! Form::text('start_date', $from == 'edit' ? $project->start_date : null, ['class' => 'form-control form-control-inline date-picker datepicker', 'size' => '16', 'placeholder' => 'Project Start Date']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-skype blue-color"></i></span>
                                {!! Form::text('end_date', $from == 'edit' ? $project->end_date : null, ['class' => 'form-control form-control-inline date-picker datepicker', 'size' => '16', 'placeholder' => 'Project Approx. End Date']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-9">
            <button type="submit" class="btn blue">Submit</button>
            <a class="btn default" href="{{ route('projects.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
        </div>
    </div>
</div>