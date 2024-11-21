<html>
<body>
    <?php
    $degrees = [];
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["degree"])) {
            $degrees = $_POST["degree"];
            if (count($degrees) < 2) {
                $error = "Please select at least two degrees.";
        } 
        }   
        else {
            $error = "Please select at least two degrees.";
        }
    }
    ?>

    <form method="post">
        <fieldset>
            <legend>Degree</legend>
            <table>
                <tr>
                    <td><input type="checkbox" name="degree[]" value="HSC" <?php if (in_array("HSC", $degrees)) echo "checked"; ?>> HSC</td>
                    <td><input type="checkbox" name="degree[]" value="SSC" <?php if (in_array("SSC", $degrees)) echo "checked"; ?>> SSC</td>
                    <td><input type="checkbox" name="degree[]" value="BSC" <?php if (in_array("BSC", $degrees)) echo "checked"; ?>> BSC</td>
                    <td><input type="checkbox" name="degree[]" value="MSC" <?php if (in_array("MSC", $degrees)) echo "checked"; ?>> MSC</td>
                </tr>
            </table>
            <span class="error"><?php echo $error; ?></span>
            <br>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</body>
</html>