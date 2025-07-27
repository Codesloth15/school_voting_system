<?php
session_start();
$adminName = $_SESSION['admin_name'] ?? 'Admin';

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$success = $error = "";

// Fetch colleges
$colleges = [];
$collegeResult = $conn->query("SELECT id, name FROM colleges ORDER BY name ASC");
if ($collegeResult && $collegeResult->num_rows > 0) {
    while ($row = $collegeResult->fetch_assoc()) {
        $colleges[] = $row;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    $course = $_POST['course'] ?? '';
    $positions = $_POST['positions'] ?? [];
    $officerCounts = $_POST['officer_counts'] ?? [];
    $collegeId = intval($_POST['college_id'] ?? 0);

    if ($title && $start_date && $end_date && $course && $collegeId > 0 && !empty($positions) && count($positions) === count($officerCounts)) {
        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("INSERT INTO elections (title, college_id, description, start_date, end_date, course, status) VALUES (?, ?, ?, ?, ?, ?, 'active')");
            if (!$stmt) throw new Exception("Failed to prepare election insert.");
            $stmt->bind_param("sissss", $title, $collegeId, $description, $start_date, $end_date, $course);
            $stmt->execute();
            $electionId = $stmt->insert_id;
            $stmt->close();
$positionStmt = $conn->prepare("INSERT INTO election_positions (election_id, position, count) VALUES (?, ?, ?)");

            if (!$positionStmt) throw new Exception("Failed to prepare position insert.");
            for ($i = 0; $i < count($positions); $i++) {
                $pos = trim($positions[$i]);
                $count = (int)($officerCounts[$i] ?? 1);
                if ($pos !== '' && $count > 0) {
                    $positionStmt->bind_param("isi", $electionId, $pos, $count);
                    $positionStmt->execute();
                }
            }
            $positionStmt->close();

            $conn->commit();
            header("Location: elections.php?election_id=$electionId");
            exit();
        } catch (Exception $e) {
            $conn->rollback();
            $error = "❌ Error creating election: " . $e->getMessage();
        }
    } else {
        $error = "❌ All fields are required and position data must match.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Election</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">

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
  <div class="bg-white shadow p-8 rounded-xl space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">🗳️ Create New Election</h2>

    <?php if ($success): ?>
      <div class="bg-green-100 text-green-700 border border-green-300 px-4 py-3 rounded-lg"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="bg-red-100 text-red-700 border border-red-300 px-4 py-3 rounded-lg"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <input name="title" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" class="w-full border px-3 py-2 rounded" placeholder="Title" required>
      <textarea name="description" class="w-full border px-3 py-2 rounded" rows="3" placeholder="Description"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>

      <select name="college_id" id="collegeSelect" class="w-full border px-3 py-2 rounded" required>
        <option value="">-- Select College --</option>
        <?php foreach ($colleges as $college): ?>
          <option value="<?= $college['id'] ?>" <?= (isset($_POST['college_id']) && $_POST['college_id'] == $college['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($college['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <select name="course" id="courseSelect" class="w-full border px-3 py-2 rounded" required>
        <option value="<?= $_POST['course'] ?? '' ?>"><?= $_POST['course'] ?? '-- Select Course --' ?></option>
      </select>

      <div class="grid grid-cols-2 gap-4">
        <input type="date" name="start_date" value="<?= $_POST['start_date'] ?? '' ?>" class="border px-3 py-2 rounded" required>
        <input type="date" name="end_date" value="<?= $_POST['end_date'] ?? '' ?>" class="border px-3 py-2 rounded" required>
      </div>

      <!-- Position Section -->
      <div class="mt-6">
        <div class="flex justify-between items-center mb-3">
          <h3 class="font-semibold text-lg">Available Positions</h3>
          <button type="button" onclick="addModal.showModal()" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">+ Add Position</button>
        </div>

        <div id="position-container" class="space-y-3">
          <?php
            if (!empty($_POST['positions'])) {
              foreach ($_POST['positions'] as $index => $pos) {
                $count = $_POST['officer_counts'][$index] ?? 1;
                echo '<div class="flex gap-2">';
                echo '<input type="text" name="positions[]" value="' . htmlspecialchars($pos) . '" placeholder="Position Name" class="w-2/3 border px-3 py-2 rounded" required>';
                echo '<input type="number" name="officer_counts[]" value="' . htmlspecialchars($count) . '" min="1" class="w-1/3 border px-3 py-2 rounded" placeholder="# of Officers" required>';
                echo '</div>';
              }
            } else {
              echo '<div class="flex gap-2">';
              echo '<input type="text" name="positions[]" placeholder="e.g. President" class="w-2/3 border px-3 py-2 rounded" required>';
              echo '<input type="number" name="officer_counts[]" placeholder="1" min="1" class="w-1/3 border px-3 py-2 rounded" required>';
              echo '</div>';
            }
          ?>
        </div>
      </div>

      <div class="flex justify-between items-center pt-4">
        <a href="elections.php" class="text-blue-600 hover:underline text-sm">← Back</a>
        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded font-semibold">Create Election</button>
      </div>
    </form>
  </div>
</main>

<!-- Add Position Modal -->
<dialog id="addModal" class="rounded-lg p-6 w-96 bg-white shadow-xl">
  <form method="dialog" class="space-y-4" onsubmit="return addNewPosition();">
    <h3 class="text-lg font-semibold">Add New Position</h3>
    <input type="text" id="newPositionInput" placeholder="e.g. Secretary" class="w-full border px-3 py-2 rounded" required>
    <input type="number" id="officerCountInput" placeholder="Number of Officers" min="1" class="w-full border px-3 py-2 rounded" required>
    <div class="flex justify-end gap-2">
      <button type="button" onclick="addModal.close()" class="px-4 py-2 border rounded">Cancel</button>
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add</button>
    </div>
  </form>
</dialog>

<!-- JavaScript Section -->
<script>
  function addNewPosition() {
    const position = document.getElementById('newPositionInput').value.trim();
    const count = parseInt(document.getElementById('officerCountInput').value.trim());

    if (!position || isNaN(count) || count <= 0) return false;

    const container = document.getElementById('position-container');
    const wrapper = document.createElement('div');
    wrapper.className = 'flex gap-2';

    const posInput = document.createElement('input');
    posInput.type = 'text';
    posInput.name = 'positions[]';
    posInput.value = position;
    posInput.className = 'w-2/3 border px-3 py-2 rounded';
    posInput.required = true;

    const countInput = document.createElement('input');
    countInput.type = 'number';
    countInput.name = 'officer_counts[]';
    countInput.value = count;
    countInput.className = 'w-1/3 border px-3 py-2 rounded';
    countInput.min = 1;
    countInput.required = true;

    wrapper.appendChild(posInput);
    wrapper.appendChild(countInput);
    container.appendChild(wrapper);

    document.getElementById('newPositionInput').value = '';
    document.getElementById('officerCountInput').value = '';
    addModal.close();
    return false;
  }

  document.getElementById('collegeSelect').addEventListener('change', function () {
    const collegeId = this.value;
    const courseSelect = document.getElementById('courseSelect');
    courseSelect.innerHTML = '<option value="">Loading...</option>';

    if (collegeId) {
      fetch(`get_courses.php?college_id=${collegeId}`)
        .then(response => response.json())
        .then(data => {
          courseSelect.innerHTML = '<option value="">-- Select Course --</option>';
          data.forEach(course => {
            const option = document.createElement('option');
            option.value = course.name;
            option.textContent = course.name;
            courseSelect.appendChild(option);
          });
        })
        .catch(() => {
          courseSelect.innerHTML = '<option value="">-- Error loading courses --</option>';
        });
    } else {
      courseSelect.innerHTML = '<option value="">-- Select Course --</option>';
    }
  });
</script>

</body>
</html>
