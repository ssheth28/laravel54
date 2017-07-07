@extends('layouts.admin.default')
@section('page-style')
@endsection
@section('page-content')
	<div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject font-dark bold uppercase">Edit Users</span>
            </div>
        </div>
        <div class="portlet-body form">
       		{!! Form::open(['route' => ['users.update', 'domain' => app('request')->route()->parameter('company'), 'userId' => $user->id], 'method' => 'PUT', 'class' => 'js-frm-edit-user userfrm', 'role' => 'form', 'id' => 'submit_edit_user_form']) !!}
		    	{{-- @include('partial.admin.users.form',['from'=>'edit']) --}}
                <div class="form-body">
                    <div class="note note-info">
                        <p style="font-size: 18px;">Your account details</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-col-1">
                                <label class="label">Email </label>
                            </div>                    
                            <div class="input-group">
                                <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                {!! Form::email('email', $user->email, ['class' => 'form-control', 'id' => 'email', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                            </div> 
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Roles </label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>         
                                    {!! Form::select('roles[]', $roles, $companyWiseRoles, array('class' =>'select2-allow-clear select2-hide-search-box form-control')) !!}
                                </div> 
                            </div>                  
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Department</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::select('department', $departments, $companyUser->settings['department'], array('class' =>'form-control select2-allow-clear select2-hide-search-box', 'placeholder' => '-- Select Department --')) !!}
                                </div> 
                            </div>                  
                        </div>

                        <div class="col-md-3 col-lg-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Date Of Joining</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-calendar blue-color"></i></span>
                                    {!! Form::text('joining_date', $user->person->date_of_joining, ['class' => 'form-control form-control-inline date-picker datepicker', 'size' => '16']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="note note-info">
                        <p style="font-size: 18px;">Basic Information</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">First Name</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('first_name', $user->person->first_name,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Middle Name</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('middle_name', $user->person->middle_name,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Last Name</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('last_name', $user->person->last_name,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Username</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('username', $user->username,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div>                        
                    </div>

                    <div class="note note-info">
                        <p style="font-size: 18px;">Personal Information</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Contact Number</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('contact_no', $user->person->mobile_number,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Landline Number</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('landline_no', $user->person->home_phone,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div>  

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Parent's Contact Number</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('parent_contact_no', $user->person->parent_contact_number,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div> 

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Driving Licence Number</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('driving_licence_no', $user->person->driving_licence_number,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div>  

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Aadhar Card Number</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('aadhar_card_no', $user->person->aadhar_card_number,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div>    

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Voter ID Number</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('voter_id_no', $user->person->voter_id_number,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div>     

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Blood Group</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('blood_group', $user->person->blood_group,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null]) !!}
                                </div> 
                            </div>                  
                        </div>  

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Date Of Birth</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::text('birth_date', $user->person->dob,['class' => 'form-control form-control-inline date-picker datepicker', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null, 'size' => '16' ]) !!}
                                </div>                                 
                            </div>                  
                        </div> 

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Current Address</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::textarea('current_address', $user->person->address['current_address'],['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null, 'rows' => '3']) !!}
                                </div>                                 
                            </div>                  
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="form-col-1">
                                    <label class="label">Permanent Address</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                    {!! Form::textarea('permanent_address', $user->person->permanent_address,['class' => 'form-control', 'readonly' => Auth::user()->id != $user->id ? 'readonly' : null, 'rows' => '3']) !!}
                                </div>                                 
                            </div>                  
                        </div>
                    </div>               

                    <div class="form-actions">
                        <div class="">
                            <div class="col-md-12">
                                <button type="submit" class="uie-btn uie-btn-primary save-btn">Submit</button>
                                <a class="uie-btn uie-secondary-btn reset-btn" href="{{ route('users.index', ['domain' => app('request')->route()->parameter('company')]) }}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{ $user->id }}" name="user_id"></input>
			{{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/users.js') }}" type="text/javascript"></script>
@endsection