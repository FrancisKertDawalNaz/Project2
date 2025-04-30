<?php
// Include the database connection file
include('db.php');
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $uid = $_SESSION['user_id'];
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $event_time = $_POST['event_time'];
    $amount = $_POST['amount'];
    $event_type = $_POST['event_type']; // This can be dynamic based on the event

    // Prepare the SQL query to insert the data
    $sql = "INSERT INTO event_bookings (full_name, address, contact_no, event_time, amount, event_type, uid) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Use a prepared statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssssi", $full_name, $address, $contact_no, $event_time, $amount, $event_type, $uid);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to dashboard.php after successful insertion
        header("Location: dashboard.php"); // Ensure to use the correct relative path if necessary
        exit(); // Exit to stop the script from executing further
    } else {
        // Display an error message if the execution failed
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
