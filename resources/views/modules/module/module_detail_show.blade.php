<div class="portlet light" style="margin: 0; padding: 0;">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-file-text" aria-hidden="true"></i> View Details</span>
        </div>
        <div class="tools">
            &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
            <a href="javascript:;" data-dismiss="modal">×</a>
        </div>
        <div class="actions">
            <a class="btn btn-icon-only btn-default" href="{{ url('admin/modules') }}/{{ $module->id }}/edit">
                <i class="fa fa-pencil-square-o"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row form-horizontal">
            <div class="col-md-12">
                <div class="portlet light bordered no-padding-bottom">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark">Basic Information </span>
                        </div>
                        <div class="tools">
                            &nbsp;<a href="" class="no-border collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body clearfix" style="display: block;">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="col-md-5 col-sm-5">                                    
                                        <label><b>Parent Module</b></label>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <label>{{ $module->parent_id }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="col-md-5 col-sm-5">
                                        <label><b>Module Name</b></label>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <label>{{ $module->name }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="col-md-5 col-sm-5">
                                        <label><b>Module URL</b></label>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <label>{{ $module->url }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="col-md-5 col-sm-5">
                                        <label><b>Page Icon</b></label>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <label>{{ $module->icon }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="col-md-5 col-sm-5">
                                        <label><b>Is Publicly Visible</b></label>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <label>{{ $module->is_publicly_visible == 1 ? 'Yes' : 'No' }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <div class="col-md-5 col-sm-5">
                                        <label><b>Status</b></label>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <label>{{ $module->is_active == 1 ? 'Yes' : 'No' }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="no-margin-top">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label><b>Remarks </b></label>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>{{ $module->description }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>