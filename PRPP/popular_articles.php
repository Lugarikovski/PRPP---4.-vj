<?php
$conn = new mysqli('host', 'username', 'password', 'database');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, title, views FROM articles ORDER BY views DESC LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li><a href='article.php?id=" . $row['id'] . "'>" . $row['title'] . " (" . $row['views'] . " pregleda)</a></li>";
    }
    echo "</ul>";
} else {
    echo "Nema članaka.";
}

$conn->close();
?>
