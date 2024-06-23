<?php
$conn = new mysqli('host', 'username', 'password', 'database');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, title, summary, date FROM articles ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<h3><a href='article.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h3>";
        echo "<p>" . $row['summary'] . "</p>";
        echo "<small>Objavljeno: " . $row['date'] . "</small>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "Nema novosti.";
}

$conn->close();
?>
