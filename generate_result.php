<?php
require('./fpdf182/fpdf.php'); // Make sure path is correct
session_start();

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$electionId = isset($_GET['election_id']) ? (int)$_GET['election_id'] : 0;
if ($electionId <= 0) die("Invalid election ID.");


// Step 1: Get course and title for this election
$course = "";
$title = "";
$courseQuery = $conn->prepare("SELECT course, title FROM elections WHERE id = ?");
$courseQuery->bind_param("i", $electionId);
$courseQuery->execute();
$courseResult = $courseQuery->get_result();

if ($courseResult->num_rows === 0) die("Election not found.");

$row = $courseResult->fetch_assoc();
$course = $row['course'];
$title = $row['title'];

$courseQuery->close();

if (empty($course)) die("Election does not have a course assigned.");

// Get candidates
$candidatesByPosition = [];
$stmt = $conn->prepare("SELECT * FROM candidates WHERE election_id = ?");
$stmt->bind_param("i", $electionId);
$stmt->execute();
$candidatesResult = $stmt->get_result();
while ($row = $candidatesResult->fetch_assoc()) {
    $candidatesByPosition[$row['position']][] = $row;
}
$stmt->close();

// Get votes
$stmt = $conn->prepare("
    SELECT v.candidate_id, v.student_id, c.position
    FROM votes v
    LEFT JOIN candidates c ON v.candidate_id = c.id
    WHERE v.election_id = ?
");
$stmt->bind_param("i", $electionId);
$stmt->execute();
$result = $stmt->get_result();

$votesByCandidate = [];
while ($row = $result->fetch_assoc()) {
    $cid = $row['candidate_id'];
    $votesByCandidate[$cid][] = $row['student_id'];
}
$stmt->close();

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, "Results for - $title", 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 8, "Course: $course", 0, 1);

$pdf->Ln(5);

foreach ($candidatesByPosition as $position => $candidates) {
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, "Position: $position", 0, 1);

    $highestVotes = -1;
    $winners = [];
    $voteResults = [];

    foreach ($candidates as $candidate) {
        $votes = count($votesByCandidate[$candidate['id']] ?? []);
        $voteResults[] = ['name' => $candidate['full_name'], 'votes' => $votes];

        if ($votes > $highestVotes) {
            $highestVotes = $votes;
            $winners = [$candidate['full_name']];
        } elseif ($votes === $highestVotes) {
            $winners[] = $candidate['full_name'];
        }
    }

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 8, "Winner(s): " . implode(', ', $winners), 0, 1);
    $pdf->Cell(0, 8, "Highest Vote(s): $highestVotes", 0, 1);
    $pdf->Cell(0, 8, "All Candidates:", 0, 1);

    foreach ($voteResults as $result) {
        $pdf->Cell(0, 8, "- {$result['name']}: {$result['votes']} vote(s)", 0, 1);
    }

    $pdf->Ln(5);
}

$pdf->Output("D", "election_results_$electionId.pdf");
