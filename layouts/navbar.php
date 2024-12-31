<nav class="navbar navbar-expand-lg navbar-white bg-white py-4 border-bottom shadow-sm">
    <div class="container">
            <div class="horizontal-logo text-left">
              <svg
                height="20pt"
                preserveAspectRatio="xMidYMid meet"
                viewBox="0 0 512 512"
                width="20pt"
                xmlns="http://www.w3.org/2000/svg"
              >
                <g transform="matrix(.1 0 0 -.1 0 512)" fill="#1e3d73">
                  <path
                    d="m1450 4481-1105-638v-1283-1283l1106-638c1033-597 1139-654 1139-619 0 4-385 674-855 1489-470 814-855 1484-855 1488 0 8 1303 763 1418 822 175 89 413 166 585 190 114 16 299 13 408-5 100-17 231-60 314-102 310-156 569-509 651-887 23-105 23-331 0-432-53-240-177-460-366-651-174-175-277-247-738-512-177-102-322-189-322-193s104-188 231-407l231-400 46 28c26 15 360 207 742 428l695 402v1282 1282l-1105 639c-608 351-1107 638-1110 638s-502-287-1110-638z"
                  />
                  <path
                    d="m2833 3300c-82-12-190-48-282-95-73-36-637-358-648-369-3-3 580-1022 592-1034 5-5 596 338 673 391 100 69 220 197 260 280 82 167 76 324-19 507-95 184-233 291-411 320-70 11-89 11-165 0z"
                  />
                </g>
              </svg>
              <span class="h6 font-weight-bold align-self-center mb-0 ml-auto"
                >Petra Homestay</span
              >
            </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item mx-3 <?php echo (basename($_SERVER['PHP_SELF']) == 'home.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item mx-3 <?php echo (basename($_SERVER['PHP_SELF']) == 'booking.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="booking.php">Booking</a>
                </li>
                <li class="nav-item mx-3 <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item mx-3 <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <li class="nav-item mx-3 <?php echo (basename($_SERVER['PHP_SELF']) == 'mybooking.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="mybooking.php">My Bookings</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="d-flex justify-content-end">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                <a href="logout.php" class="btn btn-outline-danger">Logout</a>
            <?php else: ?>
                <a href="loginform.php">
                    <button type="button" class="btn btn-outline-danger mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Log in
                    </button>
                </a>
                <a href="registerForm.php">
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registerModal">
                        Register
                    </button>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
