<?php
session_start();

include '../db_connect.php'; // Your database connection file

$user_data = check_login($conn);
$userID = $user_data['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_account'])) {
    // Perform delete operation securely
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userID);

    if ($stmt->execute()) {
        // Account deleted successfully
        session_destroy(); // Destroy all sessions
        $_SESSION['flash_message'] = "Your account has been successfully deleted.";
        header("Location: ../home.php"); // Redirect to your login or home page
        exit();
    } else {
        // Handle delete operation failure
        $_SESSION['flash_message'] = "Failed to delete account. Please try again.";
        header("Location: profile.php"); // Redirect back to profile page with error message
        exit();
    }
} else {
    // Redirect unauthorized access or invalid method requests
    header("Location: profile.php");
    exit();
}
?>
