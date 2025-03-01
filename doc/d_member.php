<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/doc_direct_main/connection.php');
session_start();

// Fetch doctor details
$doctor_id = $_SESSION['doctor_id'];  // Assuming doctor_id is stored in session
$query = "SELECT d.fullname, c.category_name, d.nic, d.gender, d.profile_image
          FROM doctor d
          JOIN category c ON d.category = c.category_id
          WHERE d.doctor_id = '$doctor_id'";
$result = mysqli_query($connection, $query);
$doctor = mysqli_fetch_assoc($result);

// Fetch hospital details
$hospital_query = "SELECT h.hos_name FROM doctor_hospitals dh
                   JOIN hospitals h ON dh.hos_id = h.hos_id
                   WHERE dh.doctor_id = '$doctor_id'";
$hospital_result = mysqli_query($connection, $hospital_query);

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
                <img src="<?php echo $doctor['profile_image']; ?>" alt="Doctor Image">
            </div>

            <!-- Profile Section -->
            <section id="profile" class="section active">
                <h2>Doctor Profile</h2>
                <table>
                    <tr><th>Name:</th><td><?php echo $doctor['fullname']; ?></td></tr>
                    <tr><th>Category:</th><td><?php echo $doctor['category_name']; ?></td></tr>
                    <tr><th>NIC:</th><td><?php echo $doctor['nic']; ?></td></tr>
                    <tr><th>Gender:</th><td><?php echo $doctor['gender']; ?></td></tr>
                    <tr>
                        <th>Hospitals:</th>
                        <td>
                            <ul>
                                <?php while ($row = mysqli_fetch_assoc($hospital_result)) {
                                    echo "<li>" . $row['hos_name'] . "</li>";
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
