<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alertMessage = "";
$redirect = false;

// Handle vote submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['votes'])) {
    $student_id = $_SESSION['student_id'];
    $votes = $_POST['votes'];
    $election_id = intval($_POST['election_id']);

    $positionQuery = $conn->prepare("SELECT DISTINCT position FROM candidates WHERE election_id = ?");
    $positionQuery->bind_param("i", $election_id);
    $positionQuery->execute();
    $positionResult = $positionQuery->get_result();

    $positions = [];
    while ($row = $positionResult->fetch_assoc()) {
        $positions[] = $row['position'];
    }

    $check = $conn->prepare("SELECT COUNT(*) FROM votes WHERE voter_id = ? AND election_id = ?");
    $check->bind_param("ii", $student_id, $election_id);
    $check->execute();
    $check->bind_result($voteCount);
    $check->fetch();
    $check->close();

    if ($voteCount > 0) {
        $alertMessage = "You have already voted in this election.";
    } elseif (count($votes) < count($positions)) {
        $alertMessage = "You must vote for all positions.";
    } else {
        $stmt = $conn->prepare("INSERT INTO votes (election_id, voter_id, student_id, candidate_id, position) VALUES (?, ?, ?, ?, ?)");
        foreach ($votes as $position => $candidate_id) {
       $stmt->bind_param("issis", $election_id, $student_id, $student_id, $candidate_id, $position);

            $stmt->execute();
        }
        $alertMessage = "Your vote has been submitted successfully.";
        $redirect = true;
    }
}

if (!isset($_GET['election_id'])) {
    die("Election not specified.");
}

$election_id = intval($_GET['election_id']);
$electionQuery = $conn->query("SELECT title FROM elections WHERE id = $election_id");
if (!$electionQuery) {
    die("Election query failed: " . $conn->error);
}

$election = $electionQuery->fetch_assoc();
if (!$election) {
    die("Election not found.");
}

$candidateSql = "SELECT * FROM candidates WHERE election_id = $election_id ORDER BY position, full_name";
$candidatesResult = $conn->query($candidateSql);

$candidatesByPosition = [];
while ($row = $candidatesResult->fetch_assoc()) {
    $candidatesByPosition[$row['position']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Candidates</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans">

<?php if (!empty($alertMessage)): ?>
  <script>
    alert("<?= $alertMessage ?>");
    <?php if ($redirect): ?>
      window.location.href = 'index.php';
    <?php endif; ?>
  </script>
<?php endif; ?>

<header class="bg-white border-b border-gray-200 shadow-sm fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="School Logo" class="w-10 h-10">
      <span class="text-xl font-bold text-blue-900">School Voting System</span>
    </div>
  </div>
</header>

<section class="max-w-6xl mx-auto pt-24 pb-12 px-4">
  <h2 class="text-2xl font-bold text-blue-900 mb-6">Candidates for: <?= htmlspecialchars($election['title']) ?></h2>

  <form method="POST" onsubmit="return confirmVotes();">
    <input type="hidden" name="election_id" value="<?= $election_id ?>">
    <?php foreach ($candidatesByPosition as $position => $candidates): ?>
      <div class="mb-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-3"><?= htmlspecialchars($position) ?></h3>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <?php foreach ($candidates as $candidate): ?>
            <label class="bg-white border rounded-2xl shadow p-4 hover:shadow-lg transition-all duration-300 cursor-pointer relative">
              <input type="radio"
                     name="votes[<?= htmlspecialchars($position) ?>]"
                     value="<?= $candidate['id'] ?>"
                     class="hidden peer"
                     required>
              <div class="flex flex-col items-center peer-checked:border-blue-700 peer-checked:ring-2 peer-checked:ring-blue-500 p-2 rounded-xl">
                <img src="<?= htmlspecialchars($candidate['photo_url']) ?>"
                     onerror="this.src='default.png';"
                     alt="Candidate Photo"
                     class="w-24 h-24 object-cover rounded-full border mb-2">
                <h4 class="text-lg font-semibold text-center text-gray-800"><?= htmlspecialchars($candidate['full_name']) ?></h4>
                <p class="text-sm text-gray-600 text-center mb-2"><?= htmlspecialchars($candidate['course']) ?> | Year <?= $candidate['year'] ?></p>
                <button type="button"
                        onclick="showModal(`<?= addslashes($candidate['full_name']) ?>`, `<?= addslashes($candidate['motto']) ?>`, `<?= addslashes($candidate['platform']) ?>`)"
                        class="text-sm text-blue-600 hover:underline mt-1">
                  View Info
                </button>
              </div>
            </label>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="text-center mt-10">
      <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-xl text-lg shadow">
        Submit My Vote
      </button>
    </div>
  </form>
</section>

<!-- Modal Backdrop -->
<div id="infoModalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>

<!-- Modal -->
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
function confirmVotes() {
  const requiredGroups = document.querySelectorAll('input[type="radio"][required]');
  const grouped = {};

  requiredGroups.forEach(radio => {
    const name = radio.name;
    grouped[name] = grouped[name] || false;
    if (radio.checked) grouped[name] = true;
  });

  for (const [key, selected] of Object.entries(grouped)) {
    if (!selected) {
      alert("Please vote for all positions.");
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
