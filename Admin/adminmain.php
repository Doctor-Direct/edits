<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin</title>
    <link rel="stylesheet" href="admin style.css">
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
                
                    <button class="nav-item" data-section="Remove">
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
                        <select id="doctorLocationFilter">
                            <option value="">All Locations</option>
                            <option value="New York">New York</option>
                            <option value="Los Angeles">Los Angeles</option>
                            <option value="Chicago">Chicago</option>
                            <option value="Houston">Houston</option>
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
                        <select id="hospitalLocationFilter">
                            <option value="">All Locations</option>
                            <option value="New York">New York</option>
                            <option value="Los Angeles">Los Angeles</option>
                            <option value="Chicago">Chicago</option>
                            <option value="Houston">Houston</option>
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
    
        <!-- Modal Forms -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="hideForm()">&times;</span>
                
                <!-- Doctor Form -->
                <form id="doctorForm" class="form">
                    <h3>Add New Doctor</h3>
                    <input type="text" name="name" placeholder="Doctor Name" required>
                    <input type="text" name="specialization" placeholder="Specialization" required>
                    <select name="location" required>
                        <option value="">Select Location</option>
                        <option value="New York">New York</option>
                        <option value="Los Angeles">Los Angeles</option>
                        <option value="Chicago">Chicago</option>
                        <option value="Houston">Houston</option>
                    </select>
                    <input type="number" name="experience" placeholder="Years of Experience" required>
                    <button type="submit">Save Doctor</button>
                </form>
    
                <!-- Hospital Form -->
                <form id="hospitalForm" class="form">
                    <h3>Add New Hospital</h3>
                    <input type="text" name="name" placeholder="Hospital Name" required>
                    <select name="location" required>
                        <option value="">Select Location</option>
                        <option value="New York">New York</option>
                        <option value="Los Angeles">Los Angeles</option>
                        <option value="Chicago">Chicago</option>
                        <option value="Houston">Houston</option>
                    </select>
                    <input type="text" name="type" placeholder="Hospital Type" required>
                    <input type="text" name="facilities" placeholder="Facilities (comma-separated)" required>
                    <button type="submit">Save Hospital</button>
                </form>
    
                <!-- Patient Form -->
                <form id="patientForm" class="form">
                    <h3>Add New Patient</h3>
                    <input type="text" name="name" placeholder="Patient Name" required>
                    <input type="number" name="age" placeholder="Age" required>
                    <input type="tel" name="contact" placeholder="Contact Number" required>
                    <textarea name="medicalHistory" placeholder="Medical History" required></textarea>
                    <button type="submit">Save Patient</button>
                </form>
            </div>
        </div>
    
        <script src="admin.js">
            
        </script>
           

        </script>
    </body>
    </html> 

</body>
</html>