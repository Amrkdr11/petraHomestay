<?php
session_start();

include '../db_connect.php'; // Your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guestCount = $_POST['guest_count'];
    $bookingId = $_GET['booking_id']; // Ensure booking_id is correctly passed

    // Update the guest_count in the database
    $sql = "UPDATE bookings SET guest_count = ? WHERE booking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $guestCount, $bookingId);

    if ($stmt->execute()) {
        // Update successful
        $_SESSION['flash_message'] = "Booking updated successfully!";
        header("Location: bookings.php"); // Redirect to the page where you display bookings
        exit();
    } else {
        // Handle error
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

?>
