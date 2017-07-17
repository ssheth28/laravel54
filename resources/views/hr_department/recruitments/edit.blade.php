@extends('layouts.admin.default')

@section('page-style')

@endsection
@section('page-content')

<div class="portlet light">
    <div class="portlet-title min-height">  
        <div class="caption">
            <i class="fa fa-newspaper-o"></i>
            <span class="caption-subject bold uppercase font-dark">EDIT RECRUITMENT
                <span class="step-title"></span>
            </span>                
        </div>
        <div class="tools">
            &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body form">
		{!! Form::open(['route' => ['recruitments.update', 'domain' => app('request')->route()->parameter('company'), 'id' => $recruitment->id], 'class' => 'js-frm-edit-recruitment','method' => 'PUT', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

    		@include('partials.admin.hr_department.recruit_manager_form',['from'=>'edit'])
    
		{{ Form::close() }}
    </div>
</div>
@endsection

@section('page-script')
	<script type="text/javascript" src="{{ asset('js/admin/recruitments.js') }}"></script>
@endsection