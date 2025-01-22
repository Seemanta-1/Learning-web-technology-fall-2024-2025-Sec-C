<html>
<head>
    <title>Hospital Background</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color:rgb(249, 249, 249);
            color: #333;
        }
        h1 {
            color:rgb(2, 92, 188);
        }
        form {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 5px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color:rgb(3, 95, 194);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color:rgb(6, 83, 170);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color:rgb(3, 87, 178);
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        function validateForm() {
            var hospitalName = document.forms["hospitalForm"]["hospital_name"].value;
            var establishmentYear = document.forms["hospitalForm"]["establishment_year"].value;
            var founderDirector = document.forms["hospitalForm"]["founder_director"].value;
            var location = document.forms["hospitalForm"]["location"].value;
            var description = document.forms["hospitalForm"]["description"].value;

            if (hospitalName == "" || establishmentYear == "" || founderDirector == "" || location == "" || description == "") {
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
?>

<h1>Hospital Background</h1>

<form name="hospitalForm" method="post" action="" onsubmit="return validateForm()">
    <label>Hospital Name:</label><br>
    <input type="text" name="hospital_name" required><br><br>

    <label>Establishment Year:</label><br>
    <input type="number" name="establishment_year" required><br><br>

    <label>Founder/Director:</label><br>
    <input type="text" name="founder_director" required><br><br>

    <label>Headquarters Location:</label><br>
    <input type="text" name="location" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="5" required></textarea><br><br>

    <input type="submit" name="save" value="Save Background">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $hospitalName = $_POST['hospital_name'];
    $establishmentYear = $_POST['establishment_year'];
    $founderDirector = $_POST['founder_director'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $sql = "INSERT INTO hospitalbackground (hospital_name, establishment_year, founder_director, location, description) 
            VALUES ('$hospitalName', $establishmentYear, '$founderDirector', '$location', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Hospital background added successfully!</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $hospitalName = $_POST['hospital_name'];
    $establishmentYear = $_POST['establishment_year'];
    $founderDirector = $_POST['founder_director'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $sql = "UPDATE hospitalbackground SET hospital_name='$hospitalName', establishment_year=$establishmentYear, 
            founder_director='$founderDirector', location='$location', description='$description' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Hospital background updated successfully!</p>";
    } else {
        echo "<p>Error updating record: " . $conn->error . "</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM hospitalbackground WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Hospital background deleted successfully!</p>";
    } else {
        echo "<p>Error deleting record: " . $conn->error . "</p>";
    }
}

$sql = "SELECT * FROM hospitalbackground";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Hospital Name</th><th>Establishment Year</th><th>Founder/Director</th><th>Location</th><th>Description</th><th>Actions</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['hospital_name'] . "</td>";
        echo "<td>" . $row['establishment_year'] . "</td>";
        echo "<td>" . $row['founder_director'] . "</td>";
        echo "<td>" . $row['location'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>
            <form method='post' style='display:inline;'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <input type='hidden' name='hospital_name' value='" . $row['hospital_name'] . "'>
                <input type='hidden' name='establishment_year' value='" . $row['establishment_year'] . "'>
                <input type='hidden' name='founder_director' value='" . $row['founder_director'] . "'>
                <input type='hidden' name='location' value='" . $row['location'] . "'>
                <input type='hidden' name='description' value='" . $row['description'] . "'>
                <input type='submit' name='update_form' value='Edit'>
            </form>
            <form method='post' style='display:inline;'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <input type='submit' name='delete' value='Delete'>
            </form>
        </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No records found.</p>";
}

if (isset($_POST['update_form'])) {
    $id = $_POST['id'];
    $hospitalName = $_POST['hospital_name'];
    $establishmentYear = $_POST['establishment_year'];
    $founderDirector = $_POST['founder_director'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    echo "<form method='post'>
        <h2>Edit Hospital Background</h2>
        <input type='hidden' name='id' value='$id'>
        <label>Hospital Name:</label><br>
        <input type='text' name='hospital_name' value='$hospitalName' required><br><br>
        <label>Establishment Year:</label><br>
        <input type='number' name='establishment_year' value='$establishmentYear' required><br><br>
        <label>Founder/Director:</label><br>
        <input type='text' name='founder_director' value='$founderDirector' required><br><br>
        <label>Headquarters Location:</label><br>
        <input type='text' name='location' value='$location' required><br><br>
        <label>Description:</label><br>
        <textarea name='description' rows='5' required>$description</textarea><br><br>
        <input type='submit' name='update' value='Update'>
    </form>";
}
?>

</body>
</html>
