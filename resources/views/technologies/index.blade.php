@extends('layouts.admin.default')
@section('page-content')

<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
		<div class="col-md-12 col-sm-12">
			@include('flash::message')
		    <div class="portlet light no-padding-bottom">
		        <div class="portlet-title">
		            <div class="caption">
		                <span class="caption-subject bold uppercase font-dark"><i class="fa fa-plus-square" aria-hidden="true"></i> Add TECHNOLOGY</span>
		            </div>
		            <div class="tools">
		                &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
		            </div>
		            <div class="actions">
		                <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
		            </div>
		        </div>
		        <div class="portlet-body">
		            {!! Form::open(['route' => ['technologies.store', 'domain' => app('request')->route()->parameter('company')], 'class' => 'js-frm-create-technology', 'role' => 'form']) !!}
		                <div class="form-body">
		                    <div class="row">
		                        <div class="col-lg-3 col-md-4">
		                            <div class="form-group">
		                                <div class="input-group select2-bootstrap-prepend">
		                                    <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
		                                    {!! Form::text('technology_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Technology Name']) !!}
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-lg-2 col-md-3">
		                            <div class="form-actions margin-bottom-15">
		                                <button class="btn blue" type="submit" name="btnSave" data-type="submit">Submit</button>
		                                <button class="btn default" data-dismiss="modal" type="reset" name="btnReset">Cancel</button>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <div class="clearfix"></div>
		            {{ Form::close() }}
		        </div>
		    </div>
		</div>
		<div class="col-md-12 col-sm-12">
       		<div class="portlet light">                    
                <div class="portlet-title">
                    <div class="caption col-md-12">
                        <i class="fa fa-user"></i>
                        <span class="caption-subject font-dark bold uppercase">MANAGE TECHNOLOGY</span> &nbsp;&nbsp;
                    </div>
                </div>
                <div class="portlet-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover order-column" id="technologiesList" v-cloak>
                            <div class="actions pull-right table-icons">
                                <a class="btn btn-icon-only btn-default" href="#">
                                    <i class="fa fa-gear"></i>
                                </a>
                                <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title="">
                                    <i class= "fa fa-expand"></i>
                                </a> 
                            </div>
                            <thead>
                                <tr>
                                	<th data-field="id" @click="sortBy('id')" :class="[sortKey != 'id' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']" class="text-center">No</th>
                                    <th class="text-center">Actions</th>                      
                                    <th data-field="name" @click="sortBy('name')" :class="[sortKey != 'name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Technology Name</th>
                                    <th data-field="created_at" @click="sortBy('created_at')" :class="[sortKey != 'created_at' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="" v-for="(index, technology) in technologyData">
                                	<td class="text-center">@{{ index + 1}}</td>
                                    <td class="text-center table_icon">
                                        <a href="#" data-technology="@{{ technology.name }}" data-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/technologies'}}/@{{ technology.id }}" class="btn green btn-outline btn-xs tooltips js-edit-techology" data-toggle="modal" data-target="#edit-technology-popup">
                                                <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this user record?" data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/technologies'}}/@{{ technology.id }}"  class="btn red btn-outline btn-xs js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                    </td>                                    
                                    <td>@{{ technology.name }}</td>
                                    <td>@{{ technology.created_datetime }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12" v-if="technologyCount == 0">
                            <h4 class="block text-center">No record found</h4>
                        </div>
                        <div v-if="technologyCount > 0">
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="technology_pagination" class="pagination-sm pull-right">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
		</div>
    </div>

<div class="modal fade" id="edit-technology-popup" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet light" style="margin: 0; padding: 0;">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-file-text" aria-hidden="true"></i> Edit Technology</span>
                        </div>
                        <div class="tools">
                            &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                            <a href="javascript:;" data-dismiss="modal">×</a>
                        </div>
                    </div>
                    <div class="portlet-body">                      
                        {!! Form::open(['method' => 'PUT', 'class' => 'js-edit-modal-form js-frm-edit-technology']) !!}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group select2-bootstrap-prepend">
                                                <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                                                {!! Form::text('technology_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Technology Name', 'id' => 'technology_name']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-9">
                                        <button type="submit" class="btn blue">Update</button>
                                        <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection

@section('page-script')
<script src="{{ asset('js/admin/technologies.js') }}" type="text/javascript"></script>
@endsection