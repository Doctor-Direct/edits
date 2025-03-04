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
        <form id="login-form" class="form active">
            <div class="form-title">Patient Login</div>
            <div class="input_wrapper">
                <input type="text" id="login-username" class="input_field" required>
                <label for="login-username" class="label">Username</label>
                <i class="fa-regular fa-user icon"></i>
            </div>
            <div class="input_wrapper">
                <input type="password" id="login-password" class="input_field" required>
                <label for="login-password" class="label">Password</label>
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