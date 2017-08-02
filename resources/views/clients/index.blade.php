@extends('layouts.admin.default')
@section('page-content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12 col-sm-12" id="clientlist" v-cloak>
            <div class="portlet light box white">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-filter" aria-hidden="true"></i> Search Client</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <div id="frmSearchData">
                        <div class="row">
                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                        <input type="text" name="name" class="form-control" placeholder="By Client Name" id="name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                        <input type="text" name="email" class="form-control" placeholder="By Email Id" id="email">
                                    </div>
                                </div>        
                            </div>
                             <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-skype blue-color"></i></span>
                                        <input type="text" name="skype" class="form-control" placeholder="By Skype Id" id="skype">
                                    </div>
                                </div>        
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-globe blue-color"></i></span>
                                        {!! Form::select('country', $countries, null, ['class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' => '-- By Country --', 'id' => 'country']) !!}
                                    </div>
                                </div>        
                            </div>

                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-industry blue-color"></i></span>
                                        <input type="text" name="industry" class="form-control" placeholder="By Industry" id="industry">
                                    </div>
                                </div>        
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <div class="form-col-2">
                                    <button type="button" class="btn blue custom-filter-submit" @click="searchClientData()">Submit</button>
                                    <button type="button" class="btn red custom-filter-cancel" @click="clearForm('frmSearchData')">Cancel</button>
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
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-user" aria-hidden="true"></i> Manage Client</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a href="{{ route('clients.create', ['domain' => app('request')->route()->parameter('company')]) }}" class="btn btn-icon-only btn-default tooltips" data-container="body" data-placement="top" data-original-title="Add New Client"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                        <table class="table table-striped table-bordered table-hover order-column" v-cloak id="clientTbl"> 
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Actions</th>            
                                    <th data-field="name" @click="sortBy('name')" :class="[sortKey != 'name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Client Name</th>
                                    <th data-field="email" @click="sortBy('email')" :class="[sortKey != 'email' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Email Id</th>
                                    <th data-field="contact_no" @click="sortBy('contact_no')" :class="[sortKey != 'contact_no' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Contact No</th>
                                    <th data-field="country" @click="sortBy('country')" :class="[sortKey != 'country' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Country</th>
                                    <th data-field="skype_address" @click="sortBy('skype_address')" :class="[sortKey != 'skype_address' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Skype Id</th>
                                    <th data-field="industry" @click="sortBy('industry')" :class="[sortKey != 'industry' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Industry</th>
                                </tr>
                            </thead>
                            <tbody>                            
                                <tr class="" v-for="(index, client) in clientData">
                                    <td class="text-center">@{{ index + 1 }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn yellow btn-outline btn-xs tooltips js-client-detail" data-toggle="modal" data-target=".client-detail-show" data-url="{{ url('admin/clients') }}/@{{ client.clientid }}">
                                            <i class="fa fa-eye"></i>
                                            </a>
                                        <a href="{{ url('admin/clients') }}/@{{client.clientid}}/edit" class="btn green btn-outline btn-xs tooltips">
                                                <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-confirm-msg="Are you sure you would like to delete this user record?" data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/clients'}}/@{{ client.clientid }}"  class="btn red btn-outline btn-xs js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                    </td>                                    
                                    <td>@{{ client.clientname }}</td>
                                    <td>@{{ client.email }}</td>
                                    <td>@{{ client.contact_no }}</td>
                                    <td>@{{ client.country }}</td>
                                    <td>@{{ client.skype_address }}</td>
                                    <td>@{{ client.industry }}</td>
                                </tr>                            
                            </tbody>
                        </table>
                    </div>
                    <div class="row">                    
                        <div v-if="clientCount == 0" class="col-md-12">
                            <h4 class="block text-center">No record found</h4>
                        </div>                    
                        <div>
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="client_pagination" class="pagination-sm pull-right">
                                </ul>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>  
        </div>    
    </div>

    <div class="modal fade in client-detail-show" id="view_client_details" role="dialog" style="display: none; padding-left: 17px;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body js-client-detail-content">
                    {{-- body will be render from client_detail_show.blade.php --}}
                </div>
            </div>
        </div>
    </div>     
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/clients.js') }}"></script>
@endsection