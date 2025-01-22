<html>
<head>
    <title>View Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #0056b3;
        }

        .notification-container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .notification-container h2 {
            margin: 0 0 10px;
            color: #333;
        }

        .notification-container p {
            margin: 5px 0;
        }

        .notification-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .notification-actions a {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .notification-card {
            border-bottom: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .notification-card:last-child {
            border-bottom: none;
        }

        .learn-more {
            display: block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .learn-more:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
include '../controller/db_connection.php';
?>

<h1>View Notification</h1>

<?php
// Fetch notifications from the database
$sql = "SELECT * FROM notifications";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='notification-card'>";
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>" . $row['description'] . "</p>";
        
        // Add the Learn More link if a link exists
        if (!empty($row['link'])) {
            echo "<a href='" . $row['link'] . "' class='learn-more' target='_blank'>Learn More</a>";
        }

        echo "<div class='notification-actions'>";
        echo "<a href='edit.php?id=" . $row['id'] . "' class='edit-btn'>Edit</a>";
        echo "<a href='delete.php?id=" . $row['id'] . "' class='delete-btn'>Delete</a>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No notifications available.</p>";
}

$conn->close();
?>

</body>
</html>
