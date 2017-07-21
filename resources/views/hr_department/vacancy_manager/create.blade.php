@extends('layouts.admin.default')

@section('page-style')
@endsection

@section('page-content')
	<div class="portlet light">
        <div class="portlet-title min-height">  
            <div class="caption">
                <i class="fa fa-newspaper-o"></i>
                <span class="caption-subject bold uppercase font-dark">CREATE VACANCY
                    <span class="step-title"></span>
                </span>                
            </div>
            <div class="tools">
                &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
   		   <!-- BEGIN FORM-->
            {!! Form::open(['route' => ['vacancies.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-vacancy', 'role' => 'form']) !!}         

                @include('partials.admin.hr_department.vacancy_manager_form', ['from' => 'add'])
            
            {{ Form::close() }}
            <!-- END FORM-->
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('js/admin/vacancies.js') }}" type="text/javascript"></script>
@endsection