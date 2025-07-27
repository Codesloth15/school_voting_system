<?php
if (!empty($_GET['id'])) {
    $conn = new mysqli("localhost", "root", "", "voting_system");
    if ($conn->connect_error) die("Connection failed");

    $id = (int)$_GET['id'];
    $conn->query("DELETE FROM courses WHERE id = $id");
    $conn->close();

    header("Location: voters.php?success=Course deleted successfully");
    exit;
}
header("Location: voters.php?error=Invalid request");
exit;
