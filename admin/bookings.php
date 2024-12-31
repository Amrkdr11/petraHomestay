<?php
session_start();

include '../db_connect.php'; // Your database connection file

$user_data = check_login($conn);
$userID = $user_data['id'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT bookings.*, users.* FROM bookings 
                       INNER JOIN users ON bookings.user_id = users.id");
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
        <meta charset="UTF-8">
        <title>Pick Admin</title>
        <link rel="shortcut icon" href="dist/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="dist/vendors/flags-icon/css/flag-icon.min.css"> 

        <!-- END Template CSS-->   

        <!-- START: Page CSS-->
        <link rel="stylesheet" href="dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="dist/css/main.css">
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

        <!-- START: Header-->
        <?php include 'layouts/navbar.php';?>

        <!-- END: Header-->

        <!-- START: Main Menu-->
        <?php include 'layouts/sidebar.php';?>

        <!-- END: Main Menu-->

        <!-- START: Main Content-->
        <main>
            <div class="container-fluid site-width">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Bookings</h4></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Table</li>
                                <li class="breadcrumb-item active"><a href="#">bookings</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <?php if ($flashMessage): ?>
                <div class="alert alert-success" id="flash-message">
                    <?php echo $flashMessage; ?>
                </div>
            <?php endif; ?>
                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header  justify-content-between align-items-center">                               
                                <h4 class="card-title">Bookings</h4> 
                            </div>
                            
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <a href="addbooking.php" class="btn btn-primary btn-sm"><i class ="bi bi-plus"></i>Add Booking</a>
                                </div>

                                <div table="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                            <th>Booking ID</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Guest Number</th>
                                            <th>Total Price</th>
                                            <th>Customer </th>
                                            <th>Edit</th>
                                            <th>Delete</th>


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
                            <td>                                
                                <a href="editBooking.php?booking_id=<?php echo $rows['booking_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                            <td>                                
                            <a href="deleteBooking.php?booking_id=<?php echo $rows['booking_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                            </td>


                            
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
                </div>
                <!-- END: Card DATA-->
            </div>
        </main>
        <!-- END: Content-->



        <!-- START: Footer-->
        <footer class="site-footer">
            2024 © PetraHomestay
        </footer>
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
        <script src="dist/vendors/datatable/js/jquery.dataTables.min.js"></script> 
        <script src="dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
        <script src="dist/vendors/datatable/jszip/jszip.min.js"></script>
        <script src="dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
        <script src="dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
        <script src="dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page Script JS-->        
        <script src="dist/js/datatable.script.js"></script>
        <!-- END: Page Script JS-->
    </body>
    <!-- END: Body-->
</html>
