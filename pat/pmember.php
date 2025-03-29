<?php
// Start session and check authentication
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: p_login.php");
    exit();
}

// Include database connection
require_once("../connection.php");

// Fetch complete patient data
$query = "SELECT * FROM patient WHERE id = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $_SESSION['patient_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$patient = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .profile-title {
            font-size: 24px;
            color: #2c3e50;
        }
        .logout-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .profile-content {
            display: flex;
            gap: 30px;
        }
        .profile-sidebar {
            width: 250px;
        }
        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #3498db;
        }
        .profile-nav {
            list-style: none;
            padding: 0;
        }
        .profile-nav li {
            margin-bottom: 10px;
        }
        .profile-nav a {
            display: block;
            padding: 8px 15px;
            background: #f8f9fa;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }
        .profile-nav a:hover, .profile-nav a.active {
            background: #3498db;
            color: white;
        }
        .profile-main {
            flex: 1;
        }
        .info-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .info-card h3 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .info-row {
            display: flex;
            margin-bottom: 10px;
        }
        .info-label {
            width: 150px;
            font-weight: bold;
            color: #7f8c8d;
        }
        .info-value {
            flex: 1;
        }
        .edit-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-header">
            <h1 class="profile-title">Patient Dashboard</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        
        <div class="profile-content">
            <div class="profile-sidebar">
                <img src="ppic.webp" alt="Profile Image" class="profile-avatar">
                <h2><?php echo htmlspecialchars($patient['fullname']); ?></h2>
                <p>Patient ID: <?php echo htmlspecialchars($patient['id']); ?></p>
                
                <ul class="profile-nav">
                    <li><a href="#" class="active">Profile</a></li>
                    <li><a href="appointments.php">Appointments</a></li>
                    <li><a href="prescriptions.php">Prescriptions</a></li>
                    <li><a href="medical_history.php">Medical History</a></li>
                    <li><a href="settings.php">Account Settings</a></li>
                </ul>
            </div>
            
            <div class="profile-main">
                <div class="info-card">
                    <h3>Personal Information</h3>
                    <div class="info-row">
                        <div class="info-label">Full Name:</div>
                        <div class="info-value"><?php echo htmlspecialchars($patient['fullname']); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Date of Birth:</div>
                        <div class="info-value"><?php echo date('F j, Y', strtotime($patient['birthday'])); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Gender:</div>
                        <div class="info-value"><?php echo htmlspecialchars($patient['gender']); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">NIC:</div>
                        <div class="info-value"><?php echo htmlspecialchars($patient['nic']); ?></div>
                    </div>
                    <a href="edit_profile.php" class="edit-btn">Edit Profile</a>
                </div>
                
                <div class="info-card">
                    <h3>Contact Information</h3>
                    <div class="info-row">
                        <div class="info-label">Email:</div>
                        <div class="info-value"><?php echo htmlspecialchars($patient['email']); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Phone:</div>
                        <div class="info-value"><?php echo htmlspecialchars($patient['contact']); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Address:</div>
                        <div class="info-value"><?php echo htmlspecialchars($patient['address']); ?></div>
                    </div>
                    <a href="edit_contact.php" class="edit-btn">Edit Contact Info</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>