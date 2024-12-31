<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Simulated user data. Replace this with your actual database query.
$user = [
    'user_id' => 1,
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone_number' => '123456789',
    'address' => '1234 Petra Street, City, Country'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        // Update user details logic
        // For example, update the user details in the database
        // $query = "UPDATE users SET name=?, email=?, phone_number=?, address=? WHERE user_id=?";
        // Use prepared statements to execute the query

        // Simulate updating user data
        $user['name'] = $_POST['name'];
        $user['email'] = $_POST['email'];
        $user['phone_number'] = $_POST['phone_number'];
        $user['address'] = $_POST['address'];
        $message = "Profile updated successfully.";
    } elseif (isset($_POST['delete'])) {
        // Delete user account logic
        // For example, delete the user from the database
        // $query = "DELETE FROM users WHERE user_id=?";
        // Use prepared statements to execute the query

        // Simulate deleting user data and logging out
        session_destroy();
        header('Location: register.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Petra Homestay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .bg-blue-800 {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body class="bg-body-secondary">
    <header>
        <nav class="navbar navbar-expand-lg navbar-white bg-white py-4 border-bottom shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">Petra Homestay</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-3">
                            <a class="nav-link link-danger" href="home.php">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="rooms.php">Rooms</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="my_bookings.php">My Bookings</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="d-flex justify-content-end">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                    <?php else: ?>
                    <button type="button" class="btn btn-outline-danger mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Log in</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <main class="bg-body-secondary">
        <section id="home">
            <div class="container mt-4 mb-5">
                <h2>Personal Information</h2>
                <?php if (isset($message)): ?>
                    <div class="alert alert-success">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <form class="m-5 bg-light bg-gradient p-4 rounded-5" method="POST">
                    <h4>Personal Information</h4>
                    <div class="form-group p-2">
                        <label class="my-2">Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="my-2">Email address</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="my-2">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" value="<?php echo $user['phone_number']; ?>" required>
                    </div>
                    <div class="form-group p-2">
                        <label class="my-2">Address</label>
                        <input type="text" class="form-control" name="address" value="<?php echo $user['address']; ?>" required>
                    </div>
                    <div class="row d-flex justify-content-end mt-3">
                        <button type="submit" name="update" class="btn btn-primary m-2 w-25">Update</button>
                    </div>
                </form>

                <form class="m-5 bg-light bg-gradient p-4 rounded-5" method="POST">
                    <h4>Delete Account</h4>
                    <div class="form-group">
                        <label for="exampleInputPassword1">
                            Are you sure you want to delete your account? This action is irreversible and all your data will be permanently deleted.
                        </label>
                    </div>
                    <div class="row d-flex justify-content-end mt-3">
                        <button type="submit" name="delete" class="btn btn-danger m-2 w-25">Delete</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer class="bg-blue-800">
        <div class="container p-3 text-center">&copy; 2024 Petra Homestay</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+PQdheLUVOQfIRyB8NfY5lS0QJpft" crossorigin="anonymous"></script>
</body>
</html>
