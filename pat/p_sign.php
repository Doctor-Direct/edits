<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require_once("../connection.php");

// Initialize an empty errors array
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fullname = trim($_POST['fullname']);
    $contact = trim($_POST['contact']);
    $birthday = trim($_POST['birthday']);
    $nic = trim($_POST['nic']);
    $gender = trim($_POST['gender']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic Validations
    if (empty($fullname) || empty($contact) || empty($birthday) || empty($nic) ||
        empty($gender) || empty($address) || empty($email) || empty($username) || empty($password)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Check if username or email already exists
    $checkQuery = "SELECT * FROM patient WHERE email='$email' OR username='$username'";
    $result = mysqli_query($connection, $checkQuery);
    if (mysqli_num_rows($result) > 0) {
        $errors[] = "Email or Username already exists!";
    }

    // If no errors, insert data
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Secure hashing

        $query = "INSERT INTO patient (fullname, contact, birthday, nic, gender, address, email, username, password)
                  VALUES ('$fullname', '$contact', '$birthday', '$nic', '$gender', '$address', '$email', '$username', '$hashed_password')";

        if (mysqli_query($connection, $query)) {
            echo "<script>alert('Registration Successful! Redirecting to login page.');
                  window.location.href='p_login.php';</script>";
            exit();
        } else {
            $errors[] = "Database Insertion Failed: " . mysqli_error($connection);
        }
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
    <title>Patient Signup</title>
    <link rel="stylesheet" href="p_sign.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <form id="signup-form" class="form" action="p_sign.php" method="POST">
            <div class="form-title">Patient Signup</div>

            <?php if (!empty($errors)) { ?>
                <div class="error-box">
                    <?php foreach ($errors as $error) {
                        echo "<p class='error'>$error</p>";
                    } ?>
                </div>
            <?php } ?>

            <div class="input_wrapper">
                <input type="text" name="fullname" class="input_field" required>
                <label class="label">Full Name</label>
                <i class="fa-regular fa-user icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="text" name="contact" class="input_field" required>
                <label class="label">Contact Number</label>
                <i class="fa-solid fa-phone icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="date" name="birthday" class="input_field" required>
                <label class="label">Date of Birth</label>
                <i class="fa-solid fa-cake-candles icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="text" name="nic" class="input_field" required>
                <label class="label">NIC Number</label>
                <i class="fa-solid fa-id-card icon"></i>
            </div>

            <div class="input_wrapper">
                <select name="gender" class="input_field" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <label class="label">Gender</label>
                <i class="fa-solid fa-venus-mars icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="text" name="address" class="input_field" required>
                <label class="label">Home Address</label>
                <i class="fa-solid fa-map-marker-alt icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="email" name="email" class="input_field" required>
                <label class="label">Email</label>
                <i class="fa-regular fa-envelope icon"></i>
            </div>

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

            <div class="input_wrapper">
                <input type="password" name="confirm_password" class="input_field" required>
                <label class="label">Confirm Password</label>
                <i class="fa-solid fa-lock icon"></i>
            </div>

            <div class="input_wrapper">
                <input type="submit" class="input-submit" value="Sign Up">
            </div>

            <div class="switch-form">
                Already have an account? <a href="p_login.php">Login</a>
            </div>
        </form>
    </div>
</body>
</html>
