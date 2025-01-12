<?php
require '../controller/db_connection.php';

// Retrieve POST data
$id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$contact_no = isset($_POST['contact']) ? $conn->real_escape_string($_POST['contact']) : '';
$username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';
$password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '';

// Validate required fields
if (!$id || !$name || !$contact_no || !$username) {
    echo "All fields are required.";
    exit();
}

// Prepare SQL query
if (!empty($password)) {
    $sql = "UPDATE employees SET name = '$name', contact_no = '$contact_no', username = '$username', password = '$password' WHERE id = '$id'";
} else {
    $sql = "UPDATE employees SET name = '$name', contact_no = '$contact_no', username = '$username' WHERE id = '$id'";
}

// Execute query
if ($conn->query($sql) === TRUE) {
    echo "Employee updated successfully.";
} else {
    echo "Error updating employee: " . $conn->error;
}

// Close connection
$conn->close();
?>
