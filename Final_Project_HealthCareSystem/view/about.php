<!DOCTYPE html>
<html>
<head>
    <title>About Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: rgb(244, 244, 244);
            color: #333;
            margin: 20px;
        }

        h2 {
            color: rgb(20, 150, 142);
        }

        p {
            margin-bottom: 15px;
        }

        a {
            color: rgb(158, 51, 47);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        hr {
            margin: 20px 0;
            border: 0;
            border-top: 1px solid #ccc;
        }

        .update-form input, .update-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .update-form button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h2>About Information</h2>

    <?php
    $about = [
        "version" => "1.0.0",
        "developer" => "Prithoy",
        "email" => "prithoy@gmail.com",
        "website" => "www.hc.com"
    ];

    echo "<p><strong>Version:</strong> " . $about["version"] . "</p>";
    echo "<p><strong>Developer:</strong> " . $about["developer"] . "</p>";
    echo "<p><strong>Email:</strong> <a href='mailto:" . $about["email"] . "'>" . $about["email"] . "</a></p>";
    echo "<p><strong>Website:</strong> <a href='http://" . $about["website"] . "'>" . $about["website"] . "</a></p>";
    ?>

    <hr>

    <h2>Overview</h2>
    <?php
    $overview = "This portal is designed to manage hospital profiles, patient transaction histories, and hospital backgrounds efficiently and securely.";
    echo "<p>" . $overview . "</p>";
    ?>

    <hr>

    <h2>Purpose</h2>
    <?php
    $purpose = "This portal aims to streamline healthcare management by offering an intuitive interface for tracking critical data and simplifying operational workflows.";
    echo "<p>" . $purpose . "</p>";
    ?>

    <hr>

    <h2>Contact Us</h2>
    <?php
    $contact = "If you have any questions, feel free to reach out via the email provided above.";
    echo "<p>" . $contact . "</p>";
    ?>
</body>
</html>
