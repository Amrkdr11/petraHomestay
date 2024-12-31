<?php
session_start();
include 'db_connect.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $role = 'user'; // Default role

    // Check if the email is already registered
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['flash_message'] = "This email is already registered.";
        $_SESSION['flash_message_type'] = "error";
        header("Location: register.php");
    } else {
        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone_number, address, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $password, $phone_number, $address, $role);
        $stmt->execute();

        $_SESSION['flash_message'] = "Account registered!";
        $_SESSION['flash_message_type'] = "success";
        header("Location: loginform.php");
    }
    exit();
}
?>
