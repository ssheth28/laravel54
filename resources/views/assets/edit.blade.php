@extends('layouts.admin.default')
@section('page-style')

@endsection

@section('page-content')
	<div class="row profile cus-pro">
		 <div class="col-md-12">
		 	<div class="portlet light">
		 		<div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Edit Assets  </span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
                    </div>
                </div>
            	<div class="portlet-body">
            		{!! Form::open(['route' => ['assets.update', 'domain' => app('request')->route()->parameter('company'), 'assetId' => $asset->id], 'method' => 'PUT', 'class' => 'js-frm-edit-asset  assetfrm', 'role' => 'form', 'id' => 'submit_asset_form', 'enctype' => 'multipart/form-data']) !!}  
            				@include('partials.admin.assets.form',['from'=>'edit'])
            				<input type="hidden" value="{{ $asset->id }}" name="asset_id"></input>
	               {{ Form::close() }}
	            </div>
	      	</div>
	    </div>
	</div>	      	                  
@endsection
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/admin/asset.js') }}"></script>
@endsection