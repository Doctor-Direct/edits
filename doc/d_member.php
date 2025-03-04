<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/doc_direct_main/connection.php');
session_start();

// Check if doctor_id is set in the session
if (!isset($_SESSION['doctor_id'])) {
    die("Error: Doctor ID is not set. Please login again.");
}

$doctor_id = mysqli_real_escape_string($connection, $_SESSION['doctor_id']); 

// Fetch doctor details
$query = "SELECT d.fullname, c.category_name, d.nic, d.gender, d.profile_image
          FROM doctor d
          JOIN category c ON d.category = c.category_id
          WHERE d.doctor_id = '$doctor_id'";
$result = mysqli_query($connection, $query);

// Handle query failure
if (!$result) {
    die("Database Query Failed: " . mysqli_error($connection));
}

$doctor = mysqli_fetch_assoc($result);

// Fetch hospital details
$hospital_query = "SELECT h.hos_name FROM doctor_hospitals dh
                   JOIN hospitals h ON dh.hos_id = h.hos_id
                   WHERE dh.doctor_id = '$doctor_id'";
$hospital_result = mysqli_query($connection, $hospital_query);

// Handle hospital query failure
if (!$hospital_result) {
    die("Database Query Failed: " . mysqli_error($connection));
}

// Set a default profile image if none exists
$profile_image = !empty($doctor['profile_image']) ? $doctor['profile_image'] : '/doc_direct_main/default-profile.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link rel="stylesheet" href="d_member.css">
    <script defer src="d_member_script.js"></script>
</head>
<body>
    <div class="container">
        <!-- Vertical Navbar -->
        <nav class="sidebar">
            <ul>
                <li class="active" onclick="showSection('profile')">Profile</li>
                <li onclick="showSection('appointments')">Appointments</li>
                <li onclick="showSection('availability')">Availability</li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="content">
            <!-- Doctor Image -->
            <div class="doctor-image">
                <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Doctor Image">
            </div>

            <!-- Profile Section -->
            <section id="profile" class="section active">
                <h2>Doctor Profile</h2>
                <table>
                    <tr><th>Name:</th><td><?php echo htmlspecialchars($doctor['fullname']); ?></td></tr>
                    <tr><th>Category:</th><td><?php echo htmlspecialchars($doctor['category_name']); ?></td></tr>
                    <tr><th>NIC:</th><td><?php echo htmlspecialchars($doctor['nic']); ?></td></tr>
                    <tr><th>Gender:</th><td><?php echo htmlspecialchars($doctor['gender']); ?></td></tr>
                    <tr>
                        <th>Hospitals:</th>
                        <td>
                            <ul>
                                <?php while ($row = mysqli_fetch_assoc($hospital_result)) {
                                    echo "<li>" . htmlspecialchars($row['hos_name']) . "</li>";
                                } ?>
                            </ul>
                        </td>
                    </tr>
                </table>
            </section>

            <!-- Appointments Section -->
            <section id="appointments" class="section">
                <h2>Appointments</h2>
                <p>Appointment details will be displayed here.</p>
            </section>

            <!-- Availability Section -->
            <section id="availability" class="section">
                <h2>Availability</h2>
                <p>Doctor availability details will be displayed here.</p>
            </section>
        </div>
    </div>
</body>
</html>

<?php mysqli_close($connection); ?>
