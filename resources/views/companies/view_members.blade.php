@extends('layouts.admin.default')
@section('page-style')
	<link href="{{ asset('css/admin/company.css') }}" rel="stylesheet" type="text/css" id="style_color" />
@endsection

@section('page-content')
	<div class="row" id="company_profile">
		<div class="col-md-3">
			@include('elements.admin.company_profile_navigation')
		</div>
		<div class="col-md-9">
			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Company Information</span>
                    </div>
					<div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a class="btn btn-icon-only btn-default" href="#">
                            <i class="fa fa-info"></i>
                        </a>
                    </div>
				</div>
				<table class="table table-striped table-bordered table-hover order-column" id="userTbl">
	                <thead>
	                    <tr>
	                        <th class="text-center">Actions</th>
	                        <th data-field="username" class="sorting">Employee Name</th>
	                        <th data-field="email" class="sorting">Email Id</th>
	                        <th data-field="person.mobile_number" class="sorting">Department</th>
	                        <th data-field="person.date_of_joining" class="sorting">Contact No</th>
	                        <th data-field="person.gender" class="sorting">DOJ</th>
	                        <th data-field="person.status" class="sorting">Gender</th>
	                        <th data-field="person.status" class="sorting">Status</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@foreach($users as $user)
	                    <tr> 
	                        <td class="text-center table_icon">
	                            <a href="#" data-confirm-msg="Are you sure you would like to delete this user record?" data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/users/'}}{{ $user->user_id }}"  class="btn red btn-outline btn-xs js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
	                        </td>
	                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
	                        <td>{{ $user->email }}</td>
	                        <td>{{ $user->department }}</td>	             
	                        <td>{{ $user->mobile_number }}</td>
	                        <td>{{ $user->joined_date}}</td>
	                        <td>{{ $user->gender == 0 ? 'Male' : 'Female'}}</td>	                        
	                        <td>
	                        	@if($user->status == 1)
	                            	<span class="wz-status active tooltips" data-container="body" data-placement="top" data-original-title="" title=""></span>
	                            @else
	                            	<span class="wz-status inactive tooltips" data-container="body" data-placement="top"></span>
	                            @endif
	                        </td>
	                    </tr>
	                   @endforeach
	                </tbody>
            	</table>				
			</div>	
        </div>
	</div>
@endsection