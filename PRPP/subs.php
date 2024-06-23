<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Neispravna email adresa.";
        exit;
    }

    $conn = new mysqli('host', 'username', 'password', 'database');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO subscriptions (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "Hvala što ste se pretplatili na novosti!";
    } else {
        echo "Došlo je do greške. Pokušajte ponovno kasnije.";
    }

    $stmt->close();
    $conn->close();
}
?>
