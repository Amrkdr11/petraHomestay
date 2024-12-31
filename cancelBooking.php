<?php
session_start();
include 'db_connect.php'; // Your database connection file

// Check if user is logged in and booking_id is provided
if (!isset($_SESSION['user_id']) || !isset($_GET['booking_id'])) {
    die('Access denied');
}

$user_id = $_SESSION['user_id'];
$booking_id = $_GET['booking_id'];

// Prepare and bind the SQL statement to delete the booking
$stmt = $conn->prepare("DELETE FROM bookings WHERE booking_id = ? AND user_id = ?");
if ($stmt === false) {
    die('Error preparing statement: ' . $conn->error);
}

// Bind parameters to the statement
$stmt->bind_param("ii", $booking_id, $user_id);

// Execute the statement
if ($stmt->execute()) {
    // Check if any row was actually deleted
    if ($stmt->affected_rows > 0) {
        // Successfully deleted the booking
        $_SESSION['message'] = "Booking has been successfully deleted.";
    } else {
        $_SESSION['message'] = "No booking found or you don't have permission to delete this booking.";
    }
} else {
    $_SESSION['message'] = "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();

// Redirect to the bookings page or another appropriate page
header("Location: mybooking.php");
exit;
?>
