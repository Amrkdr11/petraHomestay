<?php
session_start();
include 'db_connect.php'; // Your database connection file

if (isset($_POST['payment'])) {
    $bookingId = $_POST['booking_id'];
    $totalAmount = $_POST['total_amount'];
    $paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : 'bank'; // Default to Bank if not selected
    $paymentDate = date('Y-m-d H:i:s');
    $paymentStatus = $paymentMethod === 'cash' ? 'Pending' : 'Completed'; // Set status based on payment method

    // Insert payment data into the database
    $sql = "INSERT INTO payments (booking_id, payment_date, amount, payment_method, payment_status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdss", $bookingId, $paymentDate, $totalAmount, $paymentMethod, $paymentStatus);

    if ($stmt->execute()) {
        // echo "Payment successful!";
        // Optionally, redirect to a confirmation page or booking summary page
        $_SESSION['flash_message'] = "booking confirmed!";
         header("Location: mybooking.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch booking details
$sql = "SELECT * FROM bookings WHERE booking_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookingId);
$stmt->execute();
$result = $stmt->get_result();

$booking = $result->fetch_assoc();

$stmt->close();
// $conn->close();
?>