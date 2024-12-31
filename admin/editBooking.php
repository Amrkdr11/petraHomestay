<?php
session_start();

include '../db_connect.php'; // Your database connection file

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
        <div class="row">
            <div class="col-12 align-self-center">
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

        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 mt-3">
                <div class="card">
                    <div class="card-header">                               
                        <h4 class="card-title">Horizontal Form</h4>                                
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <form action="updateBooking.php?booking_id=<?php echo $bookingId; ?>" method="post">
                        <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Check in</label>
                                    <div class="col-sm-10">
                                        <input type="date" disabled name="checkin" class="form-control" id="checkin" value="<?php echo $booking['checkin']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Check Out</label>
                                    <div class="col-sm-10">
                                        <input type="date" disabled name="checkout" class="form-control" id="checkout" value="<?php echo $booking['checkout']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Guest</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="guest_count" class="form-control" id="inputGuestCount" value="<?php echo $booking['guest_count']; ?>"required>
                                    </div>
                                </div>

                                
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Subtotal</label>
                                    <div class="col-sm-10">
                                        <div id="subtotal">RM <?php echo $booking['subtotal']; ?></div>                                                    
                                    </div>
                                </div>   

                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Cleaning Fee</label>
                                    <div class="col-sm-10">
                                        <div>RM 40</div>
                                    </div>
                                </div>   

                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Total</label>
                                    <div class="col-sm-10">
                                        <h4 id="total">RM <?php echo $booking['total']; ?></h4>
                                    </div>
                                </div>   

                                <div id="error" class="text-danger"></div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-10 mx-auto text-right">
                                        <button type="submit" name="updateBooking" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
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
        2020 © PICK
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
<!-- END: Body-->
</html>
