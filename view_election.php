<?php
session_start();
$adminName = $_SESSION['admin_name'] ?? 'Admin';
// Connect to database
$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get election ID from POST (preferred) or fallback to GET
$electionId = isset($_POST['election_id']) ? (int)$_POST['election_id'] :
              (isset($_GET['election_id']) ? (int)$_GET['election_id'] : 0);

if ($electionId <= 0) {
    die("❌ Invalid Election ID.");
}

// Fetch election details
$stmt = $conn->prepare("SELECT title FROM elections WHERE id = ?");
if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $electionId);
$stmt->execute();
$result = $stmt->get_result();
if (!$result || $result->num_rows === 0) {
    die("❌ Election not found.");
}
$election = $result->fetch_assoc();
$stmt->close();

// Fetch candidates grouped by position
$candidatesByPosition = [];

$candidateQuery = "
    SELECT c.id, c.full_name, c.photo_url, c.course, c.year, c.position, c.platform, c.motto
    FROM candidates c
    WHERE c.election_id = ?
    ORDER BY c.position ASC, c.full_name ASC
";

$stmt = $conn->prepare($candidateQuery);
if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $electionId);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $candidatesByPosition[$row['position']][] = $row;
}
$stmt->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - <?= htmlspecialchars($election['title']) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<header class="bg-white border-b shadow fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-10 h-10" alt="Logo">
      <h1 class="text-xl font-bold text-blue-900">Admin Dashboard</h1>
    </div>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 font-medium">👋 Welcome, <?= htmlspecialchars($adminName) ?></span>
<a href="dashboard.php" class="text-blue-600 hover:underline">Dashboard</a>
      <a href="logout.php" class="text-red-600 hover:underline">Logout</a>
    </div>
  </div>
</header>


<main class="max-w-6xl mx-auto pt-24 pb-12 px-4">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-blue-900">Manage Candidates - <?= htmlspecialchars($election['title']) ?></h2>
    <a href="add_candidate.php?election_id=<?= $electionId ?>" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 text-sm">
      + Add Candidate
    </a>
  </div>

  <?php foreach ($candidatesByPosition as $position => $candidates): ?>
    <div class="mb-10">
      <h3 class="text-xl font-semibold text-gray-800 mb-3"><?= htmlspecialchars($position) ?></h3>
      <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
        <?php foreach ($candidates as $candidate): ?>
          <div class="bg-white border shadow-lg p-6 transition-all duration-300">
            <div class="flex flex-col items-center">
              <img src="<?= htmlspecialchars($candidate['photo_url']) ?>" alt="Candidate Photo"
                   class="w-32 h-32 object-cover border mb-4">
              <h4 class="text-xl font-semibold text-center text-gray-800 mb-1"><?= htmlspecialchars($candidate['full_name']) ?></h4>
              <p class="text-sm text-gray-600 text-center mb-2"><?= htmlspecialchars($candidate['course']) ?> | Year <?= $candidate['year'] ?></p>
            </div>
            <div class="mt-4 flex justify-center gap-3">
              <button onclick="openEditModal(<?= htmlspecialchars(json_encode($candidate)) ?>)"
                      class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 text-sm">
                Edit
              </button>
              <a href="delete_candidate.php?id=<?= $candidate['id'] ?>&election_id=<?= $electionId ?>"
                 onclick="return confirm('Delete this candidate?')"
                 class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 text-sm">
                Delete
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endforeach; ?>
</main>

<!-- ✅ Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
  <div class="bg-white w-full max-w-lg p-6 shadow-lg">
    <h3 class="text-xl font-bold mb-4 text-blue-800">Edit Candidate</h3>
    <form method="POST" action="edit_candidate.php">
      <input type="hidden" name="id" id="editId">
      <input type="hidden" name="election_id" value="<?= $electionId ?>">
      
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" name="full_name" id="editName" class="w-full border px-3 py-2 mt-1">
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Course</label>
        <input type="text" name="course" id="editCourse" class="w-full border px-3 py-2 mt-1">
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Year</label>
        <input type="number" name="year" id="editYear" class="w-full border px-3 py-2 mt-1">
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Photo URL</label>
        <input type="text" name="photo_url" id="editPhoto" class="w-full border px-3 py-2 mt-1">
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Motto</label>
        <input type="text" name="motto" id="editMotto" class="w-full border px-3 py-2 mt-1">
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Platform</label>
        <textarea name="platform" id="editPlatform" class="w-full border px-3 py-2 mt-1" rows="3"></textarea>
      </div>

      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-blue-700 text-white hover:bg-blue-800">Update</button>
      </div>
    </form>
  </div>
</div>

<script>
function openEditModal(candidate) {
  document.getElementById('editId').value = candidate.id;
  document.getElementById('editName').value = candidate.full_name;
  document.getElementById('editCourse').value = candidate.course;
  document.getElementById('editYear').value = candidate.year;
  document.getElementById('editPhoto').value = candidate.photo_url;
  document.getElementById('editMotto').value = candidate.motto;
  document.getElementById('editPlatform').value = candidate.platform;

  document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
  document.getElementById('editModal').classList.add('hidden');
}
</script>

</body>
</html>
