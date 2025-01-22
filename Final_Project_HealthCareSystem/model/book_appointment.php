<?php
session_start();
include '../controller/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("You must be logged in to book an appointment.");
    }

    $user_id = $_SESSION['user_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $fee = $_POST['fee'];

    
    $doctor_check_query = "SELECT id FROM users WHERE id = ? AND role = 'doctor'";
    $doctor_check_stmt = $conn->prepare($doctor_check_query);
    $doctor_check_stmt->bind_param('i', $doctor_id);
    $doctor_check_stmt->execute();
    $doctor_check_result = $doctor_check_stmt->get_result();

    if ($doctor_check_result->num_rows === 0) {
        die("Invalid doctor selected. Please try again.");
    }

   
    $check_query = "SELECT * FROM appointments 
                    WHERE doctor_id = ? 
                    AND appointment_date = ? 
                    AND appointment_time = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param('iss', $doctor_id, $appointment_date, $appointment_time);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        die("This time slot is already booked. Please choose a different time.");
    }

    
    $query = "INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, fee, status, payment_status)
              VALUES (?, ?, ?, ?, ?, 'Pending', 'Unpaid')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iissd', $user_id, $doctor_id, $appointment_date, $appointment_time, $fee);

    if ($stmt->execute()) {
        $appointment_id = $conn->insert_id;
        header('Location: ../view/payment_page.php?appointment_id=' . $appointment_id);
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
