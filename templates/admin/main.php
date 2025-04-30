<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- External CSS -->
    <link rel="stylesheet" href="../admin/dashboard.css">
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">

</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Lucky G Event Place</h2>
        <a href="main.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="view.php"><i class="fas fa-calendar-alt"></i> View Booking</a>
        <a href="add.php"><i class="fas fa-plus-circle"></i> Add Booking</a>
        <a href="approved.php"><i class="fas fa-check-circle"></i> Approved Booking</a>
        <a href="login.php"><i class="fas fa-door-open"></i> Logout</a>
    </div>


    <!-- Main Content -->
    <div class="main-content">
        <!-- Header Section -->
        <div class="header">
            <h1>Dashboard</h1>
            <div class="header-icons">
                <i class="fas fa-envelope"></i> <!-- Email icon -->
                <i class="fas fa-user-circle"></i> <!-- User icon -->
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