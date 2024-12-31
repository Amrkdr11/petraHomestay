<?php
session_start();
include '../db_connect.php'; // Your database connection file

$user_data = check_login($conn);

// Initialize an array to store validation errors
$errors = [];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate form data
    if (empty($_POST['checkin'])) {
        $errors['checkin'] = "Check-in date is required";
    }
    if (empty($_POST['checkout'])) {
        $errors['checkout'] = "Check-out date is required";
    }
    if (empty($_POST['guest_count'])) {
        $errors['guest_count'] = "Guest number is required";
    }

    // Proceed if there are no validation errors
    if (empty($errors)) {
        // Retrieve form data
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $guest_count = $_POST['guest_count'];
        $user_id = $_POST['user_id'];  // Assuming user_id is stored in session after login

        // Check for date conflicts
        $stmt = $conn->prepare("SELECT * FROM bookings WHERE (checkin <= ? AND checkout >= ?) OR (checkin <= ? AND checkout >= ?)");
        
        // Check if preparation succeeded
        if ($stmt === false) {
            die('Error preparing statement: ' . $conn->error);
        }

        // Bind parameters to the statement
        $stmt->bind_param("ssss", $checkout, $checkin, $checkout, $checkin);

        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors['date_conflict'] = "The selected dates are already booked. Please choose different dates.";
        }

        $stmt->close();

        // Proceed if there are still no validation errors
        if (empty($errors)) {
            // Calculate nights, subtotal, and total
            $checkinDate = new DateTime($checkin);
            $checkoutDate = new DateTime($checkout);
            $nights = $checkinDate->diff($checkoutDate)->days;
            $nightlyRate = 100.00;
            $cleaningFee = 40.00;
            $subtotal = $nights * $nightlyRate;
            $total = $subtotal + $cleaningFee;

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO bookings (checkin, checkout, guest_count, nightly_rate, cleaning_fee, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
            
            // Check if preparation succeeded
            if ($stmt === false) {
                die('Error preparing statement: ' . $conn->error);
            }

            // Bind parameters to the statement
            $stmt->bind_param("ssiidi", $checkin, $checkout, $guest_count, $nightlyRate, $cleaningFee, $user_id);

            // Execute the statement
            if ($stmt->execute()) {
                // After successful booking creation
                $booking_id = $conn->insert_id; // Assuming $conn is your database connection and insert_id gives you the last inserted ID

                // Redirect to payment page with booking ID as parameter
                header("Location: addPayment.php?booking_id=" . $booking_id);
                exit;
            } else {
                $errors['db_error'] = "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
    }

    // Store validation errors in session
    $_SESSION['errors'] = $errors;

    // Redirect to the target page
    header("Location: addBooking.php");
    exit;
}
?>
