<?php
// Include the database connection file
include('db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $event_time = $_POST['event_time'];
    $amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $event_type = $_POST['event_type']; // This can be dynamic based on the event

    // Validate the amount
    if (!$amount || $amount <= 0) {
        die("Invalid amount value."); // Exit with an error message for invalid amounts.
    }

    // Prepare the SQL query
    $sql = "INSERT INTO event_bookings (full_name, address, contact_no, event_time, amount, event_type) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    // Use a prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssds", $full_name, $address, $contact_no, $event_time, $amount, $event_type);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to add.php after successful insertion
        header("Location: add.php");
        exit(); // Exit to stop the script from executing further
    } else {
        // Display an error message if the query failed
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
