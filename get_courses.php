<?php
$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) die(json_encode([]));

$college_id = $_GET['college_id'] ?? '';
if ($college_id) {
    $stmt = $conn->prepare("SELECT name FROM courses WHERE college_id = ?");
    $stmt->bind_param("i", $college_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
    echo json_encode($courses);
} else {
    echo json_encode([]);
}
?>
