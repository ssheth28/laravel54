<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <form class="sidebar-search" action="" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="fa fa-times-circle"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            {{-- <li class="nav-item start active ms-hover">
                <a href="/home.php" class="nav-link nav-toggle">
                    <i class="fa fa-dashboard"></i>
                    <span class="title">Home</span>
                    <span class="selected"></span>
                </a>
            </li> --}}
            @if (count($menu_items) > 0)                
                @foreach ($menu_items as $menu_item)
                    <li class="nav-item start">
                        @if(isset($menu_item['children']) && count($menu_item['children']))
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa {{ $menu_item['icon'] }}"></i>
                                <span class="title">{{ $menu_item['name'] }}</span>
                                <span class="selected"></span>
                                <span class="arrow"></span>
                            </a>
                                @include('elements.admin.submenu', ['menu_item' => $menu_item['children']])
                        @else
                            <a href="{{ url($menu_item['url']) }}" class="nav-link nav-toggle">
                                <i class="fa {{ $menu_item['icon'] }}"></i>
                                <span class="title">{{ $menu_item['name'] }}</span>
                            </a>
                        @endif
                    </li>
                @endforeach
            @endif
{{-- 
            <li class="nav-item  "> 
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-shield"></i>
                    <span class="title">Organisation</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="" class="nav-link ">
                            <span class="title">List all organizations</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="" class="nav-link ">
                            <span class="title">Add organisation</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  "> 
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-cog"></i>
                    <span class="title">Configuration</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="/admin/modules" class="nav-link ">
                            <span class="title">Module Manager</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="" class="nav-link ">
                            <span class="title">Widgets Manager</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="" class="nav-link ">
                            <span class="title">Users</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="" class="nav-link ">
                            <span class="title">Group</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  "> 
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-check-square-o"></i>
                    <span class="title">Access Control</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="" class="nav-link ">
                            <span class="title">Permission</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="" class="nav-link ">
                            <span class="title">Role</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  "> 
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Team</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="" class="nav-link ">
                            <span class="title">List all team</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="" class="nav-link ">
                            <span class="title">Add team</span>
                        </a>
                    </li>
                </ul>
            </li> --}}
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>

    <div class="queck-links">
        <a href="#">
            <i class="fa fa-file-text-o"></i>
            <span class="title">New Report</span>
        </a>
        <a href="#">
            <i class="fa fa-tasks"></i>
            <span class="title">My Task</span>
        </a>
    </div>
    <!-- END SIDEBAR -->
</div>