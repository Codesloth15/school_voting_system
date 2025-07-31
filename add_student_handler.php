<?php
$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_POST['student_id'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$ext = $_POST['ext'];
$gender = $_POST['gender'];
$college_id = $_POST['college_id'];
$course = $_POST['course'];
$year_level = $_POST['year_level'];
$status = $_POST['status'];

$stmt = $conn->prepare("INSERT INTO students (student_id, first_name, middle_name, last_name, ext, gender, college_id, course, year_level, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssiiss", $student_id, $first_name, $middle_name, $last_name, $ext, $gender, $college_id, $course, $year_level, $status);

if ($stmt->execute()) {
    header("Location: students.php?success=1");
    exit();
} else {
    echo "❌ Error: " . $stmt->error;
}
?>
