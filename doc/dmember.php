<?php
// Start the session (for authentication, if needed)
session_start();

// Database connection
$host = 'localhost';
$dbname = 'doc_direct';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch doctor data (replace 'sith' with the logged-in doctor's username)
    $doctor_username = 'sith'; // Example: Fetch data for username 'sith'
    $stmt = $conn->prepare("SELECT * FROM doctor WHERE username = :username");
    $stmt->bindParam(':username', $doctor_username);
    $stmt->execute();
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link rel="stylesheet" href="dmember.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <nav class="sidebar">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
                <h1>MedPortal</h1>
            </div>
            <ul>
                <li class="active" id="profile-nav">
                    <a href="#profile">
                        <i class="fas fa-user-md"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li id="appointments-nav">
                    <a href="#appointments">
                        <i class="fas fa-calendar-check"></i>
                        <span>Appointments</span>
                    </a>
                </li>
                <li id="availability-nav">
                    <a href="#availability">
                        <i class="fas fa-clock"></i>
                        <span>Availability</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="content">
            <!-- Profile Section -->
            <section id="profile" class="section active">
                <div class="section-header">
                    <h2>Doctor Profile</h2>
                    <div class="actions">
                        <button onclick="window.location.href='editpro.index.html'">
                            <i class="fas fa-edit"></i>
                            Edit Profile
                        </button>
                    </div>
                </div>

                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="https://randomuser.me/api/portraits/men/36.jpg" alt="Doctor's Photo">
                        </div>
                        <div class="profile-info">
                            <h3>Dr. <?php echo htmlspecialchars($doctor['fullname'] ?? 'N/A'); ?></h3>
                            <div class="specialty"><?php echo htmlspecialchars($doctor['category_name'] ?? 'N/A'); ?></div>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>4.8 (124 reviews)</span>
                            </div>
                        </div>
                    </div>
                    <div class="profile-body">
                        <div class="info-grid">
                            <div class="info-card">
                                <h4><i class="fas fa-hospital"></i> Address</h4>
                                <ul>
                                    <li><?php echo htmlspecialchars($doctor['address'] ?? 'N/A'); ?></li>
                                </ul>
                            </div>
                            <div class="info-card">
                                <h4><i class="fas fa-envelope"></i> Email</h4>
                                <ul>
                                    <li><?php echo htmlspecialchars($doctor['email'] ?? 'N/A'); ?></li>
                                </ul>
                            </div>
                            <div class="info-card">
                                <h4><i class="fas fa-phone"></i> Contact</h4>
                                <ul>
                                    <li><?php echo htmlspecialchars($doctor['contact'] ?? 'N/A'); ?></li>
                                </ul>
                            </div>
                            <div class="info-card">
                                <h4><i class="fas fa-language"></i> Languages</h4>
                                <ul>
                                    <li>English (Native)</li>
                                    <li>Sinhala (Fluent)</li>
                                    <li>Tamil (Basic)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Appointments Section -->
            <section id="appointments" class="section">
                <div class="section-header">
                    <h2>Appointments</h2>
                    <div class="actions">
                        <button>
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>
                    </div>
                </div>

                <div class="appointments-list">
                    <!-- Appointment cards go here -->
                </div>
            </section>

            <!-- Availability Section -->
            <section id="availability" class="section">
                <div class="section-header">
                    <h2>Availability</h2>
                    <div class="actions">
                        <button>
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>

                <div class="calendar-container">
                    <!-- Calendar and time slots go here -->
                </div>
            </section>
        </div>
    </div>

    <script src="dmember.js"></script>
</body>
</html>