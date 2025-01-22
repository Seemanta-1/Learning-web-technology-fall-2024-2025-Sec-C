<?php
require '../controller/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $role = trim($_POST['role']);

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format. Please go back and try again.");
    }

   
    if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
        die("Invalid phone number format. Must be 10-15 digits.");
    }

    
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        die("Email already registered. Please use a different email.");
    }
    $checkEmail->close();

    
    $stmt = $conn->prepare("INSERT INTO users (username, email, phone_number, password, role) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssss", $username, $email, $phone, $password, $role);

    if ($stmt->execute()) {
        echo "Signup successful! <a href='../view/login.html'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
