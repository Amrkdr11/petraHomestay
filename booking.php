<?php
session_start();
include 'db_connect.php';

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);

// Fetch confirmed bookings' check-in and check-out dates
$query = "SELECT checkin, checkout FROM bookings";
$result = mysqli_query($conn, $query);

// Store the dates in an array
$dates = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dates[] = [
        'checkin' => $row['checkin'],
        'checkout' => $row['checkout']
    ];
}

// Encode dates array for JavaScript usage
echo "<script>var bookingDates = " . json_encode($dates) . ";</script>";
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
                        <img
                          src="images/banner.png"
                          class="d-block w-100 h-100 rounded-4"
                          alt="..."
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="p-3">
                        <h3>Deluxe Room</h3>
                        <p>
                          Experience unparalleled comfort and elegance in our Deluxe
                          Room, featuring luxurious furnishings, modern amenities, and
                          stunning views for an unforgettable stay.
                        </p>
                  </div>
                </div>
                <div class="row">
                    <ul class="mx-3" style="list-style: none;">
                        <li class="mb-2"><i class="fas fa-wifi"></i> Fast wifi at 119 Mbps</li>
                        <li class="mb-2" ><i class="fas fa-laptop"></i> Dedicated workspace</li>
                        <li class="mb-2"><i class="fas fa-lock"></i> Self check-in with lockbox</li>
                      </ul>
                </div>
              </div>
              <div class="col-6">
              <form action="addBooking.php" method="post" class="row g-3 p-5 mx-5 bg-light bg-gradient rounded-5">
                <div class="col-12">
                    <div class="container">
                        <div id="calendar"></div>
                    </div>                
                </div>
                <?php
                    if (isset($errors['date_conflict'])) {
                        echo '<div class="alert alert-danger">' . $errors['date_conflict'] . '</div>';
                    }
                ?>
                    <div class="col-md-6">
                        <label for="checkin" class="form-label">Check in</label>
                        <input type="date" name="checkin" class="form-control" id="checkin" onchange="calculateTotal()" min="<?php echo date('Y-m-d'); ?>" required>
                            
                        </div>
                    <div class="col-md-6">
                        <label for="checkout" class="form-label">Check out</label>
                        <input type="date" name="checkout" class="form-control" id="checkout" onchange="calculateTotal()"  min="<?php echo date('Y-m-d'); ?>" required>
                        
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Guest</label>
                        <input type="number" name= "guest_count" class="form-control" id="inputAddress" placeholder="input total guest" min ='1' required>
                       
                    </div>

                    <div class="row mt-4">
                        <div class="col d-flex justify-content-between">
                            <div>RM 100 x <span id="nights">0</span> nights</div>
                            <div id="subtotal">RM 0</div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col d-flex justify-content-between">
                            <div>Cleaning fee</div>
                            <div>RM 40</div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2 mb-2">
                        <div class="col d-flex justify-content-between">
                            <h4>Total</h4>
                            <h4 id="total">RM 0</h4>
                        </div>
                    </div>
                    <div id="error" class="text-danger"></div>


                    <div class="col d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-75 p-2">Reserve</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
            
          </section>

      


          <?php include './layouts/modals.php';?>   


        <?php include './layouts/footer.php';?>   

        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+PQdheLUVOQfIRyB8NfY5lS0QJpft" crossorigin="anonymous">
        </script>

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

                } 
                else if (checkinDate < checkoutDate){
                    document.getElementById('error').textContent = "";

                    if (nights > 0) {
                        const nightlyRate = 100;
                        const cleaningFee = 40;
                        const subtotal = nights * nightlyRate;
                        const total = subtotal + cleaningFee;
                        
                        document.getElementById('nights').textContent = nights;
                        document.getElementById('subtotal').textContent = `RM ${subtotal}`;
                        document.getElementById('total').textContent = `RM ${total}`;
                    } 
                    else 
                    {
                        document.getElementById('nights').textContent = 0;
                        document.getElementById('subtotal').textContent = 'RM 0';
                        document.getElementById('total').textContent = 'RM 0';
                    }
                }
            }
        </script>

            <!-- <?php 
            $fetch_event = mysqli_query($conn, "SELECT * FROM BOOKINGS");
            ?> -->
            <script>
             $(document).ready(function() {
            $('#calendar').fullCalendar({
                events: bookingDates.map(date => ({
                    start: date.checkin,
                    end: moment(date.checkout).add(1, 'days').format('YYYY-MM-DD'),
                    color: 'yellow',
                    textColor: 'black'
                }))
            });
            });
            </script>
</body>

</html>
