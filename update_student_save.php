<?php
$conn = new mysqli("localhost", "root", "", "voting_system");

// Check for required POST data
if (
    !isset($_POST['id']) || !is_numeric($_POST['id']) ||
    empty($_POST['first_name']) || empty($_POST['last_name']) ||
    empty($_POST['college_id']) || empty($_POST['course']) || empty($_POST['year_level'])
) {
    exit("❌ Error: Missing required fields.");
}

$id = (int)$_POST['id'];
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$college_id = (int)$_POST['college_id'];
$course = trim($_POST['alt']);
echo"<script>alert($course);</script>";
echo "$course"; // ✅ this is a string like "BSIT"
  // ✅ this is a string like "BSIT"
$year_level = (int)$_POST['year_level']; // Assuming year level is numeric

// Update query
$stmt = $conn->prepare("
    UPDATE students 
    SET first_name = ?, last_name = ?, college_id = ?, course = ?, year_level = ?
    WHERE id = ?
");

if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}

// ✅ Use correct types: s (string), i (integer)
$stmt->bind_param("ssissi", $first_name, $last_name, $college_id, $course, $year_level, $id);


if ($stmt->execute()) {
    header("Location: students.php?updated=1");
    exit;
} else {
    echo "❌ Error updating student: " . $stmt->error;
}
$stmt->close();
$conn->close();     
// ✅ Ensure the connection is closed after use
?>
