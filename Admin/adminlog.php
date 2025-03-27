<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/doc_direct_main/connection.php');
session_start();

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    if (empty(trim($_POST['email']))) {
        $errors[] = 'Email is required';
    }
    if (empty(trim($_POST['password']))) {
        $errors[] = 'Password is required';
    }

    if (empty($errors)) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $query = "SELECT * FROM admin WHERE email = ? LIMIT 1"; // Fix: Use email instead of username
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result_set = mysqli_stmt_get_result($stmt);

        if ($result_set && mysqli_num_rows($result_set) == 1) {
            $user = mysqli_fetch_assoc($result_set);
            
            // Direct password comparison (No hashing)
            if ($password === $user['password']) { 
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['name']; // Using 'name' instead of 'username'

                // Set remember me cookie if checked
                if (!empty($_POST['remember-me'])) {
                    setcookie('remember_email', $email, time() + 86400 * 30, '/');
                }

                // Redirect to admin dashboard
                echo "<script>
                    alert('Login Successful!');
                    window.location.href = 'index.php';
                </script>";
                exit();
            } else {
                $errors[] = 'Invalid credentials';
            }
        } else {
            $errors[] = 'Invalid credentials';
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Channeling Admin Login</title>
    <link rel="stylesheet" href="adminlog.css">
</head>
<body>
    <div class="container">
        <!-- Background Image -->
        <div class="background-overlay"></div>

        <!-- Login Container -->
        <div class="login-container">
            <div class="header">
                <div class="logo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stethoscope-icon">
                        <path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"></path>
                        <path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"></path>
                        <circle cx="20" cy="10" r="2"></circle>
                    </svg>
                </div>
                <h1>Admin Login</h1>
                <p>Welcome back! Please login to your account.</p>
                
                <?php
                // Display errors if any
                if (!empty($errors)) {
                    echo '<div class="error-message">';
                    foreach ($errors as $error) {
                        echo '<p>'.$error.'</p>';
                    }
                    echo '</div>';
                }
                ?>
            </div>

            <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="input-icon">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                        <input type="email" id="email" name="email" placeholder="admin@example.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="input-icon">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember-me">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit">Sign In</button>
            </form>

            <p class="support-text">
                Need help? Contact <a href="#">support</a>
            </p>
        </div>
    </div>
    <script src="adminlog.js"></script>
</body>
</html>
<?php mysqli_close($connection); ?>