<?php
session_start();
require '../controller/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role FROM Users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'employee') {
                header("Location: ../model/employee_dashboard.php");
            }
            elseif ($user['role'] == 'admin') {
                header("Location: ../model/admin_dashboard.php");        
            }else {
                echo "Invalid role!";
            }
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
    $conn->close();
}
?>
