<?php 
session_start(); 
include 'db_connect.php'; 
$user_data = check_login($conn);
$bookID = $_GET['booking_id'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_id = ?");
$stmt->bind_param("i", $bookID);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_assoc();
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
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="g-col-3">
                                <img src="images/banner.png" class="d-block w-100 h-100 rounded-4" alt="..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="p-3">
                                <h3>Deluxe Room</h3>
                                <p>
                                    Experience unparalleled comfort and elegance in our Deluxe Room, featuring luxurious furnishings, modern amenities, and stunning views for an unforgettable stay.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <ul class="mx-3" style="list-style: none;">
                                <li class="mb-2"><i class="fas fa-wifi"></i> Fast wifi at 119 Mbps</li>
                                <li class="mb-2"><i class="fas fa-laptop"></i> Dedicated workspace</li>
                                <li class="mb-2"><i class="fas fa-lock"></i> Self check-in with lockbox</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row g-3 p-5 mx-5 bg-light bg-gradient rounded-5">
                            <div class="col-md-6">
                                <h4>Check in</h4>
                                <label for="checkin" class="form-label" id="checkin"><?php echo date('d-m-Y', strtotime($rows['checkin']));?></label>
                            </div>
                            <div class="col-md-6">
                                <h4>Check out</h4>
                                <label for="checkout" class="form-label" id="checkout"><?php echo date('d-m-Y', strtotime($rows['checkout']));?></label>
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Guest: <?php echo $rows['guest_count'];?></label>
                            </div>
                            <div class="row mt-4">
                                <div class="col d-flex justify-content-between">
                                    <div>RM<?php echo $rows['nightly_rate'];?> x <span id="nights">0</span> nights</div>
                                    <div id="subtotal"><?php echo $rows['subtotal'];?></div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col d-flex justify-content-between">
                                    <div>Cleaning fee</div>
                                    <div><?php echo $rows['cleaning_fee'];?></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-2 mb-2">
                                <div class="col d-flex justify-content-between">
                                    <h4>Total</h4>
                                    <h4 id="total"><?php echo $rows['total'];?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include './layouts/modals.php';?>
        <?php include './layouts/footer.php';?>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+PQdheLUVOQfIRyB8NfY5lS0QJpft" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                calculateTotal();
            });

            function calculateTotal() {
                const checkinDate = new Date('<?php echo $rows['checkin'];?>');
                const checkoutDate = new Date('<?php echo $rows['checkout'];?>');
                const oneDay = 24 * 60 * 60 * 1000;
                const nights = Math.round((checkoutDate - checkinDate) / oneDay);

                if (nights > 0) {
                    const nightlyRate = <?php echo $rows['nightly_rate'];?>;
                    const cleaningFee = <?php echo $rows['cleaning_fee'];?>;
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
            
        
        </script>
</body>
</html>
