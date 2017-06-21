@extends('layouts.admin.default')

@section('page-style')

@endsection

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Edit Widget</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['widgets.update', 'domain' => app('request')->route()->parameter('company'), 'widgetId' => $widget->id], 'method' => 'PUT', 'class' => 'js-frm-edit-widget', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
		    	@include('modules.widget.form',['from'=>'edit'])
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script type="text/javascript" src="{{ Module::asset('widget:js/widgets.js') }}"></script>       
@endsection