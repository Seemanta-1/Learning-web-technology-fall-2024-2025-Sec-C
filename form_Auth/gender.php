<html>
<body>
    <?php
    $gender = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["gender"])) {
            $error = "Please select a gender.";
        } else {
            $gender = $_POST["gender"];
            $error = "You selected: " . $gender;
        }
    }
    ?>

    <form method="post">
        <fieldset>
            <legend>Gender</legend>
            <table>
                <tr>
                    <td><input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?>> Male</td>
                    <td><input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>> Female</td>
                    <td><input type="radio" name="gender" value="Other" <?php if ($gender == "Other") echo "checked"; ?>> Other</td>
                </tr>
            </table>
            <span class="error"><?php echo $error; ?></span>
            <br>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</body>
</html>
