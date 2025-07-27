<?php
session_start();
$adminName = $_SESSION['admin_name'] ?? 'Admin';

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) die("Invalid Election ID.");

// Update election
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_election'])) {
    $stmt = $conn->prepare("UPDATE elections SET title=?, description=?, course=?, start_date=?, end_date=?, status=? WHERE id=?");
    $stmt->bind_param("ssssssi", $_POST['title'], $_POST['description'], $_POST['course'], $_POST['start_date'], $_POST['end_date'], $_POST['status'], $id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['snackbar'] = 'Election updated successfully!';
    header("Location: edit_election.php?id=$id");
    exit;
}

// Add position
if (isset($_POST['add_position_modal']) && !empty(trim($_POST['new_position_modal']))) {
    $newPosition = trim($_POST['new_position_modal']);
    $newCount = (int)($_POST['new_position_count'] ?? 1);
    $stmt = $conn->prepare("INSERT INTO election_positions (election_id, position, count) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $id, $newPosition, $newCount);
    $stmt->execute();
    $stmt->close();

    $_SESSION['snackbar'] = 'Position added successfully!';
    header("Location: edit_election.php?id=$id");
    exit;
}

// Edit position
if (isset($_POST['edit_position'])) {
    $positionId = (int)($_POST['position_id'] ?? 0);
    $positionName = trim($_POST['position_name'] ?? '');
    $positionCount = (int)($_POST['position_count'] ?? 1);
    if ($positionId > 0 && $positionName !== '') {
        $stmt = $conn->prepare("UPDATE election_positions SET position=?, count=? WHERE id=? AND election_id=?");
        $stmt->bind_param("siii", $positionName, $positionCount, $positionId, $id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['snackbar'] = 'Position updated successfully!';
    }
    header("Location: edit_election.php?id=$id");
    exit;
}

// Delete position
if (isset($_POST['delete_position_confirm'])) {
    $positionId = (int)$_POST['delete_position_confirm'];
    if ($positionId > 0) {
        $stmt = $conn->prepare("DELETE FROM election_positions WHERE id=? AND election_id=?");
        $stmt->bind_param("ii", $positionId, $id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['snackbar'] = 'Position deleted!';
    }
    header("Location: edit_election.php?id=$id");
    exit;
}

// Fetch election and positions
$stmt = $conn->prepare("SELECT * FROM elections WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$election = $stmt->get_result()->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM election_positions WHERE election_id=? ORDER BY id ASC");
$stmt->bind_param("i", $id);
$stmt->execute();
$positions = $stmt->get_result();

// Fetch dynamic course list from colleges
$courses = [];
$collegeResult = $conn->query("SELECT id, name FROM colleges ORDER BY name ASC");
if ($collegeResult && $collegeResult->num_rows > 0) {
    while ($row = $collegeResult->fetch_assoc()) {
        $courses[] = $row['name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Election</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<?php if (isset($_SESSION['snackbar'])): ?>
  <div id="snackbar" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 opacity-100">
    <?= htmlspecialchars($_SESSION['snackbar']) ?>
  </div>
  <script> setTimeout(() => document.getElementById("snackbar").style.opacity = "0", 3000); </script>
  <?php unset($_SESSION['snackbar']); ?>
<?php endif; ?>

<header class="bg-white border-b shadow fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-8 h-8">
      <h1 class="text-lg font-bold">Admin Dashboard</h1>
    </div>
    <div class="flex items-center gap-4">
      <span>Welcome, <?= htmlspecialchars($adminName) ?></span>
      <a href="logout.php" class="text-red-600 hover:underline">Logout</a>
    </div>
  </div>
</header>

<main class="max-w-3xl mx-auto pt-24 px-4 pb-10">
  <div class="bg-white shadow p-8 rounded-xl">
    <h2 class="text-2xl font-bold mb-6">Edit Election</h2>
    <form method="POST" class="space-y-5">
      <input type="hidden" name="update_election" value="1">
      <input name="title" value="<?= htmlspecialchars($election['title']) ?>" class="w-full border px-3 py-2 rounded" placeholder="Title" required>
      <textarea name="description" class="w-full border px-3 py-2 rounded" rows="3" placeholder="Description"><?= htmlspecialchars($election['description']) ?></textarea>
      <select name="course" class="w-full border px-3 py-2 rounded" required>
        <option value="">-- Select Course --</option>
        <?php foreach ($courses as $course): ?>
          <option value="<?= htmlspecialchars($course) ?>" <?= $election['course'] === $course ? 'selected' : '' ?>><?= htmlspecialchars($course) ?></option>
        <?php endforeach; ?>
      </select>
      <div class="grid grid-cols-2 gap-4">
        <input type="date" name="start_date" value="<?= $election['start_date'] ?>" class="border px-3 py-2 rounded" required>
        <input type="date" name="end_date" value="<?= $election['end_date'] ?>" class="border px-3 py-2 rounded" required>
      </div>
      <select name="status" class="w-full border px-3 py-2 rounded" required>
        <option value="active" <?= $election['status'] === 'active' ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= $election['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
      </select>
      <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Save Changes</button>
    </form>

    <!-- Positions -->
    <div class="mt-10">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Positions</h3>
        <button onclick="document.getElementById('addModal').showModal()" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">+ Add Position</button>
      </div>

      <?php while ($pos = $positions->fetch_assoc()): ?>
        <form method="POST" class="flex items-center gap-2 mb-2">
          <input type="hidden" name="position_id" value="<?= $pos['id'] ?>">
          <input type="text" name="position_name" value="<?= htmlspecialchars($pos['position']) ?>" class="flex-1 border px-3 py-1 rounded" required>
          <input type="number" name="position_count" value="<?= htmlspecialchars($pos['count']) ?>" class="w-20 border px-2 py-1 rounded" min="1" required>
          <button type="submit" name="edit_position" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Save</button>
          <button type="button" onclick="openDeleteModal(<?= $pos['id'] ?>)" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
        </form>
      <?php endwhile; ?>

      <div class="flex justify-between items-center pt-4">
        <a href="elections.php" class="text-blue-600 hover:underline text-sm">← Back</a>
      </div>
    </div>
  </div>
</main>

<!-- Add Modal -->
<dialog id="addModal" class="rounded-lg p-6 w-96 bg-white shadow-xl">
  <form method="POST" class="space-y-4">
    <h3 class="text-lg font-semibold">Add New Position</h3>
    <input type="text" name="new_position_modal" placeholder="e.g. Secretary" required class="w-full border px-3 py-2 rounded">
    <input type="number" name="new_position_count" placeholder="Count (e.g. 1)" value="1" min="1" required class="w-full border px-3 py-2 rounded">
    <div class="flex justify-end gap-2">
      <button type="button" onclick="addModal.close()" class="px-4 py-2 border rounded">Cancel</button>
      <button type="submit" name="add_position_modal" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add</button>
    </div>
  </form>
</dialog>

<!-- Delete Modal -->
<dialog id="deleteModal" class="rounded-lg p-6 w-96 bg-white shadow-xl">
  <form method="POST">
    <input type="hidden" name="delete_position_confirm" id="delete_position_id">
    <h3 class="text-lg font-semibold mb-4">Are you sure you want to delete this position?</h3>
    <div class="flex justify-end gap-2">
      <button type="button" onclick="deleteModal.close()" class="px-4 py-2 border rounded">Cancel</button>
      <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Yes, Delete</button>
    </div>
  </form>
</dialog>

<script>
  function openDeleteModal(id) {
    document.getElementById('delete_position_id').value = id;
    deleteModal.showModal();
  }
</script>

</body>
</html>
