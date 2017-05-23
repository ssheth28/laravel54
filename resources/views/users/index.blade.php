@extends('layouts.admin.default')
@section('page-content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12" id="userlist" v-cloak>
            @if( in_array('filter', app('session')->get('widgetAccess')) )
                <div class="portlet box white">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark">Search</span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="reload" data-original-title="" title="" aria-describedby="tooltip73982" @click="reloadData();"> </a>
                        </div>
                    </div>
                    <div class="portlet-body flip-scroll" style="display: none">
                        <div class="form-horizontal" id="frmSearchData">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-row clearfix">
                                        <div class="form-col-1">
                                            <label class="label">Name </label>
                                        </div>
                                        <div class="p-r-5 input-wrapper right">
                                            <input type="text" name="name" class="form-control" placeholder="User Name" id="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-row clearfix">
                                        <div class="form-col-1">
                                            <label class="label">Email </label>
                                        </div>
                                        <div class="p-r-5 input-wrapper right">
                                            <input type="text" name="email" class="form-control" placeholder="Email" id="email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <button type="button" class="btn uie-btn uie-btn-primary" @click="searchUserData()">Search</button>
                                        <button type="button" class="uie-btn uie-secondary-btn" @click="clearForm('frmSearchData')">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if( in_array('listing', app('session')->get('widgetAccess')) )
                <div class="portlet light">
                    @include('flash::message')
                    <div class="portlet-title">
                        <div class="caption col-md-8">
                            <i class="fa fa-table"></i>
                            <span class="caption-subject font-dark bold uppercase">User List</span> &nbsp;&nbsp;
                            <span style="display:inline-block;">
                                <label class="mt-checkbox"> Show User With Pending Invitation
                                    <input type="checkbox" value="1" name="not_accepted_invitation" id="not_accepted_invitation" @click="searchUserData()" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group pull-right">
                                <a class="btn sbold border-btn" href="{{ route('users.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div>
                            <table class="table table-striped table-bordered table-hover order-column" v-cloak>
                                <div class="actions pull-right table-icons">
                                    <a class="btn btn-icon-only btn-default" href="#">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                    <a class="btn btn-icon-only btn-default" href="#">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-icon-only btn-default" href="#">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <a class="btn btn-icon-only btn-default" href="#">
                                        <i class="fa fa-sliders"></i>
                                    </a>
                                    <a class="btn btn-icon-only btn-default" href="#">
                                        <i class="fa fa-sort-amount-asc"></i>
                                    </a>
                                    <a class="btn btn-icon-only btn-default" href="#">
                                        <i class="fa fa-table"></i>
                                    </a>
                                    <a class="btn btn-icon-only btn-default" href="#">
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                </div>
                                <thead>
                                    <tr>
                                        <th data-field="people.first_name" @click="sortBy('people.first_name')" :class="[sortKey != 'people.first_name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">First name</th>
                                        <th data-field="people.last_name" @click="sortBy('people.last_name')" :class="[sortKey != 'people.last_name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Last name</th>
                                        <th data-field="email" @click="sortBy('email')" :class="[sortKey != 'email' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Email</th>
                                        <th>Invitation Status</th>
                                        <th data-field="created_datetime" @click="sortBy('created_datetime')" :class="[sortKey != 'created_datetime' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Created at</th>     
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="" v-for="user in userData">                                    
                                        <td>@{{ user.first_name }}</td>
                                        <td>@{{ user.last_name }}</td>
                                        <td>@{{ user.email }}</td>
                                        <td>@{{ user.settings.is_invitation_accepted == 1 ? 'Accepted' : 'Pending'}}</td>
                                        <td>@{{ user.created_datetime }}</td>
                                        <td class="text-center table_icon">                                        
                                            <a href="javascript: void(0)" @click="resendInvitation(user.user_id)" class="btn btn-icon-only" v-if="user.settings.is_invitation_accepted == 0">
                                                <i class="fa fa-share-square-o"></i>
                                            </a>
                                            <a href="{{ url('admin/users') }}/@{{user.user_id}}/edit" class="btn btn-icon-only">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" data-confirm-msg="Are you sure you would like to delete this tag record?" data-delete-url="{{ url('admin/users') }}/@{{ user.user_id }}"  class="btn btn-icon-only js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div v-if="userCount == 0" class="col-md-12">
                                <h4 class="block text-center">No record found</h4>
                            </div>
                            <div v-if="userCount > 0">
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
            @endif
        </div>
    </div>
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/users.js') }}"></script>
@endsection
