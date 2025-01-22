<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="../view/styles.css">
</head>
<body>
<?php
include '../controller/appointment_model.php';

$appointment_id = $_GET['appointment_id'];
$appointment = getAppointmentById($appointment_id);
?>
<form action="../model/process_payment.php" method="POST">
    <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
    <label for="fee">Total Fee:</label>
    <input type="text" id="fee" name="fee" value="<?php echo $appointment['fee']; ?>" readonly>
    <button type="submit">Pay Now</button>
    <a href="../model/patient_dashboard.php" class="back-button">Back to Dashboard</a>
</form>

</body>
</html>


