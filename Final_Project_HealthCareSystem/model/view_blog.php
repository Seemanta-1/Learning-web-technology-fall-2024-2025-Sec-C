<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blogs</title>
    <link rel="stylesheet" href="../view/view_blog.css">
    <script>
        function fetchBlogs() {
            let xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../model/fetch_blogs.php', true);
            xhttp.send();

            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    let blogs = JSON.parse(this.responseText);
                    let output = "";

                    blogs.forEach(blog => {
                        output += `
                            <div class="blog">
                                <h2>${blog.title}</h2>
                                <p>${blog.content}</p>
                                <p><strong>Author:</strong> ${blog.author}</p>
                            </div>
                        `;
                    });

                    document.getElementById('blogContainer').innerHTML = output;
                }
            };
        }
    </script>
</head>
<body onload="fetchBlogs()">
    <h1>Health Blogs</h1>
    <div id="blogContainer">Loading blogs...</div>
    <a href="../model/patient_dashboard.php" class="back-button">Back to Dashboard</a>
    <footer>
        &copy; 2025 HealthCare System. All rights reserved.
    </footer>
</body>
</html>
