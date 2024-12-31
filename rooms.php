<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Petra Homestay</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link link-danger" href="rooms.php">Rooms</a>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="my_bookings.php">My Bookings</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="d-flex justify-content-end">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                    <?php else: ?>
                    <button type="button" class="btn btn-outline-danger mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Log in
                    </button>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registerModal">
                        Register
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <!-- Main Content Sections -->
    <main class="bg-body-secondary">
        <section id="home">
            <div class="container mb-5 mt-5">
              <div class="flex grid justify-content-between">
                <div class="g-col-3">
                  <img
                    src="images/banner.png"
                    class="d-block w-100 h-100 rounded-4"
                    alt="..."
                    style="object-fit: cover; aspect-ratio: 1 / 1"
                  />
                </div>
                <div class="g-col-7 px-6">
                  <div class="p-3">
                    <h3>Deluxe Room</h3>
                    <p>
                      Experience unparalleled comfort and elegance in our Deluxe
                      Room, featuring luxurious furnishings, modern amenities, and
                      stunning views for an unforgettable stay.
                    </p>
                    <h5><b>RM75</b> per night</h5>
                  </div>
                </div>
                <div class="g-col-2 mt-auto p-2">
                  <button class="btn btn-danger p-3 rounded-4">Book Now</button>
                </div>
              </div>
            </div>
            <hr />
            <div class="container mb-5 mt-5">
                <div class="flex grid justify-content-between">
                  <div class="g-col-3">
                    <img
                      src="images/banner.png"
                      class="d-block w-100 h-100 rounded-4"
                      alt="..."
                      style="object-fit: cover; aspect-ratio: 1 / 1"
                    />
                  </div>
                  <div class="g-col-7 px-6">
                    <div class="p-3">
                      <h3>Deluxe Room</h3>
                      <p>
                        Experience unparalleled comfort and elegance in our Deluxe
                        Room, featuring luxurious furnishings, modern amenities, and
                        stunning views for an unforgettable stay.
                      </p>
                      <h5><b>RM75</b> per night</h5>
                    </div>
                  </div>
                  <div class="g-col-2 mt-auto p-2">
                    <button class="btn btn-danger p-3 rounded-4">Book Now</button>
                  </div>
                </div>
              </div>
          </section>

    <!-- Modals -->
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Log in</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="loginEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-danger">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="register.php" method="POST">
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="registerEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-danger">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-blue-800 ">
        <div class="container p-3 align-items-center">
            &copy; 2024 Petra Homestay
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+PQdheLUVOQfIRyB8NfY5lS0QJpft" crossorigin="anonymous">
    </script>
</body>

</html>
