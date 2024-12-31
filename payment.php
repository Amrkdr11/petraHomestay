<?php
session_start();
include 'db_connect.php'; // Your database connection file

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
<?php include './layouts/header.php';?>


<body class="bg-body-secondary">
    <header>
    <?php include './layouts/navbar.php';?>

    </header>

    <!-- Main Content Sections -->
    <main class="bg-body-secondary">
        <section id="home">
            <div class="container mt-4 mb-5">
                <h2>Payment</h2>
                <form action="paymentProcess.php" method="post">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="py-3">
                            <h3>Your trip</h3>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>Date</h5>
                                <p><?php echo date("M d", strtotime($booking['checkin'])) . " - " . date("d", strtotime($booking['checkout'])); ?></p>
                            </div>
                            <!-- <a href="#">Edit</a> -->
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>Guests</h5>
                                <p><?php echo $booking['guest_count']; ?> Guests</p>
                            </div>
                            <!-- <a href="#">Edit</a> -->
                        </div>
                        <hr />
                        <!-- Payment method -->
                        <div>
                            <div class="mb-4">
                                <h3>Payment Method</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="form-check w-100">
                                                <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod1" value="cash"/>
                                                <label class="form-check-label d-flex align-items-center justify-content-between" for="paymentMethod1">
                                                    Cash (pay later)<i class="bi bi-cash-coin me-2"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="form-check w-100">
                                                <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod2" value="bank"checked />
                                                <label class="form-check-label d-flex align-items-center justify-content-between" for="paymentMethod2">
                                                    Bank<i class="bi bi-bank me-2"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="row g-3 p-4 mx-0 mx-md-5 bg-light bg-gradient rounded-5">
                            <div class="col-12">
                                <img src="images/banner.png" class="d-block w-100 rounded-4" alt="..." />
                                <h4 class="mt-4">Deluxe Room</h4>
                            </div>
                            <hr />
                            <div class="col-12">
                                <h4>Price details</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col d-flex justify-content-between">
                                    <div>RM <?php echo $booking['nightly_rate']; ?> x <?php echo (strtotime($booking['checkout']) - strtotime($booking['checkin'])) / (60 * 60 * 24); ?> nights</div>
                                    <div>RM <?php echo $booking['nightly_rate'] * ((strtotime($booking['checkout']) - strtotime($booking['checkin'])) / (60 * 60 * 24)); ?></div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col d-flex justify-content-between">
                                    <div>Cleaning fee</div>
                                    <div>RM <?php echo $booking['cleaning_fee']; ?></div>
                                </div>
                            </div>
                            <hr />
                            <div class="row mt-2 mb-2">
                                <div class="col d-flex justify-content-between">
                                    <h4>Total</h4>
                                    <h4>RM <?php echo ($booking['nightly_rate'] * ((strtotime($booking['checkout']) - strtotime($booking['checkin'])) / (60 * 60 * 24))) + $booking['cleaning_fee']; ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- Hidden fields to pass data -->
                        <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">
                        <input type="hidden" name="total_amount" value="<?php echo ($booking['nightly_rate'] * ((strtotime($booking['checkout']) - strtotime($booking['checkin'])) / (60 * 60 * 24))) + $booking['cleaning_fee']; ?>">

                        <div class="col d-flex justify-content-center m-5">
                            <button type="submit" name="payment" class="btn btn-primary w-50 p-3">
                                Payment
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </section>
    </main>

    <?php include './layouts/modals.php';?>   


    <?php include './layouts/footer.php';?>   

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+PQdheLUVOQfIRyB8NfY5lS0QJpft" crossorigin="anonymous"></script>
</body>
</html>


<?php


?>