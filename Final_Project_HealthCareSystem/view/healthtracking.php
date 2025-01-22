<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Tracking Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .results {
            margin-top: 20px;
            padding: 10px;
            background: #e9f5e9;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }
        .results p {
            margin: 5px 0;
        }
        .alert {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .back-button {
        text-decoration: none;
        color: white;
        background-color: #0056b3;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        margin-top: 15px;
        display: inline-block;
        transition: background-color 0.3s;
        }

        .back-button:hover {
        background-color: #003366;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Health Tracking Dashboard</h2>
        <form method="POST">
            <label for="blood_pressure">Blood Pressure (e.g., 120/80):</label>
            <input type="text" name="blood_pressure" id="blood_pressure" placeholder="Enter your blood pressure" required>

            <label for="diabetic_level">Diabetic Level (mg/dL):</label>
            <input type="number" step="0.1" name="diabetic_level" id="diabetic_level" placeholder="Enter your diabetic level" required>

            <label for="temperature">Temperature (°C):</label>
            <input type="number" step="0.1" name="temperature" id="temperature" placeholder="Enter your temperature" required>

            <label for="cholesterol">Cholesterol (mg/dL):</label>
            <input type="number" step="0.1" name="cholesterol" id="cholesterol" placeholder="Enter your cholesterol level" required>

            <button type="submit">Check Health</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blood_pressure = $_POST['blood_pressure'];
            $diabetic_level = (float)$_POST['diabetic_level'];
            $temperature = (float)$_POST['temperature'];
            $cholesterol = (float)$_POST['cholesterol'];

            $feedback = [];
            $seeDoctor = false;

            // Blood Pressure
            $bp_parts = explode('/', $blood_pressure);
            if (count($bp_parts) === 2) {
                $systolic = (int)$bp_parts[0];
                $diastolic = (int)$bp_parts[1];
                if ($systolic < 90 || $diastolic < 60) {
                    $feedback[] = "Blood Pressure is LOW.";
                    $seeDoctor = true;
                } elseif ($systolic > 120 || $diastolic > 80) {
                    $feedback[] = "Blood Pressure is HIGH.";
                    $seeDoctor = true;
                } else {
                    $feedback[] = "Blood Pressure is NORMAL.";
                }
            } else {
                $feedback[] = "Invalid Blood Pressure format. Use systolic/diastolic format.";
            }

            // Diabetic Level
            if ($diabetic_level < 70) {
                $feedback[] = "Diabetic Level is LOW.";
                $seeDoctor = true;
            } elseif ($diabetic_level > 140) {
                $feedback[] = "Diabetic Level is HIGH.";
                $seeDoctor = true;
            } else {
                $feedback[] = "Diabetic Level is NORMAL.";
            }

            // Temperature
            if ($temperature < 97.9) {
                $feedback[] = "Temperature is LOW.";
                $seeDoctor = true;
            } elseif ($temperature > 100.1) {
                $feedback[] = "Temperature is HIGH.";
                $seeDoctor = true;
            } else {
                $feedback[] = "Temperature is NORMAL.";
            }

            // Cholesterol
            if ($cholesterol < 125) {
                $feedback[] = "Cholesterol is LOW.";
                $seeDoctor = true;
            } elseif ($cholesterol > 200) {
                $feedback[] = "Cholesterol is HIGH.";
                $seeDoctor = true;
            } else {
                $feedback[] = "Cholesterol is NORMAL.";
            }

            // Display Feedback
            echo "<div class='results'>";
            foreach ($feedback as $f) {
                echo "<p>$f</p>";
            }
            if ($seeDoctor) {
                echo "<div class='alert'>Please consult a doctor for further advice.</div>";
            } else {
                echo "<p>Your health metrics are within normal ranges. Keep up the good work!</p>";
            }
            echo "</div>";
        }
        ?>
        <a href="../model/patient_dashboard.php" class="back-button">Back to Dashboard</a>
    </div>
    
</body>
</html>
