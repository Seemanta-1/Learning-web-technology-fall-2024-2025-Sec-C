<?php
// Database configuration
$host = 'localhost:3307';      // Database host, usually localhost
$dbname = 'job_portal'; // Name of the database
$username = 'root';       // Database username
$password = '';           // Database password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
