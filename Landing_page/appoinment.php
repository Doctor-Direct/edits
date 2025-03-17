<?php
    include 'c:/xampp/htdocs/doc_direct_main/connection.php'; // Include your database connection

    // Fetch categories from the database
    $category_query = "SELECT category_id, category_name FROM category";
    $category_result = mysqli_query($connection, $category_query);

    //fetch Hospitals from the database
    $hos_query = "SELECT hos_id, hos_name FROM hospitals";
    $hos_result = mysqli_query($connection, $hos_query);

    if (!$category_result) {
        die('Query Failed: ' . mysqli_error($connection));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="appoinment.css">
    <!-- Flatpickr CSS for calendar and time picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr CSS for calendar and time picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>

    <!-- Flatpickr JS for functionality -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
<nav class="navbar">
        <div class="logo">Doc Direct</div>
        <ul class="nav-links">
            <li><a href="land_index.php">Home</a></li>
            
            <li><a href="appoinment.php">Appoinment</a></li>
            <li><a href="#">About Us</a></li>
            <li><a onclick="openNav()" style="cursor:pointer;"><i class="fi fi-br-search"></i></a></li>
            <li><a href="#"><i class="fi fi-br-insert-alt"></i></a></li>

        </ul>
    </nav>
    <section class="appo">
        <div class="form">
            <form class="vertical-form">
                <div class="form-group" id="doctor-name">
                    <label for="doctor-name">Doctor Name</label>
                    <input type="text" id="doctor-name" placeholder="Search Doctor Name">
                </div>

                <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <select id="specialization" name="specialization">
                        <option value="">Select Specialization</option>
                        <?php
                            while ($row = mysqli_fetch_assoc($category_result)) {
                                echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="hospital">Hospital</label>
                    <select id="hospital">
                        <option value="">Select Hospital</option>
                        <?php
                            while ($row = mysqli_fetch_assoc($hos_result)) {
                                echo "<option value='" . $row['hos_id'] . "'>" . $row['hos_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <!-- Calendar Input for Date -->
                <div class="form-group" id="date">
                    <label for="date">Date</label>
                    <input type="text" id="date" placeholder="Select Date">
                </div>
                
                <!-- Time Input for Time -->
                <div class="form-group" id="time">
                    <label for="time">Time</label>
                    <input type="text" id="time" placeholder="Select Time">
                </div>

                <button type="submit">Submit</button>
            </form>

        </div>
        <div class="img">
            <img src="doc.png" alt="Doctor with Tech">
        </div>
    </section>
</body>
</html>
<?php mysqli_close($connection); ?>