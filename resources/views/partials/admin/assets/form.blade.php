<div class="form-body">
    <div class="row">
    	<div class="col-md-6">
        	<fieldset>
                <legend class="blue-color">Asset Basic Information</legend>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-desktop blue-color"></i></span>
                         		{!! Form::text('desk_name', $from=="edit" ? $asset->desk_name : null, ['class' => 'form-control',  'placeholder' => 'Desk Name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-server blue-color"></i></span>
                         		{!! Form::text('ip_address', $from=="edit" ? $asset->ip_address : null, ['class' => 'form-control',  'placeholder' => 'IP Address']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-keyboard-o blue-color"></i></span>
                         		{!! Form::text('keyboard_name', $from=="edit" ? $asset->keyboard_name : null, ['class' => 'form-control',  'placeholder' => 'Keyboard Name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-mouse-pointer blue-color"></i></span>
                         		{!! Form::text('mouse_name', $from=="edit" ? $asset->mouse_name : null, ['class' => 'form-control',  'placeholder' => 'Mouse Name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-industry blue-color"></i></span>
                         		{!! Form::text('manufacture_name', $from=="edit" ? $asset->manufacture_name : null, ['class' => 'form-control',  'placeholder' => 'Manufacture Name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-money blue-color"></i></span>
                         		{!! Form::text('asset_price', $from=="edit" ? $asset->asset_price : null, ['class' => 'form-control',  'placeholder' => 'Asset Price']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-upload blue-color"></i></span>
                                    <div class="form-control uneditable-input input-fixed" data-trigger="fileinput">
                                        <span class="fileinput-filename">Asset Image </span>
                                    </div>
                                    <span class="input-group-addon btn light btn-file">
                                        <span class="fileinput-new"> Select file </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="asset_image"> </span>
                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>	
        </div> 
        <div class="col-md-6">
        	<fieldset>
                <legend class="blue-color">Asset Configuration</legend>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-clipboard blue-color"></i></span>
                         		{!! Form::text('motherboard_model', $from=="edit" ? $asset->motherboard_model : null, ['class' => 'form-control',  'placeholder' => 'Motherboard Model']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-qrcode blue-color"></i></span>
                         		{!! Form::text('processor', $from=="edit" ? $asset->processor : null, ['class' => 'form-control',  'placeholder' => 'Processor Model']) !!}
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-hdd-o blue-color"></i></span>
                         		{!! Form::text('hdd', $from=="edit" ? $asset->hdd : null, ['class' => 'form-control',  'placeholder' => 'HDD']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-windows blue-color"></i></span>
                         		{!! Form::text('os_version', $from=="edit" ? $asset->os_version : null, ['class' => 'form-control',  'placeholder' => 'OS Version']) !!}
                            </div>
                        </div>
                    </div>
                   	<div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-info blue-color"></i></span>
                                <!-- <textarea placeholder="Enter the Installed Software Details Here" class="form-control small-txt-e" rows="1" name="description"></textarea> -->
                                {!! Form::textarea('description', $from=="edit" ? $asset->description : null, ['class' => 'form-control',  'placeholder' => 'description']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>	
        </div>       
    </div>
    <div class="row">
    	<div class="col-md-6">
        	<fieldset>
                <legend class="blue-color">Asset Credentials</legend>
                <div class="row">
                	<div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <div class="input-group select2-bootstrap-prepend">
                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                <select data-placeholder="-- Select User Name --" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <option value="1">Ali SK</option>
                                    <option value="2">Anoop Pesala</option>
                                    <option value="3">Bala Trinadh</option>
                                </select><span class="select2 select2-container select2-container--bootstrap select2-container--below" dir="ltr"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-ke90-container"><span class="select2-selection__rendered" id="select2-ke90-container"><span class="select2-selection__placeholder">-- Select User Name --</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                         		{!! Form::text('name', null, ['class' => 'form-control',  'placeholder' => 'User ID']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-lock blue-color"></i></span>
                         		{!! Form::text('name', null, ['class' => 'form-control',  'placeholder' => 'Password']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>	
        </div>   
    </div>
   <div class="form-actions">
        <div class="row">
            <div class="col-md-9">
                <button type="submit" class="btn blue">Submit</button>
                <button type="submit" class="btn default">Cancel</button>
            </div>
        </div>
    </div>
</div>