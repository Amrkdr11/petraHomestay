<?php 
session_start(); 
include '../db_connect.php';

$bookingId = $_GET['booking_id'];

// Query database to fetch booking details using $bookingId
$sql = "SELECT * FROM bookings WHERE booking_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookingId);
$stmt->execute();
$result = $stmt->get_result();

$booking = $result->fetch_assoc();

$stmt->close();
// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
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

    <!-- FullCalendar CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

    <!-- jQuery and FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
</head>

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
                            <li class="breadcrumb-item active"><a href="#">Payments</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->

            <div class="row">
            
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">                               
                            <h4 class="card-title">Booking Details</h4>                                
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">                                           
                                    <div class="col-12">
                                    <form action="paymentProcess.php" method="post">
                                    <div class="form-group row">
                                                <label for="username" class="col-sm-2 col-form-label">Date</label>
                                                <div class="col-sm-10">
                                                    <h5>Date</h5>
                                                    <p><?php echo date("M d", strtotime($booking['checkin'])) . " - " . date("d", strtotime($booking['checkout'])); ?></p>                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">Guests</label>
                                                <div class="col-sm-10">
                                                    <h5>Guests</h5>
                                                    <p><?php echo $booking['guest_count']; ?> Guests</p>                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">Price Details</label>
                                                <div class="col-sm-10">
                                                <div>RM <?php echo $booking['nightly_rate']; ?> x <?php echo (strtotime($booking['checkout']) - strtotime($booking['checkin'])) / (60 * 60 * 24); ?> nights</div>
                                                <div>RM <?php echo $booking['nightly_rate'] * ((strtotime($booking['checkout']) - strtotime($booking['checkin'])) / (60 * 60 * 24)); ?></div>                                                </div>
                                            </div> 
                                            
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">Cleaning Fee</label>
                                                <div class="col-sm-10">
                                                    <div>Cleaning fee</div>
                                                    <div>RM <?php echo $booking['cleaning_fee']; ?></div>                                                 
                                                </div>
                                            </div>   

                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">Total</label>
                                                <div class="col-sm-10">
                                                <h4>RM <?php echo ($booking['nightly_rate'] * ((strtotime($booking['checkout']) - strtotime($booking['checkin'])) / (60 * 60 * 24))) + $booking['cleaning_fee']; ?></h4>
                                                </div>
                                            </div>   
                                            <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">
                                            <input type="hidden" name="total_amount" value="<?php echo ($booking['nightly_rate'] * ((strtotime($booking['checkout']) - strtotime($booking['checkin'])) / (60 * 60 * 24))) + $booking['cleaning_fee']; ?>">

                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-2 col-form-label">Total</label>
                                                <div class="col-sm-10">
                                                <select class="form-control" id="role" name="paymentMethod" required>
                                                        <option value="" disabled selected>Select Payment Method</option>
                                                        <option value="cash">Cash</option>
                                                </select>                                                    
                                            </div>
                                            </div>   

                                            <div id="error" class="text-danger"></div>
                                            
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <button type="submit" name="addBooking" class="btn btn-primary">Reserve</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="dist/vendors/jquery-ui/jquery-ui.min.js"></script>
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

    <script>
        function calculateTotal() {
            const checkinDate = new Date(document.getElementById('checkin').value);
            const checkoutDate = new Date(document.getElementById('checkout').value);
            const oneDay = 24 * 60 * 60 * 1000;
            const nights = Math.round((checkoutDate - checkinDate) / oneDay);

            // Check if check-in date is later than check-out date
            if (checkinDate > checkoutDate) {
                document.getElementById('error').textContent = "Please input a valid date";
                document.getElementById('nights').textContent = 0;
                document.getElementById('subtotal').textContent = 'RM 0';
                document.getElementById('total').textContent = 'RM 0';
            } else if (checkinDate < checkoutDate) {
                document.getElementById('error').textContent = "";

                if (nights > 0) {
                    const nightlyRate = 100;
                    const cleaningFee = 40;
                    const subtotal = nights * nightlyRate;
                    const total = subtotal + cleaningFee;
                    
                    document.getElementById('nights').textContent = nights;
                    document.getElementById('subtotal').textContent = `RM ${subtotal}`;
                    document.getElementById('total').textContent = `RM ${total}`;
                } else {
                    document.getElementById('nights').textContent = 0;
                    document.getElementById('subtotal').textContent = 'RM 0';
                    document.getElementById('total').textContent = 'RM 0';
                }
            }
        }

        $(document).ready(function() {
            $('#calendar').fullCalendar({
                events: bookingDates.map(date => ({
                    start: date.checkin,
                    end: date.checkout,
                    color: 'yellow',
                    textColor: 'black'
                }))
            });
        });
    </script>
</body>
</html>
