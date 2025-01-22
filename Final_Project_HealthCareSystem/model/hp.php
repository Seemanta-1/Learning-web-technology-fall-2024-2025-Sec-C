<html>
<head>
    <title>Hospital Profiles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(244, 244, 244);
            margin: 20px;
        }

        h1 {
            color: rgb(47, 61, 71);
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: rgb(55, 72, 83);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: rgb(48, 63, 67);
        }

        .hospital-container {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .hospital-container h3 {
            margin: 0;
            color: #333;
        }

        .hospital-container p {
            margin: 5px 0;
        }

        .edit-delete {
            float: right;
            color: rgb(243, 156, 18);
            cursor: pointer;
        }

        .delete {
            color: rgb(230, 72, 54);
        }
    </style>
    <script>
        function validateForm() {
            var hospitalName = document.forms["hospitalForm"]["hospital_name"].value;
            var specialization = document.forms["hospitalForm"]["specialization"].value;
            var location = document.forms["hospitalForm"]["location"].value;
            var description = document.forms["hospitalForm"]["description"].value;

            if (hospitalName == "" || specialization == "" || location == "" || description == "") {
                alert("All fields must be filled out.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<?php
include '../controller/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $hospitalName = $_POST['hospital_name'];
    $specialization = $_POST['specialization'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $sql = "INSERT INTO hospitalprofiles (hospital_name, specialization, location, description) 
            VALUES ('$hospitalName', '$specialization', '$location', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Hospital profile added successfully!</p>";
    } else {
        echo "Error: ". $sql. "<br>". $conn->error;
    }
}

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    $sql = "DELETE FROM hospitalprofiles WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Hospital profile deleted successfully!</p>";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<h1>Hospital Profiles</h1>

<form name="hospitalForm" method="post" action="" onsubmit="return validateForm()">
    <label>Hospital Name:</label><br>
    <input type="text" name="hospital_name" placeholder="Enter hospital name" required><br><br>

    <label>Specialization:</label><br>
    <input type="text" name="specialization" placeholder="Enter specialization" required><br><br>

    <label>Location:</label><br>
    <input type="text" name="location" placeholder="Enter hospital location" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="5" placeholder="Enter hospital description" required></textarea><br><br>

    <input type="submit" name="save" value="Save Profile">
</form>

<h2>List of Hospital Profiles</h2>

<?php
$sql = "SELECT id, hospital_name, specialization, location, description FROM hospitalprofiles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='hospital-container'>";
        echo "<h3>" . $row['hospital_name'] . " <span class='edit-delete'><a href='?edit_id=" . $row['id'] . "'>Edit</a> | <a href='?delete_id=" . $row['id'] . "' class='delete'>Delete</a></span></h3>";
        echo "<p><strong>Specialization:</strong> " . $row['specialization'] . "</p>";
        echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
        echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No hospital profiles available.</p>";
}

$conn->close();
?>

</body>
</html>
