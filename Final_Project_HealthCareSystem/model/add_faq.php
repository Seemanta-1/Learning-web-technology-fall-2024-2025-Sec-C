<?php
include '../controller/db_connection.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $conn->real_escape_string($_POST['question']);
    $answer = $conn->real_escape_string($_POST['answer']);

    $sql = "INSERT INTO faqs (question, answer) VALUES ('$question', '$answer')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center;'>FAQ added successfully!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add FAQ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
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
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        textarea, input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #34495e;
        }
        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Add FAQ</h1>

    <!-- Add FAQ Form -->
    <form method="POST" action="">
        <label for="question">Question:</label>
        <textarea id="question" name="question" required></textarea>

        <label for="answer">Answer:</label>
        <textarea id="answer" name="answer" required></textarea>

        <button type="submit">Add FAQ</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
