<?php
session_start();

include '../db_connect.php'; // Your database connection file

if (isset($_GET['booking_id'])) {
    $bookingID = $_GET['booking_id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM bookings WHERE booking_id = ?");
    $stmt->bind_param("i", $bookingID);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = "Booking successfully deleted.";
    } else {
        $_SESSION['flash_message'] = "Failed to delete booking.";
    }

    $stmt->close();
    $conn->close();

    header("Location: bookings.php");
    exit();
} else {
    $_SESSION['flash_message'] = "Invalid booking ID.";
    header("Location: bookings.php");
    exit();
}
?>
