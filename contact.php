<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include './layouts/header.php';?>


<body class="bg-body-secondary">
    <header>
    <?php include './layouts/navbar.php';?>
    </header>

    <main class="bg-body-secondary">
        <section id="contact" class="py-5">
            <div class="container px-5">
                <h2>Contact Us</h2>
                <p>We would love to hear from you! Whether you have a question about our services, need assistance with booking, or just want to share your experience with us, feel free to reach out.</p>
                
                <h4>Contact Information</h4>
                <p>Email: info@petrahomestay.com<br> Phone: +123 456 7890</p>
                
                <h4>Our Location</h4>
                <p>1234 Petra Street,<br> City, Country</p>
                
                <h4>Follow Us</h4>
                <p>
                    <a href="tel:+1234567890" class="text-danger me-3"><i class="fas fa-phone-alt"></i> Call Us</a>
                    <a href="https://facebook.com" target="_blank" class="text-danger me-3"><i class="fab fa-facebook-f"></i> Facebook</a>
                    <a href="https://instagram.com" target="_blank" class="text-danger me-3"><i class="fab fa-instagram"></i> Instagram</a>
                    <a href="https://tiktok.com" target="_blank" class="text-danger"><i class="fab fa-tiktok"></i> TikTok</a>
                </p>
                
                <div class="map-container mt-5">
                    <h4>Map to Petra Homestay</h4>
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
