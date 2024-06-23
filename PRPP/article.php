<?php
$article_id = $_GET['id'];

$conn = new mysqli('host', 'username', 'password', 'database');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE articles SET views = views + 1 WHERE id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();

$stmt = $conn->prepare("SELECT title, content FROM articles WHERE id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$stmt->bind_result($title, $content);
$stmt->fetch();

echo "<h1>" . $title . "</h1>";
echo "<p>" . $content . "</p>";

$stmt->close();
$conn->close();
?>
