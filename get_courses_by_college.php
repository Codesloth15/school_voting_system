<?php
$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) die("Connection failed");

header('Content-Type: application/json');

$collegeId = (int)($_GET['college_id'] ?? 0);
if ($collegeId <= 0) {
    echo json_encode([]);
    exit;
}

$result = $conn->prepare("SELECT id, name FROM courses WHERE college_id = ?");
$result->bind_param("i", $collegeId);
$result->execute();
$res = $result->get_result();

$courses = [];
while ($row = $res->fetch_assoc()) {
    $courses[] = $row;
}
echo json_encode($courses);
?>
