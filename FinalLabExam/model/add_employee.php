<?php
require '../controller/db_connection.php';

// Retrieve and sanitize POST data
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$company = isset($_POST['company']) ? $conn->real_escape_string($_POST['company']) : '';
$contact = isset($_POST['contact']) ? $conn->real_escape_string($_POST['contact']) : '';
$username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';
$password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '';

// Validate required fields
if (empty($name) || empty($company) || empty($contact) || empty($username) || empty($password)) {
    echo "All fields are required.";
    exit();
}

// Check for duplicate username
$sql = "SELECT id FROM employers WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Username already exists. Please choose a different one.";
    exit();
}

// Insert data into the database
$sql = "INSERT INTO employers (name, company, contact, username, password) 
        VALUES ('$name', '$company', '$contact', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Employee added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
