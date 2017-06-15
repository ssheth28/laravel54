@extends('layouts.admin.default')

@section('page-content')
    <div class="row">
        <div class="col-md-12" id="widgetlist">
            <div class="portlet light box white">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-filter" aria-hidden="true"></i> Search Widget</span>
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
                                        <span class="input-group-addon no-bg"><i class="fa fa-file-code-o blue-color"></i></span>
                                        <input type="text" class="form-control" placeholder="By Widget Name" id="widget_name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                                        <select class="form-control selectpicker" id="widget_status">
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
                                    <button type="button" class="btn blue custom-filter-submit" @click="searchWidgetData()">Search</button>
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
                        <span class="caption-subject bold uppercase font-dark">Mangage Widget</span>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group pull-right">
                            <a class="btn sbold border-btn" href="{{ route('widgets.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover order-column" v-cloak id="widgetTbl">
                            <div class="actions pull-right table-icons">
                                <a class="btn btn-icon-only btn-default" href="{{ route('widgets.create', ['domain' => app('request')->route()->parameter('company')]) }}">
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
                                    <th data-field="name" @click="sortBy('name')" :class="[sortKey != 'name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Widget Name</th>
                                    <th data-field="description" @click="sortBy('description')" :class="[sortKey != 'description' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Description</th>
                                    <th data-field="widget_type_id" @click="sortBy('widget_type_id')" :class="[sortKey != 'widget_type_id' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Type</th>                                    
                                    <th data-field="is_publicly_visible" @click="sortBy('is_publicly_visible')" :class="[sortKey != 'is_publicly_visible' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Visible</th>
                                    <th data-field="status" @click="sortBy('status')" :class="[sortKey != 'status' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Status</th>                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="widget in widgetData">
                                    <td class="text-center table_icon">
                                        <a href="#" class="btn btn-icon-only outline-green js-widget-detail" data-toggle="modal" data-target=".widget-detail-show" data-url="{{ url('admin/widgets') }}/@{{ widget.id }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/widgets') }}/@{{ widget.id }}/edit" class="btn btn-icon-only outline-green">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this widget record?" 
                                        data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/widgets/' }}@{{ widget.id }}" 
                                        class="btn btn-icon-only js-delete-button outline-red" 
                                        data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                    <td>@{{ widget.name }}</td>
                                    <td>@{{ widget.description }}</td>
                                    <td>@{{ widget.widgetName }}</td>
                                    <td>@{{ widget.is_publicly_visible == 1 ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <span class="wz-status active tooltips" data-container="body" data-placement="top"  v-if="widget.status == 1"></span>
                                        <span class="wz-status inactive tooltips" data-container="body" data-placement="top"  v-if="widget.status == 0"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div v-if="widgetCount == 0" class="col-md-12">
                            <h4 class="block text-center">No record found</h4>
                        </div>
                        <div v-if="widgetCount > 0">
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="widget_pagination" class="pagination-sm pull-right">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in widget-detail-show" id="view_widget_details" role="dialog" style="display: none; padding-left: 17px;">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body js-widget-detail-content">
                        {{-- body will be render from module_detail_show.blade.php --}}
                    </div>
                </div>

            </div>
        </div>        
    </div>
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ Module::asset('widget:js/widgets.js') }}"></script>
@endsection
