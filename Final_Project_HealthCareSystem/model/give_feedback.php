<!DOCTYPE html>
<html>
<head>
    <title>Give Feedback</title>
    <link rel="stylesheet" href="../view/give_feedback.css">
    <script>
        function validateFeedbackForm(event) {
            const doctorId = document.getElementById("doctor_id").value;
            const feedback = document.getElementById("feedback").value.trim();

            if (!doctorId) {
                alert("Please select a doctor.");
                event.preventDefault();
                return false;
            }

            if (feedback === "") {
                alert("Feedback cannot be empty.");
                event.preventDefault();
                return false;
            }

            if (feedback.length < 10) {
                alert("Feedback must be at least 10 characters long.");
                event.preventDefault();
                return false;
            }

            return true;
        }

        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector("form");
            form.addEventListener("submit", validateFeedbackForm);
        });
    </script>
</head>
<body>
    <div class="feature-section">
        <h2>Give Feedback</h2>
        <form action="../model/feedback.php" method="POST">
            <label for="doctor_id">Select Doctor:</label>
            <select name="doctor_id" id="doctor_id">
                <option value="">Select Doctor</option>
                <?php
                session_start();
                require '../controller/db_connection.php';

                $doctors = $conn->query("SELECT id, username FROM Users WHERE role='doctor'");
                while ($row = $doctors->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['username']) . "</option>";
                }
                ?>
            </select>
            <label for="feedback">Your Feedback:</label>
            <textarea name="feedback" id="feedback" placeholder="Write your feedback here..."></textarea>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
    <a href="../model/patient_dashboard.php" class="back-button">Back to Dashboard</a>
</body>
</html>
