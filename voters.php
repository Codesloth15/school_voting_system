<?php
session_start();
$adminName = $_SESSION['admin_name'] ?? 'Admin';

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$colleges = $conn->query("SELECT * FROM colleges ORDER BY id");

// Fetch courses by college
$courseQuery = $conn->query("SELECT * FROM courses");
$courses = [];
while ($row = $courseQuery->fetch_assoc()) {
    $courses[$row['college_id']][] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['college_id']) && !empty($_POST['name']) && !empty($_POST['acro_name'])) {
    $collegeId = (int)$_POST['college_id'];
    $name = $conn->real_escape_string(trim($_POST['name']));
    $acro = $conn->real_escape_string(trim($_POST['acro_name']));

    $conn->query("INSERT INTO courses (college_id, name, acro_name) VALUES ($collegeId, '$name', '$acro')");
    


    header("Location: voters.php?success=Course added successfully");
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Location: voters.php?error=Invalid request");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Colleges Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<header class="bg-white border-b shadow fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-10 h-10" alt="Logo">
      <h1 class="text-xl font-bold text-blue-900">Admin </h1>
    </div>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 font-medium">👋 Welcome, <?= htmlspecialchars($adminName) ?></span>
<a href="dashboard.php" class="text-blue-600 hover:underline">Dashboard</a>
      <a href="logout.php" class="text-red-600 hover:underline">Logout</a>
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto py-24 px-4">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Colleges</h2>
    <button onclick="openAddModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add College</button>
  </div>

  <div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full text-left">
      <thead class="bg-blue-50">
        <tr>
          <th class="px-4 py-3 border-b">ID</th>
          <th class="px-4 py-3 border-b">College Name</th>
          <th class="px-4 py-3 border-b">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($colleges->num_rows > 0): ?>
          <?php while ($college = $colleges->fetch_assoc()): ?>
            <tr class="border-t hover:bg-gray-50">
              <td class="px-4 py-3"><?= $college['id'] ?></td>
              <td class="px-4 py-3"><?= htmlspecialchars($college['name']) ?></td>
              <td class="px-4 py-3 space-x-2">
                <button onclick="openEditModal(<?= $college['id'] ?>, '<?= htmlspecialchars(addslashes($college['name'])) ?>')" class="bg-yellow-400 text-white px-3 py-1 rounded text-sm hover:bg-yellow-500">Edit</button>
                <button onclick="confirmDelete(<?= $college['id'] ?>)" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">Delete</button>
                <button onclick="openCourseManager(<?= $college['id'] ?>)" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">Manage Courses</button>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="3" class="text-center py-6 text-gray-500">No colleges found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<!-- Snackbar -->
<div id="snackbar" class="fixed bottom-4 right-4 bg-green-600 text-white px-4 py-2 rounded shadow hidden z-50">Success!</div>

<!-- Add College Modal -->
<div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded shadow max-w-md w-full space-y-4">
    <h3 class="text-lg font-semibold">Add College</h3>
    <form id="addForm" method="POST" action="add_college.php">
      <input type="text" name="name" placeholder="College Name" required class="w-full border px-3 py-2 rounded">
      <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeModal('addModal')" class="px-4 py-2 text-gray-600 hover:underline">Cancel</button>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit College Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded shadow max-w-md w-full space-y-4">
    <h3 class="text-lg font-semibold">Edit College</h3>
    <form method="POST" action="edit_college.php">
      <input type="hidden" name="id" id="editId">
      <input type="text" name="name" id="editName" required class="w-full border px-3 py-2 rounded">
      <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 text-gray-600 hover:underline">Cancel</button>
        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- Course Manager Modal -->
<div id="courseManager" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded shadow w-full max-w-xl space-y-4">
    <h3 class="text-lg font-semibold">Manage Courses</h3>
    <ul id="courseList" class="space-y-2"></ul>
    <form method="POST" action="" class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-4">
      <input type="hidden" name="college_id" id="courseCollegeId">
      <input type="text" name="name" placeholder="Course Name" required class="border px-3 py-2 rounded">
      <input type="text" name="acro_name" placeholder="Acronym (e.g., BSIT)" required class="border px-3 py-2 rounded">
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add</button>
    </form>

    <div class="flex justify-end">
      <button onclick="closeModal('courseManager')" class="text-gray-600 hover:underline">Close</button>
    </div>
  </div>
</div>

<script>
  const courses = <?= json_encode($courses) ?>;

  function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
  }

  function openEditModal(id, name) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editModal').classList.remove('hidden');
  }

  function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this college?")) {
      window.location.href = "delete_college.php?id=" + id;
    }
  }

  function openCourseManager(collegeId) {
    const modal = document.getElementById("courseManager");
    const list = document.getElementById("courseList");
    const inputId = document.getElementById("courseCollegeId");
    inputId.value = collegeId;

    list.innerHTML = '';
    const items = courses[collegeId] || [];
    if (items.length === 0) {
      list.innerHTML = '<p class="text-gray-500 text-sm">No courses available.</p>';
    } else {
      items.forEach(course => {
        list.innerHTML += `
          <li class="flex justify-between items-center border px-3 py-2 rounded">
            <span>${course.name}</span>
            <a href="delete_course.php?id=${course.id}" onclick="return confirm('Delete this course?')" class="text-red-500 text-sm hover:underline">Delete</a>
          </li>
        `;
      });
    }
    modal.classList.remove('hidden');
  }

  function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
  }

  function showSnackbar(message = "Success!") {
    const bar = document.getElementById("snackbar");
    bar.textContent = message;
    bar.classList.remove("hidden");
    setTimeout(() => {
      bar.classList.add("hidden");
      location.href = "voters.php"; // You may change this if needed
    }, 1500);
  }

  const url = new URL(window.location.href);
  if (url.searchParams.get("success")) {
    showSnackbar(url.searchParams.get("success"));
  }
</script>

</body>
</html>
