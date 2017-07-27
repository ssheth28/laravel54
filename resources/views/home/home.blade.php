@extends('layouts.admin.default')

@section('page-core-style')
	<link href="{{ asset('plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-content')
<div class="dashboard">
	<!-- BEGIN DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-cubes" aria-hidden="true"></i> Revenue</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a class="btn btn-icon-only btn-default" href="#">
                            <i class="fa fa-info"></i>
                        </a>
                        <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 150px 0px;">100%</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-sm-9">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bubbles font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-comments" aria-hidden="true"></i> Comments</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 100px 0px;">80%</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bubbles font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-comments" aria-hidden="true"></i> Comments</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 100px 0px;">20%</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-sm-9">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-cubes" aria-hidden="true"></i> Revenue</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a class="btn btn-icon-only btn-default" href="#">
                            <i class="fa fa-info"></i>
                        </a>
                        <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 150px 0px;">75%</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-database" aria-hidden="true"></i> Finance</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 150px 0px;">25%</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-cubes" aria-hidden="true"></i> Revenue</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a class="btn btn-icon-only btn-default" href="#">
                            <i class="fa fa-info"></i>
                        </a>
                        <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 150px 0px;">66.66%</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-database" aria-hidden="true"></i> Finance</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 150px 0px;">33.33%</h1>
                </div>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-7 col-sm-7">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-cubes" aria-hidden="true"></i> Revenue</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 150px 0px;">58.33%</h1>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-sm-5">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-database" aria-hidden="true"></i> Finance</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 150px 0px;">41.66%</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark"><i class="fa fa-cubes" aria-hidden="true"></i> Revenue</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">
                        <a class="btn btn-icon-only btn-default" href="#">
                            <i class="fa fa-info"></i>
                        </a>
                        <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 150px 0px;">50%</h1>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-database" aria-hidden="true"></i> Finance</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 150px 0px;">50%</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bubbles font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-comments" aria-hidden="true"></i> Comments</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 100px 0px;">33.33%</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class=" icon-social-twitter font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-cog" aria-hidden="true"></i> Quick Actions</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 100px 0px;">33.33%</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class=" icon-social-twitter font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-cog" aria-hidden="true"></i> Quick Actions</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 100px 0px;">33.33%</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bubbles font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-comments" aria-hidden="true"></i> Comments</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 100px 0px;">25%</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bubbles font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-comments" aria-hidden="true"></i> Comments</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 100px 0px;">25%</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bubbles font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-comments" aria-hidden="true"></i> Comments</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 100px 0px;">25%</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bubbles font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><i class="fa fa-comments" aria-hidden="true"></i> Comments</span>
                    </div>
                    <div class="tools">
                        &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h1 style="margin: 0px; text-align: center; font-weight: 600; font-size: 24px; padding: 100px 0px;">25%</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-core-scripts')
	<script src="{{ asset('plugins/moment.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/morris/morris.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/horizontal-timeline/horizontal-timeline.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/admin/dashboard.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/common.js') }}" type="text/javascript"></script>
@endsection