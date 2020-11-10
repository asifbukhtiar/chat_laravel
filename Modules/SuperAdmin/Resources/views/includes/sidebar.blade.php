<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">
                <div class="nav_icons">
                    <ul class="sidebar_threeicons">

                    </ul>
                </div>
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
                <ul id="menu" class="page-sidebar-menu">
                    <li class="active">
                        <a href="{{ route('superadmin.dashboard') }}">
                            <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="livicon" data-name="user" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                            <span class="title">Users</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ URL::to('/superadmin/userslist') }}">
                                    <i class="fa fa-angle-double-right"></i> Users List
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.create') }}">
                                    <i class="fa fa-angle-double-right"></i> Add New User
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('blocked.users') }}">
                                    <i class="fa fa-angle-double-right"></i> Blocked Users
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="#">
                            <i class="livicon" data-name="users" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                            <span class="title">Roles</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('roles.view') }}">
                                    <i class="fa fa-angle-double-right"></i> Roles
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('roles.create') }}">
                                    <i class="fa fa-angle-double-right"></i> Create Roles
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class="livicon" data-name="unlock" data-c="#FFF" data-hc="#FFF" data-size="18" data-loop="true"></i>
                            <span class="title">Policy Editor</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('policy.view') }}">
                                    <i class="fa fa-angle-double-right"></i> Policies
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('policy.create') }}">
                                    <i class="fa fa-angle-double-right"></i> Create Policies
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class="livicon" data-name="mail-alt" data-c="#F89A14" data-hc="#F89A14" data-size="18" data-loop="true"></i>
                            <span class="title">Email Templates</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('emailTemps.index') }}">
                                    <i class="fa fa-angle-double-right"></i> Templates
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('emailTemps.create') }}">
                                    <i class="fa fa-angle-double-right"></i> Create Templates
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class="livicon" data-name="comment" data-c="#FFF" data-hc="#FFF" data-size="18" data-loop="true"></i>
                            <span class="title">Chat Rooms</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('chatrooms.index') }}">
                                    <i class="fa fa-angle-double-right"></i> Chat Rooms
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('chatrooms.create') }}">
                                    <i class="fa fa-angle-double-right"></i> Create Rooms
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class="livicon" data-name="wordpress" data-c="#FFF" data-hc="#FFF" data-size="18" data-loop="true"></i>
                            <span class="title">Auto Chat</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('autochat.index') }}">
                                    <i class="fa fa-angle-double-right"></i>AutoChat Post
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('autochat.create') }}">
                                    <i class="fa fa-angle-double-right"></i> Create Posts
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class="livicon" data-name="share" data-c="#418BCA" data-hc="#418BCA" data-size="18" data-loop="true"></i>
                            <span class="title">Ads Management</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('ads.index') }}">
                                    <i class="fa fa-angle-double-right"></i>Ads
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('ads.create') }}">
                                    <i class="fa fa-angle-double-right"></i> Create Ads
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
        <!-- /.sidebar -->
    </aside>