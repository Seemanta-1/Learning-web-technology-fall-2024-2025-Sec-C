<?php
include '../controller/db_connection.php'; // Adjust path if needed

// Fetch patients
$sql = "SELECT id, username FROM users WHERE role = 'patient'";
$patients = $conn->query($sql);
if (!$patients) {
    die("<p class='error'>Error fetching patients: " . $conn->error . "</p>");
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $target_dir = "uploads/";

    // Ensure the uploads directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["report_image"]["name"]);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate doctor_id
    $doctor_check = $conn->prepare("SELECT id FROM users WHERE id = ? AND role = 'doctor'");
    $doctor_check->bind_param("i", $doctor_id);
    $doctor_check->execute();
    $doctor_check->store_result();

    if ($doctor_check->num_rows === 0) {
        echo "<p class='error'>Invalid Doctor ID. Please check and try again.</p>";
        $upload_ok = 0;
    }
    $doctor_check->close();

    // Validate image
    $check = getimagesize($_FILES["report_image"]["tmp_name"]);
    if ($check !== false) {
        $upload_ok = $upload_ok && 1;
    } else {
        echo "<p class='error'>File is not an image.</p>";
        $upload_ok = 0;
    }

    // Check size and type
    if ($_FILES["report_image"]["size"] > 5000000 || !in_array($image_file_type, ["jpg", "jpeg", "png", "gif"])) {
        echo "<p class='error'>Invalid file size or type.</p>";
        $upload_ok = 0;
    }

    // Upload file
    if ($upload_ok == 1) {
        if (move_uploaded_file($_FILES["report_image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO medical_reports (patient_id, doctor_id, report_image) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $patient_id, $doctor_id, $target_file);

            if ($stmt->execute()) {
                echo "<p class='success'>Report uploaded successfully.</p>";
            } else {
                echo "<p class='error'>Database error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p class='error'>Failed to move uploaded file.</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Medical Report</title>
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
        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        select, input[type="file"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #2c3e50;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
        button:hover {
            background-color: #34495e;
        }
        .success {
            color: green;
            text-align: center;
            font-weight: bold;
        }
        .error {
            color: red;
            text-align: center;
            font-weight: bold;
        }
        .info {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Upload Medical Report</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="doctor_id">Doctor ID:</label>
        <input type="text" id="doctor_id" name="doctor_id" required>

        <label for="patient_id">Select Patient:</label>
        <select name="patient_id" id="patient_id" required>
            <option value="" disabled selected>Choose a patient</option>
            <?php while ($row = $patients->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['username']); ?></option>
            <?php endwhile; ?>
        </select>

        <label for="report_image">Upload Report:</label>
        <input type="file" id="report_image" name="report_image" accept="image/*" required>

        <button type="submit">Upload</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
