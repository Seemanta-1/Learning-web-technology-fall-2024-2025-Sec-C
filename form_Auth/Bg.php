<html>
<body>
    <?php
    $bloodGroup = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["bloodGroup"])) {
            $error = "Please select a blood group.";
        } 
    }
    ?>

    <form method="post">
        <fieldset>
            <legend>Blood Group</legend>
        <select name="bloodGroup" id="bloodGroup">
            <option value="">Select</option>
            <option value="A+" <?php if ($bloodGroup == "A+") echo "selected"; ?>>A+</option>
            <option value="B+" <?php if ($bloodGroup == "B+") echo "selected"; ?>>B+</option>
            <option value="AB+" <?php if ($bloodGroup == "AB+") echo "selected"; ?>>AB+</option>
            <option value="O+" <?php if ($bloodGroup == "O+") echo "selected"; ?>>O+</option>
        </select>
        <br>
        <span class="error"><?php echo $error; ?></span>
        <br><br>
        <input type="submit" value="Submit"></fieldset>
        
    </form>
</body>
</html>
