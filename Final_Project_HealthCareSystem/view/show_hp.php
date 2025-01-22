<html>
<head>
    <title>Hospital Profiles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(250, 250, 250);
            margin: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
            color:rgb(0, 86, 179);
        }
        .profile-container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .profile-container h2 {
            margin: 0 0 10px;
            color: #333;
        }
        .profile-container p {
            margin: 5px 0;
        }
        .specialization, .location {
            font-weight: bold;
            color: #555;
        }
        .description {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php
include '../controller/db_connection.php';

$sql = "SELECT hospital_name, specialization, location, description FROM hospitalprofiles";
$result = $conn->query($sql);

echo "<h1>Hospital Profiles</h1>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='profile-container'>";
        echo "<h2>" . $row['hospital_name'] . "</h2>";
        echo "<p class='specialization'>Specialization: " . $row['specialization'] . "</p>";
        echo "<p class='location'>Location: " . $row['location'] . "</p>";
        echo "<p class='description'>" . $row['description'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p style='text-align: center;'>No hospital profiles found.</p>";
}

$conn->close();
?>

</body>
</html>
