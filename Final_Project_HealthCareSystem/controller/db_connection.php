<?php
$host = 'localhost:3307';      
$dbname = 'healthsystem'; 
$username = 'root';       
$password = '';         


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
