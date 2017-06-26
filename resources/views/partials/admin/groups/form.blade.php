<div class="col-md-12"> 
    <div class="portlet light">
        <div class="portlet-title min-height">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject bold uppercase font-dark"> 
                <i class="fa fa-gear fa-lg" aria-hidden="true">&nbsp;</i> Create New Group  </span>
            </div>
            <div class="tools">
                &nbsp;<a href="" class="collapse" data-original-title="" title=""> </a>
            </div>
            <div class="actions">
                <a class="btn btn-icon-only btn-default fullscreen" href="#" data-original-title="" title=""> </a>
            </div>
        </div>

        <div class="portlet-body form">  
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon no-bg"><i class="fa fa-user-secret blue-color"></i></span>
                            {!! Form::text('group_name', $from=="edit" ? $role->display_name : null, ['class' => 'form-control', 'placeholder' => 'Role Name']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="form-group">
                        <div class="input-group select2-bootstrap-prepend">
                            <span class="input-group-addon no-bg"><i class="fa fa-genderless blue-color"></i></span>
                            {!! Form::select('status', config('config-variables.job_type'), $from=="edit" ? $role->status : null, array('class' =>'form-control selectpicker', 'placeholder' =>'-- Select Job Type --')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portlet light box-layout ribb-box modul_list">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-dark hide"></i>
                <span class="caption-subject bold uppercase font-dark">
                <i class="fa fa-gear fa-lg" aria-hidden="true">&nbsp;</i> Assign Access Widgets</span>
            </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="add-group-form manage-widget">
                <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-light page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <h3><span>STEP 1</span> Parent Module</h3>
                    <div class="scroller">
                    @foreach($menuTree as $item)
                        <li class="nav-item {{$loop->first ? 'open' : '' }}">
                            <a href="javascript:;" class="nav-link nav-toggle"><i class="fa {{ $item['icon'] }}"></i>{{ $item['name'] }}</a>
                            <ul class="sub-level sub1 sub-menu">
                                <h3><span>STEP 2</span> Child Module</h3>
                                <div class="scroller">
                                    @if(isset($item['children']) && count($item['children']))
                                    @foreach ($item['children'] as $item)
                                        <li class="nav-item {{$loop->first ? 'open' : '' }}">
                                            <a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-tag"></i>{{ $item['name'] }}</a>
                                            <ul class="sub-level sub2 sub-menu">
                                                <h3><span>STEP 3</span> Page Module</h3>
                                                <div class="scroller">
                                                    @if(isset($item['children']) && count($item['children']))
                                                    @foreach ($item['children'] as $child)
                                                        <li class="nav-item {{$loop->first ? 'open' : '' }}">
                                                            <a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-tag"></i>{{ $child['name'] }}</a>
                                                            <ul class="sub-level sub3 sub-menu">
                                                                <h3>
                                                                   <span>STEP 4</span> Select Widgets
                                                                        <div class="checkbox">
                                                                        <input type="checkbox" class="selectall">
                                                                        <label class="css-label">Check All</label>
                                                                    </div>
                                                                </h3>
                                                                <div class="scroller">
                                                                    @foreach ($child['widgets'] as $widget)
                                                                        <li>
                                                                            <a class="clearfix widget-list">
                                                                                <span class="chk-des">
                                                                                {{-- <input type="checkbox"> --}}
                                                                                {!! Form::checkbox("widgets[".$item['id']."][]", $widget['id'], ($from=="edit" &&
                                                                                     in_array($widget['id'], $widgets))  ? true : null) !!}
                                                                                <label class="css-label">{{ $widget['name'] }}
                                                                                </label>
                                                                                {{-- <span class="des">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span> --}}
                                                                                <i class="fa fa-info popovers" data-container="body" onclick=" " data-trigger="hover" data-placement="left" data-content="Lorem Ipsum is simply dummy text of the printing and typesetting industry."></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </div>
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </ul>
                                        </li>
                                    @endforeach
                                    @endif
                                </div>
                            </ul>
                        </li>
                    @endforeach
                    </div>
                </ul>
            </div>
        </div>
        <div class="form-actions margin-top-20">
            <div class="row">
                <div class="col-md-9">
                    <button type="submit" class="btn blue">Submit</button>
                    <button type="button" class="btn default">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    
    
</div>