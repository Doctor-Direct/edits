<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/doc_direct_main/connection.php');
session_start();

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    // Sanitize and validate input
    $fullname = mysqli_real_escape_string($connection, trim($_POST['fullname']));
    $contact = mysqli_real_escape_string($connection, trim($_POST['contact']));
    $birthday = mysqli_real_escape_string($connection, trim($_POST['birthday']));
    $nic = mysqli_real_escape_string($connection, trim($_POST['nic']));
    $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
    $address = mysqli_real_escape_string($connection, trim($_POST['address']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $username = mysqli_real_escape_string($connection, trim($_POST['username']));
    $password = mysqli_real_escape_string($connection, trim($_POST['password']));
    $confirm_password = mysqli_real_escape_string($connection, trim($_POST['confirm_password']));

    // Basic validations
    if (empty($fullname) || empty($contact) || empty($birthday) || empty($nic) || empty($gender) || empty($address) || empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $errors[] = 'All fields are required.';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Securely hash the password

        $query = "INSERT INTO patient (fullname, contact, birthday, nic, gender, address, email, username, password) 
                  VALUES ('$fullname', '$contact', '$birthday', '$nic', '$gender', '$address', '$email', '$username', '$hashed_password')";

        if (mysqli_query($connection, $query)) {
            echo "<script>alert('Registration Successful! Redirecting to login page.'); window.location.href='patient_login.php';</script>";
            exit();
        } else {
            $errors[] = 'Database Insertion Failed: ' . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Signup</title>
    <link rel="stylesheet" href="p_sign.css">
</head>
<body>
    <div class="container">
        <form method="post" action="patient_signup.php" id="signup-form">
            <div class="form-title">Patient Signup</div>
            <?php if (!empty($errors)) {
                echo '<p class="Error">' . implode('<br>', $errors) . '</p>';
            } ?>
            <div class="input_wrapper">
                <input type="text" name="fullname" class="input_field" required>
                <label class="label">Full Name</label>
            </div>
            <div class="input_wrapper">
                <input type="text" name="contact" class="input_field" required>
                <label class="label">Contact Number</label>
            </div>
            <div class="input_wrapper">
                <input type="date" name="birthday" class="input_field" required>
                <label class="label">Date of Birth</label>
            </div>
            <div class="input_wrapper">
                <input type="text" name="nic" class="input_field" required>
                <label class="label">NIC Number</label>
            </div>
            <div class="input_wrapper">
                <select name="gender" class="input_field" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <label class="label">Gender</label>
            </div>
            <div class="input_wrapper">
                <input type="text" name="address" class="input_field" required>
                <label class="label">Home Address</label>
            </div>
            <div class="input_wrapper">
                <input type="email" name="email" class="input_field" required>
                <label class="label">Email</label>
            </div>
            <div class="input_wrapper">
                <input type="text" name="username" class="input_field" required>
                <label class="label">Username</label>
            </div>
            <div class="input_wrapper">
                <input type="password" name="password" class="input_field" required>
                <label class="label">Password</label>
            </div>
            <div class="input_wrapper">
                <input type="password" name="confirm_password" class="input_field" required>
                <label class="label">Confirm Password</label>
            </div>
            <div class="input_wrapper">
                <input type="submit" class="input-submit" value="Sign Up">
            </div>
            <div class="switch-form">
                Already have an account? <a href="patient_login.php">Login</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php mysqli_close($connection); ?>
