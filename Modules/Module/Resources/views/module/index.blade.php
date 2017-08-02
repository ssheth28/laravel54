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
                <div class="portlet-body flip-scroll">
                    <div id="frmSearchData">
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-object-ungroup blue-color"></i></span>
                                        <select class="form-control select2 select2-allow-clear select2-hide-search-box" id="module_name" id="module_name" placeholder="By Module Name">
                                            <option value="">By Module Name</option>
                                            @foreach( $byModuleName as $id=>$name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-object-group blue-color"></i></span>
                                        <select class="form-control select2 select2-allow-clear select2-hide-search-box" id="parent_module" id="parent_module" placeholder="By Parent Module">
                                            <option value="">By Parent Module</option>
                                            @foreach( $byParentModule as $id=>$name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-genderless blue-color"></i></span>
                                        <select class="form-control select2 select2-allow-clear select2-hide-search-box" id="module_publicly_visible" placeholder="By Is Publicly Visible">
                                        <option value="">By Is Publicly Visible</option>
                                        @foreach( config('config-variables.is_publicly_visible') as $key=>$status)
                                            <option value="{{ $key }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    </div> 
                                </div>                  
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-genderless blue-color"></i></span>
                                        <select class="form-control select2 select2-allow-clear select2-hide-search-box" id="module_status">
                                        <option value="">By Status</option>
                                        @foreach( config('config-variables.select_status') as $key=>$status)
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
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-user" aria-hidden="true"></i> Manage Module </span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a href="{{ route('modules.create', ['domain' => app('request')->route()->parameter('company')]) }}" class="btn btn-icon-only btn-default tooltips" data-container="body" data-placement="top" data-original-title="Add New Module"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                        <table class="table table-striped table-bordered table-hover order-column" v-cloak id="moduleTbl">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Action</th>
                                    <th data-field="name" @click="sortBy('name')" :class="[sortKey != 'name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Module Name</th>
                                    <th data-field="parent_id" @click="sortBy('parent_id')" :class="[sortKey != 'parent_id' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Parent Module</th>
                                    <th data-field="created_datetime" @click="sortBy('created_datetime')" :class="[sortKey != 'created_datetime' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Created Date-time</th>
                                    <th data-field="is_publicly_visible" @click="sortBy('is_publicly_visible')" :class="[sortKey != 'is_publicly_visible' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Publicly Visible</th>
                                    <th data-field="is_active" @click="sortBy('is_active')" :class="[sortKey != 'is_active' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="(index, module) in moduleData">
                                    <td class="text-center">@{{ index + 1 }}</td>
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
                                    <td>@{{ module.parentMenuName ? module.parentMenuName : '-' }}</td>
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
        <div class="modal fade in module-detail-show show-modal" id="view_module_details" role="dialog" style="display: none; padding-left: 17px;">
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
