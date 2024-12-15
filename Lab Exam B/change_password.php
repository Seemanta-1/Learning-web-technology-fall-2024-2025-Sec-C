<?php
session_start();
if (!isset($_SESSION['username'])) {
header('Location: login.php');
exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = $_POST['new_password'];
    $lines = file('users.txt', FILE_IGNORE_NEW_LINES);
    $updated = [];
    foreach ($lines as $line) {
list($username, $password, $type) = explode(',', $line);
        if ($username == $_SESSION['username']) {
            $updated[] = "$username,$newPassword,$type";
        } else {
            $updated[] = $line;
        }
    }
file_put_contents('users.txt', implode("\n", $updated));
    echo "Password updated successfully!";
}
?>
<form method="POST">
    New Password: <input type="password" name="new_password" required><br>
<button type="submit">Update</button>
</form>
