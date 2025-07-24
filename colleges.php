<?php
session_start();

// Ensure student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

// Connect to the database
$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch active elections with course field and college name
$sql = "SELECT elections.*, colleges.name AS college_name 
        FROM elections 
        JOIN colleges ON elections.college_id = colleges.id 
        WHERE elections.status = 'active'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>School Voting System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Fixed Navbar -->
  <header class="bg-white border-b border-gray-200 shadow-sm fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <div class="flex items-center space-x-3">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="School Logo" class="w-10 h-10">
        <span class="text-xl font-bold text-blue-900">School Voting System</span>
      </div>
      <nav class="hidden md:flex space-x-6 text-sm text-gray-700">
        <a href="index.php" class="hover:text-blue-700 flex items-center"><i data-lucide="home" class="w-4 h-4 mr-1"></i>Home</a>
        <a href="#" class="hover:text-blue-700 flex items-center"><i data-lucide="users" class="w-4 h-4 mr-1"></i>Candidates</a>
        <a href="#" class="hover:text-blue-700 flex items-center"><i data-lucide="help-circle" class="w-4 h-4 mr-1"></i>Help</a>
      </nav>
    </div>
  </header>

  <!-- Active Elections Section -->
  <section class="max-w-6xl mx-auto pt-24 pb-12 px-4">
    <h2 class="text-2xl font-bold text-blue-900 mb-6">Active College Elections</h2>

    <div class="grid md:grid-cols-2 gap-6">
      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($row['college_name']) ?></h3>
            <p class="text-sm text-gray-600">Election: <span class="font-medium"><?= htmlspecialchars($row['title']) ?></span></p>
            <p class="text-sm text-gray-500 mt-1">Allowed Course: <strong><?= htmlspecialchars($row['course'] ?? 'N/A') ?></strong></p>
            <span class="inline-block mt-2 px-3 py-1 text-xs bg-green-100 text-green-800 rounded-full">
              Status: <?= htmlspecialchars($row['status']) ?>
            </span>

            <button 
              class="mt-4 bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg"
              onclick="checkCourseAndRedirect('<?= $row['course'] ?>', <?= $row['id'] ?>)">
              Vote Now
            </button>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-gray-600">No active elections at the moment.</p>
      <?php endif; ?>
    </div>
  </section>

  <script>
    // Student's course from PHP session
    const studentCourse = <?= json_encode($_SESSION['course'] ?? '') ?>;

    function checkCourseAndRedirect(electionCourse, electionId) {
      if (studentCourse === electionCourse) {
        window.location.href = 'candidates.php?election_id=' + electionId;
      } else {
        alert("Only students from the same course are allowed to vote in this election.");
      }
    }

    lucide.createIcons();
  </script>
</body>
</html>
