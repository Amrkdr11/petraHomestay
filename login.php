<?php
session_start();
include 'db_connect.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data from the database
    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        // Redirect to the appropriate page
        if ($user['role'] === 'admin') {
            $_SESSION['is_admin'] = true;

            header('Location: admin/admin_dashboard.php');
            exit;
            
        } else {
            header('Location: home.php');
            exit;
        }
    } else {
        $_SESSION['error_message'] = 'Invalid email or password.';
        header('Location: loginform.php'); // Redirect back to the login form
        exit;    }
}
?>
