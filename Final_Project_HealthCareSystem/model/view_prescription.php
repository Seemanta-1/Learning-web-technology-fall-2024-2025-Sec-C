<html>
<head>
    <title>View Prescription</title>
    <link rel="stylesheet" href="../view/view_prescription.css">
</head>
<body>
    <div class="feature-section">
        <h2>Your Prescriptions</h2>
        <?php
        session_start();
        require '../controller/db_connection.php';
        
        $patient_id = $_SESSION['user_id'];
        $prescriptions = $conn->query("SELECT prescription FROM Prescriptions WHERE patient_id = $patient_id");

        if ($prescriptions->num_rows > 0) {
            while ($row = $prescriptions->fetch_assoc()) {
                echo "<div class='feedback'>";
                echo "<p>" . htmlspecialchars($row['prescription']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No prescriptions available.</p>";
        }
        ?>
        <a href="../model/patient_dashboard.php" class="back-button">Back to Dashboard</a>
    </div>
    
</body>
</html>
