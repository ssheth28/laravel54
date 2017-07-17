@extends('layouts.admin.default')
@section('page-content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12" id="projectList">
            {{-- @if( in_array('filter', app('session')->get('widgetAccess')) ) --}}
                <div class="portlet light box white">
                    <div class="portlet-title">
                        <div class="caption">                            
                            <span class="caption-subject font-dark bold uppercase"><i class="fa fa-filter"></i>
                            SEARCH PROJECT</span>
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
                                            <input type="text" name="name" class="form-control" placeholder="By Project Name" id="name">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-col-2">
                                        <button type="button" class="btn blue custom-filter-submit" @click="searchProjectData()">Search</button>
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
                            <span class="caption-subject font-dark bold uppercase">MANAGE PROJECT</span> &nbsp;&nbsp;
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group pull-right">
                                <a class="btn sbold border-btn" href="{{ route('projects.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div>
                            <table class="table table-striped table-bordered table-hover order-column">
                                <div class="actions pull-right table-icons">
                                    <a class="btn btn-icon-only btn-default" href="{{ route('projects.create', ['domain' => app('request')->route()->parameter('company')]) }}">
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
                                        <th data-field="username" @click="sortBy('username')" :class="[sortKey != 'username' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Project Name</th>
                                        <th data-field="email" @click="sortBy('email')" :class="[sortKey != 'email' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Project Technology</th>
                                        <th data-field="person.department" @click="sortBy('person.department')" :class="[sortKey != 'person.department' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Total Members</th>
                                        <th data-field="person.mobile_number" @click="sortBy('person.mobile_number')" :class="[sortKey != 'person.mobile_number' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Hours Spent</th>
                                        <th data-field="person.date_of_joining" @click="sortBy('person.date_of_joining')" :class="[sortKey != 'person.date_of_joining' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Project Priority</th>
                                        <th data-field="person.gender" @click="sortBy('person.gender')" :class="[sortKey != 'person.gender' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Client Name</th>
                                        <th data-field="person.status" @click="sortBy('person.status')" :class="[sortKey != 'person.status' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="" v-for="project in projectData"> 
                                        <td class="text-center table_icon">
                                            <a href="#" class="btn btn-icon-only outline-green js-project-detail" data-toggle="modal" data-target=".project-detail-show" data-url="{{ url('admin/projects') }}/@{{ project.id }}">
                                            <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('admin/projects') }}/@{{project.id}}/edit" class="btn green btn-outline btn-xs tooltips">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" data-confirm-msg="Are you sure you would like to delete this user record?" data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/projects/'}}@{{ project.id }}"  class="btn red btn-outline btn-xs js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                        </td>
                                        <td> @{{ project.name }}</td>
                                        <td> @{{ project.technologyName }}</td>
                                        <td>@{{ project.totalMembers }}</td>
                                        <td></td>
                                        <td>@{{ project.priority }}</td>
                                        <td>@{{ project.clientName }}</td>
                                        <td>@{{ project.status }}</td>                                      
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div v-if="projectCount == 0" class="col-md-12">
                                <h4 class="block text-center">No record found</h4>
                            </div>
                            <div v-if="projectCount > 0">
                                <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                    <pagination_component>
                                    </pagination_component>
                                </div>
                                <div class="col-md-7 col-sm-12 dataTables_paginate">
                                    <ul id="user_pagination" class="pagination-sm pull-right">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- @endif --}}
        </div>
    </div>


    <div class="modal fade in project-detail-show show-modal" id="view_project_details" role="dialog" style="display: none; padding-left: 17px;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body js-project-detail-content">
                    {{-- body will be render from project_detail_show.blade.php --}}
                </div>
            </div>
        </div>
    </div>   
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/project.js') }}"></script>
@endsection
