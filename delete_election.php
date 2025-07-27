<?php
session_start();

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['election_id'])) {
    $electionId = intval($_POST['election_id']);

    // Optional: delete related positions
    $conn->query("DELETE FROM election_positions WHERE election_id = $electionId");

    // Delete the election
    $deleteQuery = "DELETE FROM elections WHERE id = $electionId";
    if ($conn->query($deleteQuery)) {
        $_SESSION['delete_success'] = "Election deleted successfully.";
    } else {
        $_SESSION['delete_error'] = "Error deleting election.";
    }
}

header("Location: elections.php");
exit;
