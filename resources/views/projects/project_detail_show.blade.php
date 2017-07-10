<div class="portlet light" style="margin: 0; padding: 0;">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-file-text" aria-hidden="true"></i> View Details</span>
        </div>
        <div class="tools">
            &nbsp;<a href="" class="collapse"> </a>
            <a href="javascript:;" data-dismiss="modal">×</a>
        </div>
        <div class="actions">
            <a class="btn btn-icon-only btn-default" href="{{ url('admin/projects') }}/{{ $project->id }}/edit">
                <i class="fa fa-pencil-square-o"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row form-horizontal">
            <div class="col-md-12">
                <fieldset>
                    <legend class="blue-color">Project Basic Information</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Project Name</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $project->name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Project Technology</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $project->technology->name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Project Type</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $project->project_type }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Project Group</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">Development</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Client Name</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $project->client->name }} </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Project Old Website</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $project->old_website }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="blue-color">Project Timeline</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Project Start Date</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Project Approx. End Date</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="blue-color">Project Manage Details</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Project Members</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">3</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Project Priority</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color"> {{ $project->priority }} </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Project Status </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $project->status }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="margin-top-10">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="col-md-4 col-sm-4 text-right">
                                    <label>Other Information </label>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <label class="blue-color">{{ $project->other_info }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>