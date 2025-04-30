<?php
// Include the database connection
include('../templates/admin/db.php');

// Start session and validate user authentication
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['message' => 'User not authenticated.']);
    exit();
}

ini_set('display_errors', 1); // Enable error display for debugging
error_reporting(E_ALL);

header('Content-Type: application/json'); // Set content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $action = filter_var($_POST['action'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Use SANITIZE_FULL_SPECIAL_CHARS instead of SANITIZE_STRING

    $allowed_actions = ['approve', 'reject'];
    if (!$id || !$action || !in_array($action, $allowed_actions)) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid parameters.']);
        exit();
    }

    $status = ($action === 'approve') ? 'Approved' : 'Rejected';
    $userId = $_SESSION['user_id'];
    $message = "Your booking has been $status.";

    // Update booking status
    $query = "UPDATE event_bookings SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log('Booking Query Error: ' . $conn->error);
        http_response_code(500);
        echo json_encode(['message' => 'Failed to prepare booking update query.']);
        exit();
    }

    $stmt->bind_param('si', $status, $id);
    if ($stmt->execute()) {
        // Insert notification
        $notif_query = "INSERT INTO notifications (booking_id, user_id, action, message) VALUES (?, ?, ?, ?)";
        $notif_stmt = $conn->prepare($notif_query);
        if ($notif_stmt) {
            $notif_stmt->bind_param('iiss', $id, $userId, $action, $message);
            if ($notif_stmt->execute()) {
                http_response_code(200);
                echo json_encode(['message' => "Booking $status successfully"]);
            } else {
                error_log('Notification Insert Error: ' . $notif_stmt->error);
                http_response_code(500);
                echo json_encode(['message' => 'Failed to insert notification.']);
            }
            $notif_stmt->close();
        } else {
            error_log('Notification Query Error: ' . $conn->error);
            http_response_code(500);
            echo json_encode(['message' => 'Failed to prepare notification query.']);
        }
    } else {
        error_log('Booking Update Error: ' . $stmt->error);
        http_response_code(500);
        echo json_encode(['message' => 'Failed to update the booking status.']);
    }
    $stmt->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['message' => 'Invalid request method.']);
}
?>
