<!DOCTYPE html>
<html>
<head>
    <title>Create Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            text-align: center;
            color: #333;
        }

        h1 {
            font-size: 2em;
            color: #003366;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        button:active {
            background-color: #1e7e34;
            transform: translateY(0);
        }

        .back-button {
            text-decoration: none;
            color: white;
            background-color: #0056b3;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 10px;
        }

        .back-button:hover {
            background-color: #003366;
            transform: translateY(-2px);
        }

        .back-button:active {
            background-color: #002850;
            transform: translateY(0);
        }
    </style>
    <script>
        function validateBlogForm(event) {
            const title = document.getElementById("title").value.trim();
            const content = document.getElementById("content").value.trim();

            if (title === "") {
                alert("Blog title cannot be empty.");
                event.preventDefault();
                return false;
            }

            if (content === "") {
                alert("Blog content cannot be empty.");
                event.preventDefault();
                return false;
            }

            if (content.length < 50) {
                alert("Blog content must be at least 50 characters long.");
                event.preventDefault();
                return false;
            }

            return true; 
        }

        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector("form");
            form.addEventListener("submit", validateBlogForm);
        });
    </script>
</head>
<body>
    <h1>Create Health Blog</h1>
    <form method="POST" action="create_blog.php">
        <label for="title">Blog Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="content">Blog Content:</label>
        <textarea id="content" name="content" rows="8" cols="50" required></textarea>

        <button type="submit">Create Blog</button>
        <a href="../model/doctor_dashboard.php" class="back-button">Back to Dashboard</a>
    </form>
</body>
</html>
