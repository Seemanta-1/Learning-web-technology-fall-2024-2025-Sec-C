<?php
session_start();
require '../controller/db_connection.php';

if ($_SESSION['role'] !== 'doctor') {
    die("Unauthorized Access");
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_id = $_SESSION['user_id'];
    $patient_id = isset($_POST['patient_id']) ? (int)$_POST['patient_id'] : null;
    $prescription = isset($_POST['prescription']) ? trim($_POST['prescription']) : '';

    if (!$patient_id || empty($prescription)) {
        $message = "Error: Please fill in all fields.";
    } else {
        $sql = "INSERT INTO Prescriptions (doctor_id, patient_id, prescription) 
                VALUES ('$doctor_id', '$patient_id', '$prescription')";
        if ($conn->query($sql)) {
            $message = "Prescription uploaded successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

$patients = $conn->query("SELECT id, username FROM Users WHERE role='patient'");
?>

<html>
<head>
    <title>Update Prescription</title>
    <link rel="stylesheet" href="../view/upload_prescription.css">
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector("form");

        form.addEventListener("submit", function (event) {
            const patientId = document.getElementById("patient_id").value;
            const prescription = document.getElementById("prescription").value.trim();

            if (!patientId) {
                alert("Please select a patient.");
                event.preventDefault();
                return false;
            }

            if (prescription === "") {
                alert("Please enter prescription details.");
                event.preventDefault();
                return false;
            }

            if (prescription.length < 10) {
                alert("Prescription details must be at least 10 characters long.");
                event.preventDefault();
                return false;
            }

            return true; 
        });
    });
</script>


</head>
<body>
    <div class="container">
        <h2>Update Prescription</h2>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="patient_id">Select Patient:</label>
            <select name="patient_id" id="patient_id" required>
                <option value="">-- Select Patient --</option>
                <?php while ($row = $patients->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo htmlspecialchars($row['username']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="prescription">Prescription Details:</label>
            <textarea name="prescription" id="prescription" rows="5" placeholder="Enter prescription details" required></textarea>

            <button type="submit">Upload Prescription</button>
        </form>
        <a href="../model/doctor_dashboard.php" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>
