<?php
session_start();
$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$adminName = $_SESSION['admin_name'] ?? 'Administrator';

// Fetch colleges and courses
$collegeResult = $conn->query("SELECT * FROM colleges ORDER BY name");
$colleges = $collegeResult->fetch_all(MYSQLI_ASSOC);

$courseResult = $conn->query("SELECT * FROM courses ORDER BY name");
$courses = $courseResult->fetch_all(MYSQLI_ASSOC);

// Filters
$selectedCollege = $_GET['college'] ?? '';
$selectedCourse = $_GET['course'] ?? '';
$search = trim($_GET['search'] ?? '');

// Pagination
$perPage = 20;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? max((int)$_GET['page'], 1) : 1;
$offset = ($page - 1) * $perPage;

// Build query filters
$where = "WHERE 1";
$params = [];
$types = "";

if ($selectedCollege !== '') {
    $where .= " AND s.college_id = ?";
    $params[] = $selectedCollege;
    $types .= "i";
}
if ($selectedCourse !== '') {
    $where .= " AND s.course = ?";
    $params[] = $selectedCourse;
    $types .= "i";
}
if ($search !== '') {
    $where .= " AND (s.first_name LIKE ? OR s.last_name LIKE ? OR s.student_id LIKE ?)";
    $searchTerm = "%$search%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= "sss";
}

// Count total students
$countQuery = "
    SELECT COUNT(*) as total
    FROM students s
    LEFT JOIN colleges c ON s.college_id = c.id
    LEFT JOIN courses cr ON s.course = cr.id
    $where
";
$countStmt = $conn->prepare($countQuery);
if (!$countStmt) {
    die("❌ Count Prepare failed: " . $conn->error);
}
if (!empty($params)) {
    $countStmt->bind_param($types, ...$params);
}
$countStmt->execute();
$countResult = $countStmt->get_result();
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $perPage);

// Main query with LIMIT
$query = "
    SELECT s.id, s.student_id, s.first_name, s.middle_name, s.last_name, s.ext,
           s.gender, s.status, c.name AS college_name, course AS course_name,year_level
    FROM students s
    LEFT JOIN colleges c ON s.college_id = c.id
    LEFT JOIN courses cr ON s.course = cr.id
    $where
    ORDER BY s.last_name ASC
    LIMIT ? OFFSET ?
";
$params[] = $perPage;
$params[] = $offset;
$types .= "ii";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
$students = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Navbar -->
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
<div class="max-w-7xl mx-auto px-4 py-10 mt-[80px]">


<!-- Filters -->
<form method="GET" class="flex flex-col md:flex-row md:flex-wrap gap-4 mb-8 bg-white p-4 rounded shadow-sm items-end">
  <!-- College Filter -->
  <div class="flex flex-col w-full md:w-52">
    <label class="block text-sm font-medium mb-1">College</label>
    <select name="college" class="border px-3 py-2 rounded w-full">
      <option value="">All Colleges</option>
      <?php foreach ($colleges as $college): ?>
        <option value="<?= $college['id'] ?>" <?= $college['id'] == $selectedCollege ? 'selected' : '' ?>>
          <?= htmlspecialchars($college['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Course Filter -->
  <div class="flex flex-col w-full md:w-52">
    <label class="block text-sm font-medium mb-1">Course</label>
    <select name="course" class="border px-3 py-2 rounded w-full">
      <option value="">All Courses</option>
      <?php foreach ($courses as $course): ?>
        <option value="<?= $course['id'] ?>" <?= $course['id'] == $selectedCourse ? 'selected' : '' ?>>
          <?= htmlspecialchars($course['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Search -->
  <div class="flex flex-col w-full md:w-64">
    <label class="block text-sm font-medium mb-1">Search</label>
    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Name or Student ID"
           class="border px-3 py-2 rounded w-full">
  </div>

  <!-- Submit -->
  <div class="flex justify-end md:justify-start w-full md:w-auto">
    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 mt-1">
      🔍 Filter
    </button>
  </div>
</form>


  <!-- Table -->
  <?php if (count($students) > 0): ?>
    <div class="overflow-x-auto bg-white shadow rounded">
      <table class="min-w-full border-collapse text-sm">
        <thead class="bg-blue-600 text-white">
          <tr>
            <th class="px-4 py-3 text-left">#</th>
            <th class="px-4 py-3 text-left">Student ID</th>
            <th class="px-4 py-3 text-left">Full Name</th>
            <th class="px-4 py-3 text-left">Gender</th>
            <th class="px-4 py-3 text-left">College</th>
            <th class="px-4 py-3 text-left">Course</th>
                <th class="px-4 py-3 text-left">Year Level</th>
            <th class="px-4 py-3 text-left">Status</th>

            <th class="px-4 py-3 text-left">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <?php foreach ($students as $index => $s): ?>
            <tr class="border-t hover:bg-gray-50">
              <td class="px-4 py-2"><?= $offset + $index + 1 ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($s['student_id']) ?></td>
              <td class="px-4 py-2">
                <?= htmlspecialchars("{$s['last_name']}, {$s['first_name']} {$s['middle_name']} {$s['ext']}") ?>
              </td>
              <td class="px-4 py-2"><?= htmlspecialchars($s['gender']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($s['college_name']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($s['course_name']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($s['year_level']) ?></td>

              <td class="px-4 py-2"><?= htmlspecialchars($s['status']) ?></td>
              <td class="px-4 py-2">
                <a href="update_student.php?id=<?= urlencode($s['id']) ?>"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                  ✏️ Update
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center items-center mt-6 space-x-2">
      <?php if ($page > 1): ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>"
           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">⬅ Prev</a>
      <?php endif; ?>

      <span class="px-4 py-2 bg-white border rounded">Page <?= $page ?> of <?= $totalPages ?></span>

      <?php if ($page < $totalPages): ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>"
           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Next ➡</a>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <p class="text-gray-600 mt-6 italic">No matching students found.</p>
  <?php endif; ?>
</div>

</body>
</html>
