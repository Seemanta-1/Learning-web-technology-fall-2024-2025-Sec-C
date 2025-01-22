<html>
<head>
    <title>View Hospital Background</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color:rgb(249, 249, 249);
            color: #333;
        }
        h1 {
            color:rgb(0, 86, 179);
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
            background-color:rgb(0, 86, 179);
            color: white;
        }
        tr:nth-child(even) {
            background-color:rgb(242, 242, 242);
        }
        p {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>

<h1>Hospital Background</h1>

<?php
include '../controller/db_connection.php';

$sql = "SELECT * FROM hospitalbackground";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Hospital Name</th><th>Establishment Year</th><th>Founder/Director</th><th>Location</th><th>Description</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['hospital_name'] . "</td>";
        echo "<td>" . $row['establishment_year'] . "</td>";
        echo "<td>" . $row['founder_director'] . "</td>";
        echo "<td>" . $row['location'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No hospital background data found.</p>";
}

$conn->close();
?>

</body>
</html>
