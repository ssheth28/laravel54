@extends('layouts.admin.default')

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                <span class="caption-subject bold uppercase font-dark">Add Module</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['modules.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-module form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
		    	@include('modules.module.form', ['from'=>'add'])
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script type="text/javascript" src="{{ Module::asset('module:js/modules.js') }}"></script>
@endsection