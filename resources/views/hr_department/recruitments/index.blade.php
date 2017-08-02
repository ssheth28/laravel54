@extends('layouts.admin.default')
@section('page-content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-md-12" id="recruitmentList">
        {{-- @if( in_array('filter', app('session')->get('widgetAccess')) ) --}}
            <div class="portlet light box white">
                <div class="portlet-title">
                    <div class="caption">                            
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-filter"></i>
                        SEARCH RECRUITMENT</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="reload" data-original-title="" title="" aria-describedby="tooltip73982" @click="reloadData();"> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <div class="" id="frmSearchData">
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                        <input type="text" name="person_name" class="form-control" placeholder="By Person Name" id="person_name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-file-code-o blue-color"></i></span>
                                        <select class="form-control select2 select2-allow-clear select2-hide-search-box" id="position">
                                        <option value="">By Position</option>
                                        @foreach( config('config-variables.positions') as $key=>$status)
                                            <option value="{{ $key }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    </div> 
                                </div>                  
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                        {!! Form::select('assignee', $users, null, ['class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' => '-- By Assigned To --', 'id' => 'assignee']) !!}
                                    </div> 
                                </div>                  
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-random blue-color"></i></span>
                                        <select class="form-control select2 select2-allow-clear select2-hide-search-box" id="last_status">
                                        <option value="">By Last Status</option>
                                        @foreach( config('config-variables.last_status') as $key=>$status)
                                            <option value="{{ $key }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    </div> 
                                </div>                  
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-col-2">
                                    <button type="button" class="btn blue custom-filter-submit" @click="searchRecruitmentData()">Submit</button>
                                    <button type="button" class="btn red custom-filter-cancel" @click="clearForm('frmSearchData')">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- @endif --}}
        {{-- @if( in_array('listing', app('session')->get('widgetAccess')) ) --}}
            <div class="portlet light">
                @include('flash::message')
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-user" aria-hidden="true"></i> Manage Recruitment</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a href="{{ route('recruitments.create', ['domain' => app('request')->route()->parameter('company')]) }}" class="btn btn-icon-only btn-default tooltips" data-container="body" data-placement="top" data-original-title="Add New Recruitment"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        <a class="btn btn-icon-only btn-default dropdown-toggle tooltips" data-container="body" data-placement="top" data-original-title="Tools" data-toggle="dropdown"><i class="fa fa-gear" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-print"></i> Print </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                            </li>
                        </ul>
                        <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover order-column" v-cloak>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Actions</th>
                                    <th data-field="person_name" @click="sortBy('person_name')" :class="[sortKey != 'person_name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Person Name</th>
                                    <th data-field="position" @click="sortBy('position')" :class="[sortKey != 'position' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Applied for position</th>
                                    <th data-field="person.mobile_number" @click="sortBy('person.mobile_number')" :class="[sortKey != 'person.mobile_number' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Date and Time</th>
                                    <th data-field="contact_no" @click="sortBy('contact_no')" :class="[sortKey != 'contact_no' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Contact No.</th>
                                    <th data-field="assign_to" @click="sortBy('assign_to')" :class="[sortKey != 'assign_to' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Assigned To</th>
                                    <th data-field="last_status" @click="sortBy('last_status')" :class="[sortKey != 'last_status' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Last Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="(index, recruitment) in recruitmentData"> 
                                    <td class="text-center">@{{ index + 1 }}</td>
                                    <td class="text-center table_icon">
                                        <a href="#" class="btn btn-icon-only outline-green js-recruitment-detail" data-toggle="modal" data-target=".recruitment-detail-show" data-url="{{ url('admin/recruitments') }}/@{{ recruitment.id }}">
                                        <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/recruitments') }}/@{{recruitment.id}}/edit" class="btn green btn-outline btn-xs tooltips">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this user record?" data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/recruitments/'}}@{{ recruitment.id }}"  class="btn red btn-outline btn-xs js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                    </td>
                                    <td>@{{ recruitment.person_name }}</td>
                                    <td>@{{ recruitment.position }}</td>
                                    <td>@{{ recruitment.date_of_interview }} @{{ recruitment.time_of_interview }}</td>
                                    <td>@{{ recruitment.contact_no }}</td>
                                    <td>@{{ recruitment.userFullName }}</td>
                                    <td>@{{ recruitment.last_status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div v-if="recruitmentCount == 0" class="col-md-12">
                            <h4 class="block text-center">No record found</h4>
                        </div>
                        <div v-if="recruitmentCount > 0">
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="recruitment_pagination" class="pagination-sm pull-right">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- @endif --}}
    </div>
</div>

<div class="modal fade in recruitment-detail-show show-modal" id="view_recruitment_details" role="dialog" style="display: none; padding-left: 17px;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body js-recruitment-detail-content">
                {{-- body will be render from recruitment_detail_show.blade.php --}}
            </div>
        </div>
    </div>
</div>   
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/recruitments.js') }}"></script>
@endsection
