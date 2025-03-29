<?php
// Start session and check authentication
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: p_login.php");
    exit();
}

// Include database connection
require_once("../connection.php");

// Initialize search variables
$search_name = $search_location = $search_hospital = $search_category = '';
$doctors = [];

// Process search form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search_name = trim($_POST['search_name']);
    $search_location = trim($_POST['search_location']);
    $search_hospital = trim($_POST['search_hospital']);
    $search_category = trim($_POST['search_category']);
    
    // Build the query with corrected table and column names
    $query = "SELECT d.*, GROUP_CONCAT(DISTINCT h.hos_name SEPARATOR ', ') AS hospitals 
              FROM doctor d
              LEFT JOIN doctor_hospital dh ON d.doctor_id = dh.doctor_id
              LEFT JOIN hospitals h ON dh.hos_id = h.hos_id
              LEFT JOIN category c ON d.category_id = c.category_id
              WHERE 1=1";
    
    $params = [];
    $types = '';
    
    if (!empty($search_name)) {
        $query .= " AND d.fullname LIKE ?";
        $params[] = "%$search_name%";
        $types .= 's';
    }
    
    if (!empty($search_location)) {
        $query .= " AND h.address LIKE ?";
        $params[] = "%$search_location%";
        $types .= 's';
    }
    
    if (!empty($search_hospital)) {
        $query .= " AND h.hos_name LIKE ?";
        $params[] = "%$search_hospital%";
        $types .= 's';
    }
    
    if (!empty($search_category)) {
        $query .= " AND c.category_name LIKE ?";
        $params[] = "%$search_category%";
        $types .= 's';
    }
    
    $query .= " GROUP BY d.doctor_id";
    
    // Prepare and execute the query
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Doctors</title>
    <style>
        /* Your existing CSS remains the same */
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
        .search-form h2 {
            margin-top: 0;
            color: #2c3e50;
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
            color: #7f8c8d;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .search-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .search-btn:hover {
            background: #2980b9;
        }
        .doctor-card {
            display: flex;
            gap: 20px;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #fff;
            transition: all 0.3s ease;
        }
        .doctor-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .doctor-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #3498db;
        }
        .doctor-info {
            flex: 1;
        }
        .doctor-name {
            font-size: 20px;
            margin: 0 0 10px;
            color: #2c3e50;
        }
        .doctor-specialty {
            display: inline-block;
            background: #e8f4fc;
            color: #3498db;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .doctor-hospitals, .doctor-bio {
            color: #7f8c8d;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .view-profile-btn {
            background: #2ecc71;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }
        .no-results {
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
        
        <div class="search-form">
            <h2>Find a Doctor</h2>
            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="search_name">Doctor Name</label>
                            <input type="text" id="search_name" name="search_name" value="<?php echo htmlspecialchars($search_name); ?>" placeholder="Enter doctor name">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="search_category">Category</label>
                            <input type="text" id="search_category" name="search_category" value="<?php echo htmlspecialchars($search_category); ?>" placeholder="e.g. Cardiologist">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="search_hospital">Hospital/Clinic</label>
                            <input type="text" id="search_hospital" name="search_hospital" value="<?php echo htmlspecialchars($search_hospital); ?>" placeholder="Enter hospital name">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="search_location">Location</label>
                            <input type="text" id="search_location" name="search_location" value="<?php echo htmlspecialchars($search_location); ?>" placeholder="Enter city or area">
                        </div>
                    </div>
                </div>
                <button type="submit" class="search-btn">Search Doctors</button>
            </form>
        </div>
        
        <div class="search-results">
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                <h2>Search Results</h2>
                
                <?php if (empty($doctors)): ?>
                    <div class="no-results">
                        No doctors found matching your criteria. Please try different search terms.
                    </div>
                <?php else: ?>
                    <?php foreach ($doctors as $doctor): ?>
                        <div class="doctor-card">
                            <img src="<?php echo !empty($doctor['profile_pic']) ? htmlspecialchars($doctor['profile_pic']) : 'default_doctor.jpg'; ?>" alt="Doctor" class="doctor-avatar">
                            <div class="doctor-info">
                                <h3 class="doctor-name"><?php echo htmlspecialchars($doctor['fullname']); ?></h3>
                                <span class="doctor-specialty"><?php echo htmlspecialchars($doctor['category_name'] ?? $doctor['specialty']); ?></span>
                                <?php if (!empty($doctor['hospitals'])): ?>
                                    <div class="doctor-hospitals"><strong>Available at:</strong> <?php echo htmlspecialchars($doctor['hospitals']); ?></div>
                                <?php endif; ?>
                                <?php if (!empty($doctor['bio'])): ?>
                                    <div class="doctor-bio"><?php echo htmlspecialchars(substr($doctor['bio'], 0, 150)); ?>...</div>
                                <?php endif; ?>
                                <a href="appo.php?id=<?php echo htmlspecialchars($doctor['doctor_id']); ?>" class="view-profile-btn">View Profile & Book Appointment</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>