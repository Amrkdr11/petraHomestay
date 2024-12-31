<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include './layouts/header.php';?>


<body class="bg-body-secondary">
    <header>
        <?php 
            include './layouts/navbar.php';
?>
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
                            <h4>Book your reservation now.</h4>
                                <a href="booking.php">
                                    <div class="ms-auto py-3">
                                        <button class="btn btn-danger">Book Now</button>

                                    </div>
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="py-5 bg-light.bg-gradient">
            <div class="container px-5">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6 width-50">
                        <div class="service-details text-center">
                            <div class="service-image">
                                <img alt="image" class="img-responsive" src="images/icons/wifi.png">
                            </div>
                            <h4>Free Wifi</h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 width-50">
                        <div class="service-details text-center">
                            <div class="service-image">
                                <img alt="image" class="img-responsive" src="images/icons/key.png">
                            </div>
                            <h4>Room Service</h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 mt-25">
                        <div class="service-details text-center">
                            <div class="service-image">
                                <img alt="image" class="img-responsive" src="images/icons/car.png">
                            </div>
                            <h4>Free Parking</h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 mt-25">
                        <div class="service-details text-center">
                            <div class="service-image">
                                <img alt="image" class="img-responsive" src="images/icons/user.png">
                            </div>
                            <h4>Customer Support</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include './layouts/footer.php';?>   

    
    <?php include './layouts/modals.php';?>   


    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+PQdheLUVOQfIRyB8NfY5lS0QJpft" crossorigin="anonymous">
    </script>
</body>

</html>
