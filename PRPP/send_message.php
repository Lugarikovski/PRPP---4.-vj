<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validacija email adrese
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Neispravna email adresa.";
        exit;
    }

    // Pohranjivanje poruke u bazu podataka ili slanje emaila
    $conn = new mysqli('host', 'username', 'password', 'database');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Poruka je uspješno poslana!";
    } else {
        echo "Došlo je do greške. Pokušajte ponovno kasnije.";
    }

    $stmt->close();
    $conn->close();
}
?>
