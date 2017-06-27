@extends('layouts.admin.default')
@section('page-style')
	<link href="{{ asset('css/admin/company.css') }}" rel="stylesheet" type="text/css" />   
@endsection

@section('page-content')
	<div class="row profile cus-pro">
        <div class="">
            <div class="col-md-3">
        	   @include('elements.admin.user_profile_navigation')
            </div>

        	<div class="col-md-9">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">User Information</span>
                        </div>
                        <div class="tools">
                            &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
                        </div>
                        <div class="actions">
                            <a class="btn btn-icon-only btn-default" href="#">
                                <i class="fa fa-info"></i>
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-8 profile-info">
                                <h1 class="font-green sbold uppercase">{{ Auth::user()->person->first_name }} {{ Auth::user()->person->last_name}}</h1>
                                <p> {{ Auth::user()->person->bio}}</p>
                                <p>
                                    <a href="javascript:;"> {{ Auth::user()->email }} </a>
                                </p>
                                <ul class="list-inline">
                                    <li><i class="fa fa-hashtag blue-color"></i> 025</li>
                                    <li><i class="fa fa-briefcase blue-color"></i> HTML Developer </li>
                                    <li><i class="fa fa-industry blue-color"></i> ViitorCloud Technology </li>
                                    <li><i class="fa fa-calendar blue-color"></i> {{ Auth::user()->person->dob }}</li>
                                    <li><i class="fa fa-building-o blue-color"></i> Development </li>
                                </ul>
                            </div>
                            <!--end col-md-8-->
                            <div class="col-md-4">
                                <div class="portlet sale-summary">
                                    <div class="portlet-title">
                                        <div class="caption font-red sbold"> Project Summary </div>
                                    </div>
                                    <div class="portlet-body">
                                        <ul class="list-unstyled">
                                            <li>
                                                <span class="sale-info"> TODAY SOLD
                                                    <i class="fa fa-img-up"></i>
                                                </span>
                                                <span class="sale-num"> 23 </span>
                                            </li>
                                            <li>
                                                <span class="sale-info"> WEEKLY SALES
                                                    <i class="fa fa-img-down"></i>
                                                </span>
                                                <span class="sale-num"> 87 </span>
                                            </li>
                                            <li>
                                                <span class="sale-info"> TOTAL SOLD </span>
                                                <span class="sale-num"> 2377 </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end col-md-4-->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabbable-line tabbable-custom-profile">
                                    <ul class="nav nav-tabs">
                                        <li class="active ms-hover">
                                            <a href="#tab_1_11" data-toggle="tab"> Latest Customers </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_22" data-toggle="tab"> Feeds </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_11">
                                            <div class="portlet-body">
                                                <table class="table table-striped table-bordered table-advance table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <i class="fa fa-briefcase"></i> Company </th>
                                                            <th class="hidden-xs">
                                                                <i class="fa fa-info"></i> Descrition </th>
                                                            <th>
                                                                <i class="fa fa-bookmark"></i> Amount </th>
                                                            <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <a href="javascript:;"> Pixel Ltd </a>
                                                            </td>
                                                            <td class="hidden-xs"> Server hardware purchase </td>
                                                            <td> 52560.10$
                                                                <span class="label label-success label-sm"> Paid </span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <a href="javascript:;"> Smart House </a>
                                                            </td>
                                                            <td class="hidden-xs"> Office furniture purchase </td>
                                                            <td> 5760.00$
                                                                <span class="label label-warning label-sm"> Pending </span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <a href="javascript:;"> FoodMaster Ltd </a>
                                                            </td>
                                                            <td class="hidden-xs"> Company Anual Dinner Catering </td>
                                                            <td> 12400.00$
                                                                <span class="label label-success label-sm"> Paid </span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <a href="javascript:;"> WaterPure Ltd </a>
                                                            </td>
                                                            <td class="hidden-xs"> Payment for Jan 2013 </td>
                                                            <td> 610.50$
                                                                <span class="label label-danger label-sm"> Overdue </span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <a href="javascript:;"> Pixel Ltd </a>
                                                            </td>
                                                            <td class="hidden-xs"> Server hardware purchase </td>
                                                            <td> 52560.10$
                                                                <span class="label label-success label-sm"> Paid </span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <a href="javascript:;"> Smart House </a>
                                                            </td>
                                                            <td class="hidden-xs"> Office furniture purchase </td>
                                                            <td> 5760.00$
                                                                <span class="label label-warning label-sm"> Pending </span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <a href="javascript:;"> FoodMaster Ltd </a>
                                                            </td>
                                                            <td class="hidden-xs"> Company Anual Dinner Catering </td>
                                                            <td> 12400.00$
                                                                <span class="label label-success label-sm"> Paid </span>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--tab-pane-->
                                        <div class="tab-pane" id="tab_1_22">
                                            <div class="tab-pane active" id="tab_1_1_1">
                                                <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                                                    <ul class="feeds">
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-success">
                                                                            <i class="fa fa-bell-o"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> You have 4 pending tasks.
                                                                            <span class="label label-danger label-sm"> Take action
                                                                                <i class="fa fa-share"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> Just now </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-success">
                                                                                <i class="fa fa-bell-o"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc"> New version v1.4 just lunched! </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"> 20 mins </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-danger">
                                                                            <i class="fa fa-bolt"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> Database server #12 overloaded. Please fix the issue. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 24 mins </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 30 mins </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-success">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 40 mins </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-warning">
                                                                            <i class="fa fa-plus"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New user registered. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 1.5 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-success">
                                                                            <i class="fa fa-bell-o"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> Web server hardware needs to be upgraded.
                                                                            <span class="label label-inverse label-sm"> Overdue </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 2 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-default">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 3 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-warning">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 5 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 18 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-default">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 21 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 22 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-default">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 21 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 22 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-default">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 21 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 22 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-default">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 21 hours </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-info">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> New order received. Please take care of it. </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> 22 hours </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--tab-pane-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
	<script src="{{ asset('js/admin/profile.js') }}" type="text/javascript"></script>
@endsection