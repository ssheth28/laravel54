@extends('layouts.admin.default')

@section('page-style')

@endsection
@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject bold uppercase font-dark"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Create Client </span>
            </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
            </div>
            <div class="actions">
                <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
            </div>
        </div>

        <div class="portlet-body form">
   		   <!-- BEGIN FORM-->
            {!! Form::open(['route' => ['clients.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-client clientfrm', 'role' => 'form', 'id' => 'submit_client_form']) !!}                    
                @include('clients.form', ['from' => 'add'])
            {{ Form::close() }}
            <!-- END FORM-->
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('js/admin/clients.js') }}" type="text/javascript"></script>
@endsection