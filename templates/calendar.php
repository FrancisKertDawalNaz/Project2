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
    <title>Event Calendar</title>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
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
        <div class="header">
            <h1>Event Calendar</h1>
            <div class="header-icons">
                <i class="fas fa-envelope"></i>
                <i class="fas fa-user-circle"></i>
            </div>
        </div>

        <!-- Calendar Section -->
        <div id='calendar'></div>
    </div>

    <!-- FullCalendar and jQuery Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Initializing FullCalendar...");
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) {
                console.error("Calendar element not found!");
                return;
            }
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [{
                        title: 'Birthday Celebration Package',
                        start: '2025-03-15',
                        end: '2025-03-16'
                    },
                    {
                        title: 'Baby Shower Package',
                        start: '2025-03-20'
                    }
                ]
            });
            calendar.render();
        });
    </script>
</body>

</html>