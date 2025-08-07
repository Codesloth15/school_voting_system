<?php
session_start();
$adminName = $_SESSION['admin_name'] ?? 'Admin';

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$electionId = isset($_POST['election_id']) ? (int)$_POST['election_id'] : 0;
if ($electionId <= 0) die("Invalid election ID.");

// Step 1: Get course for this election
$course = "";
$courseQuery = $conn->prepare("SELECT course FROM elections WHERE id = ?");
$courseQuery->bind_param("i", $electionId);
$courseQuery->execute();
$courseResult = $courseQuery->get_result();
if ($courseResult->num_rows === 0) die("Election not found.");
$row = $courseResult->fetch_assoc();
$course = $row['course'];
$courseQuery->close();
if (empty($course)) die("Election does not have a course assigned.");

// Step 2: Fetch candidates
$candidatesByPosition = [];
$stmt = $conn->prepare("SELECT * FROM candidates WHERE election_id = ?");
$stmt->bind_param("i", $electionId);
$stmt->execute();
$candidatesResult = $stmt->get_result();
while ($row = $candidatesResult->fetch_assoc()) {
    $candidatesByPosition[$row['position']][] = $row;
}
$stmt->close();

// Step 3: Fetch all votes for this election
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
$votesByPosition = [];
$votedStudentsByPosition = [];
$allVotedStudentIds = [];

while ($row = $result->fetch_assoc()) {
    $cid = $row['candidate_id'];
    $pos = $row['position'];
    $sid = $row['student_id'];
    $votesByCandidate[$cid][] = $sid;
    $votesByPosition[$pos][$cid][] = $sid;
    $votedStudentsByPosition[$pos][$sid] = true;
    $allVotedStudentIds[$sid] = true;
}
$stmt->close();

// Step 4: Fetch students in that course
$allStudents = [];
$studentQuery = $conn->prepare(" 
    SELECT id, student_id, first_name, last_name, middle_name, ext, course, year_level 
    FROM students 
    WHERE course = ?
    ORDER BY last_name ASC
");

$studentQuery->bind_param("s", $course);
$studentQuery->execute();
$res = $studentQuery->get_result();
while ($s = $res->fetch_assoc()) {
    $allStudents[$s['student_id']] = $s;
}
$studentQuery->close();

$totalStudents = count($allStudents);

// Step 5: Get students who haven't voted
$notVotedStudents = [];
foreach ($allStudents as $student_id => $student) {
    if (!isset($allVotedStudentIds[$student_id])) {
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
<body class="bg-blue-100 font-sans">

<header class="bg-white border-b shadow fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-10 h-10" alt="Logo">
      <h1 class="text-xl font-bold text-blue-900">Admin</h1>
    </div>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 font-medium">👋 Welcome, <?= htmlspecialchars($adminName) ?></span>
      <a href="all_election.php" class="text-blue-600 hover:underline">Elections</a>
      <a href="dashboard.php" class="text-blue-600 hover:underline">Dashboard</a>
      <a href="logout.php" class="text-red-600 hover:underline">Logout</a>
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto pt-24 pb-10 px-4">
  <h2 class="text-2xl font-bold mb-6 text-gray-800">Election #<?= $electionId ?> Results</h2>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white p-4 shadow rounded">
      <p class="text-gray-600 text-sm">Total Students</p>
      <p class="text-2xl font-bold"><?= $totalStudents ?></p>
         <br>
       <div>
        <button  onclick="openSummaryModal()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
          Result
        </button>
      </div>
  
    </div>
    <div class="bg-white p-4 shadow rounded">
      <p class="text-gray-600 text-sm">Students Who Voted</p>
      <p class="text-2xl font-bold"><?= count($allVotedStudentIds) ?></p>
         <br>
       <div>
        <button onclick="openVotedModal()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
          Show Students Who Voted
        </button>
      </div>
    </div>
    <div class="bg-white p-4 shadow rounded">
      <p class="text-gray-600 text-sm">Not Yet Voted</p>
      <p class="text-2xl font-bold"><?= $totalStudents - count($allVotedStudentIds) ?></p>
      <br>
      <div class="mb-2">
        <button onclick="openModal()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
          Show Students Who Didn't Vote
        </button>
      </div>
     
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


<!-- MODAL: Summary of Winners -->
<div id="summaryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl max-h-[80vh] overflow-auto p-6 relative">
    <button onclick="closeSummaryModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black text-2xl">&times;</button>
    <h2 class="text-xl font-semibold mb-4">Election Summary: Winners & Total Votes</h2>

    <?php foreach ($candidatesByPosition as $position => $candidates): ?>
      <?php
        $winner = '';
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
      ?>
      <div class="mb-6">
        <h3 class="text-lg font-semibold text-blue-800"><?= htmlspecialchars($position) ?></h3>
        <p><strong>Winner<?= count($winners) > 1 ? 's' : '' ?>:</strong> <?= htmlspecialchars(implode(', ', $winners)) ?></p>
        <p><strong>Total Votes:</strong> <?= $highestVotes ?></p>
        <p class="mt-2 font-medium text-gray-700">All Candidates:</p>
        <ul class="list-disc list-inside text-gray-800">
          <?php foreach ($voteResults as $result): ?>
            <li><?= htmlspecialchars($result['name']) ?> — <?= $result['votes'] ?> vote<?= $result['votes'] === 1 ? '' : 's' ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
  </div>
  <a href="generate_result.php?election_id=<?= $electionId ?>" target="_blank">
  <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    Download PDF of Winners
  </button>
</a>

</div>

<!-- ADD TO YOUR EXISTING <script> -->
<script>
  function openSummaryModal() {
    document.getElementById("summaryModal").classList.remove("hidden");
    document.getElementById("summaryModal").classList.add("flex");
  }
  function closeSummaryModal() {
    document.getElementById("summaryModal").classList.remove("flex");
    document.getElementById("summaryModal").classList.add("hidden");
  }
</script>

<!-- MODAL: Not Voted -->
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

<!-- MODAL: Voted -->
<div id="votedModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl max-h-[80vh] overflow-auto p-6 relative">
    <button onclick="closeVotedModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black text-2xl">&times;</button>
    <h2 class="text-xl font-semibold mb-4">Students Who Voted</h2>
    <?php if (count($allVotedStudentIds) > 0): ?>
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
          <?php foreach ($allVotedStudentIds as $student_id => $_): 
            $s = $allStudents[$student_id] ?? null;
            if (!$s) continue;
          ?>
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
      <p class="text-gray-500">No students have voted yet.</p>
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

  function openVotedModal() {
    document.getElementById("votedModal").classList.remove("hidden");
    document.getElementById("votedModal").classList.add("flex");
  }
  function closeVotedModal() {
    document.getElementById("votedModal").classList.remove("flex");
    document.getElementById("votedModal").classList.add("hidden");
  }
</script>

</body>
</html>
