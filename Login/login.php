<?php
session_start();

// Redirect to welcome page if already logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: welcome.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validate input fields
    if (empty($_POST["Email"])) {
        $errors[] = "Email is required.";
    }
    if (empty($_POST["Password"])) {
        $errors[] = "Password is required.";
    }

    // Check credentials
    if (empty($errors)) {
        $storedUser = $_SESSION["user"] ?? null;
        if ($storedUser && $storedUser["Email"] === $_POST["Email"] && $storedUser["Password"] === $_POST["Password"]) {
            $_SESSION["loggedin"] = true;
            header("Location: welcome.php");
            exit();
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login Form</h1>
    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email"><br><br>

        <label for="Password">Password:</label>
        <input type="password" id="Password" name="Password"><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
