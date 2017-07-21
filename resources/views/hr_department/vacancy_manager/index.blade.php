@extends('layouts.admin.default')
@section('page-content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-md-12" id="vacancyList">
        {{-- @if( in_array('filter', app('session')->get('widgetAccess')) ) --}}
            <div class="portlet light box white">
                <div class="portlet-title">
                    <div class="caption">                            
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-filter"></i>
                        SEARCH VACANCY</span>
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
                                        <input type="text" name="position_name" class="form-control" placeholder="By Position Name" id="position_name">
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-3 col-lg-3">
                                <div class="form-col-2">
                                    <button type="button" class="btn blue custom-filter-submit" @click="searchVacancyData()">Search</button>
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
                        <span class="caption-subject font-dark bold uppercase">MANAGE VACANCY</span> &nbsp;&nbsp;
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group pull-right">
                            <a class="btn sbold border-btn" href="{{ route('vacancies.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover order-column">
                            <div class="actions pull-right table-icons">
                                <a class="btn btn-icon-only btn-default" href="{{ route('vacancies.create', ['domain' => app('request')->route()->parameter('company')]) }}">
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
                                    <th data-field="position_name" @click="sortBy('position_name')" :class="[sortKey != 'position_name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Position Name</th>
                                    <th data-field="department_id" @click="sortBy('department_id')" :class="[sortKey != 'department_id' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Department Name</th>
                                    <th data-field="no_of_vacancies" @click="sortBy('no_of_vacancies')" :class="[sortKey != 'no_of_vacancies' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">No. Of Vacancy</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="vacancy in vacancyData"> 
                                    <td class="text-center table_icon">
                                        <a href="{{ url('admin/vacancies') }}/@{{vacancy.id}}/edit" class="btn green btn-outline btn-xs tooltips">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this record?" data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/vacancies/'}}@{{ vacancy.id }}"  class="btn red btn-outline btn-xs js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                    </td>
                                    <td>@{{ vacancy.position_name }}</td>
                                    <td>@{{ vacancy.departmentName }}</td>
                                    <td>@{{ vacancy.no_of_vacancies }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div v-if="vacancyCount == 0" class="col-md-12">
                            <h4 class="block text-center">No record found</h4>
                        </div>
                        <div v-if="vacancyCount > 0">
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="vacancy_pagination" class="pagination-sm pull-right">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- @endif --}}
    </div>
</div>

@endsection
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/vacancies.js') }}"></script>
@endsection
