<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- External CSS -->
    <link rel="stylesheet" href="../static/dashboard.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Lucky G Event Place</h2>
        <a href="calendar.php"><i class="fas fa-calendar-alt"></i> Event Calendar</a>
        <a href="dashboard.php"><i class="fas fa-search"></i> Explore Services</a>
        <a href="booking.php"><i class="fas fa-book"></i> My Bookings</a>
        <a href="guide.php"><i class="fas fa-question-circle"></i> Guide</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
<div class="main-content">
    <!-- Header Section -->
    <div class="header">
        <h1>Guide</h1>
        <div class="header-icons">
            <i class="fas fa-envelope"></i> <!-- Email icon -->
            <i class="fas fa-user-circle"></i> <!-- User icon -->
        </div>
    </div>

    <!-- Guide Content -->
    <div class="guide-content">
        <p>This guide will help you navigate through the features and functionality of our platform. Here's how you can get started:</p>

        <h3>1. Explore Services</h3>
        <p>Click on the "Explore Services" section in the menu to view a variety of packages available. Each service comes with detailed information on pricing and features.</p>

        <h3>2. My Bookings</h3>
        <p>To view or manage your bookings, simply navigate to the "My Bookings" section. Here, you can see all your upcoming events and their statuses.</p>

        <h3>3. Contact Support</h3>
        <p>If you need assistance, head to the "Contact Support" section. Our team is available to help with any queries or issues you may have.</p>

        <h3>4. Logout</h3>
        <p>When you're done, make sure to logout securely by clicking the "Logout" link in the sidebar.</p>

        <p>If you need more help, feel free to contact us at <strong>support@luckygeventplace.com</strong>.</p>
    </div>
</div>

</body>

</html>