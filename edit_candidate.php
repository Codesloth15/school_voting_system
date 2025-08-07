<?php
session_start();

// DB connection
$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Sanitize and collect POST inputs
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$electionId = isset($_POST['election_id']) ? (int)$_POST['election_id'] : 0;
$full_name = trim($_POST['full_name'] ?? '');
$course = trim($_POST['course'] ?? '');
$year = isset($_POST['year']) ? (int)$_POST['year'] : 0;
$position = trim($_POST['position'] ?? '');
$platform = trim($_POST['platform'] ?? '');
$motto = trim($_POST['motto'] ?? '');

// Validate required fields
if (!$id || !$electionId || empty($full_name) || empty($course) || !$year || empty($position)) {
    die("❌ Missing or invalid form data.");
}

// Handle photo upload
$photo_url = null;
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['photo']['tmp_name'];
    $fileName = basename($_FILES['photo']['name']);
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($ext, $allowedExts)) {
        $newFileName = uniqid('img_', true) . '.' . $ext;
        $uploadPath = __DIR__ . '/uploads/' . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            $photo_url = 'uploads/' . $newFileName;
        } else {
            die("❌ Failed to move uploaded file.");
        }
    } else {
        die("❌ Invalid file type. Only JPG, JPEG, PNG, and GIF allowed.");
    }
}

// Update candidate in database
if ($photo_url) {
    $stmt = $conn->prepare("UPDATE candidates SET full_name=?, course=?, year=?, position=?, platform=?, motto=?, photo_url=? WHERE id=?");
    $stmt->bind_param("ssissssi", $full_name, $course, $year, $position, $platform, $motto, $photo_url, $id);
} else {
    $stmt = $conn->prepare("UPDATE candidates SET full_name=?, course=?, year=?, position=?, platform=?, motto=? WHERE id=?");
    $stmt->bind_param("ssisssi", $full_name, $course, $year, $position, $platform, $motto, $id);
}

// Execute and handle response
if ($stmt->execute()) {
    header("Location: view_election.php?election_id=$electionId");
    exit();
} else {
    echo "❌ Failed to update candidate. Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
