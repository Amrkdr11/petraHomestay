<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Availability Calendar - Petra Homestay</title>
    <!-- FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS (remove if not available) -->
    <!-- <link rel="stylesheet" href="styles.css" /> -->
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
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
    <main class="bg-body-secondary py-5">
        <div class="container">
            <h2>Availability Calendar</h2>
            <div id="calendar"></div>
        </div>
    </main>
    <footer class="bg-blue-800">
        <div class="container p-3 text-center">&copy; 2024 Petra Homestay</div>
    </footer>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS to initialize the calendar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    // Sample events, you can replace these with dynamic data from a database
                    {
                        title: 'Booked',
                        start: '2024-06-01',
                        end: '2024-06-05',
                        color: '#FF0000'
                    },
                    {
                        title: 'Booked',
                        start: '2024-06-10',
                        end: '2024-06-12',
                        color: '#FF0000'
                    }
                ]
            });

            calendar.render();
        });
    </script>
</body>

</html>
