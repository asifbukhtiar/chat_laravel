<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Josh Admin Template</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link href="{{ asset('josh/css/app.css') }}" rel="stylesheet" type="text/css" />
    <!-- end of global css -->
    <!--page level css -->
    <link href="{{ asset('josh/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('josh/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" media="all" href="{{ asset('josh/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}" />
    <link rel="stylesheet" href="{{ asset('josh/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('josh/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('josh/css/pages/only_dashboard.css') }}" />
    <!--end of page level css-->
</head>

<body class="skin-josh">
<header class="header">
    <a href="index.html" class="logo">
        <h1>OCP</h1>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="livicon" data-name="message-flag" data-loop="true" data-color="#42aaca" data-hovercolor="#42aaca" data-size="28"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages pull-right">
                        <li class="dropdown-title">4 New Messages</li>
                        <li class="unread message">
                            <a href="javascript:;" class="message"> <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read"><span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span></i>
                                <img src="{{ asset('josh/img/authors/avatar.jpg') }}" class="img-responsive message-image" alt="icon" />
                                <div class="message-body">
                                    <strong>Riot Zeast</strong>
                                    <br>Hello, You there?
                                    <br>
                                    <small>8 minutes ago</small>
                                </div>
                            </a>
                        </li>
                        <li class="unread message">
                            <a href="javascript:;" class="message">
                                <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read"><span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span></i>
                                <img src="{{ asset('josh/img/authors/avatar1.jpg') }}" class="img-responsive message-image" alt="icon" />
                                <div class="message-body">
                                    <strong>John Kerry</strong>
                                    <br>Can we Meet ?
                                    <br>
                                    <small>45 minutes ago</small>
                                </div>
                            </a>
                        </li>
                        <li class="unread message">
                            <a href="javascript:;" class="message">
                                <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">
                                    <span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span>
                                </i>
                                <img src="{{ asset('josh/img/authors/avatar5.jpg') }}" class="img-responsive message-image" alt="icon" />
                                <div class="message-body">
                                    <strong>Jenny Kerry</strong>
                                    <br>Dont forgot to call...
                                    <br>
                                    <small>An hour ago</small>
                                </div>
                            </a>
                        </li>
                        <li class="unread message">
                            <a href="javascript:;" class="message">
                                <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">
                                    <span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span>
                                </i>
                                <img src="{{ asset('josh/img/authors/avatar4.jpg') }}" class="img-responsive message-image" alt="icon" />
                                <div class="message-body">
                                    <strong>Ronny</strong>
                                    <br>Hey! sup Dude?
                                    <br>
                                    <small>3 Hours ago</small>
                                </div>
                            </a>
                        </li>
                        <li class="footer">
                            <a href="#">View all</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f" data-hovercolor="#e9573f" data-size="28"></i>
                        <span class="label label-warning">7</span>
                    </a>
                    <ul class=" notifications dropdown-menu">
                        <li class="dropdown-title">You have 7 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <i class="livicon danger" data-n="timer" data-s="20" data-c="white" data-hc="white"></i>
                                    <a href="#">after a long time</a>
                                    <small class="pull-right">
                                        <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                        Just Now
                                    </small>
                                </li>
                                <li>
                                    <i class="livicon success" data-n="gift" data-s="20" data-c="white" data-hc="white"></i>
                                    <a href="#">Jef's Birthday today</a>
                                    <small class="pull-right">
                                        <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                        Few seconds ago
                                    </small>
                                </li>
                                <li>
                                    <i class="livicon warning" data-n="dashboard" data-s="20" data-c="white" data-hc="white"></i>
                                    <a href="#">out of space</a>
                                    <small class="pull-right">
                                        <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                        8 minutes ago
                                    </small>
                                </li>
                                <li>
                                    <i class="livicon bg-aqua" data-n="hand-right" data-s="20" data-c="white" data-hc="white"></i>
                                    <a href="#">New friend request</a>
                                    <small class="pull-right">
                                        <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                        An hour ago
                                    </small>
                                </li>
                                <li>
                                    <i class="livicon danger" data-n="shopping-cart-in" data-s="20" data-c="white" data-hc="white"></i>
                                    <a href="#">On sale 2 products</a>
                                    <small class="pull-right">
                                        <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                        3 Hours ago
                                    </small>
                                </li>
                                <li>
                                    <i class="livicon success" data-n="image" data-s="20" data-c="white" data-hc="white"></i>
                                    <a href="#">Lee Shared your photo</a>
                                    <small class="pull-right">
                                        <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                        Yesterday
                                    </small>
                                </li>
                                <li>
                                    <i class="livicon warning" data-n="thumbs-up" data-s="20" data-c="white" data-hc="white"></i>
                                    <a href="#">David liked your photo</a>
                                    <small class="pull-right">
                                        <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                        2 July 2014
                                    </small>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Sentinel::getUser()->pic)
                            <img src="{{ Sentinel::getUser()->pic }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>

                        @elseif(Sentinel::getUser()->gender === "male")
                            <img src="{{ asset('josh/images/authors/avatar3.png') }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>

                        @elseif(Sentinel::getUser()->gender === "female")
                            <img src="{{ asset('josh/images/authors/avatar5.png') }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>

                        @else
                            <img src="{{ asset('josh/images/authors/no_avatar.jpg') }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>
                        @endif
                        <div class="riot">
                            <div>
                                Riot
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            @if(Sentinel::getUser()->pic)
                                <img src="{{ Sentinel::getUser()->pic }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>

                            @elseif(Sentinel::getUser()->gender === "male")
                                <img src="{{ asset('josh/images/authors/avatar3.png') }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>

                            @elseif(Sentinel::getUser()->gender === "female")
                                <img src="{{ asset('josh/images/authors/avatar5.png') }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>

                            @else
                                <img src="{{ asset('josh/images/authors/no_avatar.jpg') }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>
                            @endif
                            <p class="topprofiletext">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
                        </li>
                        <!-- Menu Body -->
                        <li>
                            <a href="view_user.html">
                                <i class="livicon" data-name="user" data-s="18"></i> My Profile
                            </a>
                        </li>
                        <li role="presentation"></li>
                        <li>
                            <a href="adduser.html">
                                <i class="livicon" data-name="gears" data-s="18"></i> Account Settings
                            </a>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="lockscreen.html">
                                    <i class="livicon" data-name="lock" data-s="18"></i> Lock
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ URL::to('superadmin/logout') }}">
                                    <i class="livicon" data-name="sign-out" data-s="18"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>