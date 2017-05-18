@extends('layouts.admin.default')

@section('page-style')

@endsection

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-newspaper-o"></i>
                <span class="caption-subject bold uppercase font-dark">Add Widget</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['widgets.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-widget form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
		    	@include('modules.widget.form',['from'=>'add'])
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script type="text/javascript" src="{{ Module::asset('widget:js/widgets.js') }}"></script> 
@endsection