<?php
session_start();
require '../controller/db_connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'patient') {
    die("Unauthorized Access");
}

if (!isset($_POST['doctor_id'], $_POST['feedback']) || empty($_POST['doctor_id']) || empty($_POST['feedback'])) {
    die("Invalid input. All fields are required.");
}

$patient_id = (int)$_SESSION['user_id'];
$doctor_id = (int)$_POST['doctor_id'];
$feedback = $conn->real_escape_string(trim($_POST['feedback']));

$sql = "INSERT INTO Feedback (patient_id, doctor_id, feedback) VALUES ('$patient_id', '$doctor_id', '$feedback')";

if ($conn->query($sql)) {
    echo "Feedback submitted successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>
