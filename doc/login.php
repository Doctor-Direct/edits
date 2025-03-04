<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/doc_direct_main/connection.php');
session_start(); // Start session

// Redirect if already logged in
if (isset($_SESSION['doctor_id'])) {
    header('Location: dashboard.php');
    exit();
}

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    // Validate username and password
    if (empty(trim($_POST['username']))) {
        $errors[] = 'Username is missing or invalid';
    }
    if (empty(trim($_POST['password']))) {
        $errors[] = 'Password is missing or invalid';
    }

    // If no errors, process login
    if (empty($errors)) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM doctor WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result_set = mysqli_stmt_get_result($stmt);

        if ($result_set && mysqli_num_rows($result_set) == 1) {
            $user = mysqli_fetch_assoc($result_set);

            // Use password_verify to compare hashed passwords
            if (password_verify($password, $user['password'])) {
                // Regenerate session ID for security
                session_regenerate_id(true);

                // Store user data in session
                $_SESSION['doctor_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Show success popup and redirect after clicking OK
                echo "<script>
                    alert('Login Successful!');
                    window.location.href = 'd_member.php';
                </script>";
                exit();
            } else {
                $errors[] = 'Invalid Username / Password';
            }
        } else {
            $errors[] = 'Invalid Username / Password';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="/doc_direct_main/pat/DOCTOR PAL.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-signup-container">
            <!-- Login Form -->
            <form action="login.php" method="post" id="login-form">
                <div class="form-title">Login</div>
                <?php
                    if (!empty($errors)) {
                        echo '<p class="Error">' . implode('<br>', $errors) . '</p>';
                    }
                ?>
                <div class="input_wrapper">
                    <input type="text" class="input_field" name="username" required>
                    <label class="label">Username</label>
                </div>
                <div class="input_wrapper">
                    <input type="password" class="input_field" name="password" required>
                    <label class="label">Password</label>
                </div>
                <div class="input_wrapper">
                    <input type="submit" class="input-submit" value="Login" name="submit">
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
            
                <div class="switch-form">
                    Don't have an account? <a href="signup.php" id="show-signup">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php mysqli_close($connection); ?>