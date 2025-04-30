<?php
// Include the database connection file
include('../templates/admin/db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $event_time = $_POST['event_time'];
    $amount = $_POST['amount'];
    $event_type = $_POST['event_type'];  // This can be dynamic based on the event

    // Prepare the SQL query to insert the data
    $sql = "INSERT INTO event_bookings (full_name, address, contact_no, event_time, amount, event_type)
            VALUES ('$full_name', '$address', '$contact_no', '$event_time', '$amount', '$event_type')";

    // Execute the query and check if it was successful
    if ($conn->query($sql) === TRUE) {
        // Redirect to dashboard.php after successful insertion
        header("Location: dashboard.php"); // Ensure to use the correct relative path if necessary
        exit(); // Exit to stop the script from executing further
    } else {
        // Display an error message if the query failed
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
