<?php
// Start session and check authentication
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: p_login.php");
    exit();
}

// Include database connection
require_once("../connection.php");

// Check if doctor ID is provided
if (!isset($_GET['id'])) {
    header("Location: search_doctors.php");
    exit();
}

$doctor_id = $_GET['id'];

// Fetch doctor details
$query = "SELECT d.* FROM doctor d WHERE d.id = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $doctor_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$doctor = mysqli_fetch_assoc($stmt);

if (!$doctor) {
    header("Location: search_doctors.php");
    exit();
}

// Fetch hospitals where the doctor practices
$query = "SELECT h.*, dh.consultation_fee, dh.available_days, dh.available_time 
          FROM hospital h
          JOIN doctor_hospital dh ON h.id = dh.hospital_id
          WHERE dh.doctor_id = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $doctor_id);
mysqli_stmt_execute($stmt);
$hospitals = mysqli_stmt_get_result($stmt)->fetch_all(MYSQLI_ASSOC);

// Process appointment booking form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_appointment'])) {
    $hospital_id = $_POST['hospital_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $reason = trim($_POST['reason']);
    $patient_id = $_SESSION['patient_id'];
    
    // Generate a unique appointment ID
    $appointment_id = 'APPT' . uniqid();
    
    // Insert appointment into database
    $query = "INSERT INTO appointment (id, patient_id, doctor_id, hospital_id, appointment_date, appointment_time, reason) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $appointment_id, $patient_id, $doctor_id, $hospital_id, $appointment_date, $appointment_time, $reason);
    
    if (mysqli_stmt_execute($stmt)) {
        $success_message = "Appointment booked successfully!";
    } else {
        $error_message = "Error booking appointment. Please try again.";
    }
    
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($doctor['fullname']); ?> - Profile</title>
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
        .doctor-header {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }
        .doctor-avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #3498db;
        }
        .doctor-info {
            flex: 1;
        }
        .doctor-name {
            font-size: 28px;
            margin: 0 0 10px;
            color: #2c3e50;
        }
        .doctor-specialty {
            display: inline-block;
            background: #e8f4fc;
            color: #3498db;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .doctor-details {
            margin-bottom: 15px;
        }
        .detail-label {
            font-weight: bold;
            color: #7f8c8d;
        }
        .section-title {
            font-size: 22px;
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin: 30px 0 20px;
        }
        .hospital-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .hospital-name {
            font-size: 20px;
            margin: 0 0 10px;
            color: #2c3e50;
        }
        .hospital-details {
            margin-bottom: 15px;
        }
        .appointment-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #7f8c8d;
        }
        input[type="date"], input[type="time"], select, textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        textarea {
            min-height: 100px;
        }
        .book-btn {
            background: #2ecc71;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .book-btn:hover {
            background: #27ae60;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #3498db;
            text-decoration: none;
        }
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include('patient_nav.php'); ?>
        
        <a href="search_doctors.php" class="back-link">&larr; Back to Search</a>
        
        <?php if (isset($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <div class="doctor-header">
            <img src="<?php echo !empty($doctor['profile_pic']) ? htmlspecialchars($doctor['profile_pic']) : 'default_doctor.jpg'; ?>" alt="Doctor" class="doctor-avatar">
            <div class="doctor-info">
                <h1 class="doctor-name"><?php echo htmlspecialchars($doctor['fullname']); ?></h1>
                <span class="doctor-specialty"><?php echo htmlspecialchars($doctor['specialty']); ?></span>
                
                <div class="doctor-details">
                    <div><span class="detail-label">Email:</span> <?php echo htmlspecialchars($doctor['email']); ?></div>
                    <div><span class="detail-label">Phone:</span> <?php echo htmlspecialchars($doctor['contact']); ?></div>
                    <div><span class="detail-label">Address:</span> <?php echo htmlspecialchars($doctor['address']); ?></div>
                </div>
                
                <?php if (!empty($doctor['qualifications'])): ?>
                    <div class="doctor-details">
                        <span class="detail-label">Qualifications:</span>
                        <?php echo nl2br(htmlspecialchars($doctor['qualifications'])); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($doctor['bio'])): ?>
                    <div class="doctor-details">
                        <span class="detail-label">About:</span>
                        <?php echo nl2br(htmlspecialchars($doctor['bio'])); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <h2 class="section-title">Available Hospitals/Clinics</h2>
        
        <?php if (empty($hospitals)): ?>
            <p>This doctor is not currently available at any hospitals.</p>
        <?php else: ?>
            <?php foreach ($hospitals as $hospital): ?>
                <div class="hospital-card">
                    <h3 class="hospital-name"><?php echo htmlspecialchars($hospital['name']); ?></h3>
                    <div class="hospital-details">
                        <div><span class="detail-label">Address:</span> <?php echo htmlspecialchars($hospital['address']); ?></div>
                        <div><span class="detail-label">Contact:</span> <?php echo htmlspecialchars($hospital['contact']); ?></div>
                        <div><span class="detail-label">Email:</span> <?php echo htmlspecialchars($hospital['email']); ?></div>
                        <div><span class="detail-label">Consultation Fee:</span> $<?php echo number_format($hospital['consultation_fee'], 2); ?></div>
                        <div><span class="detail-label">Available Days:</span> <?php echo htmlspecialchars($hospital['available_days']); ?></div>
                        <div><span class="detail-label">Available Time:</span> <?php echo htmlspecialchars($hospital['available_time']); ?></div>
                    </div>
                    
                    <div class="appointment-form">
                        <h3>Book Appointment</h3>
                        <form method="POST" action="">
                            <input type="hidden" name="hospital_id" value="<?php echo htmlspecialchars($hospital['id']); ?>">
                            
                            <div class="form-group">
                                <label for="appointment_date">Appointment Date</label>
                                <input type="date" id="appointment_date" name="appointment_date" required min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="appointment_time">Appointment Time</label>
                                <input type="time" id="appointment_time" name="appointment_time" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="reason">Reason for Appointment</label>
                                <textarea id="reason" name="reason" required></textarea>
                            </div>
                            
                            <button type="submit" name="book_appointment" class="book-btn">Book Appointment</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>