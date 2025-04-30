<?php
// Include the database connection file
include('db.php');

// Initialize variables
$success = false;
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch the user by email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, now check the password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $success = true;
            // Start a session to store user data if login is successful
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            // Redirect to dashboard.php after successful login
            header("Location: calendar.php");
            exit();
        } else {
            $error = "Invalid password.";
            // Redirect back to main.php if password is incorrect
            header("Location: ../index.php?error=" . urlencode($error));
            exit();
        }
    } else {
        $error = "No user found with that email.";
        // Redirect back to main.php if no user found
        header("Location: ../index.php?error=" . urlencode($error));
        exit();
    }

}
?>

<!-- Login Form and Modal -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Login Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    if ($success) {
                        echo "Login successful! You will be redirected shortly.";
                    } elseif ($error) {
                        echo $error;
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        <?php if ($success): ?>
            // Show the modal if the login was successful
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();

            // Redirect to dashboard.php after 3 seconds
            setTimeout(function () {
                window.location.href = "dashboard.php";
            }, 3000); // 3 seconds delay
        <?php elseif ($error): ?>
            // Show the modal if there's an error (invalid login credentials)
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        <?php endif; ?>
    </script>

</body>

</html>