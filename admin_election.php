<?php
session_start();

// ✅ Inline DB connection (fix for missing db.php)
$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Validate election ID
$electionId = isset($_GET['election_id']) ? (int)$_GET['election_id'] : 2;
if (!$electionId) {
    die("Election ID is required.");
}

// ✅ Fetch election title
$election = $conn->query("SELECT title FROM elections WHERE id = $electionId")->fetch_assoc();

// ✅ Handle candidate addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_candidate'])) {
    $name = trim($_POST['name']);
    $bio = trim($_POST['bio']);
    if (!empty($name)) {
        $stmt = $conn->prepare("INSERT INTO candidates (election_id, name, bio) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $electionId, $name, $bio);
        $stmt->execute();
        $stmt->close();
        header("Location: admin_election.php?election_id=$electionId");
        exit();
    }
}

// ✅ Handle candidate deletion
if (isset($_GET['delete_candidate'])) {
    $candidateId = (int) $_GET['delete_candidate'];
    $stmt = $conn->prepare("DELETE FROM candidates WHERE id = ? AND election_id = ?");
    $stmt->bind_param("ii", $candidateId, $electionId);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_election.php?election_id=$electionId");
    exit();
}

// ✅ Fetch all candidates
$candidates = $conn->query("SELECT * FROM candidates WHERE election_id = $electionId");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Candidates</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-4xl mx-auto bg-white shadow rounded-xl p-6">
    <!-- ✅ Election Title -->
    <h1 class="text-3xl font-bold text-blue-800 mb-2">
      <?= htmlspecialchars($election['title'] ?? 'Election') ?>
    </h1>

    <h2 class="text-2xl font-bold mb-6">Manage Candidates</h2>

    <!-- ✅ Add Candidate Form -->
    <form method="POST" class="mb-8 space-y-4">
      <input type="hidden" name="add_candidate" value="1">
      <div>
        <label class="block mb-1 font-medium text-gray-700">Candidate Name</label>
        <input type="text" name="name" required class="w-full border rounded px-3 py-2">
      </div>
      <div>
        <label class="block mb-1 font-medium text-gray-700">Bio</label>
        <textarea name="bio" rows="3" class="w-full border rounded px-3 py-2"></textarea>
      </div>
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        <i data-lucide="plus" class="w-4 h-4 mr-1 inline"></i> Add Candidate
      </button>
    </form>

    <!-- ✅ List of Candidates -->
    <h3 class="text-lg font-semibold mb-3">Candidates</h3>
    <?php if ($candidates->num_rows > 0): ?>
      <ul class="space-y-4">
        <?php while ($row = $candidates->fetch_assoc()): ?>
          <li class="border p-4 rounded-lg flex justify-between items-center bg-gray-50">
            <div>
              <p class="font-medium text-gray-800"><?= htmlspecialchars($row['name']) ?></p>
              <p class="text-gray-600 text-sm"><?= htmlspecialchars($row['bio']) ?></p>
            </div>
            <a href="?election_id=<?= $electionId ?>&delete_candidate=<?= $row['id'] ?>"
               class="text-red-600 hover:text-red-800 text-sm">
              <i data-lucide="trash-2" class="w-5 h-5 inline"></i> Delete
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p class="text-gray-500">No candidates added yet.</p>
    <?php endif; ?>

    <!-- ✅ Back link -->
    <div class="mt-6">
      <a href="view_election.php?id=<?= $electionId ?>" class="text-blue-600 hover:underline">&larr; Back to Election</a>
    </div>
  </div>

  <script>lucide.createIcons();</script>
</body>
</html>
