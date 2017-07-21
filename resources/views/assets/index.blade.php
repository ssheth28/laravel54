@extends('layouts.admin.default')
@section('page-style')

@endsection

@section('page-content')
	<div class="row profile cus-pro">
		<div class="col-md-12 col-md-12 col-sm-12" id="assetList">
		 	<div class="portlet light">
		 		<div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-filter" aria-hidden="true"></i>Search Assets</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                	<div class="" id="frmSearchData">
                        <div class="row">
                        	<div class="col-lg-2 col-md-3">
                        		<div class="form-group">
                        			 <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-desktop blue-color"></i></span>
                                 		    <input type="text" name="desk_name" class="form-control" placeholder="By Desk Name" id="desk_name">
                                        <!-- {!! Form::text('desk_name', null, ['class' => 'form-control',  'placeholder' => 'By Desk Name']) !!} -->
                                    </div>
                                </div>  
                            </div>      
                            <div class="col-lg-2 col-md-3">
                        		<div class="form-group">
                        			 <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-server blue-color"></i></span>
                                 		<!-- {!! Form::text('ip_address', null, ['class' => 'form-control',  'placeholder' => 'By IP Address']) !!} -->
                                         <input type="text" name="ip_address" class="form-control" placeholder="By IP Address" id="ip_address">
                                    </div>
                                </div>  
                            </div> 
                            <div class="col-lg-2 col-md-3">
                        		<div class="form-group">
                        			 <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-industry blue-color"></i></span>
                                 		<!-- {!! Form::text('manufacture_name', null, ['class' => 'form-control',  'placeholder' => 'By Manufacture Name']) !!} -->
                                         <input type="text" name="manufacture_name" class="form-control" placeholder="By Manufacture Name" id="manufacture_name">
                                    </div>
                                </div>  
                            </div> 
                            <div class="col-lg-2 col-md-3">
                        		<div class="form-group">
                        			 <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-money blue-color"></i></span>
                                 		<input type="text" name="asset_price" class="form-control" placeholder="By Asset Price" id="asset_price">
                                        <!-- {!! Form::text('asset_price', null, ['class' => 'form-control',  'placeholder' => 'By Asset Price']) !!} -->
                                    </div>
                                </div>  
                            </div> 
                            <!-- <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                        <select data-placeholder="-- By User Name --" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                            <option value=""></option>
                                            <option value="1">Ali SK</option>
                                            <option value="2">Anoop Pesala</option>
                                            <option value="3">Bala Trinadh</option>
                                        </select><span class="select2 select2-container select2-container--bootstrap" dir="ltr"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-i1i3-container"><span class="select2-selection__rendered" id="select2-i1i3-container"><span class="select2-selection__placeholder">-- By User Name --</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-2 col-md-3">
                        		<div class="form-group">
                        			 <div class="input-group select2-bootstrap-prepend">
                                        <span class="input-group-addon no-bg"><i class="fa fa-user blue-color"></i></span>
                                 		{!! Form::text('user_id', null, ['class' => 'form-control',  'placeholder' => 'By User ID']) !!}
                                    </div>
                                </div>  
                            </div>  -->
                            <div class="col-lg-2 col-md-3">
                                <div class="form-col-2">
                                    <button type="button" class="btn blue custom-filter-submit" @click="searchAssetData()">Submit</button>
                                    <button type="button" class="btn red custom-filter-cancel" @click="clearForm('frmSearchData')">Cancel</button>
                                </div>
                            </div> 	
                        </div>
                    </div>        
                </div>
            </div>    
            <div class="col-md-12 col-md-12 col-sm-12">
            	<div class="portlet light">
            		<div class="portlet-title">
            			<div class="caption col-md-8">                            
                            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-user" aria-hidden="true"></i> Manage Assets</span>
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group pull-right">
                                <a class="btn sbold border-btn" href="{{ route('assets.create', ['domain' => app('request')->route()->parameter('company')]) }}"> Add New
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>                        
            		</div>
            		<div class="portlet-body">
                        <div>
                            <table class="table table-striped table-bordered table-hover order-column" id="assetList">
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
                                     <th class="text-center">No</th>
                                        <th class="text-center">Actions</th>                      
                                        <th data-field="desk_name" @click="sortBy('desk_name')" :class="[sortKey != 'desk_name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Desk Name</th>
                                        <th data-field="desk_name" @click="sortBy('desk_name')" :class="[sortKey != 'desk_name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">IP Address</th>
                                        <th data-field="manufacture_name" @click="sortBy('manufacture_name')" :class="[sortKey != 'manufacture_name' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Manufacture Name</th>
                                        <th data-field="asset_price" @click="sortBy('asset_price')" :class="[sortKey != 'asset_price' ? 'sorting' : sortOrder == 1 ? 'sorting_asc' : 'sorting_desc']">Asset Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="" v-for="asset in assetData">                               
                                     <td class="text-center">@{{asset.id}}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn yellow btn-outline btn-xs tooltips js-asset-detail" data-toggle="modal" data-target=".asset-detail-show" data-url="{{ url('admin/assets') }}/@{{ asset.id }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{url('admin/assets')}}/@{{asset.id}}/edit" data-department="" data-url="" class="btn green btn-outline btn-xs tooltips js-edit-department">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" data-confirm-msg="Are you sure you would like to delete this assets record?" data-delete-url="{{ '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole') . '/admin/assets'}}/@{{ asset.id }}"  class="btn red btn-outline btn-xs js-delete-button" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i></a>
                                        </td>                                    
                                        <td>@{{asset.desk_name}}</td>
                                        <td>@{{asset.ip_address}}</td>
                                        <td>@{{asset.manufacture_name}}</td>
                                        <td>@{{asset.asset_price}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      	 <div class="row">
                            <div v-if="assetCount == 0" class="col-md-12">
                                <h4 class="block text-center">No record found</h4>
                            </div>
                            <div class="col-md-5 col-sm-12 dataTables_info table-pagination-info">
                                <pagination_component>
                                </pagination_component>
                            </div>
                            <div class="col-md-7 col-sm-12 dataTables_paginate">
                                <ul id="asset_pagination" class="pagination-sm pull-right">
                                </ul>
                            </div>
                        </div>
                    </div>
            	</div>
            </div>
        </div>   
    </div>      
    <div class="modal fade in asset-detail-show" id="view_asset_details" role="dialog" style="display: none; padding-left: 17px;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body js-asset-detail-content">
                    {{-- body will be render from asset_detail_show.blade.php --}}
                </div>
            </div>
        </div>
    </div>              
@endsection
@section('page-script')
    <script src="{{ asset('js/admin/asset.js') }}" type="text/javascript"></script>
@endsection