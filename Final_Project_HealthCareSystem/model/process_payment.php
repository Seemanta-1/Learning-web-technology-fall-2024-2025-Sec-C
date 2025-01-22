<?php
include '../controller/db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $appointment_id = filter_input(INPUT_POST, 'appointment_id', FILTER_VALIDATE_INT);
    if (!$appointment_id) {
        die("Invalid appointment ID.");
    }

    
    $update_query = "UPDATE appointments SET payment_status = 'paid' WHERE appointment_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('i', $appointment_id);

    if ($stmt->execute()) {
        
        header('Location: ../model/patient_dashboard.php');
        exit();
    } else {
        echo "Error updating payment status: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}
?>
