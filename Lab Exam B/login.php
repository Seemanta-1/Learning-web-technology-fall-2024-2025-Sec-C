

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
list($storedUser, $storedPass, $type) = explode(',', $user);
        if ($username == $storedUser&& $password == $storedPass) {
            $_SESSION['username'] = $username;
            $_SESSION['type'] = $type;
header('Location: ' . ($type == 'admin' ? 'admin.php' : 'user.php'));
exit;
        }
    }
    echo "Invalid credentials!";
}
?>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
<button type="submit">Login</button>
</form>






























































































