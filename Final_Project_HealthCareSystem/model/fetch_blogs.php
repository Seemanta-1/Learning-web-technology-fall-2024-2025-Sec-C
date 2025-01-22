<?php
include '../controller/db_connection.php';

$sql = "SELECT b.title, b.content, u.username AS author 
        FROM Blogs b
        JOIN users u ON b.doctor_id = u.id";
$result = $conn->query($sql);

$blogs = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $blogs[] = [
            'title' => $row['title'],
            'content' => $row['content'],
            'author' => $row['author']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($blogs);
?>
