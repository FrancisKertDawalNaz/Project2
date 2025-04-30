<?php
// db.php - This file connects to the MySQL database

$servername = "localhost"; // Host name
$username = "root";        // MySQL username (default in XAMPP is 'root')
$password = "";            // MySQL password (default in XAMPP is empty)
$dbname = "lucky_g_db"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
