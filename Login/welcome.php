<?php
session_start();

// Debug session data
if (empty($_SESSION)) {
    echo "Session is empty. Please register or login first.";
    exit();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo "You are not logged in! Redirecting to login page...";
    header("Refresh: 2; url=login.php");
    exit();
}

$user = $_SESSION["user"] ?? null;
if (!$user) {
    echo "User information is missing in the session. Redirecting to registration...";
    header("Refresh: 2; url=register.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user["Name"]); ?>!</h1>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user["Email"]); ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
