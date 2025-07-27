<?php
if (!empty($_GET['id'])) {
    $conn = new mysqli("localhost", "root", "", "voting_system");
    if ($conn->connect_error) die("Connection failed");

    $id = (int)$_GET['id'];

    // Optional: delete associated courses first
    $conn->query("DELETE FROM courses WHERE college_id = $id");
    $conn->query("DELETE FROM colleges WHERE id = $id");

    $conn->close();
    header("Location: voters.php?success=College deleted successfully");
    exit;
}
header("Location: voters.php?error=Invalid request");
exit;
