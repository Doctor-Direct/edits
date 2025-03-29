<?php
// Start session and check authentication
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: p_login.php");
    exit();
}

// Include database connection
require_once("../connection.php");

// Check if appointment ID is provided
if (!isset($_GET['id'])) {
    header("Location: my_appointments.php");
    exit();
}

$appointment_id = $_GET['id'];

// Verify that the appointment belongs to the patient
$query = "SELECT id FROM appointment WHERE id = ? AND patient_id = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "ss", $appointment_id, $_SESSION['patient_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    header("Location: my_appointments.php");
    exit();
}

// Update appointment status to Cancelled
$query = "UPDATE appointment SET status = 'Cancelled' WHERE id = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $appointment_id);
mysqli_stmt_execute($stmt);

header("Location: my_appointments.php?cancel_success=1");
exit();
?>