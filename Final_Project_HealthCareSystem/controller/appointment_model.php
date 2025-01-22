<?php
include '../controller/db_connection.php';


function createAppointment($user_id, $doctor_id, $appointment_date, $appointment_time, $fee) {
    global $conn;
    $sql = "INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, fee, status, payment_status)
            VALUES (?, ?, ?, ?, ?, 'Pending', 'Unpaid')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iissd', $user_id, $doctor_id, $appointment_date, $appointment_time, $fee);
    return $stmt->execute() ? $conn->insert_id : false;
}

function getAppointmentById($appointment_id) {
    global $conn;
    $sql = "SELECT * FROM appointments WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $appointment_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateAppointmentPayment($appointment_id) {
    global $conn;
    $sql = "UPDATE appointments SET payment_status = 'Paid', status = 'Confirmed' WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $appointment_id);
    return $stmt->execute();
}

function createPayment($user_id, $appointment_id, $amount) {
    global $conn;
    $sql = "INSERT INTO payments (user_id, appointment_id, amount, payment_date) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iid', $user_id, $appointment_id, $amount);
    return $stmt->execute();
}
?>
