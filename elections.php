<?php
session_start();
$adminName = $_SESSION['admin_name'] ?? 'Admin';

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete election logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_election_id'])) {
    $electionId = (int)$_POST['delete_election_id'];
    if ($electionId > 0) {
        $stmt = $conn->prepare("DELETE FROM elections WHERE id = ?");
        $stmt->bind_param("i", $electionId);
        if ($stmt->execute()) {
            $_SESSION['delete_success'] = 'Election deleted successfully!';
        } else {
            $_SESSION['delete_error'] = 'Failed to delete election.';
        }
        $stmt->close();
    } else {
        $_SESSION['delete_error'] = 'Invalid election ID.';
    }
    header("Location: elections.php");
    exit;
}

$query = "SELECT * FROM elections ORDER BY id ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Elections - Voting System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen">

<!-- Snackbar -->
<?php if (isset($_SESSION['delete_success']) || isset($_SESSION['delete_error'])): ?>
  <div id="snackbar" class="fixed bottom-6 right-6 z-50 px-5 py-3 rounded-lg shadow-lg transition-all duration-300
    <?= isset($_SESSION['delete_success']) ? 'bg-green-600 text-white' : 'bg-red-600 text-white' ?>">
    <?= isset($_SESSION['delete_success']) ? $_SESSION['delete_success'] : $_SESSION['delete_error'] ?>
  </div>
  <?php unset($_SESSION['delete_success'], $_SESSION['delete_error']); ?>
  <script>
    setTimeout(() => {
      const snackbar = document.getElementById("snackbar");
      if (snackbar) {
        snackbar.classList.add("opacity-0", "translate-y-4");
        setTimeout(() => snackbar.remove(), 500);
      }
    }, 3000);
  </script>
<?php endif; ?>

<!-- Header -->
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

<!-- Main Content -->
<main class="max-w-6xl mx-auto pt-24 pb-10 px-4">
  <div class="flex justify-between items-center mb-10">
    <h2 class="text-3xl font-semibold text-gray-800">Current Elections</h2>
    <a href="create_election.php" class="bg-blue-700 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-800 transition">
      + Create New Election
    </a>
  </div>

  <?php if ($result && $result->num_rows > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <?php while ($row = $result->fetch_assoc()): ?>
      <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition flex flex-col justify-between">
        <div>
          <div class="flex items-center space-x-4 mb-4">
            <i data-lucide="calendar-clock" class="w-6 h-6 text-blue-600"></i>
            <h3 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($row['title']) ?></h3>
          </div>
          <p class="text-gray-600 mb-2">
            <?= isset($row['description']) ? htmlspecialchars($row['description']) : '<em>No description available</em>' ?>
          </p>
          <div class="text-sm text-gray-500 mb-4">
            <p><strong>Start:</strong> <?= htmlspecialchars($row['start_date']) ?></p>
            <p><strong>End:</strong> <?= htmlspecialchars($row['end_date']) ?></p>
          </div>
        </div>
        <div class="mt-4 flex flex-wrap gap-4">
          <!-- View -->
          <form action="view_election.php" method="POST">
            <input type="hidden" name="election_id" value="<?= $row['id'] ?>">
            <button type="submit" class="inline-flex items-center text-sm text-blue-700 hover:underline font-medium">
              <i data-lucide="eye" class="w-4 h-4 mr-1"></i> View
            </button>
          </form>

          <!-- Edit -->
          <form action="edit_election.php" method="GET">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" class="inline-flex items-center text-sm text-green-600 hover:underline font-medium">
              <i data-lucide="pencil" class="w-4 h-4 mr-1"></i> Edit
            </button>
          </form>

          <!-- Delete -->
          <form method="POST" onsubmit="return confirm('Are you sure you want to delete this election?');">
            <input type="hidden" name="delete_election_id" value="<?= $row['id'] ?>">
            <button type="submit" class="inline-flex items-center text-sm text-red-600 hover:underline font-medium">
              <i data-lucide="trash" class="w-4 h-4 mr-1"></i> Delete
            </button>
          </form>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="bg-white p-6 rounded-xl shadow text-center text-gray-600">
      No elections found. <a href="create_election.php" class="text-blue-600 underline">Create one now</a>.
    </div>
  <?php endif; ?>
</main>

<script>
  lucide.createIcons();
</script>
</body>
</html>
