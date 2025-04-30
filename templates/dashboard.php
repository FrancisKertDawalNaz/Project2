<?php
// Include the database connection file
include('db.php');

// Start session to access user data
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    $_SESSION['alert_message'] = "You need to log in to access this page.";
    header("Location: ../index.php");
    exit();
}

// Get the logged-in user's details
$user_id = $_SESSION['user_id'];
$sql = "SELECT full_name, email FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

function getNotifications($user_id)
{
    global $conn;
    $sql = "SELECT n.id, n.message, n.created_at, e.event_type
            FROM notifications n
            JOIN event_bookings e ON n.booking_id = e.id
            JOIN users u ON n.user_id = u.id
            WHERE n.user_id = ?
            ORDER BY n.created_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $notifications = [];

    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    return $notifications;
}

$notifications = getNotifications($user_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <h1>Explore Services</h1>
            <div class="header-icons">
                <i class="fas fa-envelope" data-bs-toggle="modal" data-bs-target="#notificationModal"></i>
                <!-- Email icon -->
                <!-- User Icon with modal trigger -->
                <i class="fas fa-user-circle" data-bs-toggle="modal" data-bs-target="#userModal"></i>
            </div>
        </div>

        <!-- Service Cards -->
        <div class="card-container">
            <div class="card">
                <div class="card-image">
                    <img src="../static/images/image12.jpg" alt="Birthday Celebration Package">
                </div>
                <div class="card-content">
                    <h3>Birthday Celebration Package</h3>
                    <p class="description">Make birthdays extra special with our tailored celebration package.</p>
                    <button class="view-details" data-bs-toggle="modal" data-bs-target="#eventModal1">View
                        Details</button>
                </div>
            </div>

            <div class="card">
                <div class="card-image">
                    <img src="../static/images/image13.jpg" alt="Corporate Event Package">
                </div>
                <div class="card-content">
                    <h3>Corporate Event Package</h3>
                    <p class="description">Professional setups for corporate events, meetings, and conferences.</p>
                    <button class="view-details" data-bs-toggle="modal" data-bs-target="#eventModal2">View
                        Details</button>
                </div>
            </div>

            <div class="card">
                <div class="card-image">
                    <img src="../static/images/image14.jpg" alt="Anniversary Package">
                </div>
                <div class="card-content">
                    <h3>Anniversary Package</h3>
                    <p class="description">Celebrate milestones with our romantic anniversary themes.</p>
                    <button class="view-details" data-bs-toggle="modal" data-bs-target="#eventModal3">View
                        Details</button>
                </div>
            </div>

            <div class="card">
                <div class="card-image">
                    <img src="../static/images/image15.jpg" alt="Debut Package">
                </div>
                <div class="card-content">
                    <h3>Debut Package</h3>
                    <p class="description">Grand debuts with elegant setups for unforgettable moments.</p>
                    <button class="view-details" data-bs-toggle="modal" data-bs-target="#eventModal4">View
                        Details</button>
                </div>
            </div>

            <div class="card">
                <div class="card-image">
                    <img src="../static/images/image16.jpg" alt="Baby Shower Package">
                </div>
                <div class="card-content">
                    <h3>Baby Shower Package</h3>
                    <p class="description">Cute and cozy setups to welcome the little one in style.</p>
                    <button class="view-details" data-bs-toggle="modal" data-bs-target="#eventModal5">View
                        Details</button>
                </div>
            </div>

            <div class="card">
                <div class="card-image">
                    <img src="../static/images/image17.jpg" alt="Retirement Party Package">
                </div>
                <div class="card-content">
                    <h3>Retirement Party Package</h3>
                    <p class="description">Celebrate retirements with joy and memorable themes.</p>
                    <button class="view-details" data-bs-toggle="modal" data-bs-target="#eventModal6">View
                        Details</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Notifications -->
    <div class="modal" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Your Notifications</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (!empty($notifications)): ?>
                        <?php foreach ($notifications as $notification): ?>
                            <div class="notification">
                                <strong><?= htmlspecialchars($notification['event_type']) ?></strong>
                                <p><?= htmlspecialchars($notification['message']) ?></p>
                                <small><?= htmlspecialchars($notification['created_at']) ?></small>
                                <hr>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No notifications available.</p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal for Birthday Celebration Package -->
    <div class="modal fade" id="eventModal1" tabindex="-1" aria-labelledby="eventModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel1">Birthday Celebration Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Price:</strong> $300</p>
                    <form action="your_form_handler.php" method="POST">
                        <div class="mb-3">
                            <label for="full_name1" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name1" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address1" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address1" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_no1" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_no1" name="contact_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="event_time1" class="form-label">Event Time</label>
                            <input type="datetime-local" class="form-control" id="event_time1" name="event_time"
                                required>
                        </div>
                        <input type="hidden" class="form-control" id="amount1" name="amount" value="300" required
                            min="100" max="10000" step="10">
                        <input type="hidden" name="event_type" value="Birthday Celebration Package">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Corporate Event Package -->
    <div class="modal fade" id="eventModal2" tabindex="-1" aria-labelledby="eventModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel2">Corporate Event Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Price:</strong> $800</p>
                    <form action="your_form_handler.php" method="POST">
                        <div class="mb-3">
                            <label for="full_name2" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name2" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address2" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address2" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_no2" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_no2" name="contact_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="event_time2" class="form-label">Event Time</label>
                            <input type="datetime-local" class="form-control" id="event_time2" name="event_time"
                                required>
                        </div>
                        <input type="hidden" class="form-control" id="amount2" name="amount" value="800" required
                            readonly>
                        <input type="hidden" name="event_type" value="Corporate Event Package">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Anniversary Package -->
    <div class="modal fade" id="eventModal3" tabindex="-1" aria-labelledby="eventModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel3">Anniversary Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Price:</strong> $600</p>
                    <form action="your_form_handler.php" method="POST">
                        <div class="mb-3">
                            <label for="full_name3" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name3" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address3" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address3" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_no3" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_no3" name="contact_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="event_time3" class="form-label">Event Time</label>
                            <input type="datetime-local" class="form-control" id="event_time3" name="event_time"
                                required>
                        </div>
                        <input type="hidden" class="form-control" id="amount3" name="amount" value="600" required
                            readonly>
                        <input type="hidden" name="event_type" value="Anniversary Package">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Debut Package -->
    <div class="modal fade" id="eventModal4" tabindex="-1" aria-labelledby="eventModalLabel4" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel4">Debut Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Price:</strong> $700</p>
                    <form action="your_form_handler.php" method="POST">
                        <div class="mb-3">
                            <label for="full_name4" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name4" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address4" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address4" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_no4" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_no4" name="contact_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="event_time4" class="form-label">Event Time</label>
                            <input type="datetime-local" class="form-control" id="event_time4" name="event_time"
                                required>
                        </div>
                        <input type="hidden" class="form-control" id="amount4" name="amount" value="700" required
                            readonly>
                        <input type="hidden" name="event_type" value="Debut Package">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Baby Shower Package -->
    <div class="modal fade" id="eventModal5" tabindex="-1" aria-labelledby="eventModalLabel5" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel5">Baby Shower Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Price:</strong> $400</p>
                    <form action="your_form_handler.php" method="POST">
                        <div class="mb-3">
                            <label for="full_name5" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name5" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address5" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address5" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_no5" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_no5" name="contact_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="event_time5" class="form-label">Event Time</label>
                            <input type="datetime-local" class="form-control" id="event_time5" name="event_time"
                                required>
                        </div>
                        <input type="hidden" class="form-control" id="amount5" name="amount" value="400" required
                            readonly>
                        <input type="hidden" name="event_type" value="Baby Shower Package">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for Retirement Party Package -->
    <div class="modal fade" id="eventModal6" tabindex="-1" aria-labelledby="eventModalLabel6" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel6">Retirement Party Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Price:</strong> $900</p>
                    <form action="your_form_handler.php" method="POST">
                        <div class="mb-3">
                            <label for="full_name6" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name6" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address6" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address6" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_no6" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_no6" name="contact_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="event_time6" class="form-label">Event Time</label>
                            <input type="datetime-local" class="form-control" id="event_time6" name="event_time"
                                required>
                        </div>
                        <input type="hidden" class="form-control" id="amount6" name="amount" value="900" required
                            readonly>
                        <input type="hidden" name="event_type" value="Retirement Party Package">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal for displaying user details -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Displaying user details -->
                    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>