        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Member</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if(TITLE=="Dashboard"){echo "active";} ?>">
                <a class="nav-link" href="dashboard.php">
                    <i class="pe-2 fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if(TITLE=="Message"){echo "active";} ?> <?php if(TITLE=="Message"){echo "active";} ?>">
                <a class="nav-link" href="message.php">
                    <i class="pe-2 fas fa-lg fa-envelope fa-fw"></i>
                    <span>Message</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if(TITLE=="Animal Health info"){echo "active";} ?>">
                <a class="nav-link" href="animal_health_info.php">
                    <i class="pe-2 fas fa-lg fa-notes-medical"></i>
                    <span>Animal Health info</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if(TITLE=="Profile"){echo "active";} ?>">
                <a class="nav-link" href="profile.php">
                    <i class="pe-2 fas fa-lg fa-fw fa-user-alt"></i>
                    <span>Profile</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if(TITLE=="Receipt"){echo "active";} ?>">
                <a class="nav-link" href="receipt.php">
                    <i class="pe-2 fas fa-lg fa-receipt"></i>
                    <span>Receipt</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="pe-2 fas fa-lg fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->