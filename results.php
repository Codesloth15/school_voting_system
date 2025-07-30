<?php
session_start();
$adminName = $_SESSION['admin_name'] ?? 'Admin';
$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$electionId = isset($_POST['election_id']) ? (int)$_POST['election_id'] : 0;
if ($electionId <= 0) die("Invalid election ID.");

// Fetch candidates
$candidatesSql = "SELECT * FROM candidates WHERE election_id = ?";
$stmt = $conn->prepare($candidatesSql);
$stmt->bind_param("i", $electionId);
$stmt->execute();
$candidatesResult = $stmt->get_result();
$candidatesByPosition = [];
while ($row = $candidatesResult->fetch_assoc()) {
    $candidatesByPosition[$row['position']][] = $row;
}
$stmt->close();

// Fetch votes
$votesSql = "
    SELECT v.candidate_id, v.student_id, c.position
    FROM votes v
    LEFT JOIN candidates c ON v.candidate_id = c.id
    WHERE v.election_id = ?
";
$stmt = $conn->prepare($votesSql);
$stmt->bind_param("i", $electionId);
$stmt->execute();
$result = $stmt->get_result();

$votesByCandidate = [];
$votesByPosition = [];
$votedStudentsByPosition = [];
while ($row = $result->fetch_assoc()) {
    $cid = $row['candidate_id'];
    $pos = $row['position'];
    $sid = $row['student_id'];
    $votesByCandidate[$cid][] = $sid;
    $votesByPosition[$pos][$cid][] = $sid;
    $votedStudentsByPosition[$pos][$sid] = true;
}
$stmt->close();

// Get all students
$allStudents = [];
$res = $conn->query("SELECT id, student_id, first_name, last_name, middle_name, ext, course, year_level FROM students");
if (!$res) {
    die("Query failed: " . $conn->error);  // Helps you debug
}

while ($s = $res->fetch_assoc()) {
    $allStudents[$s['id']] = $s;
}

$totalStudents = count($allStudents);

// Flatten voted student IDs
$allVotedStudentIds = [];
foreach ($votedStudentsByPosition as $byPos) {
    foreach ($byPos as $sid => $v) {
        $allVotedStudentIds[$sid] = true;
    }
}

// Get students who haven’t voted
$notVotedStudents = [];
foreach ($allStudents as $id => $student) {
    if (!isset($allVotedStudentIds[$id])) {
        $notVotedStudents[] = $student;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Election Results</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">

<header class="bg-white shadow fixed w-full top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-10 h-10">
      <h1 class="text-xl font-bold text-blue-900">Election Results</h1>
    </div>
    <div>
      <span class="text-gray-700">👋 <?= htmlspecialchars($adminName) ?></span>
      <a href="elections.php" class="ml-4 text-blue-600 hover:underline">Back</a>
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto pt-24 pb-10 px-4">
  <h2 class="text-2xl font-bold mb-6 text-gray-800">Election #<?= $electionId ?> Results</h2>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white p-4 shadow rounded">
      <p class="text-gray-600 text-sm">Total Students</p>
      <p class="text-2xl font-bold"><?= $totalStudents ?></p>
    </div>
    <div class="bg-white p-4 shadow rounded">
      <p class="text-gray-600 text-sm">Students Who Voted</p>
      <p class="text-2xl font-bold"><?= count($allVotedStudentIds) ?></p>
      <br>
      <div class="mb-4">
        <button onclick="openModal()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
          Show Students Who Didn't Vote
        </button>
      </div>
    </div>
    <div class="bg-white p-4 shadow rounded">
      <p class="text-gray-600 text-sm">Not Yet Voted</p>
      <p class="text-2xl font-bold"><?= $totalStudents - count($allVotedStudentIds) ?></p>
    </div>
  </div>

  <div class="space-y-10">
    <?php foreach ($candidatesByPosition as $position => $candidates): ?>
      <div class="bg-white rounded shadow p-6">
        <h3 class="text-xl font-semibold text-blue-800 mb-4"><?= htmlspecialchars($position) ?></h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div class="space-y-2">
            <?php foreach ($candidates as $candidate): ?>
              <div class="flex justify-between">
                <span><?= htmlspecialchars($candidate['full_name']) ?></span>
                <span class="font-semibold"><?= count($votesByCandidate[$candidate['id']] ?? []) ?> vote(s)</span>
              </div>
            <?php endforeach; ?>
          </div>
          <div>
            <canvas id="chart-<?= md5($position) ?>" width="300" height="300"></canvas>
            <script>
              const ctx<?= md5($position) ?> = document.getElementById('chart-<?= md5($position) ?>').getContext('2d');
              new Chart(ctx<?= md5($position) ?>, {
                type: 'pie',
                data: {
                  labels: [
                    <?php foreach ($candidates as $candidate): ?>
                      "<?= addslashes($candidate['full_name']) ?>",
                    <?php endforeach; ?>
                    "Not Voted"
                  ],
                  datasets: [{
                    data: [
                      <?php
                        $totalVotedForPosition = 0;
                        foreach ($candidates as $c) {
                            $voteCount = count($votesByCandidate[$c['id']] ?? []);
                            echo "$voteCount,";
                            $totalVotedForPosition += $voteCount;
                        }
                        $notVoted = max(0, $totalStudents - $totalVotedForPosition);
                        echo "$notVoted";
                      ?>
                    ],
                    backgroundColor: [
                      <?php
                        $colors = ["#60a5fa", "#f87171", "#34d399", "#fbbf24", "#c084fc", "#f472b6"];
                        foreach ($candidates as $i => $c) {
                            echo "'".$colors[$i % count($colors)]."',";
                        }
                        echo "'#d1d5db'";
                      ?>
                    ],
                    borderWidth: 1
                  }]
                },
                options: {
                  responsive: false,
                  plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                      callbacks: {
                        label: function(ctx) {
                          return `${ctx.label}: ${ctx.parsed} vote(s)`;
                        }
                      }
                    }
                  }
                }
              });
            </script>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<!-- MODAL -->
<div id="notVotedModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl max-h-[80vh] overflow-auto p-6 relative">
    <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black text-2xl">&times;</button>
    <h2 class="text-xl font-semibold mb-4">Students Who Haven't Voted</h2>
    <?php if (count($notVotedStudents) > 0): ?>
      <table class="w-full border border-collapse text-sm">
        <thead class="bg-gray-100 text-left">
          <tr>
            <th class="border px-2 py-1">Student ID</th>
            <th class="border px-2 py-1">Full Name</th>
            <th class="border px-2 py-1">Course</th>
            <th class="border px-2 py-1">Year</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($notVotedStudents as $s): ?>
            <tr class="hover:bg-gray-50">
              <td class="border px-2 py-1"><?= htmlspecialchars($s['student_id']) ?></td>
              <td class="border px-2 py-1"><?= htmlspecialchars($s['last_name']) ?>, <?= htmlspecialchars($s['first_name']) ?> <?= htmlspecialchars($s['middle_name']) ?> <?= htmlspecialchars($s['ext']) ?></td>
              <td class="border px-2 py-1"><?= htmlspecialchars($s['course']) ?></td>
              <td class="border px-2 py-1"><?= htmlspecialchars($s['year_level']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-gray-500">All students have voted.</p>
    <?php endif; ?>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById("notVotedModal").classList.remove("hidden");
    document.getElementById("notVotedModal").classList.add("flex");
  }
  function closeModal() {
    document.getElementById("notVotedModal").classList.remove("flex");
    document.getElementById("notVotedModal").classList.add("hidden");
  }
</script>

</body>
</html>
