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
            <a class="btn btn-icon-only btn-default" href="{{ url('admin/assets') }}/{{ $asset->id }}/edit">
                <i class="fa fa-pencil-square-o"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row form-horizontal">
            <div class="col-md-12">
                <fieldset>
                    <legend class="blue-color" align="">Asset Basic Information</legend>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                <div class="col-md-12">
                                @if(count($asset->getMedia('Asset_image')) > 0)
                                    <img src="{{ $asset->getMedia('Asset_image')[0]->getUrl() }}" class="img-responsive img-circle" style="widht:85px;">
                                @else
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=NoImage" class="img-responsive margin-bottom-10 img-circle" style="width:85px; margin: auto;">
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Desk Name</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $asset->desk_name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>IP Address</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $asset->ip_address }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Keyboard Name</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $asset->keyboard_name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Mouse Name</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $asset->mouse_name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Manufacture Name</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $asset->manufacture_name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Asset Price</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $asset->asset_price }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <legend class="blue-color" align="">Asset Credentials</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>User Name</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>User ID</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <legend class="blue-color" align="">Asset Configuration</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Motherboard Model</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $asset->motherboard_model }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Processor Model</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $asset->processor }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>HDD</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $asset->hdd }}</label>
                                </div>
                            </div>
                        </div>  
                    </div>
                     <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>OS Version</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $asset->os_version }}</label>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <hr class="margin-top-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-4 col-sm-4 text-right">
                                    <label>Enter the Installed Software Details Here</label>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <label class="blue-color">{{ $asset->description }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>