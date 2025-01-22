<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Center</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(249, 249, 249);
            margin: 20px;
        }

        h1 {
            color:rgb(53, 66, 74);
            text-align: center;
        }

        form {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            max-width: 500px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form input, form textarea, form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            background-color:rgb(53, 66, 74);
            color: white;
            cursor: pointer;
        }

        form button:hover {
            background-color:rgb(237, 74, 29);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color:rgb(53, 66, 74);
            color: white;
        }

        .actions button {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .actions .edit {
            background-color:rgba(0, 123, 255, 0.95);
            color: white;
        }

        .actions .edit:hover {
            background-color:rgb(0, 86, 179);
        }

        .actions .delete {
            background-color:rgb(220, 53, 69);
            color: white;
        }

        .actions .delete:hover {
            background-color:rgb(167, 29, 42);
        }

        .notification-btn {
            display: inline-block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color:rgb(40, 158, 67);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
        }

        .notification-btn:hover {
            background-color:rgb(35, 140, 57);
        }
    </style>
</head>
<body>
<h1>Notification Center</h1>

<?php
include '../controller/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_notification'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link']; 

    $sql = "INSERT INTO notifications (title, description, link) VALUES ('$title', '$description', '$link')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Notification added successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_notification'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link']; 

    $sql = "UPDATE notifications SET title='$title', description='$description', link='$link' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Notification updated successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM notifications WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $reset_sql = "ALTER TABLE notifications AUTO_INCREMENT = 1";
        if ($conn->query($reset_sql) === TRUE) {
            echo "<p>Notification deleted and ID reset successfully!</p>";
        } else {
            echo "<p>Error resetting ID: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<form method="post" action="" onsubmit="return validateForm()">
    <h2>Add New Notification</h2>
    <input type="text" name="title" placeholder="Notification Title" required>
    <textarea name="description" rows="4" placeholder="Notification Description" required></textarea>
    <input type="text" name="link" placeholder="Notification Link (Optional)">
    <button type="submit" name="add_notification">Add Notification</button>
</form>

<h2>Manage Notifications</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Link</th> 
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM notifications";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>";
            if ($row['link']) {
                echo "<a href='" . $row['link'] . "' target='_blank'>" . $row['link'] . "</a>";
            } else {
                echo "None";
            }
            echo "</td>";
            echo "<td class='actions'>";
            echo "<form method='post' action='' style='display:inline;'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<input type='text' name='title' value='" . $row['title'] . "' required>";
            echo "<textarea name='description' rows='2' required>" . $row['description'] . "</textarea>";
            echo "<input type='text' name='link' value='" . $row['link'] . "' placeholder='Link'>";
            echo "<button type='submit' name='update_notification' class='edit'>Edit</button>";
            echo "</form>";
            echo "<a href='?delete=" . $row['id'] . "' class='delete' style='text-decoration: none;'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No notifications found.</td></tr>";
    }
    ?>
    </tbody>
</table>

<script>
    function validateForm() {
        var title = document.querySelector("input[name='title']").value;
        var description = document.querySelector("textarea[name='description']").value;
        
        if (title.trim() === "") {
            alert("Please enter the notification title.");
            return false;
        }
        
        if (description.trim() === "") {
            alert("Please enter the notification description.");
            return false;
        }

        return true;
    }
</script>

</body>
</html>
