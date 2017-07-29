<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="note note-warning">
                <p>If you are creating Parent Module itself then no need to select value from <code><b>Select Parent Module</b></code> From <b>"Basic Information"</b></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered no-padding-bottom mb-0">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark">Basic Information </span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse no-border" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body clearfix">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>                                    
                                    <select class="form-control selectpicker" tabindex="-98" id="parent_id" name="parent_id">
                                        <option value="">-- Select Parent Module --</option>
                                        @if (count($allModules) > 0)
                                            @foreach ($allModules as $mod)
                                                @if(isset($mod['children']) && count($mod['children']))
                                                    <option value="{{ $mod['id'] }}" {{ ($from=='edit' && $mod['id'] == $module->parent_id) ? 'selected=selected ' : '' }}>{{ $mod['name'] }}</option>
                                                    @include('elements.admin.module_select', ['mod' => $mod['children'], 'prefix' => '&nbsp;&nbsp;&nbsp;'])
                                                @else
                                                    <option value="{{ $mod['id'] }}" {{ ($from=='edit' && $mod['id'] == $module->parent_id) ? 'selected=selected ' : '' }}>{{ $mod['name'] }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-object-ungroup blue-color"></i></span>
                                    {!! Form::text('name', $from=="edit" ? $module->name : null, ['class' => 'form-control', 'id' => 'module_name', 'placeholder' => 'Module Name']) !!}
                                </div>
                            </div>
                        </div>                   
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-external-link blue-color"></i></span>
                                    {!! Form::text('url', $from=="edit" ? $module->url : null,['class' => 'form-control', 'id' => 'module_url', 'placeholder' => 'Module URL']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-genderless blue-color"></i></span>
                                    {!! Form::text('icon', $from=="edit" ? $module->icon : null, ['class' => 'form-control icp icp-auto js-icon-picker', 'readonly' => 'readonly', 'data-placement' =>'bottomLeft', 'placeholder' => 'Select Page Icon']) !!}
                                </div>
                            </div>
                        </div>                           
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-external-link blue-color"></i></span>
                                    {!! Form::text('order', $from=="edit" ? $module->order : null,['class' => 'form-control', 'placeholder' => 'Module Order']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>
                                    {!! Form::select('is_active', config('config-variables.select_status'), $from=="edit" ? $module->is_active : null, ['class' => 'form-control selectpicker', 'placeholder' => '-- Select Status --']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>
                                    {!! Form::select('is_publicly_visible', config('config-variables.is_publicly_visible'), $from=="edit" ? $module->is_publicly_visible : null, ['class' => 'form-control selectpicker', 'id' => 'is_publicly_visible', 'placeholder' => '-- Is Publicly Visible? --']) !!}
                                </div>
                            </div>
                        </div>                              
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>                                    
                                    {!! Form::select('type', config('config-variables.module_types'), $from=="edit" ? $module->type : null, array('class' =>'form-control selectpicker', 'tabindex' => '-98', 'placeholder' =>'Select Module Type', 'id' => 'module_type')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>                                    
                                    {!! Form::select('is_shown_on_menu', config('config-variables.is_shown_on_menu'), $from=="edit" ? $module->is_shown_on_menu : null, ['class' => 'form-control selectpicker', 'placeholder' => 'Is Show On Menu?']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-info blue-color"></i></span>
                                    {{ Form::textarea('description', $from=="edit" ? $module->description : null, ['class' => 'form-control small-txt-e', 'id' =>'description', 'rows' => '1', 'placeholder' => 'Remarks']) }}
                                </div>
                            </div>
                        </div>                                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-actions padding0">
    <div class="row">
        <div class="col-md-9">
            <button type="submit" class="btn blue">Submit</button>
            <a class="btn default" href="{{ route('modules.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
        </div>
    </div>
</div>