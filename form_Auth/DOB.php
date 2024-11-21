<html>
<body>
    <?php
    $day = $month = $year = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $day = $_POST["day"];
        $month = $_POST["month"];
        $year = $_POST["year"];

        if (empty($day) || empty($month) || empty($year)) {
            $error = "All fields are required.";
        } elseif (!is_numeric($day) || !is_numeric($month) || !is_numeric($year)) {
            $error = "Day, Month, and Year must be valid numbers.";
        } elseif ($day < 1 || $day > 31) {
            $error = "Day must be between 1 and 31.";
        } elseif ($month < 1 || $month > 12) {
            $error = "Month must be between 1 and 12.";
        } elseif ($year < 1953 || $year > 1998) {
            $error = "Year must be between 1953 and 1998.";
        } else {
            $error = "Date of Birth is valid.";
        }
    }
    ?>

    <form method="post">
        <fieldset>
            <legend>Date Of Birth</legend>
            <table>
                <tr class="table-center">
                    <td>dd</td>
                    <td>mm</td>
                    <td>yyyy</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="day" value="<?php echo htmlspecialchars($day); ?>"> /
                    </td>
                    <td>
                        <input type="text" name="month" value="<?php echo htmlspecialchars($month); ?>"> /
                    </td>
                    <td>
                        <input type="text" name="year" value="<?php echo htmlspecialchars($year); ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><span class="error"><?php echo $error; ?></span></td>
                </tr>
                <tr>
                    <td colspan="3"><hr></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>
</html>
