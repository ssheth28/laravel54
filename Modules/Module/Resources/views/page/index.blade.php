@extends('layouts.admin.default')

@section('page-content')
    <div class="row">
        <div class="col-md-12" id="modulelist">
            <div class="portlet light box white">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-filter" aria-hidden="true"></i>SEARCH PAGE</span>
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
                                        <select class="form-control select2 select2-allow-clear select2-hide-search-box" id="page_name" id="page_name" placeholder="By Page Name">
                                            <option value="">-- By Page Name --</option>
                                            @foreach( $byPageName as $id=>$name)
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
                                        <select class="form-control select2 select2-allow-clear select2-hide-search-box" tabindex="-98" id="module_name" name="module_name">
                                            <option value="">-- By Module Name --</option>
                                            @if (count($byModuleName) > 0)
                                                @foreach ($byModuleName as $mod)
                                                    @if(isset($mod['children']) && count($mod['children']))
                                                        <option value="{{ $mod['id'] }}" {{ $mod['parent_id'] == null ? ' disabled=disabled' : '' }}>{{ $mod['name'] }}</option>
                                                        @include('elements.admin.module_select', ['mod' => $mod['children'], 'prefix' => '&nbsp;&nbsp;&nbsp;'], ['from' => ''])
                                                    @else
                                                        <option value="{{ $mod['id'] }}" {{ $mod['parent_id'] == null ? ' disabled=disabled' : '' }}>{{ $mod['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div> 
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-genderless blue-color"></i></span>
                                        <select class="form-control select2 select2-allow-clear select2-hide-search-box" id="page_publicly_visible" placeholder="By Is Publicly Visible">
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
                                        <select class="form-control select2 select2-allow-clear select2-hide-search-box" id="page_status">
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
{{--                 <div class="portlet-title">
                    <div class="caption col-md-9">
                        <i class="fa fa-table"></i>
                        <span class="caption-subject bold uppercase font-dark">MANAGE PAGE</span>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group pull-right">
                            <a class="btn sbold border-btn" href="{{ route('pages.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div> --}}

                    <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-user" aria-hidden="true"></i> Manage Page </span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a href="{{ route('pages.create', ['domain' => app('request')->route()->parameter('company')]) }}" class="btn btn-icon-only btn-default tooltips" data-container="body" data-placement="top" data-original-title="Add New Page"><i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                        <a class="btn btn-icon-only btn-default dropdown-toggle tooltips" data-container="body" data-placement="top" data-original-title="Tools" data-toggle="dropdown"><i class="fa fa-gear" aria-hidden="true"></i>
                        </a>
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
                                    <th class="text-center">Actions</th>
                                    <th data-field="name" @click="sortBy('name')" :class="[sortKey != 'name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Page Name</th>
                                    <th data-field="parentMenuName" @click="sortBy('parentMenuName')" :class="[sortKey != 'parentMenuName' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Sub Module Name</th>
                                    <th data-field="mainParentMenuName" @click="sortBy('mainParentMenuName')" :class="[sortKey != 'mainParentMenuName' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Parent Module Name</th>
                                    <th data-field="is_publicly_visible" @click="sortBy('is_publicly_visible')" :class="[sortKey != 'is_publicly_visible' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Publicly Visible</th>
                                    <th data-field="is_active" @click="sortBy('is_active')" :class="[sortKey != 'is_active' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="module in moduleData">  
                                    <td class="text-center table_icon">
                                        <a href="#" class="btn btn-icon-only outline-green js-module-detail" data-toggle="modal" data-target=".module-detail-show" data-url="{{ url('admin/pages') }}/@{{ module.id }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/pages') }}/@{{ module.id }}/edit" class="btn btn-icon-only outline-green">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this module record?" data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/pages/' }}@{{ module.id }}" class="btn btn-icon-only js-delete-button outline-red" data-toggle="modal" data-target="#delete_modal">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                    <td>@{{ module.name }}</td>
                                    <td>@{{ module.parentMenuName ? module.parentMenuName : '-' }}</td>
                                    <td>@{{ module.mainParentMenuName ? module.mainParentMenuName : '-'  }}</td>                                 
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
    <script type="text/javascript" src="{{ Module::asset('module:js/pages.js') }}"></script>
@endsection
