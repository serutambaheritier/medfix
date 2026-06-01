<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">HOME</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="doctor-home" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">OPERATIONS</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="doctors-list-d-p" aria-expanded="false">
                <span>
                    <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Doctors</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="users-d-p" aria-expanded="false">
                <span>
                    <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Technicians</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="job-requests" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Job Requests</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">REPORTS</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="pending-job-requests" aria-expanded="false">
                <span>
                    <i class="ti ti-calendar-stats"></i>
                </span>
                <span class="hide-menu">Pending Job Requests</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="troubleshooting" aria-expanded="false">
                <span>
                    <i class="ti ti-tool"></i>
                </span>
                <span class="hide-menu">Troubleshooting</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="maintained" aria-expanded="false">
                <span>
                    <i class="ti ti-checklist"></i>
                </span>
                <span class="hide-menu">Maintained</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">ACCOUNT</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="change-password-d-p" aria-expanded="false">
                <span>
                    <i class="ti ti-lock"></i>
                </span>
                <span class="hide-menu">Change Password</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="logout" aria-expanded="false">
                <span>
                    <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Logout</span>
            </a>
        </li>
    </ul>

    <br><br><p class="mb-0 fs-4"><b>Logged in as a <?php echo $_SESSION['hbUser_Type']; ?>, <?php echo $_SESSION['hbUser_Name']; ?></b></p>

</nav>