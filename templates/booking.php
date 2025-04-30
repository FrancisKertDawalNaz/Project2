<?php
// Include the database connection file
include('db.php');

// Fetch all bookings from the database
session_start();
$uid = $_SESSION['user_id'];
$sql = "SELECT full_name, address, contact_no, event_time, amount, event_type, status FROM event_bookings where uid = $uid";
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    die("Error fetching bookings: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/dashboard.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>

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
                <h1>Bookings</h1>
                <div class="header-icons">
                    <i class="fas fa-envelope"></i> <!-- Email icon -->
                    <i class="fas fa-user-circle"></i> <!-- User icon -->
                </div>
            </div>

            <!-- Booking Table -->
            <div class="booking-table">
                <table id="bookingsTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Contact No.</th>
                            <th>Event Time</th>
                            <th>Amount</th>
                            <th>Event_Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if there are any bookings to display
                        if ($result->num_rows > 0) {
                            // Loop through the bookings and display each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['contact_no']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['event_time']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['event_type']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            // If no bookings, show a message with the correct colspan
                            echo "<tr><td colspan='6' style='text-align: center;'>No bookings found</td></tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>

        <?php
        // Close the database connection
        $conn->close();
        ?>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize DataTables with a search bar
                $('#bookingsTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "lengthChange": true,
                    "language": {
                        "search": "Search bookings:" // Customize the search bar text
                    }
                });
            });
        </script>
    </body>

</html>