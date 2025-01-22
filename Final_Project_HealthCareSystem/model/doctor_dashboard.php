<?php
session_start();
require '../controller/db_connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    die("Unauthorized Access");
}

$doctor_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$doctor = $stmt->get_result()->fetch_assoc();
$stmt->close();

$appointmentsQuery = $conn->prepare(
    "SELECT 
        a.appointment_id, 
        p.username AS patient_name, 
        a.appointment_date, 
        a.appointment_time, 
        a.fee, 
        a.payment_status 
    FROM appointments a 
    JOIN users p ON a.user_id = p.id 
    WHERE a.doctor_id = ? AND a.status = 'pending'"
);
$appointmentsQuery->bind_param("i", $doctor_id);
$appointmentsQuery->execute();
$appointments = $appointmentsQuery->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="../view/doctor_dashboard.css">
   
</head>
<body>
    <div class="sidebar">
        <h2>Doctor Info</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($doctor['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($doctor['email']); ?></p>
        <a href="../controller/logout.php" class="logout">Logout</a>
    </div>

    <div class="dashboard-container">
        <h1>Welcome, Dr. <?php echo htmlspecialchars($doctor['username']); ?>!</h1>
        <p>Select an option below:</p>

        <div class="button-container">
            <a href="../model/create_blog.php" class="dashboard-button">Write Health Blog</a>
            <a href="../model/upload_prescription.php" class="dashboard-button">Manage Prescriptions</a>
            <a href="../model/view_feedback.php" class="dashboard-button">View Feedback</a>
            <a href="../model/upload_report.php" class="dashboard-button">Upload Report</a>

        </div>

        <h2>Pending Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Fee</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($appointment = $appointments->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $appointment['appointment_id']; ?></td>
                        <td><?php echo htmlspecialchars($appointment['patient_name']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['fee']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['payment_status']); ?></td>
                        <td class="action-buttons">
                            <form action="../controller/update_appointment.php" method="POST" style="display: inline;">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
                                <button type="submit" name="action" value="accept" class="accept">Accept</button>
                            </form>
                            <form action="../controller/update_appointment.php" method="POST" style="display: inline;">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
                                <button type="submit" name="action" value="reject" class="reject">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>
