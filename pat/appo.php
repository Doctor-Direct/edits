<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: p_login.php");
    exit();
}

require_once("../connection.php");

// Initialize variables
$search_name = $search_specialty = $search_hospital = $search_location = '';
$doctors = [];
$success_message = '';

// Process search form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['search'])) {
        // Search functionality
        $search_name = trim($_POST['search_name']);
        $search_specialty = trim($_POST['search_specialty']);
        $search_hospital = trim($_POST['search_hospital']);
        $search_location = trim($_POST['search_location']);
        
        $query = "SELECT d.*, GROUP_CONCAT(DISTINCT h.hos_name SEPARATOR ', ') AS hospitals 
                  FROM doctor d
                  LEFT JOIN doctor_hospital dh ON d.doctor_id = dh.doctor_id
                  LEFT JOIN hospitals h ON dh.hos_id = h.hos_id
                  WHERE 1=1";
        
        $params = [];
        $types = '';
        
        if (!empty($search_name)) {
            $query .= " AND d.fullname LIKE ?";
            $params[] = "%$search_name%";
            $types .= 's';
        }
        
        if (!empty($search_specialty)) {
            $query .= " AND d.specialty LIKE ?";
            $params[] = "%$search_specialty%";
            $types .= 's';
        }
        
        if (!empty($search_hospital)) {
            $query .= " AND h.hos_name LIKE ?";
            $params[] = "%$search_hospital%";
            $types .= 's';
        }
        
        if (!empty($search_location)) {
            $query .= " AND h.address LIKE ?";
            $params[] = "%$search_location%";
            $types .= 's';
        }
        
        $query .= " GROUP BY d.doctor_id";
        
        $stmt = mysqli_prepare($connection, $query);
        if (!empty($params)) {
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $doctors[] = $row;
        }
        mysqli_stmt_close($stmt);
    }
    elseif (isset($_POST['book_appointment'])) {
        // Appointment booking functionality
        $doctor_id = $_POST['doctor_id'];
        $hospital_id = $_POST['hospital_id'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $reason = trim($_POST['reason']);
        
        // Generate appointment ID
        $appointment_id = 'APT' . date('YmdHis');
        
        $query = "INSERT INTO appointment (id, patient_id, doctor_id, hospital_id, appointment_date, appointment_time, reason) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sssssss", 
            $appointment_id,
            $_SESSION['patient_id'],
            $doctor_id,
            $hospital_id,
            $appointment_date,
            $appointment_time,
            $reason
        );
        
        if (mysqli_stmt_execute($stmt)) {
            $success_message = "Appointment booked successfully!";
        } else {
            $error_message = "Error booking appointment: " . mysqli_error($connection);
        }
        mysqli_stmt_close($stmt);
    }
}

// Fetch available time slots (example function)
function getAvailableTimeSlots($doctor_id, $hospital_id, $date) {
    // In a real implementation, you would query the database for available slots
    return ['09:00', '10:00', '11:00', '14:00', '15:00'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
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
        .search-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .form-col {
            flex: 1;
            min-width: 200px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #2980b9;
        }
        .doctor-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: #fff;
        }
        .booking-form {
            margin-top: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include('pat_nav.php'); ?>
        
        <h1>Book an Appointment</h1>
        
        <?php if (isset($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <div class="search-form">
            <h2>Find a Doctor</h2>
            <form method="POST">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="search_name">Doctor Name</label>
                            <input type="text" id="search_name" name="search_name" value="<?php echo htmlspecialchars($search_name); ?>">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="search_specialty">Specialty</label>
                            <input type="text" id="search_specialty" name="search_specialty" value="<?php echo htmlspecialchars($search_specialty); ?>">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="search_hospital">Hospital/Clinic</label>
                            <input type="text" id="search_hospital" name="search_hospital" value="<?php echo htmlspecialchars($search_hospital); ?>">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="search_location">Location</label>
                            <input type="text" id="search_location" name="search_location" value="<?php echo htmlspecialchars($search_location); ?>">
                        </div>
                    </div>
                </div>
                <button type="submit" name="search">Search Doctors</button>
            </form>
        </div>
        
        <?php if (!empty($doctors)): ?>
            <h2>Search Results</h2>
            <?php foreach ($doctors as $doctor): ?>
                <div class="doctor-card">
                    <h3><?php echo htmlspecialchars($doctor['fullname']); ?></h3>
                    <p><strong>Specialty:</strong> <?php echo htmlspecialchars($doctor['specialty']); ?></p>
                    <?php if (!empty($doctor['hospitals'])): ?>
                        <p><strong>Available at:</strong> <?php echo htmlspecialchars($doctor['hospitals']); ?></p>
                    <?php endif; ?>
                    
                    <div class="booking-form">
                        <h4>Book Appointment</h4>
                        <form method="POST">
                            <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor['doctor_id']); ?>">
                            
                            <div class="form-group">
                                <label for="hospital_id">Hospital/Clinic</label>
                                <select id="hospital_id" name="hospital_id" required>
                                    <?php
                                    // Fetch hospitals for this doctor
                                    $hospitals_query = "SELECT h.hos_id, h.hos_name 
                                                       FROM hospitals h
                                                       JOIN doctor_hospital dh ON h.hos_id = dh.hos_id
                                                       WHERE dh.doctor_id = ?";
                                    $stmt = mysqli_prepare($connection, $hospitals_query);
                                    mysqli_stmt_bind_param($stmt, "s", $doctor['doctor_id']);
                                    mysqli_stmt_execute($stmt);
                                    $hospitals = mysqli_stmt_get_result($stmt)->fetch_all(MYSQLI_ASSOC);
                                    
                                    foreach ($hospitals as $hospital) {
                                        echo '<option value="' . htmlspecialchars($hospital['hos_id']) . '">' . 
                                             htmlspecialchars($hospital['hos_name']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="appointment_date">Date</label>
                                <input type="date" id="appointment_date" name="appointment_date" required 
                                       min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="appointment_time">Time</label>
                                <select id="appointment_time" name="appointment_time" required>
                                    <?php
                                    // Example time slots - in real app, fetch from database
                                    $times = ['09:00', '10:00', '11:00', '14:00', '15:00'];
                                    foreach ($times as $time) {
                                        echo '<option value="' . htmlspecialchars($time) . '">' . 
                                             htmlspecialchars($time) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="reason">Reason for Appointment</label>
                                <textarea id="reason" name="reason" required></textarea>
                            </div>
                            
                            <button type="submit" name="book_appointment">Book Appointment</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])): ?>
            <p>No doctors found matching your criteria.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>