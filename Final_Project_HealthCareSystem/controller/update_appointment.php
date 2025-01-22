<?php
session_start();
require '../controller/db_connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    die("Unauthorized Access");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $action = $_POST['action'];

    if (!in_array($action, ['accept', 'reject'])) {
        die("Invalid action.");
    }

    $new_status = $action === 'accept' ? 'accepted' : 'rejected';

    $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE appointment_id = ?");
    $stmt->bind_param("si", $new_status, $appointment_id);

    if ($stmt->execute()) {
        header("Location: ../model/doctor_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
