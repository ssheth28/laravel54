@extends('layouts.admin.default')

@section('page-style')

@endsection
@section('page-content')
	<div class="portlet light">
        <div class="portlet-title min-height">  
            <div class="caption">
                <i class="fa fa-newspaper-o"></i>
                <span class="caption-subject bold uppercase font-dark">Edit Client
                    <span class="step-title"></span>
                </span>                
            </div>
            <div class="tools">
                &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
   		   <!-- BEGIN FORM-->
            {!! Form::open(['route' => ['clients.update', 'domain' => app('request')->route()->parameter('company'), 'clientId' => $client->id], 'method' => 'PUT', 'class' => 'js-frm-edit-client clientfrm', 'role' => 'form']) !!}                    
                @include('clients.form', ['from' => 'edit'])
            {{ Form::close() }}
            <!-- END FORM-->
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('js/admin/clients.js') }}" type="text/javascript"></script>
@endsection