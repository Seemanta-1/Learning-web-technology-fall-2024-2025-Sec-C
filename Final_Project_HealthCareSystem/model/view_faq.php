<?php
include '../controller/db_connection.php';

// Fetch FAQs
$sql = "SELECT * FROM faqs ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View FAQs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        .faq {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .faq h2 {
            color: #2c3e50;
        }
        .faq p {
            margin: 10px 0;
        }
        a {
            display: block;
            text-align: center;
            margin: 20px auto;
            text-decoration: none;
            color: #3498db;
            font-size: 16px;
        }
        a:hover {
            text-decoration: underline;
            color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>FAQs</h1>

    <!-- Display FAQs -->
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="faq">
                <h2><?php echo htmlspecialchars($row['question']); ?></h2>
                <p><?php echo htmlspecialchars($row['answer']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align: center;">No FAQs found.</p>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
