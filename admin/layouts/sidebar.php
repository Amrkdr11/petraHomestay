<?php


// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

// Clear errors from the session
unset($_SESSION['errors']);
?>

<div class="sidebar">
    <div class="site-width">
        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown <?php echo ($current_page == 'admin_dashboard.php') ? 'active' : ''; ?>">
                <a href="admin_dashboard.php"><i class="icon-home mr-1"></i> Dashboard</a>
                <ul>
                    <li class="<?php echo ($current_page == 'admin_dashboard.php') ? 'active' : ''; ?>">
                        <a href="admin_dashboard.php"><i class="icon-speedometer"></i> Dashboard</a>
                    </li>
                    <li class="<?php echo ($current_page == 'bookings.php') ? 'active' : ''; ?>">
                        <a href="bookings.php"><i class="icon-calendar"></i> Bookings</a>
                    </li>
                    <li class="<?php echo ($current_page == 'payments.php') ? 'active' : ''; ?>">
                        <a href="payments.php"><i class="icon-credit-card"></i> Payments</a>
                    </li>
                    <li class="<?php echo ($current_page == 'guests.php') ? 'active' : ''; ?>">
                        <a href="guests.php"><i class="icon-people"></i> Guests</a>
                    </li>
                    <!-- <li class="<?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
                        <a href="profile.php"><i class="icon-user"></i> Profile</a>
                    </li> -->
                </ul>
            </li>
            
            <div class="d-flex flex-column mt-5 ml-2 mr-2">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                <?php endif; ?>
            </div>
        </ul>
        <!-- END: Menu-->
        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item <?php echo ($current_page == 'admin_dashboard.php') ? 'active' : ''; ?>">
                <a href="admin_dashboard.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item <?php echo ($current_page == 'bookings.php') ? 'active' : ''; ?>">
                <a href="bookings.php">Bookings</a>
            </li>
            <li class="breadcrumb-item <?php echo ($current_page == 'payments.php') ? 'active' : ''; ?>">
                <a href="payments.php">Payments</a>
            </li>
            <li class="breadcrumb-item <?php echo ($current_page == 'guests.php') ? 'active' : ''; ?>">
                <a href="guests.php">Guests</a>
            </li>
            <li class="breadcrumb-item <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
                <a href="profile.php">Profile</a>
            </li>
        </ol>
    </div>
</div>
