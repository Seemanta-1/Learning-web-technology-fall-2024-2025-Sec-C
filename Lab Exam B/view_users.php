<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['type'] != 'admin') {
header('Location: login.php');
exit;
}
$users = file('users.txt', FILE_IGNORE_NEW_LINES);
foreach ($users as $user) {
list($username, $password, $type) = explode(',', $user);
    echo "Username: $username, Type: $type<br>";
}
?>
<a href="logout.php">Logout</a>

