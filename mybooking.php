<?php
session_start();
include 'db_connect.php'; // Your database connection file

$user_data = check_login($conn);
$userID = $user_data['id'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM bookings WHERE user_id = ?");
$stmt->bind_param("i", $userID);
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
<?php include './layouts/header.php';?>



<body class="bg-body-secondary">
    <header>
        <?php include './layouts/navbar.php';?>
    </header>

    <main class="bg-body-secondary">
        <div class="container">
            <section class="py-5">
            <?php if ($flashMessage): ?>
                <div class="alert alert-success" id="flash-message">
                    <?php echo $flashMessage; ?>
                </div>
            <?php endif; ?>
            <h2>My Bookings</h2>
            <div class="table-responsive bg-light p-3 rounded-4 mt-3">
                <table id="bookingsTable" class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Booking ID</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Guest Number</th>
                            <th>Total Price</th>
                            <th colspan = '2'>Action</th>
                            <!-- <th></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['booking_id'] . "</td>";
                            echo "<td>" . $row['checkin'] . "</td>";
                            echo "<td>" . $row['checkout'] . "</td>";
                            echo "<td>" . $row['guest_count'] . "</td>";
                            echo "<td>" .'RM '. $row['total'] . "</td>";
                            echo "<td>";
                            echo "<a href='viewBooking.php?booking_id=" . $row['booking_id'] . "' class='btn btn-info btn-sm'>";
                            echo "<i class='fas fa-eye'></i>"; // Icon for view
                            echo "</a>";
                            echo "</td>";
                            echo "<td>";
                            
                            // Show cancel button only if booking status is not 'cancelled'
                            if ($row['booking_status'] != 'Cancelled') {
                                echo "<a href='cancelBooking.php?booking_id=" . $row['booking_id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to cancel this booking?\");'>";
                                echo "<i class='fas fa-trash'></i>"; // Replace with appropriate icon class
                                echo "</a>";                            }
                            
                            echo "</td>";
                           
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </section>
        </div>
    </main>

    <?php include './layouts/modals.php';?>
    <?php include './layouts/footer.php';?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+PQdheLUVOQfIRyB8NfY5lS0QJpft" crossorigin="anonymous"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- JavaScript to hide flash message after 3 seconds -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var flashMessage = document.getElementById("flash-message");
                if (flashMessage) {
                    flashMessage.style.transition = "opacity 1s ease";
                    flashMessage.style.opacity = "0";
                    setTimeout(function() {
                        flashMessage.style.display = "none";
                    }, 1000);
                }
            }, 3000);

            // Initialize DataTables
            $('#bookingsTable').DataTable();
        });
    </script>
</body>

</html>
