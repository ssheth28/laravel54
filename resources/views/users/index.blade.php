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
                                    <a class="btn btn-icon-only btn-default" href="#" data-toggle="modal" data-target="#caret-down-popup">
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
                                            <a href="#" data-confirm-msg="Are you sure you would like to delete this user record?" data-delete-url="{{ url('admin/users') }}/@{{ user.user_id }}"  class="btn btn-icon-only js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
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

    <div class="modal fade" id="caret-down-popup" role="dialog">
       <div class="modal-dialog">
          <div class="modal-content popup-action">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Actions</h4>
             </div>
             <div class="modal-body">
                 <div class="action-box element-sec clearfix">
                    <div class="select-record-status hide">
                        <p></p>
                        <div class="radio-btn">
                            <input type="radio" id="radio" name="selectRecordAction" value="1">
                            <label for="radio" class="redio-btn-string"><span><span></span></span>All Records matched the filter Criteria</label>
                            <div class="searched-criteria-text-popup searched-criteria-text-show"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="radio-btn">
                            <input type="radio" id="radio1" name="selectRecordAction" value="2" disabled="disabled">
                            <label for="radio1"><span><span></span></span> Selected Records on the Page </label>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div>
                        <h3 class="action-title">action.command.label</h3>
                        <div class="clearfix"></div>
                        <div class="owl-carousel owl-theme owl-responsive-1000 owl-loaded">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0s; width: 1008px;">
                                    <div class="owl-item active" style="width: 116px; margin-right: 10px;">
                                        <div class="item"><a href="javascript:void(0);" class="assignrole-action action-popup-close"><span class="action-image"></span><span class="action-title">assign.role.link.label</span></a></div>
                                    </div>
                                    <div class="owl-item active" style="width: 116px; margin-right: 10px;">
                                        <div class="item"><a href="javascript:void(0);" class="assignorganization-action action-popup-close"><span class="action-image"></span><span class="action-title">assign.organization.link.label</span></a></div>
                                    </div>
                                    <div class="owl-item active" style="width: 116px; margin-right: 10px;">
                                        <div class="item"><a href="javascript:void(0);" class="assignusergroup-action action-popup-close"><span class="action-image"></span><span class="action-title">assign.usergroup.link.label</span></a></div>
                                    </div>
                                    <div class="owl-item active" style="width: 116px; margin-right: 10px;">
                                        <div class="item"><a href="javascript:void(0);" class="suspenduser-action action-popup-close"><span class="action-image"></span><span class="action-title">suspend.user.link.label</span></a></div>
                                    </div>
                                    <div class="owl-item active" style="width: 116px; margin-right: 10px;">
                                        <div class="item"><a href="javascript:void(0);" class="unsuspenduser-action action-popup-close"><span class="action-image"></span><span class="action-title">active.user.link.label</span></a></div>
                                    </div>
                                    <div class="owl-item" style="width: 116px; margin-right: 10px;">
                                        <div class="item"><a href="javascript:void(0);" class="forcelogout-action action-popup-close"><span class="action-image"></span><span class="action-title">forcelogout.link.label</span></a></div>
                                    </div>
                                    <div class="owl-item" style="width: 116px; margin-right: 10px;">
                                        <div class="item"><a href="javascript:void(0);" class="regpswd-action action-popup-close"><span class="action-image"></span><span class="action-title">regenrate.pswrd.link.label</span></a></div>
                                    </div>
                                    <div class="owl-item" style="width: 116px; margin-right: 10px;">
                                        <div class="item"><a href="javascript:void(0);" class="forcechangepswd-action action-popup-close"><span class="action-image"></span><span class="action-title">force.change.pswrd.link.label</span></a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-controls">
                                <div class="owl-nav">
                                    <div class="owl-prev" style="">prev</div>
                                    <div class="owl-next" style="">next</div>
                                </div>
                                <div class="owl-dots" style="">
                                    <div class="owl-dot active"><span></span></div>
                                    <div class="owl-dot"><span></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
             </div>
          </div>
       </div>
    </div>
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/users.js') }}"></script>
@endsection
