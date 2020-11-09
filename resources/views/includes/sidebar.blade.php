        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <li class="user-pro">
                        <a href="#" class="waves-effect"><img src="{{asset('public/assets/admin/plugins/images/users/varun.jpg')}}" alt="user-img" class="img-circle"> <span class="hide-menu">{{ Auth::user()->name }}<span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i> <span class="hide-menu">My Profile</span></a></li>
                            <li><a href="javascript:void(0)"><i class="ti-wallet"></i> <span class="hide-menu">My Balance</span></a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i> <span class="hide-menu">Inbox</span></a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> <span class="hide-menu">Account Setting</span></a></li>
                            <li><a href="{{url('logout')}}"><i class="fa fa-power-off"></i> <span class="hide-menu">Logout</span></a></li>
                        </ul>
                    </li>
                    <li> <a href="{{url('dashboard')}}" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard</a>
                     
                    </li>

                    <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-user fa-fw"></i><span class="hide-menu">Users<span class="fa arrow"></span></span></a>
                       <ul class="nav nav-third-level collapse">
                            <li> <a href="{{url('users')}}"><i class="icon-people fa-fw"></i><span class="hide-menu">Users</span></a></li>
                            <li> <a href="javascript:void(0)"><i class="ti-bar-chart fa-fw"></i><span class="hide-menu">Reports</span></a></li>
                        </ul>
                    </li>
 <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-user fa-fw"></i><span class="hide-menu">Tree view<span class="fa arrow"></span></span></a>
                       <ul class="nav nav-third-level collapse">
                            <li> <a href="{{url('folder-list')}}"><i class="icon-people fa-fw"></i><span class="hide-menu">Folder List</span></a></li>
                            <li> <a href="{{url('files-list')}}"><i class="ti-bar-chart fa-fw"></i><span class="hide-menu">Files List</span></a></li>
                        </ul>
                    </li>
                


                    <li><a href="{{url('logout')}}" class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>

              
                </ul>
            </div>
        </div>