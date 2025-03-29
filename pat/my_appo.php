<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: p_login.php");
    exit();
}

require_once("../connection.php");

// Debug: Show doctor table structure (uncomment to check)
/*
$result = mysqli_query($connection, "DESCRIBE doctor");
echo "<pre>Doctor table structure:\n";
while ($row = mysqli_fetch_assoc($result)) {
    print_r($row);
}
echo "</pre>";
*/

// MOST LIKELY CORRECT VERSION - Try this first
$query = "SELECT a.*, d.fullname AS doctor_name, h.hos_name AS hospital_name 
          FROM appointment a
          JOIN doctor d ON a.doctor_id = d.id
          JOIN hospitals h ON a.hospital_id = h.hos_id
          WHERE a.patient_id = ?
          ORDER BY a.appointment_date DESC, a.appointment_time DESC";

$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $_SESSION['patient_id']);
mysqli_stmt_execute($stmt);
$appointments = mysqli_stmt_get_result($stmt)->fetch_all(MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
?>

<!-- Rest of your HTML remains exactly the same -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
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
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .appointment-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: #fff;
        }
        .appointment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .appointment-title {
            font-size: 20px;
            margin: 0;
            color: #2c3e50;
        }
        .appointment-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-confirmed {
            background: #d4edda;
            color: #155724;
        }
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        .status-completed {
            background: #e2e3e5;
            color: #383d41;
        }
        .appointment-details {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 15px;
        }
        .detail-group {
            flex: 1;
            min-width: 200px;
        }
        .detail-label {
            font-weight: bold;
            color: #7f8c8d;
            margin-bottom: 5px;
        }
        .detail-value {
            margin-bottom: 10px;
        }
        .action-btns {
            margin-top: 15px;
        }
        .btn {
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 10px;
            display: inline-block;
        }
        .btn-cancel {
            background: #e74c3c;
            color: white;
        }
        .btn-reschedule {
            background: #f39c12;
            color: white;
        }
        .no-appointments {
            text-align: center;
            padding: 30px;
            color: #7f8c8d;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include('pat_nav.php'); ?>
        
        <h1>My Appointments</h1>
        
        <?php if (empty($appointments)): ?>
            <div class="no-appointments">
                You don't have any appointments yet. <a href="search_doctors.php">Find a doctor</a> to book an appointment.
            </div>
        <?php else: ?>
            <?php foreach ($appointments as $appointment): ?>
                <div class="appointment-card">
                    <div class="appointment-header">
                        <h2 class="appointment-title">Appointment with Dr. <?php echo htmlspecialchars($appointment['doctor_name']); ?></h2>
                        <span class="appointment-status status-<?php echo strtolower($appointment['status']); ?>">
                            <?php echo htmlspecialchars($appointment['status']); ?>
                        </span>
                    </div>
                    
                    <div class="appointment-details">
                        <div class="detail-group">
                            <div class="detail-label">Hospital/Clinic</div>
                            <div class="detail-value"><?php echo htmlspecialchars($appointment['hospital_name']); ?></div>
                            
                            <div class="detail-label">Appointment Date</div>
                            <div class="detail-value"><?php echo date('F j, Y', strtotime($appointment['appointment_date'])); ?></div>
                        </div>
                        
                        <div class="detail-group">
                            <div class="detail-label">Appointment Time</div>
                            <div class="detail-value"><?php echo date('g:i A', strtotime($appointment['appointment_time'])); ?></div>
                            
                            <div class="detail-label">Reason</div>
                            <div class="detail-value"><?php echo nl2br(htmlspecialchars($appointment['reason'])); ?></div>
                        </div>
                    </div>
                    
                    <div class="action-btns">
                        <?php if ($appointment['status'] == 'Pending' || $appointment['status'] == 'Confirmed'): ?>
                            <a href="cancel_appointment.php?id=<?php echo htmlspecialchars($appointment['id']); ?>" class="btn btn-cancel">Cancel Appointment</a>
                            <a href="rech_appo.php?id=<?php echo htmlspecialchars($appointment['id']); ?>" class="btn btn-reschedule">Reschedule</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>