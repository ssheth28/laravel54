<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend class="blue-color">Basic Information</legend>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-object-ungroup blue-color"></i></span>
                                    {!! Form::text('widget_name', $from=="edit" ? $widget->name : null,['class' => 'form-control', 'placeholder' => 'Widget Name']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group select2-bootstrap-prepend">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>
                                    <select class="form-control select2 select2-allow-clear select2-hide-search-box" tabindex="-98" id="parent_id" name="widget_controller">
                                        <option value="">Select Parent Module</option>
                                        @if (count($allWidgetControllers) > 0)
                                            @foreach ($allWidgetControllers as $controller)
                                                    @if(isset($controller['children']) && count($controller['children']))
                                                        <option value="{{ $controller['id'] }}" {{ ($from=='edit' && $controller['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }} {{ $controller['type'] == 'Module'? 'disabled' : '' }}>{{ $controller['name'] }}</option>
                                                        @include('elements.admin.widget_select_controller', ['mod' => $controller['children'], 'prefix' => '&nbsp;&nbsp;&nbsp;'])
                                                    @else
                                                        <option value="{{ $controller['id'] }}" {{ ($from=='edit' && $controller['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }}>{{ $controller['name'] }}</option>
                                                    @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>                                            
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group select2-bootstrap-prepend">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>
                                    <select class="form-control select2 select2-allow-clear select2-hide-search-box" tabindex="-98" id="parent_id" name="widget_parent">
                                        <option value="">Select Module</option>
                                            @if (count($WidgetTree) > 0)
                                                @foreach ($WidgetTree as $wt)
                                                    @if(isset($wt['children']) && count($wt['children']))
                                                        <option value="{{ $wt['id'] }}" {{ ($from=='edit' && $wt['id'] == $widget->parent_id) ? 'selected=selected ' : '' }}>{{ $wt['name'] }}</option>
                                                        @include('elements.admin.widget_parent_select', ['widgets' => $wt['children']])
                                                    @else
                                                        <option value="{{ $wt['id'] }}" {{ ($from=='edit' && $wt['id'] == $widget->parent_id) ? 'selected=selected ' : '' }}>{{ $wt['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group select2-bootstrap-prepend">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>
                                   {!! Form::select('widget_width', config('config-variables.widget_widths'), $from=="edit" ? $widget->width : null, array('class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' =>'Select Widget Width (%)')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group select2-bootstrap-prepend">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>
                                    <select class="form-control select2 select2-allow-clear select2-hide-search-box" tabindex="-98" id="parent_id" name="widget_type">
                                        <option value="">Select Widget Type</option>
                                        @if (count($WidgetTypes) > 0)
                                            @foreach ($WidgetTypes as $type)
                                                @if(isset($type['children']) && count($type['children']))
                                                    <option value="{{ $type['id'] }}" {{ ($from=='edit' && $type['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }}>{{ $type['name'] }}</option>
                                                    @include('elements.admin.widget_type_select', ['type' => $type['children']])
                                                @else
                                                    <option value="{{ $type['id'] }}" {{ ($from=='edit' && $type['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }}>{{ $type['name'] }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>                    
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group select2-bootstrap-prepend">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>
                                   {!! Form::select('status', config('config-variables.select_status'), $from=="edit" ? $widget->status : null, ['class' => 'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' => 'Select Status']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group select2-bootstrap-prepend">
                                    <span class="input-group-addon no-bg">
                                        <i class="fa fa-object-group blue-color"></i>
                                    </span>
                                   {!! Form::select('is_publicly_visible', config('config-variables.is_publicly_visible'), $from=="edit" ? $widget->is_publicly_visible : null, ['class' => 'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' => 'Select Is Publicly Visible']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-object-ungroup blue-color"></i></span>
                                    {{ Form::textarea('description', $from=="edit" ? $widget->description : null, ['class' => 'ckeditor form-control', 'id' =>'description', 'rows' => '1', 'placeholder' => 'Description']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-genderless blue-color"></i></span>
                                    {!! Form::text('widget_icon', $from=="edit" ? $widget->icon : null, ['class' => 'form-control js-icon-picker', 'readonly' => 'readonly', 'placeholder' => 'Select Page Icon']) !!}
                                </div>
                            </div>
                        </div>   
                    </div>                
            </fieldset>
        </div>
    </div>
</div>
{{--     <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Controller </label>
        </div>
        <div class="p-r-5 input-wrapper right">
            <select class="form-control select2-hide-search-box" id="parent_id" name="widget_controller">
                <option value="">Select</option>
                @if (count($allWidgetControllers) > 0)
                    @foreach ($allWidgetControllers as $controller)
                            @if(isset($controller['children']) && count($controller['children']))
                                <option value="{{ $controller['id'] }}" {{ ($from=='edit' && $controller['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }} {{ $controller['type'] == 'Module'? 'disabled' : '' }}>{{ $controller['name'] }}</option>
                                @include('elements.admin.widget_select_controller', ['mod' => $controller['children'], 'prefix' => '&nbsp;&nbsp;&nbsp;'])
                            @else
                                <option value="{{ $controller['id'] }}" {{ ($from=='edit' && $controller['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }}>{{ $controller['name'] }}</option>
                            @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Widget Type</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            <select class="form-control select2-hide-search-box" id="parent_id" name="widget_type">
                <option value="">Select</option>
                @if (count($WidgetTypes) > 0)
                    @foreach ($WidgetTypes as $type)
                        @if(isset($type['children']) && count($type['children']))
                            <option value="{{ $type['id'] }}" {{ ($from=='edit' && $type['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }}>{{ $type['name'] }}</option>
                            @include('elements.admin.widget_type_select', ['type' => $type['children']])
                        @else
                            <option value="{{ $type['id'] }}" {{ ($from=='edit' && $type['id'] == $widget->widget_type_id) ? 'selected=selected ' : '' }}>{{ $type['name'] }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Widget Parent</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            <select class="form-control select2-hide-search-box" id="parent_id" name="widget_parent">
                <option value="">Select</option>                
                @if (count($WidgetTree) > 0)
                    @foreach ($WidgetTree as $wt)
                        @if(isset($wt['children']) && count($wt['children']))
                            <option value="{{ $wt['id'] }}" {{ ($from=='edit' && $wt['id'] == $widget->parent_id) ? 'selected=selected ' : '' }}>{{ $wt['name'] }}</option>
                            @include('elements.admin.widget_parent_select', ['widgets' => $wt['children']])
                        @else
                            <option value="{{ $wt['id'] }}" {{ ($from=='edit' && $wt['id'] == $widget->parent_id) ? 'selected=selected ' : '' }}>{{ $wt['name'] }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Widget Icon</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::text('widget_icon', $from=="edit" ? $widget->icon : null, ['class' => 'form-control js-icon-picker', 'readonly' => 'readonly']) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Widget Slug</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::text('widget_slug', $from=="edit" ? $widget->slug : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Widget Name</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::text('widget_name', $from=="edit" ? $widget->name : null,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Description</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {{ Form::textarea('description', $from=="edit" ? $widget->description : null, ['class' => 'ckeditor form-control', 'id' =>'description', 'rows' => '1']) }}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Widget Width</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::select('widget_width', config('config-variables.widget_widths'), $from=="edit" ? $widget->width : null, array('class' =>'form-control select2-allow-clear select2-hide-search-box', 'placeholder' =>'Select')) !!}
        </div>
    </div>
    <div class="form-row col-md-6 clearfix">
        <div class="form-col-1">
            <label class="label">Is active?</label>
        </div>
        <div class="p-r-5 input-wrapper right">
            {!! Form::checkbox('status', 1, $from=="edit" ? $widget->status : true, ['class' => 'make-switch', 'data-on-text' => 'Yes', 'data-off-text' => 'No']) !!}
        </div>
    </div> --}}
</div>
<div class="form-actions padding0">
    <div class="row">
        <div class="col-md-9">
            <button type="submit" class="btn blue">Submit</button>
            <a class="btn default" href="{{ route('widgets.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
        </div>
    </div>
</div>