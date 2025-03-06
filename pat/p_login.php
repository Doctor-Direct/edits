<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Include database connection
require_once("../connection.php");

// Initialize error message
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form inputs
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($password)) {
        $error_msg = "Username and Password are required.";
    } else {
        // Prepare the SQL query
        $query = "SELECT * FROM patients WHERE username = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if user exists
        if ($row = mysqli_fetch_assoc($result)) {
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Store user info in session
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                
                // Redirect to patient dashboard
                header("Location: .php");
                exit();
            } else {
                $error_msg = "Invalid username or password.";
            }
        } else {
            $error_msg = "User not found.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Close database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
    <link rel="stylesheet" href="p_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <form id="login-form" class="form active" action="p_login.php" method="POST">
            <div class="form-title">Patient Login</div>

            <?php if (!empty($error_msg)) { ?>
                <div class="error-box">
                    <p class="error"><?= $error_msg; ?></p>
                </div>
            <?php } ?>

            <div class="input_wrapper">
                <input type="text" name="username" class="input_field" required>
                <label class="label">Username</label>
                <i class="fa-regular fa-user icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="password" name="password" class="input_field" required>
                <label class="label">Password</label>
                <i class="fa-solid fa-lock icon"></i>
            </div>

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember Me</label>
                </div>
                <div class="forgot">
                    <a href="#">Forgot Password?</a>
                </div>
            </div>

            <div class="input_wrapper">
                <input type="submit" class="input-submit" value="Login">
            </div>

            <div class="switch-form">
                Don't have an account? <a href="p_sign.php">Sign Up</a>
            </div>
        </form>
    </div>
</body>
</html>
