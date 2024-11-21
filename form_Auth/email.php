<!DOCTYPE html>
<html>
<body>
    <?php
    $email = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["Email"];

        if (empty($email)) {
            $error = "Email cannot be empty.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Please enter a valid email address (e.g., sample@example.com).";
        }
    }
    ?>
   
    <form method="post">
        <fieldset>
            <legend>Email</legend>
            <label for="email"></label> <br>
        <input type="email" id="email" name="Email" value="<?php echo htmlspecialchars($email); ?>"> 
        <abbr title="hint: sample@example.com">i</abbr><br>
        <span class="error"><?php echo $error; ?></span><br><br>
        <input type="submit" value="Submit"></fieldset>
        
    </form>
</body>
</html>
