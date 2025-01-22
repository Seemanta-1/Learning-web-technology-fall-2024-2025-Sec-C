<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #003366;
            color: white;
        }
        .header h1 {
            font-size: 24px;
        }
        .header .logout {
            text-decoration: none;
            color: white;
            background-color: #d9534f;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .header .logout:hover {
            background-color: #c9302c;
        }
        .content {
            padding: 20px;
            margin: 0 auto;
            max-width: 1200px;
        }
        .dashboard-buttons {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            justify-content: center;
        }
        .dashboard-button {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 15px 20px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s;
        }
        .dashboard-button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #003366;
            color: white;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Admin Dashboard</h1>
        <a href="../controller/logout.php" class="logout">Logout</a>
    </header>

    <div class="content">
        <h2>Welcome, Admin!</h2>
        <p>Select an option below to manage the system:</p>

        <div class="dashboard-buttons">
            <a href="../model/add_contact.php" class="dashboard-button">Add Emergency Contacts</a>
            <a href="../model/add_faq.php" class="dashboard-button">Add FAQ</a>
            <a href="../model/view_lab_booking.php" class="dashboard-button">View Lab Booking</a>
            <a href="../model/clinical_portal.php" class="dashboard-button">Notification</a>
            <a href="../model/hb.php" class="dashboard-button">Add Hospital Background</a>
            <a href="../model/hp.php" class="dashboard-button">Add Hospital Profile</a>
        </div>
    </div>
</body>
</html>
