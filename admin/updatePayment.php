<?php
session_start();

include '../db_connect.php'; // Your database connection file

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['payment_id'])) {
    $paymentId = $_GET['payment_id'];

    // Update the payment status to 'Completed' in the database
    $sql = "UPDATE payments SET payment_status = 'Completed' WHERE payment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $paymentId);

    if ($stmt->execute()) {
        // Update successful
        $_SESSION['flash_message'] = 'Payment status updated.';
    } else {
        // Handle error
        $_SESSION['flash_message'] = 'Error updating payment status: ' . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the page where you display payments
    header("Location: payments.php");
    exit();
} else {
    // Redirect to an error page or handle invalid request
    header("Location: error.php");
    exit();
}
?>
