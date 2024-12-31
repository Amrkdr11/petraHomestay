<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include './layouts/header.php';?>


<body class="bg-body-secondary">
    <header>
    <?php include './layouts/navbar.php'; ?>
    </header>

    <main class="bg-body-secondary">
        <section id="about" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="images/aboutus.jpg" class="img-fluid rounded" alt="About Us">
                    </div>
                    <div class="col-md-6">
                        <h2>About Us</h2>
                        <p>Welcome to Petra Homestay, your home away from home. Nestled in a serene and picturesque location, we offer a perfect getaway destination for families, couples, and solo travelers alike. Our homestay is designed to provide a comfortable and memorable stay with modern amenities and warm hospitality.</p>
                        <p>Our mission is to offer a unique blend of comfort and luxury, ensuring that every guest experiences the best of both worlds. Whether you are here for a short stay or an extended vacation, Petra Homestay is committed to making your stay enjoyable and unforgettable.</p>
                        <h4>Our Story</h4>
                        <p>Founded in 2020, Petra Homestay was born out of a passion for hospitality and a desire to create a welcoming space for travelers from around the world. Our team is dedicated to providing exceptional service, making sure that every guest feels at home from the moment they arrive.</p>
                        <h4>Why Choose Us?</h4>
                        <ul>
                            <li>Prime Location: Conveniently located near major attractions and transportation hubs.</li>
                            <li>Comfortable Accommodations: Spacious rooms with modern amenities and beautiful views.</li>
                            <li>Exceptional Service: Friendly and attentive staff ready to assist you with all your needs.</li>
                            <li>Value for Money: Competitive rates with no compromise on quality.</li>
                        </ul>
                    </div>
                </div>

                <h4 class="mt-5">Map to Petra Homestay</h4>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.389588033349!2d-122.08424968469145!3d37.42206597982444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb5e3a39bcaeb%3A0xa7d3a1d75e45a7a5!2sGoogleplex!5e0!3m2!1sen!2sus!4v1626218567458!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </section>
    </main>
    <?php include './layouts/modals.php';?>   


    <?php include './layouts/footer.php';?>   

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+PQdheLUVOQfIRyB8NfY5lS0QJpft" crossorigin="anonymous">
    </script>
</body>

</html>
