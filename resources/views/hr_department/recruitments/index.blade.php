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
                <div class="portlet-body flip-scroll" style="display: none">
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
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                        <select class="form-control selectpicker" id="position">
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
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                        <select class="form-control selectpicker" id="last_status">
                                        <option value="">By Position</option>
                                        @foreach( config('config-variables.last_status') as $key=>$status)
                                            <option value="{{ $key }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    </div> 
                                </div>                  
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-col-2">
                                    <button type="button" class="btn blue custom-filter-submit" @click="searchRecruitmentData()">Search</button>
                                    <button type="button" class="btn red custom-filter-cancel" @click="clearForm('frmSearchData')">Clear</button>
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
                    <div class="caption col-md-8">
                        <i class="fa fa-user"></i>
                        <span class="caption-subject font-dark bold uppercase">MANAGE RECRUITMENT</span> &nbsp;&nbsp;
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group pull-right">
                            <a class="btn sbold border-btn" href="{{ route('recruitments.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover order-column">
                            <div class="actions pull-right table-icons">
                                <a class="btn btn-icon-only btn-default" href="{{ route('recruitments.create', ['domain' => app('request')->route()->parameter('company')]) }}">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <a class="btn btn-icon-only btn-default" href="#">
                                    <i class="fa fa-gear"></i>
                                </a>
                                <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title="">
                                    <i class= "fa fa-expand"></i>
                                </a> 
                            </div>
                            <thead>
                                <tr>
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
                                <tr class="" v-for="recruitment in recruitmentData"> 
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
                                    <td>@{{ recruitment.assign_to }}</td>
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
