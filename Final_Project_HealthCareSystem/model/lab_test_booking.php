<?php
include '../controller/db_connection.php'; // Adjust the path as needed
session_start();


$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $test_name = $conn->real_escape_string($_POST['test_name']);
    $test_date = $conn->real_escape_string($_POST['test_date']);
    $test_time = $conn->real_escape_string($_POST['test_time']);
    $additional_notes = $conn->real_escape_string($_POST['additional_notes']);

    $sql = "INSERT INTO lab_test_bookings (user_id, test_name, test_date, test_time, additional_notes) 
            VALUES ('$user_id', '$test_name', '$test_date', '$test_time', '$additional_notes')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Lab test booked successfully!</p>";
    } else {
        echo "<p class='error'>Error booking lab test: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Lab Test</title>
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
        input, textarea, button {
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
    </style>
</head>
<body>
    <h1>Book a Lab Test</h1>
    <form method="POST">
        <label for="test_name">Test Name:</label>
        <input type="text" id="test_name" name="test_name" required>

        <label for="test_date">Test Date:</label>
        <input type="date" id="test_date" name="test_date" required>

        <label for="test_time">Test Time:</label>
        <input type="time" id="test_time" name="test_time" required>

        <label for="additional_notes">Additional Notes:</label>
        <textarea id="additional_notes" name="additional_notes" rows="4"></textarea>

        <button type="submit">Book Test</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
