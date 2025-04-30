<?php
// Start the session
session_start();

// Include db.php for database connection
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch all pending bookings for the table
$bookingQuery = "SELECT id, full_name, address, contact_no, event_time, amount, event_type 
                FROM event_bookings 
                WHERE status = 'Pending' 
                ORDER BY event_time ASC";
$bookingResult = $conn->query($bookingQuery);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Booking</title>
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- External CSS -->
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
        <div class="header d-flex justify-content-between align-items-center">
            <h1>View Booking</h1>
            <div class="header-icons">
                <i class="fas fa-envelope me-3"></i>
                <i class="fas fa-user-circle" style="cursor: pointer;"></i> <!-- User icon -->
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-container mt-4">
            <table id="bookingTable" class="display" style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Contact No</th>
                        <th>Event Time</th>
                        <th>Amount</th>
                        <th>Event Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($bookingResult && $bookingResult->num_rows > 0) {
                        // Output data for each row
                        while ($row = $bookingResult->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['full_name']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['contact_no']}</td>
                                <td>{$row['event_time']}</td>
                                <td>{$row['amount']}</td>
                                <td>{$row['event_type']}</td>
                                <td>
                                    <button class='approve-btn btn btn-primary btn-sm' data-id='{$row['id']}'>Approve</button>
                                    <button class='reject-btn btn btn-danger btn-sm' data-id='{$row['id']}'>Reject</button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize DataTables
            $('#bookingTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthChange": true,
                "language": {
                    "emptyTable": "No bookings found"
                }
            });

            function handleBookingAction(bookingId, actionType) {
                // Confirm action
                if (!confirm(`Are you sure you want to ${actionType} this booking?`)) {
                    return;
                }

                $.post('../../handler/process_booking.php', { id: bookingId, action: actionType }, function (response) {
                    try {
                        const responseData = JSON.parse(response);
                        if (responseData.message) {
                            alert(responseData.message);
                            location.reload();
                        } else {
                            console.error('Unexpected response format:', response);
                            alert("Error processing request. Please try again.");
                        }
                    } catch (e) {
                        console.error('Error parsing response:', response);
                        alert("Error processing request. Please try again.");
                    }
                }, 'text')
                .fail(function (xhr) {
                    console.error("Error response text:", xhr.responseText);
                    alert("Error: Unable to process the request. Please try again.");
                });
            }

            // Approve button click handler
            $('.approve-btn').click(function () {
                const bookingId = $(this).data('id');
                handleBookingAction(bookingId, 'approve');
            });

            // Reject button click handler
            $('.reject-btn').click(function () {
                const bookingId = $(this).data('id');
                handleBookingAction(bookingId, 'reject');
            });
        });
    </script>
</body>

</html>
