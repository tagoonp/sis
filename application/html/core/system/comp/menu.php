<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
        <li class=" nav-item  <?php if($page == 'home'){ echo "active"; }?>"><a href="./"><i class="menu-livicon" data-icon="home"></i><span class="menu-title text-truncate text-white" data-i18n="First page">Home</span></a></li>

        <?php 
        if(($role == 'admin') || ($role == 'lecturer') || ($role == 'staff')){
            ?>
            <li class=" nav-item text-white"><a href="../../../html/ltr/vertical-menu-template-dark/index.html"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title text-truncate text-white" data-i18n="Dashboard">Dashboard</span><span class="badge badge-light-danger badge-pill badge-round float-right mr-50 ml-auto">2</span></a>
            <ul class="menu-content">
                <li><a class="d-flex align-items-center" href="dashboard-analytics.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate text-white" data-i18n="Analytics">Analytics</span></a></li>
                <li><a class="d-flex align-items-center" href="dashboard-analytics.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate text-white" data-i18n="Analytics">Monitoring student</span></a></li>
                </ul>
            </li>
            <?php
        }
        ?>

        
        
        <li class=" navigation-header text-truncate text-white"><span data-i18n="Apps">Your info.</span></li>
        <li class=" nav-item  <?php if($page == 'page-user-profile'){ echo "active"; }?>"><a href="page-user-profile"><i class="menu-livicon" data-icon="user"></i><span class="menu-title text-truncate text-white" data-i18n="User Profile">Profile</span></a></li>
        <?php 
        if($role == 'student'){
            ?>
            <li class=" nav-item  <?php if($page == 'page-study-info'){ echo "active"; }?>"><a href="page-study-info"><i class="menu-livicon" data-icon="briefcase"></i><span class="menu-title text-truncate text-white" data-i18n="User Profile">Study info.</span></a></li>
            <?php
        }
        ?>

        <?php 
        if($role != 'student'){
            ?>
            <li class=" navigation-header text-truncate text-white"><span data-i18n="Apps">Management</span></li>
            <?php
        }
        ?>

        <?php 
        if($role == 'admin'){
            ?>
            <li class=" nav-item <?php if($page == 'app-user-add'){ echo "active"; }?>"><a href="Javascript:showModalType()"><i class="menu-livicon" data-icon="plus"></i><span class="menu-title text-truncate text-white" data-i18n="Calendar">Create new user</span></a>
            <li class=" nav-item <?php if($page == 'app-users'){ echo "active"; }?>"><a href="app-users"><i class="menu-livicon" data-icon="users"></i><span class="menu-title text-truncate text-white" data-i18n="Calendar">All users</span></a>
            <li class=" nav-item <?php if($page == 'app-lecturer'){ echo "active"; }?>"><a href="app-lecturer"><i class="menu-livicon" data-icon="rocket"></i><span class="menu-title text-truncate text-white" data-i18n="Calendar">Lecturer</span></a>
            <!-- <li class=" nav-item <?php if($page == 'app-staff'){ echo "active"; }?>"><a href="app-staff"><i class="menu-livicon" data-icon="pencil"></i><span class="menu-title text-truncate text-white" data-i18n="Calendar">Staff</span></a> -->
            <li class=" nav-item <?php if($page == 'app-monitor'){ echo "active"; }?>"><a href="app-monitor"><i class="menu-livicon" data-icon="dashboard"></i><span class="menu-title text-truncate text-white" data-i18n="Calendar">Monitoring</span></a>
            <li class=" nav-item <?php if($page == 'app-student'){ echo "active"; }?>"><a href="app-student"><i class="menu-livicon" data-icon="user"></i><span class="menu-title text-truncate text-white" data-i18n="Calendar">Student</span></a>
            <?php
        }
        ?>

        <?php 
        if($role == 'staff'){
            ?>
            <li class=" nav-item <?php if($page == 'app-monitor'){ echo "active"; }?>"><a href="app-monitor"><i class="menu-livicon" data-icon="dashboard"></i><span class="menu-title text-truncate text-white" data-i18n="Calendar">Monitoring</span></a>
            <li class=" nav-item <?php if($page == 'app-student'){ echo "active"; }?>"><a href="app-student"><i class="menu-livicon" data-icon="user"></i><span class="menu-title text-truncate text-white" data-i18n="Calendar">Student</span></a>
            <?php
        }
        ?>

        <?php 
        if($role == 'lecturer'){
            ?>
            <li class=" nav-item <?php if($page == 'app-monitor'){ echo "active"; }?>"><a href="app-monitor"><i class="menu-livicon" data-icon="dashboard"></i><span class="menu-title text-truncate text-white" data-i18n="Calendar">Monitoring</span></a>
            <li class=" nav-item <?php if($page == 'app-student'){ echo "active"; }?>"><a href="app-student"><i class="menu-livicon" data-icon="user"></i><span class="menu-title text-truncate text-white" data-i18n="Calendar">Student</span></a>
            <?php
        }
        ?>
        
        <!-- <li class=" navigation-header text-truncate text-white"><span data-i18n="Support">Support</span>
        </li>
        <li class=" nav-item"><a href="https://pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/documentation" target="_blank"><i class="menu-livicon" data-icon="morph-folder"></i><span class="menu-title text-truncate text-white" data-i18n="Documentation">Documentation</span></a>
        </li> -->
    </ul>
</div>