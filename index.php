<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky G Event Place</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="static/main.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Lucky G Event Place</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about-us">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <!-- Right-aligned login button -->
                <ul class="navbar-nav ms-auto">
                    <!-- Login Link -->
                    <li class="nav-item">
                        <a class="nav-link login-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="bi bi-person"></i> Login
                        </a>
                    </li>
                    <!-- Sign Up Link -->
                    <li class="nav-item">
                        <a class="nav-link sign-up-link" href="#" data-bs-toggle="modal" data-bs-target="#signUpModal">
                            <i class="bi bi-person-plus"></i> Sign Up
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="home" id="home">
        <h1>Make Your Events Memorable</h1>
        <button class="btn btn-book-now" data-bs-toggle="modal" data-bs-target="#loginModal">Book now</button>
    </section>

    <!-- About Us Section -->
    <section id="about-us" class="about">
        <div class="container" data-aos="fade-up" data-aos-duration="2000">
            <h2 class="section-title">About Us</h2>
            <p class="section-description">Lucky G Event Place is the ideal destination for celebrating your special
                moments. We offer a stunning venue with modern amenities to make your event unforgettable.</p>
            <div class="row align-items-center">
                <!-- Image Column (Left) -->
                <div class="col-md-5">
                    <img src="./templates/admin/images/lucky.jpg" class="img-fluid" alt="Venue Image">
                </div>
                <!-- Description Column (Right) -->
                <div class="col-md-5">
                    <h5 class="card-title">Venue</h5>
                    <p class="card-text">Our venue is equipped with state-of-the-art facilities for all your event
                        needs.We offer modern, spacious rooms, customizable layouts, and the latest technology to make
                        your event memorable. Our professional staff is dedicated to ensuring every detail is perfect
                        for your occasion.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up" data-aos-duration="2000">
            <h2 class="section-title">Services</h2>
            <p class="section-description">We offer a variety of services to ensure your event goes smoothly. From
                catering to event planning, we are here to help!</p>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <img src="static/images/image3.jpg" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title">Catering</h5>
                            <p class="card-text">Delicious catering options for all types of events, tailored to your
                                taste.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="static/images/image4.jpg" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title">Event Planning</h5>
                            <p class="card-text">Full event planning services to ensure everything runs smoothly on your
                                special day.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="static/images/image5.jpg" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title">Music & Entertainment</h5>
                            <p class="card-text">Entertainment options to keep your guests engaged and enjoying the
                                celebration.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery">
        <div class="container" data-aos="fade-up" data-aos-duration="2000">
            <h2 class="section-title">Gallery</h2>
            <p class="section-description">Take a look at some of the beautiful events hosted at Lucky G Event Place. We
                capture every memorable moment!</p>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <img src="static/images/i2.jpg" class="card-img-top" alt="Image">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="static/images/i8.jpg" class="card-img-top" alt="Image">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="static/images/i11.jpg" class="card-img-top" alt="Image">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <img src="static/images/i7.jpg" class="card-img-top" alt="Image">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="static/images/i1.jpg" class="card-img-top" alt="Image">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="static/images/i9.jpg" class="card-img-top" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <p class="section-description">Get in touch with us to book your next event or ask any questions. We’re here
                to help!</p>
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h5>Pakil, Lag.</h5>
                    <p>123 Event Place, City, Country</p>
                    <h5>Phone</h5>
                    <p>(123) 456-7890</p>
                    <h5>Email</h5>
                    <p>info@luckyeventplace.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Sitemap Section -->
                <div class="col-md-6">
                    <h5 class="footer-title">Sitemap</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Gallery</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <!-- Social Media Section -->
                <div class="col-md-6">
                    <h5 class="footer-title">Follow Us</h5>
                    <ul class="list-unstyled social-media-links">
                        <li><a href="#" class="social-link"><i class="bi bi-facebook"></i> Facebook</a></li>
                        <li><a href="#" class="social-link"><i class="bi bi-twitter"></i> Twitter</a></li>
                        <li><a href="#" class="social-link"><i class="bi bi-instagram"></i> Instagram</a></li>
                        <li><a href="#" class="social-link"><i class="bi bi-youtube"></i> YouTube</a></li>
                        <li><a href="#" class="social-link"><i class="bi bi-linkedin"></i> LinkedIn</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; 2024 Lucky G Event Place. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="bi bi-box-arrow-in-right fs-3 me-2"></i> <!-- Login Icon -->
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="templates/login.php" method="POST">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="loginEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="bi bi-person-plus fs-3 me-2"></i> <!-- Sign Up Icon -->
                    <h5 class="modal-title" id="signUpModalLabel">Sign Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="templates/sign_up.php" method="POST">
                        <div class="mb-3">
                            <label for="signUpName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="signUpName" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="signUpEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="signUpEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="signUpPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="signUpPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="signUpConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="signUpConfirmPassword"
                                name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>