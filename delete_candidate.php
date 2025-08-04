<?php
session_start();

// 🔐 Optional: You can protect this file by checking if admin is logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$candidateId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$electionId = isset($_GET['election_id']) ? (int)$_GET['election_id'] : 0;

if ($candidateId <= 0 || $electionId <= 0) {
    die("❌ Invalid candidate or election ID.");
}

// Optional: Fetch candidate to get photo URL (for cleanup)
$stmt = $conn->prepare("SELECT photo_url FROM candidates WHERE id = ?");
$stmt->bind_param("i", $candidateId);
$stmt->execute();
$result = $stmt->get_result();
$photo = null;
if ($row = $result->fetch_assoc()) {
    $photo = $row['photo_url'];
}
$stmt->close();

// Delete candidate
$stmt = $conn->prepare("DELETE FROM candidates WHERE id = ?");
$stmt->bind_param("i", $candidateId);
$stmt->execute();
$stmt->close();

// Optionally delete photo from server (if applicable and not external URL)
if ($photo && file_exists($photo) && strpos($photo, 'http') !== 0) {
    unlink($photo);
}

// Redirect back to candidates list
header("Location: view_election.php?election_id=" . $electionId);
exit();
