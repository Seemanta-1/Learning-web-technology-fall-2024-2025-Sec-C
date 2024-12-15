<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['type'] != 'admin') {
header('Location: login.php');
exit;
}
echo "Welcome Admin, " . $_SESSION['username'] ."!<br>";
?>
<a href="profile.php">Profile</a><br>
<a href="view_users.php">View Users</a><br>
<a href="change_password.php">Change Password</a><br>
<a href="logout.php">Logout</a>

user.php

<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['type'] != 'user') {
header('Location: login.php');
exit;
}
echo "Welcome User, " . $_SESSION['username'] ."!<br>";
?>
<a href="profile.php">Profile</a><br>
<a href="change_password.php">Change Password</a><br>
<a href="logout.php">Logout</a>
