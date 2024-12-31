<?php
include 'db_connect.php'; // Your database connection file

// The plain text password
$plainPassword = 'admin';

// Hash the password
$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

// Update the admin user's password in the database
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
$stmt->bind_param("ss", $hashedPassword, 'admin@gmail.com');

if ($stmt->execute()) {
    echo "Admin password updated successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
