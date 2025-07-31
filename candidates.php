<?php
session_start();
$conn = new mysqli("localhost", "root", "", "voting_system");
$studentName = $_SESSION['student_name'];
$student_id = $_SESSION['student_id'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alertMessage = "";
$redirect = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['votes'])) {
    $votes = $_POST['votes'];
    $election_id = intval($_POST['election_id']);

    // Load position limits
    $positionLimits = [];
    $requiredPositions = [];
    $positionLimitQuery = $conn->prepare("SELECT position, `count` FROM election_positions WHERE election_id = ?");
    $positionLimitQuery->bind_param("i", $election_id);
    $positionLimitQuery->execute();
    $positionLimitResult = $positionLimitQuery->get_result();
    while ($row = $positionLimitResult->fetch_assoc()) {
        $positionLimits[$row['position']] = intval($row['count']);
        $requiredPositions[] = $row['position'];
    }

    // Check if already voted
    $check = $conn->prepare("SELECT COUNT(*) FROM votes WHERE voter_id = ? AND election_id = ?");
    $check->bind_param("ii", $student_id, $election_id);
    $check->execute();
    $check->bind_result($voteCount);
    $check->fetch();
    $check->close();

    if ($voteCount > 0) {
        $alertMessage = "You have already voted in this election.";
    } else {
        $valid = true;

        // Enforce voting for all required positions
        foreach ($requiredPositions as $position) {
            if (!isset($votes[$position])) {
                $valid = false;
                $alertMessage = "You must vote for all required positions.";
                break;
            }

            $selected = $votes[$position];
            $selectedCount = is_array($selected) ? count($selected) : 1;
            $maxVotes = $positionLimits[$position];

            if ($selectedCount !== $maxVotes) {
                $valid = false;
                $alertMessage = "You must select exactly $maxVotes candidate(s) for $position.";
                break;
            }
        }

        if ($valid) {
            $stmt = $conn->prepare("INSERT INTO votes (election_id, voter_id, student_id, candidate_id, position) VALUES (?, ?, ?, ?, ?)");
            foreach ($votes as $position => $selected) {
                $selectedCandidates = is_array($selected) ? $selected : [$selected];
                foreach ($selectedCandidates as $candidate_id) {
                    $stmt->bind_param("issis", $election_id, $student_id, $student_id, $candidate_id, $position);
                    $stmt->execute();
                }
            }
            $stmt->close();
            $alertMessage = "Your vote has been submitted successfully.";
            $redirect = true;
        }
    }
}

// Ensure election ID is provided
if (!isset($_GET['election_id'])) {
    die("Election not specified.");
}

$election_id = intval($_GET['election_id']);

// Load election info
$election = null;
$electionQuery = $conn->prepare("SELECT title FROM elections WHERE id = ?");
$electionQuery->bind_param("i", $election_id);
$electionQuery->execute();
$electionResult = $electionQuery->get_result();
$election = $electionResult->fetch_assoc();
$electionQuery->close();

if (!$election) {
    die("Election not found.");
}

// Load candidates
$candidatesByPosition = [];
$stmt = $conn->prepare("SELECT * FROM candidates WHERE election_id = ? ORDER BY position, full_name");
$stmt->bind_param("i", $election_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $candidatesByPosition[$row['position']][] = $row;
}
$stmt->close();

// Load position limits again for frontend
$positionLimits = [];
$positionLimitQuery = $conn->prepare("SELECT position, `count` FROM election_positions WHERE election_id = ?");
$positionLimitQuery->bind_param("i", $election_id);
$positionLimitQuery->execute();
$positionLimitResult = $positionLimitQuery->get_result();
while ($row = $positionLimitResult->fetch_assoc()) {
    $positionLimits[$row['position']] = intval($row['count']);
}
$positionLimitQuery->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Candidates</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans">

<?php if (!empty($alertMessage)): ?>
<script>
  alert("<?= $alertMessage ?>");
  <?php if ($redirect): ?> window.location.href = 'index.php'; <?php endif; ?>
</script>
<?php endif; ?>

<header class="bg-white border-b shadow fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-10 h-10" alt="Logo">
      <h1 class="text-xl font-bold text-blue-900">School Voting System</h1>
    </div>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 font-medium">👋 Welcome, <?= htmlspecialchars($studentName) ?></span>
      <a href="colleges.php" class="text-blue-600 hover:underline">Elections</a>
      <a href="student_logout.php" class="text-red-600 hover:underline">Logout</a>
    </div>
  </div>
</header>

<section class="max-w-6xl mx-auto pt-24 pb-12 px-4">
  <h2 class="text-2xl font-bold text-blue-900 mb-6">
    Candidates for: <?= htmlspecialchars($election['title'] ?? 'Unknown Election') ?>
  </h2>

  <form method="POST" onsubmit="return validateVote();">
    <input type="hidden" name="election_id" value="<?= $election_id ?>">

    <?php if (!empty($candidatesByPosition)): ?>
      <?php foreach ($candidatesByPosition as $position => $candidates): 
        $limit = $positionLimits[$position] ?? 1;
      ?>
      <div class="mb-10">
        <div class="flex justify-between items-center mb-3">
          <h3 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($position) ?></h3>
          <span class="text-sm text-gray-500">Select exactly <?= $limit ?> candidate<?= $limit > 1 ? 's' : '' ?></span>
        </div>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 vote-section" data-position="<?= htmlspecialchars($position) ?>" data-limit="<?= $limit ?>">
          <?php foreach ($candidates as $candidate): ?>
          <label class="bg-white border rounded-2xl shadow p-4 hover:shadow-lg cursor-pointer relative">
            <input 
              type="<?= $limit > 1 ? 'checkbox' : 'radio' ?>"
              name="votes[<?= htmlspecialchars($position) ?>]<?= $limit > 1 ? '[]' : '' ?>"
              value="<?= $candidate['id'] ?>"
              class="hidden peer"
              onchange="handleVoteLimit(this)"
            >
            <div class="flex flex-col items-center peer-checked:border-blue-700 peer-checked:ring-2 peer-checked:ring-blue-500 p-2 rounded-xl">
              <img src="<?= htmlspecialchars($candidate['photo_url']) ?>" onerror="this.src='default.png';"
                   class="w-24 h-24 object-cover rounded-full border mb-2">
              <h4 class="text-lg font-semibold text-center text-gray-800"><?= htmlspecialchars($candidate['full_name']) ?></h4>
              <p class="text-sm text-gray-600 text-center"><?= htmlspecialchars($candidate['course']) ?> | Year <?= $candidate['year'] ?></p>
              <button type="button"
                      onclick="showModal('<?= addslashes($candidate['full_name']) ?>', '<?= addslashes($candidate['motto']) ?>', '<?= addslashes($candidate['platform']) ?>')"
                      class="text-sm text-blue-600 hover:underline mt-1">View Info</button>
            </div>
          </label>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-red-500">No candidates found for this election.</p>
    <?php endif; ?>

    <div class="text-center mt-10">
      <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-xl text-lg shadow">
        Submit My Vote
      </button>
    </div>
  </form>
</section>

<!-- Modal -->
<div id="infoModalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>
<div id="infoModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-xl shadow-lg max-w-md w-full mx-4 p-6 relative">
    <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-2xl">✕</button>
    <h2 id="modalName" class="text-xl font-bold text-blue-900 mb-2"></h2>
    <p class="text-gray-700"><strong>Motto:</strong> <span id="modalMotto"></span></p>
    <p class="text-gray-700 mt-2"><strong>Platform:</strong></p>
    <p id="modalPlatform" class="text-gray-600 whitespace-pre-wrap"></p>
  </div>
</div>

<script>
function handleVoteLimit(input) {
  const section = input.closest('.vote-section');
  const limit = parseInt(section.dataset.limit);
  const checkboxes = section.querySelectorAll("input[type='checkbox']");
  const checkedCount = Array.from(checkboxes).filter(i => i.checked).length;

  if (limit > 1) {
    checkboxes.forEach(cb => {
      if (!cb.checked) {
        cb.disabled = checkedCount >= limit;
      }
    });
  }
}

function validateVote() {
  const sections = document.querySelectorAll(".vote-section");
  for (let section of sections) {
    const position = section.dataset.position;
    const limit = parseInt(section.dataset.limit);
    const checked = section.querySelectorAll("input:checked");

    if (checked.length !== limit) {
      alert(`You must select exactly ${limit} candidate${limit > 1 ? 's' : ''} for ${position}`);
      return false;
    }
  }
  return confirm("Are you sure you want to submit your vote?");
}

function showModal(name, motto, platform) {
  document.getElementById('modalName').textContent = name;
  document.getElementById('modalMotto').textContent = motto;
  document.getElementById('modalPlatform').textContent = platform;

  document.getElementById('infoModal').classList.remove('hidden');
  document.getElementById('infoModalBackdrop').classList.remove('hidden');
}

function closeModal() {
  document.getElementById('infoModal').classList.add('hidden');
  document.getElementById('infoModalBackdrop').classList.add('hidden');
}

lucide.createIcons();
</script>

</body>
</html>
