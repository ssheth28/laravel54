@extends('layouts.admin.default')

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title min-height">
            <div class="caption">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                <span class="caption-subject bold uppercase font-dark">Create Page</span>
            </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
            </div>
            <div class="actions">
                <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['pages.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-module', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
		    	@include('modules.module.page_form', ['from'=>'add'])
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script type="text/javascript" src="{{ Module::asset('module:js/pages.js') }}"></script>
@endsection