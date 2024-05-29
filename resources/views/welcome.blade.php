<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
                            <a class="nav-link link-danger" href="#home">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="#rooms">Rooms</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="#services">Services</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
                {{-- <div class="ms-auto">
                    <button class="btn btn-outline-danger">Sign In</button>
                </div> --}}

                <div class="d-flex justify-content-end">
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Dashboard
                                </a>
                            @else
                                <button type="button" onclick="window.location='{{ route('login') }}'"
                                    class="btn btn-outline-danger">
                                    Log in
                                </button>


                                @if (Route::has('register'))
                                    <button type="button" onclick="window.location='{{ route('register') }}'"
                                        class="btn btn-outline-danger">
                                        Register </button>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </nav>
    </header>
    <!-- Main Content Sections -->
    <main class="bg-body-secondary">
        <section id="home" class="py-5">
            <div class="container">
                <h2>Welcome to Homestay Paradise</h2>
                <p>Your perfect getaway destination!</p>
                <!-- Carousel -->
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/banner.png" class="d-block w-100 rounded-4" alt="..." />
                        </div>
                        <div class="carousel-item">
                            <img src="images/banner2.png" class="d-block w-100 rounded-4" alt="..." />
                        </div>
                        <div class="carousel-item">
                            <img src="images/banner3.png" class="d-block w-100 rounded-4" alt="..." />
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        <section id="about" class="py-5 bg-light.bg-gradient">
            <div class="container px-5">
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="vacation-offer-details">
                            <h1>Welcome to Petra Homestay</h1>
                            <h4>Book your reservartion now.</h4>
                            <div class="ms-auto py-3">
                                <button class="btn btn-danger">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="py-5 bg-light.bg-gradient">
            <div class="container px-5">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6 width-50">
                        <div class="service-details text-center">
                            <div class="service-image">
                                <img alt="image" class="img-responsive" src="images/icons/wifi.png">
                            </div>
                            <h4><a>free wifi</a></h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 width-50">
                        <div class="service-details text-center">
                            <div class="service-image">
                                <img alt="image" class="img-responsive" src="images/icons/key.png">
                            </div>
                            <h4><a>room service</a></h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 mt-25">
                        <div class="service-details text-center">
                            <div class="service-image">
                                <img alt="image" class="img-responsive" src="images/icons/car.png">
                            </div>
                            <h4><a>free parking</a></h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 mt-25">
                        <div class="service-details text-center">
                            <div class="service-image">
                                <img alt="image" class="img-responsive" src="images/icons/user.png">
                            </div>
                            <h4><a>customer support</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <footer>
            <div class="container">
                <p>&copy; 2024 Petra Homestay</p>
            </div>
        </footer>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+PQdheLUVOQfIRyB8NfY5lS0QJpft" crossorigin="anonymous">
        </script>
</body>

</html>
