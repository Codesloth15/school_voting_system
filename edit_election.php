<?php
session_start();
$adminName = $_SESSION['admin_name'] ?? 'Admin';

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) die("Invalid Election ID.");

// Save everything (election + positions)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_all'])) {
    $stmt = $conn->prepare("UPDATE elections SET title=?, description=?, course=?, start_date=?, end_date=?, status=?, college_id=? WHERE id=?");
    $stmt->bind_param("ssssssii", $_POST['title'], $_POST['description'], $_POST['course'], $_POST['start_date'], $_POST['end_date'], $_POST['status'], $_POST['college'], $id);
    $stmt->execute();
    $stmt->close();

    if (isset($_POST['positions']) && is_array($_POST['positions'])) {
        $stmt = $conn->prepare("UPDATE election_positions SET position=?, count=? WHERE id=? AND election_id=?");
        foreach ($_POST['positions'] as $pos) {
            $posId = (int)($pos['id'] ?? 0);
            $posName = trim($pos['position'] ?? '');
            $posCount = (int)($pos['count'] ?? 1);
            if ($posId > 0 && $posName !== '') {
                $stmt->bind_param("siii", $posName, $posCount, $posId, $id);
                $stmt->execute();
            }
        }
        $stmt->close();
    }

    $_SESSION['snackbar'] = 'Election and positions updated successfully!';
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

// Fetch election
$stmt = $conn->prepare("SELECT * FROM elections WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$election = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch positions
$stmt = $conn->prepare("SELECT * FROM election_positions WHERE election_id=? ORDER BY id ASC");
$stmt->bind_param("i", $id);
$stmt->execute();
$positionsResult = $stmt->get_result();
$positions = [];
while ($row = $positionsResult->fetch_assoc()) {
    $positions[] = $row;
}
$stmt->close();

// Fetch colleges
$collegeResult = $conn->query("SELECT id, name FROM colleges ORDER BY name ASC");
$colleges = [];
while ($row = $collegeResult->fetch_assoc()) {
    $colleges[] = $row;
}

// Fetch initial courses
$initialCourses = [];
if (!empty($election['college_id'])) {
    $stmt = $conn->prepare("SELECT id, name FROM courses WHERE college_id=?");
    $stmt->bind_param("i", $election['college_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($courseRow = $result->fetch_assoc()) {
        $initialCourses[] = $courseRow;
    }
    $stmt->close();
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
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-10 h-10" alt="Logo">
      <h1 class="text-xl font-bold text-blue-900">Admin</h1>
    </div>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 font-medium">👋 Welcome, <?= htmlspecialchars($adminName) ?></span>
      <a href="dashboard.php" class="text-blue-600 hover:underline">Dashboard</a>
      <a href="logout.php" class="text-red-600 hover:underline">Logout</a>
    </div>
  </div>
</header>

<main class="max-w-3xl mx-auto pt-24 px-4 pb-10">
  <div class="bg-white shadow p-8 rounded-xl">
    <h2 class="text-2xl font-bold mb-6">Edit Election</h2>
    <form method="POST" class="space-y-5">
      <input type="hidden" name="update_all" value="1">

      <!-- Election Fields -->
      <input name="title" value="<?= htmlspecialchars($election['title']) ?>" class="w-full border px-3 py-2 rounded" placeholder="Title" required>
      <textarea name="description" class="w-full border px-3 py-2 rounded" rows="3" placeholder="Description"><?= htmlspecialchars($election['description']) ?></textarea>

      <select name="college" id="collegeDropdown" class="w-full border px-3 py-2 rounded" required>
        <option value="">-- Select College --</option>
        <?php foreach ($colleges as $college): ?>
          <option value="<?= $college['id'] ?>" <?= ($election['college_id'] ?? '') == $college['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($college['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <select name="course" id="courseDropdown" class="w-full border px-3 py-2 rounded" required>
        <option value="">-- Select Course --</option>
        <?php foreach ($initialCourses as $course): ?>
          <option value="<?= htmlspecialchars($course['name']) ?>" <?= $election['course'] === $course['name'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($course['name']) ?>
          </option>
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

      <!-- Positions Section -->
      <div class="mt-10">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold">Positions</h3>
          <button type="button" onclick="document.getElementById('addModal').showModal()" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">+ Add Position</button>
        </div>

        <?php foreach ($positions as $index => $pos): ?>
          <div class="flex items-center gap-2 mb-2">
            <input type="hidden" name="positions[<?= $index ?>][id]" value="<?= $pos['id'] ?>">
            <input type="text" name="positions[<?= $index ?>][position]" value="<?= htmlspecialchars($pos['position']) ?>" class="flex-1 border px-3 py-1 rounded" required>
            <input type="number" name="positions[<?= $index ?>][count]" value="<?= htmlspecialchars($pos['count']) ?>" class="w-20 border px-2 py-1 rounded" min="1" required>
            <button type="button" onclick="openDeleteModal(<?= $pos['id'] ?>)" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="flex justify-between items-center pt-4">
        <a href="elections.php" class="text-blue-600 hover:underline text-sm">← Back</a>
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Save All Changes</button>
      </div>
    </form>
  </div>
</main>

<!-- Modals -->
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

document.getElementById('collegeDropdown').addEventListener('change', function () {
  const collegeId = this.value;
  const courseDropdown = document.getElementById('courseDropdown');
  courseDropdown.innerHTML = '<option value="">Loading...</option>';

  fetch('get_courses_by_college.php?college_id=' + collegeId)
    .then(res => res.json())
    .then(data => {
      let options = '<option value="">-- Select Course --</option>';
      data.forEach(course => {
        options += `<option value="${course.name}">${course.name}</option>`;
      });
      courseDropdown.innerHTML = options;
    })
    .catch(() => {
      courseDropdown.innerHTML = '<option value="">-- Failed to load courses --</option>';
    });
});
</script>

</body>
</html>
