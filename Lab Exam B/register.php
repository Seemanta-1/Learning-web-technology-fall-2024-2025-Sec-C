<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type']; // 'admin' or 'user'

    $data = "$username,$password,$type\n";
file_put_contents('users.txt', $data, FILE_APPEND);
    echo "Registration successful! <a href='login.php'>Login here</a>";
}
?>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Type: 
<select name="type">
<option value="admin">Admin</option>
<option value="user">User</option>
</select><br>
<button type="submit">Register</button>
</form>
