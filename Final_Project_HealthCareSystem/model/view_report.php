<?php
include '../controller/db_connection.php';
session_start();
$patient_id = $_SESSION['user_id']; 

$sql = "SELECT medical_reports.*, users.username AS doctor_name 
        FROM medical_reports
        JOIN users ON medical_reports.doctor_id = users.id
        WHERE medical_reports.patient_id = '$patient_id'
        ORDER BY medical_reports.uploaded_at DESC";
$reports = $conn->query($sql);

if (!$reports) {
    die("<p class='error'>Error fetching reports: " . $conn->error . "</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Medical Reports</title>
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
        .report {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .report img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .report h2 {
            font-size: 18px;
            color: #2c3e50;
        }
        .report p {
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
    <h1>View Medical Reports</h1>
    <?php if ($reports->num_rows > 0): ?>
        <?php while ($row = $reports->fetch_assoc()): ?>
            <div class="report">
                <h2>Uploaded by Doctor: <?php echo htmlspecialchars($row['doctor_name']); ?></h2>
                <img src="<?php echo htmlspecialchars($row['report_image']); ?>" alt="Medical Report">
                <p>Uploaded on: <?php echo htmlspecialchars($row['uploaded_at']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="error">No reports found for this patient.</p>
    <?php endif; ?>
</body>
</html>

<?php $conn->close(); ?>
