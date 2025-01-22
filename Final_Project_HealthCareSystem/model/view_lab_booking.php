<?php
include '../controller/db_connection.php'; 
session_start();

$patient_id = $_SESSION['user_id']; 

$sql = "SELECT * FROM lab_test_bookings WHERE user_id = '$patient_id' ORDER BY created_at DESC";
$bookings = $conn->query($sql);

if (!$bookings) {
    die("<p class='error'>Error fetching bookings: " . $conn->error . "</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Test Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        .booking {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .booking h2 {
            font-size: 18px;
            color: #2c3e50;
        }
        .booking p {
            margin: 10px 0;
        }
        .error {
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>My Lab Test Bookings</h1>
    <?php if ($bookings->num_rows > 0): ?>
        <?php while ($row = $bookings->fetch_assoc()): ?>
            <div class="booking">
                <h2><?php echo htmlspecialchars($row['test_name']); ?></h2>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($row['test_date']); ?></p>
                <p><strong>Time:</strong> <?php echo htmlspecialchars($row['test_time']); ?></p>
                <p><strong>Notes:</strong> <?php echo htmlspecialchars($row['additional_notes'] ?: 'None'); ?></p>
                <p><strong>Booked On:</strong> <?php echo htmlspecialchars($row['created_at']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="error">No bookings found.</p>
    <?php endif; ?>
</body>
</html>

<?php $conn->close(); ?>
