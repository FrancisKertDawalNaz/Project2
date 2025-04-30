<?php
// Start the session securely
session_start();
session_regenerate_id(true);

// Include database connection
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Booking</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../admin/dashboard.css">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Lucky G Event Place</h2>
        <a href="main.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="view.php"><i class="fas fa-calendar-alt"></i> View Booking</a>
        <a href="add.php"><i class="fas fa-plus-circle"></i> Add Booking</a>
        <a href="approved.php"><i class="fas fa-check-circle"></i> Approved Booking</a>
        <a href="logout.php"><i class="fas fa-door-open"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header Section -->
        <div class="header">
            <h1>Add Booking</h1>
            <div class="header-icons">
                <i class="fas fa-envelope"></i> <!-- Email icon -->
                <i class="fas fa-user-circle"></i> <!-- User icon -->
            </div>
        </div>

        <!-- Service Cards -->
        <div class="card-container">
            <!-- Card Template -->
            <?php
            // Sample data from the database for demonstration
            $events = [
                ["title" => "Birthday Celebration Package", "description" => "Make birthdays extra special with our tailored celebration package.", "image" => "../admin/images/image12.jpg", "price" => "$300"],
                ["title" => "Corporate Event Package", "description" => "Professional setups for corporate events, meetings, and conferences.", "image" => "../admin/images/image13.jpg", "price" => "$500"],
                ["title" => "Anniversary Package", "description" => "Celebrate milestones with our romantic anniversary themes.", "image" => "../admin/images/image14.jpg", "price" => "$600"],
                ["title" => "Debut Package", "description" => "Grand debuts with elegant setups for unforgettable moments.", "image" => "../admin/images/image15.jpg", "price" => "$700"],
                ["title" => "Anniversary Package", "description" => "Cute and cozy setups to welcome the little one in style.", "image" => "../admin/images/image16.jpg", "price" => "$400"],
                ["title" => "Anniversary Package", "description" => "Celebrate retirements with joy and memorable themes.", "image" => "../admin/images/image17.jpg", "price" => "$900"],
                // Add more events as needed
            ];

            foreach ($events as $index => $event) {
                echo '
                <div class="card">
                    <div class="card-image">
                        <img src="' . htmlspecialchars($event['image']) . '" alt="' . htmlspecialchars($event['title']) . '">
                    </div>
                    <div class="card-content">
                        <h3>' . htmlspecialchars($event['title']) . '</h3>
                        <p class="description">' . htmlspecialchars($event['description']) . '</p>
                        <button class="view-details" data-bs-toggle="modal" data-bs-target="#eventModal" data-title="' . htmlspecialchars($event['title']) . '" data-price="' . htmlspecialchars($event['price']) . '">View Details</button>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!-- Modal Template -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Price:</strong> <span id="eventPrice">$0</span></p>
                    <form action="your_form_handler.php" method="POST">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_no" name="contact_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="event_time" class="form-label">Event Time</label>
                            <input type="datetime-local" class="form-control" id="event_time" name="event_time"
                                required>
                        </div>
                        <input type="hidden" name="event_type" id="event_type">
                        <input type="hidden" name="amount" id="event_price"> <!-- Add this hidden input -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const viewDetailsButtons = document.querySelectorAll(".view-details");

            viewDetailsButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const title = button.getAttribute("data-title");
                    const price = button.getAttribute("data-price");

                    document.getElementById("eventModalLabel").textContent = title;
                    document.getElementById("eventPrice").textContent = price;
                    document.getElementById("event_type").value = title;
                    document.getElementById("event_price").value = price; // Update the hidden input field
                });
            });
        });

    </script>
</body>

</html>