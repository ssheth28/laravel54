@extends('layouts.admin.default')

@section('page-content')
    <div class="row">
        <div class="col-md-12" id="modulelist">
            <div class="portlet light box white">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-filter" aria-hidden="true"></i>SEARCH MODULE</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="reload" data-original-title="" title="" aria-describedby="tooltip73982" @click="reloadData();"> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll" style="display: none">
                    <div id="frmSearchData">
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-file-code-o blue-color"></i></span>
                                        <input type="text" class="form-control" placeholder="By Module Name" id="module_name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                        <select class="form-control selectpicker" id="module_status">
                                        <option value="">By Status</option>
                                        @foreach( config('config-variables.search_section.status') as $key=>$status)
                                            <option value="{{ $key }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    </div> 
                                </div>                  
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="form-col-2">
                                    <button type="button" class="btn blue custom-filter-submit" @click="searchModuleData()">Search</button>
                                    <button type="button" class="btn red custom-filter-cancel" @click="clearForm('frmSearchData')">Clear</button>
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
                        <span class="caption-subject bold uppercase font-dark">MANAGE MODULE</span>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group pull-right">
                            <a class="btn sbold border-btn" href="{{ route('modules.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
               <div class="portlet-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover order-column" v-cloak id="moduleTbl">
                            <div class="actions pull-right table-icons">
                                <a class="btn btn-icon-only btn-default" href="{{ route('modules.create', ['domain' => app('request')->route()->parameter('company')]) }}">
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
                                    <th data-field="name" @click="sortBy('name')" :class="[sortKey != 'name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Module Name</th>
                                    <th data-field="parent_id" @click="sortBy('parent_id')" :class="[sortKey != 'parent_id' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Parent Module</th>
                                    <th data-field="created_datetime" @click="sortBy('created_datetime')" :class="[sortKey != 'created_datetime' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Created Date-time</th>
                                    <th data-field="is_publicly_visible" @click="sortBy('is_publicly_visible')" :class="[sortKey != 'is_publicly_visible' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Publicly Visible</th>
                                    <th data-field="is_active" @click="sortBy('is_active')" :class="[sortKey != 'is_active' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="module in moduleData">  
                                    <td class="text-center table_icon">
                                        <a href="#" class="btn btn-icon-only outline-green js-module-detail" data-toggle="modal" data-target=".module-detail-show" data-url="{{ url('admin/modules') }}/@{{ module.id }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/modules') }}/@{{ module.id }}/edit" class="btn btn-icon-only outline-green">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this module record?" data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/modules/' }}@{{ module.id }}" class="btn btn-icon-only js-delete-button outline-red" data-toggle="modal" data-target="#delete_modal">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                    <td>@{{ module.name }}</td>
                                    <td>@{{ module.parentMenuName }}</td>
                                    <td>@{{ module.created_datetime }}</td>                                 
                                    <td>@{{ module.is_publicly_visible == 1 ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <span class="wz-status active tooltips" data-container="body" data-placement="top"  v-if="module.is_active == 1"></span>
                                        <span class="wz-status inactive tooltips" data-container="body" data-placement="top"  v-if="module.is_active == 0"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div v-if="moduleCount == 0" class="col-md-12">
                            <h4 class="block text-center">No record found</h4>
                        </div>
                        <div v-if="moduleCount > 0">
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="module_pagination" class="pagination-sm pull-right">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in module-detail-show" id="view_module_details" role="dialog" style="display: none; padding-left: 17px;">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body js-module-detail-content">
                        {{-- body will be render from module_detail_show.blade.php --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ Module::asset('module:js/modules.js') }}"></script>
@endsection
