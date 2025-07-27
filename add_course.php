<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['college_id']) && !empty($_POST['name'])) {
    $conn = new mysqli("localhost", "root", "", "voting_system");
    if ($conn->connect_error) die("Connection failed");

    $collegeId = (int)$_POST['college_id'];
    $name = $conn->real_escape_string(trim($_POST['name']));
    $conn->query("INSERT INTO courses (college_id, name) VALUES ($collegeId, '$name')");
    $conn->close();

    header("Location: voters.php?success=Course added successfully");
    exit;
}
header("Location: voters.php?error=Invalid request");
exit;
