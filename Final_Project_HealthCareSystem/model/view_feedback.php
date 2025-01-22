<html>
<head>
    <title>View Feedback</title>
    <link rel="stylesheet" href="../view/view_feedback.css">
</head>
<body>
    <div class="container">
        <h2>Feedback from Patients</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    session_start();
                    require '../controller/db_connection.php';

                    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
                        die("Unauthorized Access");
                    }

                    $doctor_id = intval($_SESSION['user_id']); 
                    $query = "SELECT f.feedback, p.username AS patient_name 
                              FROM Feedback f 
                              JOIN Users p ON f.patient_id = p.id 
                              WHERE f.doctor_id = $doctor_id";
                    
                    $feedbacks = $conn->query($query);

                    if ($feedbacks && $feedbacks->num_rows > 0): 
                        while ($row = $feedbacks->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['feedback']); ?></td>
                            </tr>
                        <?php endwhile; 
                    else: ?>
                        <tr>
                            <td colspan="2">No feedback available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="../model/doctor_dashboard.php" class="back-button">Back to Dashboard</a>
</body>
</html>
