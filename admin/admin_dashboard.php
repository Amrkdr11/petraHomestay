<?php
session_start();
include '../db_connect.php'; // Your database connection file

if (!isset($_SESSION['loggedin']) || $_SESSION['is_admin'] !== true) {
    echo '<a href="../logout.php" class="btn btn-outline-danger">Logout</a>';
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_user'])) {
        $userIdToDelete = $_POST['user_id'];
        // Add your database deletion logic here
        $message = "User with ID $userIdToDelete has been deleted.";
    }
}


// calculate total bookings
$queryTotalBook = "SELECT COUNT(*) AS total_bookings FROM bookings";
$resulTotalBook = mysqli_query($conn, $queryTotalBook);

// Check if query executed successfully
if ($resulTotalBook) {
    // Fetch the total number of bookings
    $row = mysqli_fetch_assoc($resulTotalBook);
    $totalBookings = $row['total_bookings'];
} else {
    // Handle query error
    $totalBookings = 0; // Default to 0 or handle error message
}

$queryRevenue = "SELECT SUM(total) AS total_revenue FROM bookings";
$resultRevenue = mysqli_query($conn, $queryRevenue);

$totalRevenue = 0;

if ($resultRevenue) {
    $row = mysqli_fetch_assoc($resultRevenue);
    $totalRevenue = $row['total_revenue'];
}

// Display the total revenue formatted as currency
$revenue = number_format($totalRevenue, 2);

// Get current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Query to calculate total income for the current month
$queryIncome = "SELECT SUM(total) AS income
               FROM bookings
               WHERE MONTH(checkout) = $currentMonth
               AND YEAR(checkout) = $currentYear";

$resultIncome = mysqli_query($conn, $queryIncome);

if ($resultIncome) {
    $row = mysqli_fetch_assoc($resultIncome);
    $income = $row['income'];
    
    // Display the income formatted as currency
    $formattedIncome = number_format($income, 2);
} 
?>


<?php


$user_data = check_login($conn);
$userID = $user_data['id'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT bookings.*, users.* 
                        FROM bookings 
                        INNER JOIN users ON bookings.user_id = users.id
                        WHERE bookings.checkin >= CURDATE()
                        ORDER BY bookings.checkin ASC");
$stmt->execute();
$result = $stmt->get_result();

// Check for flash message
$flashMessage = "";
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}


?>
<!DOCTYPE html>
<html lang="en">
  <!-- START: Head-->
  <head>
    <meta charset="UTF-8" />
    <title>Pick Admin</title>
    <link rel="shortcut icon" href="dist/images/favicon.ico" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <!-- START: Template CSS-->
    <link
      rel="stylesheet"
      href="dist/vendors/bootstrap/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.min.css" />
    <link
      rel="stylesheet"
      href="dist/vendors/jquery-ui/jquery-ui.theme.min.css"
    />
    <link
      rel="stylesheet"
      href="dist/vendors/simple-line-icons/css/simple-line-icons.css"
    />
    <link
      rel="stylesheet"
      href="dist/vendors/flags-icon/css/flag-icon.min.css"
    />
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="dist/vendors/chartjs/Chart.min.css" />
    <!-- END: Page CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="dist/vendors/morris/morris.css" />
    <link
      rel="stylesheet"
      href="dist/vendors/weather-icons/css/pe-icon-set-weather.min.css"
    />
    <link rel="stylesheet" href="dist/vendors/chartjs/Chart.min.css" />
    <link rel="stylesheet" href="dist/vendors/starrr/starrr.css" />
    <link rel="stylesheet" href="dist/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="dist/vendors/ionicons/css/ionicons.min.css" />
    <link
      rel="stylesheet"
      href="dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css"
    />
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="dist/css/main.css" />
    <!-- END: Custom CSS-->
  </head>
  <!-- END Head-->

  <!-- START: Body-->
  <body id="main-container" class="default">
    <!-- START: Pre Loader-->
    <div class="se-pre-con">
      <div class="loader"></div>
    </div>
    <!-- END: Pre Loader-->

    <?php include 'layouts/navbar.php';?>

    <!-- START: Main Menu-->
    
    <!-- END: Main Menu-->
    <?php include 'layouts/sidebar.php';?>

    <!-- START: Main Content-->
    <main>
      <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row">
          <div class="col-12 align-self-center">
            <div
              class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded"
            >
              <div class="w-sm-100 mr-auto">
                <h4 class="mb-0">Dashboard</h4>
                <p>Welcome to liner admin panel</p>
              </div>

              <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
          <div class="col-12 col-sm-6 col-xl-4 mt-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex px-0 px-lg-2 py-2 align-self-center">
                  <i class="icon-user icons card-liner-icon mt-2"></i>
                  <div class="card-liner-content">
                    <h2 class="card-liner-title"><?php echo $totalBookings?></h2>
                    <h6 class="card-liner-subtitle">Total Bookings</h6>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-xl-4 mt-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex px-0 px-lg-2 py-2 align-self-center">
                  <i class="icon-bag icons card-liner-icon mt-2"></i>
                  <div class="card-liner-content">
                    <h2 class="card-liner-title">RM<?php echo $formattedIncome?></h2>
                    <h6 class="card-liner-subtitle">Current month's Income</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-xl-4 mt-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex px-0 px-lg-2 py-2 align-self-center">
                  <span class="card-liner-icon mt-1">$</span>
                  <div class="card-liner-content">
                    <h2 class="card-liner-title">RM <?php echo $revenue?></h2>
                    <h6 class="card-liner-subtitle">Total Income</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-12 mt-3">
          <div class="card">
                            <div class="card-header  justify-content-between align-items-center">                               
                                <h4 class="card-title">UpcomingBookings</h4> 
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                            <th>Booking ID</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Guest Number</th>
                                            <th>Total Price</th>
                                            <th>Customer </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Fetch and display data for bookings from the database -->
                                <?php
                                // Assuming $result is the result set from your previous query
                                while ($rows = mysqli_fetch_assoc($result)) {
                                ?>  
                                    <tr>
                                        <td><?php echo $rows['booking_id']; ?></td>
                                        <td><?php echo $rows['checkin']; ?></td>
                                        <td><?php echo $rows['checkout']; ?></td>
                                        <td><?php echo $rows['guest_count']; ?></td>
                                        <td>RM <?php echo $rows['total']; ?></td>
                                        <td> <?php echo $rows['name']; ?></td>
                                        


                                        
                                    </tr>
                                <?php
                                }
                                ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
  
        </div>
        <!-- END: Card DATA-->
      </div>
    </main>
    <!-- END: Content-->
    <!-- START: Footer-->
    <footer class="site-footer">2024 © PetraHomestay</footer>
    <!-- END: Footer-->

    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
      <i class="icon-arrow-up"></i>
    </a>
    <!-- END: Back to top-->

    <!-- START: Template JS-->
    <script src="dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="dist/vendors/moment/moment.js"></script>
    <script src="dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- END: Template JS-->

    <!-- START: APP JS-->
    <script src="dist/js/app.js"></script>
    <!-- END: APP JS-->

    <!-- START: Page Vendor JS-->
    <script src="dist/vendors/raphael/raphael.min.js"></script>
    <script src="dist/vendors/morris/morris.min.js"></script>
    <script src="dist/vendors/chartjs/Chart.min.js"></script>
    <script src="dist/vendors/starrr/starrr.js"></script>
    <script src="dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
    <script src="dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
    <script src="dist/vendors/jquery-flot/jquery.flot.js"></script>
    <script src="dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
    <script src="dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
    <script src="dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
    <script src="dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
    <script src="dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
    <script src="dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
    <script src="dist/vendors/chartjs/Chart.min.js"></script>
    <script src="dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
    <script src="dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
    <script src="dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <script src="dist/js/home.script.js"></script>
    <!-- END: Page JS-->
  </body>
  <!-- END: Body-->
</html>
