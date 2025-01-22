<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="../view/book_appointment.css"> 
    <script>
        function validateForm(event) {
            const doctor = document.getElementById("doctor").value;
            const date = document.getElementById("date").value;
            const time = document.getElementById("time").value;
            const today = new Date().toISOString().split("T")[0]; 

            if (!doctor) {
                alert("Please select a doctor.");
                event.preventDefault();
                return false;
            }

            if (!date || date < today) {
                alert("Please select a valid appointment date.");
                event.preventDefault();
                return false;
            }

            if (!time) {
                alert("Please select a valid appointment time.");
                event.preventDefault();
                return false;
            }

            return true;
        }

        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector("form");
            form.addEventListener("submit", validateForm);
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Book Appointment</h1>
        <form action="../model/book_appointment.php" method="POST">
            <label for="doctor">Select Doctor:</label>
            <select id="doctor" name="doctor_id" required>
                <?php
                include '../controller/db_connection.php';

                if (!$conn) {
                    die("Database connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT id, username FROM users WHERE role = 'doctor'";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Query failed: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['username']}</option>";
                    }
                } else {
                    echo "<option value=''>No doctors available</option>";
                }
                ?>
            </select>

            <label for="date">Select Date:</label>
            <input type="date" id="date" name="appointment_date" required>

            <label for="time">Select Time:</label>
            <input type="time" id="time" name="appointment_time" required>

            <label for="fee">Appointment Fee:</label>
            <input type="text" id="fee" name="fee" value="500" readonly>

            <button type="submit">Book Appointment</button>
        </form>
        <p><a href="../model/patient_dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
