<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/doc_direct_main/connection.php');
session_start();

// Fetch locations from the database
$location_query = "SELECT area_id, area_name FROM area";
$location_result = mysqli_query($connection, $location_query);

if (!$location_result) {
    die('Query Failed: ' . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin</title>
    <link rel="stylesheet" href="adminmain.css">
</head>
<body>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Doctor Channeling Admin Dashboard</title>
        <link rel="stylesheet" href="styles.css">
    </head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Admin Dashboard</h1>
            </div>
            <nav class="sidebar-nav">
                <button class="nav-item active" data-section="doctors">Doctors</button>
                <button class="nav-item" data-section="hospitals">Hospitals</button>
                <button class="nav-item" data-section="patients">Patients</button>
                <button class="nav-item" data-section="remove">
                    <a href="index.html">Remove</a>
                </button>
            </nav>
        </aside>

        <main class="main-content">
            <!-- Doctors Section -->
            <section id="doctors" class="section active">
                <div class="section-header">
                    <h2>Manage Doctors</h2>
                    <button class="add-btn" onclick="showForm('doctor')">Add Doctor</button>
                </div>
                <div class="filters">
                    <label for="hospitalLocationFilter">Select Location:</label>
                    <select id="hospitalLocationFilter">
                        <option value="">All Locations</option>
                        <?php 
                        // Re-run the query for hospital dropdown since the previous result was used
                        $location_result = mysqli_query($connection, $location_query);
                        while ($row = mysqli_fetch_assoc($location_result)) { 
                        ?>
                            <option value="<?= $row['area_name']; ?>"><?= $row['area_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div id="doctorsList" class="list"></div>
            </section>

            <!-- Hospitals Section -->
            <section id="hospitals" class="section">
                <div class="section-header">
                    <h2>Manage Hospitals</h2>
                    <button class="add-btn" onclick="showForm('hospital')">Add Hospital</button>
                </div>
                <div class="filters">
                    <label for="hospitalLocationFilter">Select Location:</label>
                    <select id="hospitalLocationFilter">
                        <option value="">All Locations</option>
                        <?php 
                        // Re-run the query for hospital dropdown since the previous result was used
                        $location_result = mysqli_query($connection, $location_query);
                        while ($row = mysqli_fetch_assoc($location_result)) { 
                        ?>
                            <option value="<?= $row['area_name']; ?>"><?= $row['area_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div id="hospitalsList" class="list"></div>
            </section>

            <!-- Patients Section -->
            <section id="patients" class="section">
                <div class="section-header">
                    <h2>Manage Patients</h2>
                    <button class="add-btn" onclick="showForm('patient')">Add Patient</button>
                </div>
                <div id="patientsList" class="list"></div>
            </section>
        </main>
    </div>

    <script src="admin.js"></script>
</body>
</html>
