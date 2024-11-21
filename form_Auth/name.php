<html>  
<body>
    <?php
    $name = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["Name"];

        if (empty($name)) {
            $error = "Name is required.";
        } elseif (!preg_match("/^[a-zA-Z][a-zA-Z .-]*$/", $name)) {
            $error = "Name must start with a letter and contain only letters, periods, or dashes.";
        } elseif (str_word_count($name) < 2) {
            $error = "Name must contain at least two words.";
        }
    }
    ?>

    <form method="post">
        <fieldset>
            <legend>Name</legend>
            <label for="name"></label><br>
            <input type="text" id="name" name="Name" value="<?php echo htmlspecialchars($name); ?>">
            <span class="error"><?php echo  $error; ?></span><br><br>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</body>
</html>
