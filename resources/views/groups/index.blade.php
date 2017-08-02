@extends('layouts.admin.default')

@section('page-content')
    <div class="row">
        <div class="col-md-12" id="grouplist">
                <div class="portlet light box white">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-filter" aria-hidden="true"></i> Search role</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse" data-original-title="" title=""> </a>
                        </div>
                        <div class="actions">
                            <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
                        </div>
                    </div>                  
                    <div class="portlet-body flip-scroll" style="display: none">
                        <div class="" id="frmSearchData">
                            <div class="form-body">
                                <div class="row">
                                   <div class="col-lg-2 col-md-3">
                                        <div class="form-group">
                                            <div class="input-group select2-bootstrap-prepend">
                                                <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                                <input type="text" name="role_name" class="form-control" placeholder="By Role Name" id="role_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="form-group">
                                            <div class="input-group select2-bootstrap-prepend">
                                                <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                                {!! Form::select('parent_module', $parentModule,null, array('class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'id' => 'parent_module', 'placeholder' => '-- By Module --')) !!}
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-2 col-md-3">
                                        <div class="form-group">
                                            <div class="input-group select2-bootstrap-prepend">
                                                <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                                {!! Form::select('sub_module', $subModules,null, array('class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'id' => 'sub_module', 'placeholder' => '-- By SubModule --')) !!}
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="form-group">
                                            <div class="input-group select2-bootstrap-prepend">
                                                <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                                {!! Form::select('page_name', $pageName,null, array('class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'id' => 'page_name', 'placeholder' => '-- By Page Name --')) !!}
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="form-group">
                                            <div class="input-group select2-bootstrap-prepend">
                                                <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                                {!! Form::select('widget', $widgets,null, array('class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'id' => 'widget', 'placeholder' => '-- By Widget Name --')) !!}
                                            </div>
                                        </div>        
                                    </div> 
                                    <div class="col-lg-2 col-md-3">
                                        <div class="form-col-2">
                                            <button type="button" class="btn blue custom-filter-submit" @click="searchGroupData()">Search</button>
                                            <button type="button" class="btn red custom-filter-cancel" @click="clearForm('frmSearchData')">Cancel</button>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="portlet light">
                @include('flash::message')
                <div class="portlet-title">
                    <div class="caption col-md-9">
                        <i class="fa fa-table"></i>
                        <span class="caption-subject bold uppercase font-dark">Manage role</span>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group pull-right">
                            <a class="btn sbold border-btn" href="{{ route('groups.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
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
                                    <th data-field="name" @click="sortBy('name')" :class="[sortKey != 'name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Group Name</th>
                                    <th data-field="status" @click="sortBy('status')" :class="[sortKey != 'status' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Status</th>
                                    <th data-field="created_datetime" @click="sortBy('created_datetime')" :class="[sortKey != 'created_datetime' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Created at</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="group in groupData"> 
                                    <td>@{{ group.display_name }}</td>
                                    <td>@{{ group.status==1 ? 'Activated' : 'Inactive' }}</td>
                                    <td>@{{ group.created_datetime }}</td>
                                    <td class="text-center table_icon">
                                        <a href="{{ url('admin/groups') }}/@{{ group.id }}/edit" class="btn btn-icon-only outline-green">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this group record?" data-delete-url="{{ url('admin/groups') }}/@{{ group.id }}" class="btn btn-icon-only js-delete-button outline-red" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div v-if="groupCount == 0" class="col-md-12">
                            <h4 class="block text-center">No record found</h4>
                        </div>
                        <div v-if="groupCount > 0">
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="group_pagination" class="pagination-sm pull-right">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/groups.js') }}"></script>
@endsection
