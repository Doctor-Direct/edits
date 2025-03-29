<?php
// Start session and check authentication
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: p_login.php");
    exit();
}

// Include database connection
require_once("../connection.php");

// Check if appointment ID is provided
if (!isset($_GET['id'])) {
    header("Location: my_appo.php");
    exit();
}

$appointment_id = $_GET['id'];

// Fetch appointment details
$query = "SELECT a.*, d.fullname AS doctor_name, h.name AS hospital_name 
          FROM appointment a
          JOIN doctor d ON a.doctor_id = d.id
          JOIN hospital h ON a.hospital_id = h.id
          WHERE a.id = ? AND a.patient_id = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "ss", $appointment_id, $_SESSION['patient_id']);
mysqli_stmt_execute($stmt);
$appointment = mysqli_stmt_get_result($stmt)->fetch_assoc();

if (!$appointment) {
    header("Location: my_appointments.php");
    exit();
}

// Process reschedule form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_date = $_POST['appointment_date'];
    $new_time = $_POST['appointment_time'];
    
    // Update appointment
    $query = "UPDATE appointment 
              SET appointment_date = ?, appointment_time = ?, status = 'Pending' 
              WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "sss", $new_date, $new_time, $appointment_id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: my_appointments.php?reschedule_success=1");
        exit();
    } else {
        $error_message = "Error rescheduling appointment. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Appointment</title>
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
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #7f8c8d;
        }
        input[type="date"], input[type="time"] {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .btn-primary {
            background: #3498db;
            color: white;
        }
        .btn-secondary {
            background: #95a5a6;
            color: white;
            margin-right: 10px;
        }
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .appointment-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include('patient_nav.php'); ?>
        
        <h1>Reschedule Appointment</h1>
        
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <div class="appointment-info">
            <h3>Current Appointment Details</h3>
            <p><strong>Doctor:</strong> Dr. <?php echo htmlspecialchars($appointment['doctor_name']); ?></p>
            <p><strong>Hospital:</strong> <?php echo htmlspecialchars($appointment['hospital_name']); ?></p>
            <p><strong>Current Date:</strong> <?php echo date('F j, Y', strtotime($appointment['appointment_date'])); ?></p>
            <p><strong>Current Time:</strong> <?php echo date('g:i A', strtotime($appointment['appointment_time'])); ?></p>
        </div>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="appointment_date">New Appointment Date</label>
                <input type="date" id="appointment_date" name="appointment_date" required min="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <div class="form-group">
                <label for="appointment_time">New Appointment Time</label>
                <input type="time" id="appointment_time" name="appointment_time" required>
            </div>
            
            <a href="my_appo.php" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Reschedule Appointment</button>
        </form>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>