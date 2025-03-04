<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Signup</title>
    <link rel="stylesheet" href="p_sign.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <form id="signup-form" class="form">
            <div class="form-title">Patient Signup</div>
            <div class="input_wrapper">
                <input type="text" id="signup-fullname" class="input_field" required>
                <label for="signup-fullname" class="label">Full Name</label>
                <i class="fa-regular fa-user icon"></i>
            </div>
            <div class="input_wrapper">
                <input type="text" id="signup-contact" class="input_field" required>
                <label for="signup-contact" class="label">Contact Number</label>
                <i class="fa-solid fa-phone icon"></i>
            </div>
            <div class="input_wrapper">
                <input type="date" id="signup-birthday" class="input_field" placeholder=" " required>
                <label for="signup-birthday" class="label">Date of Birth</label>
                <i class="fa-solid fa-cake-candles icon"></i>
            </div>
            <div class="input_wrapper">
                <input type="text" id="signup-address" class="input_field" placeholder=" " required>
                <label for="signup-address" class="label">Home Address</label>
                <i class="fa-solid fa-map-marker-alt icon"></i>
            </div>
            <div class="input_wrapper">
                <input type="email" id="signup-email" class="input_field" required>
                <label for="signup-email" class="label">Email</label>
                <i class="fa-regular fa-envelope icon"></i>
            </div>
            <div class="input_wrapper">
                <input type="text" id="signup-username" class="input_field" placeholder=" " required>
                <label for="signup-username" class="label">Username</label>
                <i class="fa-regular fa-user icon"></i>
            </div>
            <div class="input_wrapper">
                <input type="password" id="signup-password" class="input_field" required>
                <label for="signup-password" class="label">Password</label>
                <i class="fa-solid fa-lock icon"></i>
            </div>
            <div class="input_wrapper">
                <input type="password" id="signup-confirm-password" class="input_field" required>
                <label for="signup-confirm-password" class="label">Confirm Password</label>
                <i class="fa-solid fa-lock icon"></i>
            </div>
            <div class="input_wrapper">
                <input type="submit" class="input-submit" value="Sign Up">
            </div>
            <div class="switch-form">
                Already have an account? <a href="patient_login.html">Login</a>
            </div>
        </form>
    </div>
</body>
</html>