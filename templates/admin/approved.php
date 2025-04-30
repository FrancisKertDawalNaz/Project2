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
            <h1>Approved Booking</h1>
            <div class="header-icons">
                <i class="fas fa-envelope"></i> <!-- Email icon -->
                <i class="fas fa-user-circle"></i> <!-- User icon -->
            </div>
        </div>

        
</body>

</html>