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
    <title>Home</title>
    <link rel="stylesheet" href="land_style.css">

    <!-- Flatpickr CSS for calendar and time picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Flatpickr JS for functionality -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Doc Direct</div>
        <ul class="nav-links">
            <li><a href="land_index.php">Home</a></li>
            <li><a href="land_log_index.html">Login</a></li>
            <li><a href="appoinment.html">Appoinment</a></li>
            <li><a href="#">About Us</a></li>
        </ul>
    </nav>

    <!-- Slideshow container -->
    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="img1.jpg" style="width:100%">
            <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="img2.jpg" style="width:100%">
            <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="img3.jpg" style="width:100%">
            <div class="text">Caption Three</div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <section class="opp">
        <div class="opportunities-container">
            <h2>Welcome to Doc Direct</h2><br>
            <p>
                Our online appointment system simplifies the process of booking medical consultations, 
                ensuring convenience for both patients and doctors. This platform enhances accessibility, 
                reduces wait times, and provides seamless scheduling, making healthcare more efficient.
            </p><br>
            <h3>Opportunities of Doc Direct</h3><br>
        </div>
    </section>
    
    <section class="listview">
        <div class="list">
            <h1>hi</h1>
        </div>
    </section>

    <section class="appo" id="appo">
        <div class="container">
            <form class="horizontal-form">
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
    </section>

    <section class="home-content">
        <div class="section">
            <h2>Our Vision</h2>
            <p>To revolutionize healthcare accessibility by connecting patients with top doctors and hospitals through a seamless online platform.</p>
        </div>

        <div class="section">
            <h2>Our Mission</h2>
            <p>We aim to provide a user-friendly system that simplifies doctor appointments, enhances patient care, and ensures efficient communication between users and healthcare professionals.</p>
        </div>
    </section>

    <section class="part">
        <div class="section_part">
            <h2>Be a Part of Us</h2>
            <p>Join our platform to experience effortless appointment booking and top-quality healthcare services at your fingertips.</p>
            <button onclick="document.location = 'land_log_index.html'" class="btn">Join Now</button>
        </div>
    </section>

    <script src="land_scripts.js"></script>

    <script>
        // Initialize Flatpickr for date (calendar)
        flatpickr("#date", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: "today" // Prevent selecting past dates
        });

        // Initialize Flatpickr for time (time picker)
        flatpickr("#time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true // Use 24-hour format
        });
    </script>

</body>
</html>

<?php mysqli_close($connection); ?>
