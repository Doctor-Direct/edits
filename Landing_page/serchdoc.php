<?php
// search_doctors.php

// Include your database connection
include 'c:/xampp/htdocs/doc_direct_main/connection.php';

// Get the search term from the request
$searchTerm = isset($_GET['term']) ? $_GET['term'] : '';

// Prepare the SQL query to search for doctors
$query = "SELECT doctor_id, fullname FROM doctor WHERE fullname LIKE ?";
$stmt = mysqli_prepare($connection, $query);

// Bind the search term to the query
$searchTerm = '%' . $searchTerm . '%';
mysqli_stmt_bind_param($stmt, "s", $searchTerm);

// Execute the query
mysqli_stmt_execute($stmt);

// Bind the result variables
mysqli_stmt_bind_result($stmt, $doctor_id, $fullname);

// Fetch the results into an array
$results = [];
while (mysqli_stmt_fetch($stmt)) {
    $results[] = [
        'id' => $doctor_id,
        'name' => $fullname
    ];
}

// Close the statement
mysqli_stmt_close($stmt);

// Generate HTML for the results
if (!empty($results)) {
    foreach ($results as $doctor) {
        echo "<div class='result-item' data-id='{$doctor['id']}'>{$doctor['name']}</div>";
    }
} else {
    echo "<div class='result-item'>No results found</div>";
}

// Close the database connection
mysqli_close($connection);
?>
