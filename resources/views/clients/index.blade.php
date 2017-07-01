@extends('layouts.admin.default')
@section('page-content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12 col-sm-12" id="clientlist" v-cloak>
            <div class="portlet light box white">
                <div class="portlet-title">
                    <div class="caption">                            
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-filter"></i>
                        SEARCH CLIENT</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="reload" data-original-title="" title="" aria-describedby="tooltip73982" @click="reloadData();"> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll" style="display: none">
                    <div class="" id="frmSearchData">
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                        <input type="text" name="name" class="form-control" placeholder="By Client Name" id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-envelope blue-color"></i></span>
                                        <input type="text" name="email" class="form-control" placeholder="By Email Id" id="email">
                                    </div>
                                </div>        
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-skype blue-color"></i></span>
                                        <input type="text" name="skype" class="form-control" placeholder="By Skype Id" id="skype">
                                    </div>
                                </div>        
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-globe blue-color"></i></span>
                                        {!! Form::select('country', $countries, null, ['class' =>'selectpicker', 'placeholder' => '-- By Country --', 'id' => 'country']) !!}
                                    </div>
                                </div>        
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon no-bg"><i class="fa fa-industry blue-color"></i></span>
                                        <input type="text" name="industry" class="form-control" placeholder="By Industry" id="industry">
                                    </div>
                                </div>        
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-col-2">
                                    <button type="button" class="btn blue custom-filter-submit" @click="searchClientData()">Search</button>
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
                    <div class="caption col-md-12">
                        <i class="fa fa-user"></i>
                        <span class="caption-subject font-dark bold uppercase">MANAGE CLIENT</span> &nbsp;&nbsp;
                    </div>
                </div>
                <div class="portlet-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover order-column" v-cloak id="clientTbl"> 
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