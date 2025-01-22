<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'patient') {
    die("Unauthorized access!");
}

require '../controller/db_connection.php';

$patient_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();

$appointmentsQuery = $conn->prepare(
    "SELECT 
        appointments.appointment_id, 
        users.username AS doctor_name, 
        appointments.appointment_date, 
        appointments.appointment_time, 
        appointments.fee, 
        appointments.status, 
        appointments.payment_status 
    FROM appointments 
    JOIN users ON appointments.doctor_id = users.id 
    WHERE appointments.user_id = ?"
);
$appointmentsQuery->bind_param("i", $patient_id);
$appointmentsQuery->execute();
$appointments = $appointmentsQuery->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="../view/patient_dashboard.css">
</head>
<body>
    <div class="sidebar">
        <h2>Patient Info</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($patient['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($patient['email']); ?></p>
        <a href="../controller/logout.php" class="logout">Logout</a>
    </div>

    <div class="dashboard-container">
        <h1>Welcome, <?php echo htmlspecialchars($patient['username']); ?>!</h1>
        <p>Your health is our priority. Select an option below:</p>

        <div class="button-container">
            <a href="../model/view_blog.php" class="dashboard-button">View Blog</a>
            <a href="../model/view_prescription.php" class="dashboard-button">View Prescriptions</a>
            <a href="../model/give_feedback.php" class="dashboard-button">Give Feedback</a>
            <a href="../view/healthtracking.php" class="dashboard-button">Health Condition Meter</a>
            <a href="../model/book_appointment1.php" class="dashboard-button">Book Appointment</a>
            <a href="../model/view_report.php" class="dashboard-button">View Report</a>
            <a href="../model/lab_test_booking.php" class="dashboard-button">Lab Test Booking</a>
        </div>

        <h2>Your Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Fee</th>
                    <th>Status</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($appointment = $appointments->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $appointment['appointment_id']; ?></td>
                        <td><?php echo htmlspecialchars($appointment['doctor_name']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['fee']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['status']); ?></td>
                        <td>
                            <?php if ($appointment['status'] === 'accepted' && $appointment['payment_status'] === 'unpaid'): ?>
                                <a href="../view/payment_page.php?appointment_id=<?php echo $appointment['appointment_id']; ?>" class="pay-now-button">Pay Now</a>
                            <?php elseif ($appointment['payment_status'] === 'paid'): ?>
                                Paid
                            <?php else: ?>
                                Not Available
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
         <footer class="footer">
            <p>&copy; 2025 HealthCare System. All Rights Reserved. <a href="#privacy">Privacy Policy</a> | <a href="#terms">Terms of Service</a></p>
        </footer>
    </div>
    </div>
    
</body>
</html>
