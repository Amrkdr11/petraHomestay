<?php
session_start();

include '../db_connect.php'; // Your database connection file

$user_data = check_login($conn); // Assuming check_login function retrieves user info
$userID = $user_data['id']; // Assuming 'id' is the primary key for users table

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Use prepared statement to update user information
    $sql = "UPDATE users SET name = ?, email = ?, phone_number = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $userID);

    if ($stmt->execute()) {
        // Update successful
        $_SESSION['flash_message'] = 'Profile updated successfully.';
    } else {
        // Handle error
        $_SESSION['flash_message'] = 'Error updating profile: ' . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the profile page
    header("Location: profile.php");
    exit();
} else {
    // Redirect to an error page or handle invalid request
    header("Location: error.php");
    exit();
}
?>
