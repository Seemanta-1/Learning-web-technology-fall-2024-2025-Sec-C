<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validate input fields
    if (empty($_POST["Name"])) {
        $errors[] = "Name is required.";
    }
    if (empty($_POST["Email"])) {
        $errors[] = "Email is required.";
    }
    if (empty($_POST["Password"])) {
        $errors[] = "Password is required.";
    }

    // Save to session if no errors
    if (empty($errors)) {
        $_SESSION["user"] = [
            "Name" => $_POST["Name"],
            "Email" => $_POST["Email"],
            "Password" => $_POST["Password"],
        ];
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <h1>Registration Form</h1>
    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="Name">Name:</label>
        <input type="text" id="Name" name="Name"><br><br>

        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email"><br><br>

        <label for="Password">Password:</label>
        <input type="password" id="Password" name="Password"><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
