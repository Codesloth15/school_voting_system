<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
    $conn = new mysqli("localhost", "root", "", "voting_system");
    if ($conn->connect_error) die("Connection failed");

    $name = $conn->real_escape_string(trim($_POST['name']));
    $conn->query("INSERT INTO colleges (name) VALUES ('$name')");
    $conn->close();

    header("Location: voters.php?success=College added successfully");
    exit;
}
header("Location: voters.php?error=Invalid request");
exit;
