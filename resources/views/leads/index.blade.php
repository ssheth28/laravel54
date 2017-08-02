@extends('layouts.admin.default')
@section('page-content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12" id="leadList">
            {{-- @if( in_array('filter', app('session')->get('widgetAccess')) ) --}}
                <div class="portlet light box white">
                    <div class="portlet-title">
                        <div class="caption">                            
                            <span class="caption-subject font-dark bold uppercase"><i class="fa fa-filter"></i>
                            SEARCH LEAD</span>
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
                                            <input type="text" name="lead_name" class="form-control" placeholder="By Lead Name" id="lead_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                            <input type="text" name="lead_email" class="form-control" placeholder="By Email Id" id="lead_email">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4">
                                    <div class="form-group">
                                        <div class="input-group select2-bootstrap-prepend">
                                            <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                                            {!! Form::select('country', $countries, null, ['class' =>'selectpicker', 'placeholder' => '-- By Country --', 'id' => 'country']) !!}
                                        </div>
                                    </div>
                                </div>                                                              
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-col-2">
                                        <button type="button" class="btn blue custom-filter-submit" @click="searchLeadData()">Search</button>
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
                            <span class="caption-subject font-dark bold uppercase">MANAGE LEAD</span> &nbsp;&nbsp;
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group pull-right">
                                <a class="btn sbold border-btn" href="{{ route('leads.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div>
                            <table class="table table-striped table-bordered table-hover order-column">
                                <div class="actions pull-right table-icons">
                                    <a class="btn btn-icon-only btn-default" href="{{ route('leads.create', ['domain' => app('request')->route()->parameter('company')]) }}">
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
                                        <th data-field="lead_name" @click="sortBy('lead_name')" :class="[sortKey != 'lead_name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Lead Name</th>
                                        <th data-field="email" @click="sortBy('email')" :class="[sortKey != 'email' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Email Id</th>
                                        <th data-field="skype_id" @click="sortBy('skype_id')" :class="[sortKey != 'skype_id' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Skype Id</th>
                                        <th data-field="industry" @click="sortBy('industry')" :class="[sortKey != 'industry' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Interested In</th>
                                        <th data-field="poc" @click="sortBy('poc')" :class="[sortKey != 'poc' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">POC</th>
                                        <th data-field="last_update_status" @click="sortBy('last_update_status')" :class="[sortKey != 'last_update_status' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="" v-for="lead in leadData"> 
                                        <td class="text-center table_icon">
                                            <a href="#" class="btn btn-icon-only outline-green js-lead-detail" data-toggle="modal" data-target=".lead-detail-show" data-url="{{ url('admin/leads') }}/@{{ lead.id }}">
                                            <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('admin/leads') }}/@{{lead.id}}/edit" class="btn green btn-outline btn-xs tooltips">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" data-confirm-msg="Are you sure you would like to delete this user record?" data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/leads/'}}@{{ lead.id }}"  class="btn red btn-outline btn-xs js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                        </td>
                                        <td>@{{ lead.lead_name }}</td>
                                        <td>@{{ lead.email }}</td>
                                        <td>@{{ lead.skype_id }}</td>
                                        <td>@{{ lead.industry }}</td>
                                        <td>@{{ lead.userFullName }}</td>
                                        <td>@{{ lead.last_update_status }}</td>                                      
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div v-if="leadCount == 0" class="col-md-12">
                                <h4 class="block text-center">No record found</h4>
                            </div>
                            <div v-if="leadCount > 0">
                                <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                    <pagination_component>
                                    </pagination_component>
                                </div>
                                <div class="col-md-7 col-sm-12 dataTables_paginate">
                                    <ul id="lead_pagination" class="pagination-sm pull-right">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- @endif --}}
        </div>
    </div>


    <div class="modal fade in lead-detail-show show-modal" id="view_lead_details" role="dialog" style="display: none; padding-left: 17px;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body js-lead-detail-content">
                    {{-- body will be render from lead_detail_show.blade.php --}}
                </div>
            </div>
        </div>
    </div>   
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/leads.js') }}"></script>
@endsection
