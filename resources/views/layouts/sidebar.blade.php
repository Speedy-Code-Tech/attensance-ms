   
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header">

                <a href="user/" class="logo" align="center">
                    <img src="{{ asset('images/rotary_logo.png') }}" style="width:79%;margin-left: -72px"
                        alt="navbar brand" class="navbar-brand">
                    <!-- <h3 class="navbar-brand card-title mt-3" style="font-size: 18px;"><span class="text-white"> 
                THINKWOLI </span> -->
                    <!-- </h3> -->
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="">

                <div class="container-fluid">
                    <div class="collapse" id="search-nav">
                        <h3 class="navbar-brand card-title " style="font-size: 18px;"><span class="text-white">
                                Rotary Club of Tanauan Automated Attendance System
                            </span>
                        </h3>
                        <!-- <form class="navbar-left navbar-form nav-search mr-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-search pr-1">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                            <input type="text" placeholder="Search ..." class="form-control">
                        </div>
                    </form> -->
                    </div>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <!-- <li class="nav-item toggle-nav-search hidden-caret">
                        <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                            <i class="fa fa-search"></i>
                        </a>
                    </li> -->
                        <li hidden class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="notification"></span>
                            </a>
                            <ul hidden class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                <li>
                                    <div class="dropdown-title">Low Stock Notification</div>
                                </li>
                                <li>

                                </li>
                                <li>
                                    <a class="see-all" href="inventories/index/low_stock">See Details<i
                                            class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        <li hidden class="nav-item">
                            <a href="#" class="nav-link quick-sidebar-toggler">
                                <i class="fa fa-th"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <?php
                                $profile_picture = "create_hope.jpg";
                                // if($_SESSION['picture']){
                                //     $profile_picture = $_SESSION['picture'];
                                // }
                                ?>
                                    {{-- <img src="public/uploads/dp/$profile_picture" alt="..."
                                        class="avatar-img rounded-circle"> --}}
                                    @if ($profilePicture)
                                    <img src="{{asset('storage/'.$profilePicture)}}" alt="..."
                                        class="avatar-img rounded-circle">
                                    @else
                                    <img src="{{ asset('images/create_hope.jpg')}}" alt="..."
                                        class="avatar-img rounded-circle">
                                    @endif
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="scroll-wrapper dropdown-user-scroll scrollbar-outer"
                                    style="position: relative;">
                                    <div class="dropdown-user-scroll scrollbar-outer scroll-content"
                                        style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 0px;">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    {{-- <img
                                                        src="public/uploads/dp/profile_picture"
                                                        alt="image profile" class="avatar-img rounded"> --}}
                                                        @if ($profilePicture)
                                                        <img src="{{asset('storage/'.$profilePicture)}}" alt="..."
                                                            class="avatar-img rounded">
                                                        @else
                                                        <img
                                                            src="{{asset('images/create_hope.jpg')}}"
                                                            alt="image profile" class="avatar-img rounded">
                                                        @endif
                                                </div>
                                                <div class="u-text">
                                                    <h4>
                                                        {{$firstName}} {{$lastName}}
                                                    </h4>
                                                    <p class="text-muted">
                                                        {{ $role }}
                                                    </p>

                                                    <!-- <a href="user/profile/" class="btn btn-xs btn-secondary btn-sm">View Profile</a> -->
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <!-- <div class="dropdown-divider"></div> -->
                                            <div class="dropdown-divider"></div>
                                            @if (Auth::user()->role == 'member')
                                            <a class="dropdown-item" href="{{route('profile')}}">Account
                                                Setting</a>
                                                <div class="dropdown-divider"></div>
                                            @endif
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">Logout</a>


                                        </li>
                                    </div>
                                    <div class="scroll-element scroll-x" style="">
                                        <div class="scroll-element_outer">
                                            <div class="scroll-element_size"></div>
                                            <div class="scroll-element_track"></div>
                                            <div class="scroll-bar ui-draggable ui-draggable-handle"></div>
                                        </div>
                                    </div>
                                    <div class="scroll-element scroll-y" style="">
                                        <div class="scroll-element_outer">
                                            <div class="scroll-element_size"></div>
                                            <div class="scroll-element_track"></div>
                                            <div class="scroll-bar ui-draggable ui-draggable-handle"></div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>


        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2" data-background-color="white">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            {{-- <img src="public/uploads/dp/profile_picture" alt="..."
                                class="avatar-img rounded-circle"> --}}
                            @if ($profilePicture)
                            <img src="{{asset('storage/'.$profilePicture)}}" alt="..."
                                class="avatar-img rounded-circle">
                            @else
                            <img src="{{asset('images/create_hope.jpg')}}" alt="..."
                                class="avatar-img rounded-circle">
                            @endif
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    {{ $firstName }} {{$lastName}}
                                    <span class="user-level">
                                        {{ $role }}
                                    </span>
                                    <?php
                                    // if($_SESSION['type'] == 0){
                                    // 		echo '<span class="user-level">Administrator</span>';
                                    // }
                                    ?>

                                </span>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Components</h4>
                        </li>

                        <li class="nav-item {{ $pageTitle == 'Home' ? 'active' : null }}">
                            {{-- add active class if selected --}}
                            <a href="{{route('home')}}">
                                <i class="fas fa-chalkboard"></i>
                                <p>My Dashboard</p>
                            </a>
                        </li>

                        @if (Auth::user()->role == 'member')
                        <li
                        class="nav-item {{ $pageTitle == 'Profile' ? 'active' : null }}">
                        <a href="{{route('profile')}}">
                            <i class="fas fa-user"></i>
                            <p>Account Settings</p>
                        </a>
                    </li>
                    @endif
                    
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                        <li class="nav-item {{ $pageTitle == 'Attendance Sheet' ? 'active' : null }} ">
                            <a href="{{ route('attendance.sheet') }}">
                                <i class="fas fa-sticky-note"></i>
                                <p>Attendance Sheet</p>
                            </a>
                        </li>

                        <li class="nav-item {{ $pageTitle == 'Attendance Logs' || $pageTitle == 'Add Attendance Log' ? 'active' : null }}">
                            <a href="{{ route('attendance-logs.index') }}">
                                <i class="fas fa-clock"></i>
                                <p>Attendance Logs</p>
                            </a>
                        </li>

                        <li class="nav-item {{ $pageTitle == 'Schedules' || $pageTitle == 'Add Schedule' || $pageTitle == 'Edit Schedule' ? 'active' : null }}">
                            <a href="{{ route('schedules.index') }}">
                                <i class="fas fa-calendar-alt"></i>
                                <p>Schedule</p>
                            </a>
                        </li>

                        
                        <li class="nav-item {{ $pageTitle == 'Members' || $pageTitle == 'Edit Member' || $pageTitle == 'Add Member' ? 'active' : null }}">
                            @if (Auth::user()->role == 'admin')
                            <a data-toggle="collapse" href="#side_sys_user" class="collapsed" aria-expanded="false">
                                <i class="fas fa-users"></i>
                                <p>System Users</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse "
                                id="side_sys_user" style="">
                                <ul class="nav nav-collapse">
                                    <li
                                    class="{{ $pageTitle == 'Members' || $pageTitle == 'Edit Member' || $pageTitle == 'Add Member' ? 'active' : null }}">
                                        <a href="{{ route('members.index', ['role' => 'member']) }}">
                                            <span class="sub-item">Members</span>
                                        </a>
                                    </li>
                                    <li
                                        class="{{ $pageTitle == 'Staffs' ? 'active' : null }}">
                                        <a href="{{ route('members.index', ['role' => 'staff']) }}">
                                            <span class="sub-item">Staffs</span>
                                        </a>
                                    </li>
                                    <li
                                    class="{{ $pageTitle == 'Admins' ? 'active' : null }}">
                                    <a href="{{ route('members.index', ['role' => 'admin']) }}">
                                        <span class="sub-item">Admins</span>
                                    </a>
                                    </li>
                                    @if (Auth::user()->role == 'admin')
                                    <li
                                        class="{{ $pageTitle == 'Deleted Members' ? 'active' : null }}">
                                        <a href="{{ route('members.deleted') }}">
                                            <span class="sub-item">Deleted Members</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            @endif
                        </li>
                        <li
                            class="nav-item {{ $pageTitle == 'Magazines' || $pageTitle == 'Edit Magazine' || $pageTitle == 'Add Magazine' ? 'active' : null }}">
                            <a data-toggle="collapse" href="#forms" class="collapsed" aria-expanded="false">
                                <i class="fas fa-cogs"></i>
                                <p>Miscellaneous</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse "
                            id="forms" style="">
                            <ul class="nav nav-collapse">
                                <li
                                class="{{ $pageTitle == 'Magazines' || $pageTitle == 'Edit Magazine' || $pageTitle == 'Add Magazine' ? 'active' : null }}">
                                <a href="{{ route('magazines.index') }}">
                                    <span class="sub-item">Publications</span>
                                </a>
                                    </li>
                                    <li
                                    class="{{ $pageTitle == 'Links' || $pageTitle == 'Edit Link' || $pageTitle == 'Add Link' ? 'active' : null }}">
                                    <a href="{{ route('links.index') }}">
                                            <span class="sub-item">Links</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('attendance')}}">
                                <i class="fas fa-desktop"></i>
                                <p>Attendance Display</p>
                            </a>
                        </li>
                        
                        <li class="nav-item ">
                            <a href="{{route('phone-scanner')}}">
                                <i class="fas fa-qrcode"></i>
                                <p>QR Scanner</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('settings')}}">
                                <i class="fas fa-cog"></i>
                                <p>Settings</p>
                            </a>
                        </li>

                        @endif
                        
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->