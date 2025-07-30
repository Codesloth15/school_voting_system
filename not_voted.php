<?php
session_start();

$adminName = $_SESSION['admin_name'] ?? 'Admin';

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$electionId = isset($_GET['election_id']) ? (int)$_GET['election_id'] : 0;
if ($electionId <= 0) {
    die("Invalid election ID.");
}

// Get students who voted in this election
$votesSql = "SELECT DISTINCT student_id FROM votes WHERE election_id = ?";
$stmt = $conn->prepare($votesSql);
$stmt->bind_param("i", $electionId);
$stmt->execute();
$voteResult = $stmt->get_result();

$votedStudentIds = [];
while ($row = $voteResult->fetch_assoc()) {
    $votedStudentIds[] = $row['student_id'];
}
$stmt->close();

$idsIn = implode(',', array_map('intval', $votedStudentIds));
$whereNotIn = empty($idsIn) ? "1=1" : "id NOT IN ($idsIn)";

// Get students who didn't vote
$notVotedSql = "SELECT * FROM students WHERE $whereNotIn ORDER BY last_name";
$studentsResult = $conn->query($notVotedSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Students Who Didn't Vote</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<header class="bg-white shadow fixed w-full top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-10 h-10">
      <h1 class="text-xl font-bold text-red-600">Non-Voters - Election #<?= htmlspecialchars($electionId) ?></h1>
    </div>
    <div>
      <span class="text-gray-700">👋 <?= htmlspecialchars($adminName) ?></span>
      <a href="javascript:history.back()" class="ml-4 text-blue-600 hover:underline">⬅ Back</a>
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto pt-24 pb-10 px-4">
  <h2 class="text-2xl font-semibold mb-6 text-gray-800">Students Who Didn't Vote</h2>

  <div class="bg-white shadow rounded p-4 overflow-auto">
    <table class="w-full table-auto border-collapse">
      <thead class="bg-gray-200">
        <tr>
          <th class="p-2 border">#</th>
          <th class="p-2 border">Student ID</th>
          <th class="p-2 border">Full Name</th>
          <th class="p-2 border">Course</th>
          <th class="p-2 border">Year</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($studentsResult->num_rows > 0): ?>
          <?php $i = 1; while ($student = $studentsResult->fetch_assoc()): ?>
            <tr class="hover:bg-gray-50">
              <td class="p-2 border"><?= $i++ ?></td>
              <td class="p-2 border"><?= htmlspecialchars($student['student_id']) ?></td>
              <td class="p-2 border">
                <?= htmlspecialchars($student['last_name']) ?>, 
                <?= htmlspecialchars($student['first_name']) ?> 
                <?= htmlspecialchars($student['middle_name']) ?> <?= htmlspecialchars($student['ext']) ?>
              </td>
              <td class="p-2 border"><?= htmlspecialchars($student['course']) ?></td>
              <td class="p-2 border"><?= htmlspecialchars($student['year']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center p-4 text-gray-500">All students have voted.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

</body>
</html>
