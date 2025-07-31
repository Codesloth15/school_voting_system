<?php
session_start();

$studentName =    $_SESSION['student_name'];

// Connect to the database
$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student's course based on their ID
$studentId = $_SESSION['student_id'];
$studentCourse = $_SESSION['student_course'];

$studentSql = "SELECT course FROM students WHERE id = ?";
$stmt = $conn->prepare($studentSql);
$stmt->bind_param("i", $studentId);
$stmt->execute();
$studentResult = $stmt->get_result();

if ($studentResult->num_rows > 0) {
    $studentRow = $studentResult->fetch_assoc();
    $studentCourse = strtoupper(trim($studentRow['course']));
} 
$stmt->close();

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
<header class="bg-white border-b shadow fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-10 h-10" alt="Logo">
      <h1 class="text-xl font-bold text-blue-900">School Voting System</h1>
    </div>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 font-medium">👋 Welcome, <?= htmlspecialchars($studentName) ?></span>
          <a href="colleges.php" class="text-blue-600 hover:underline">Elections</a>
      <a href="student_logout.php" class="text-red-600 hover:underline">Logout</a>
    </div>
  </div>
</header>

  <!-- Active Elections Section -->
  <section class="max-w-6xl mx-auto pt-24 pb-12 px-4">
    <h2 class="text-2xl font-bold text-blue-900 mb-6">Active College Elections</h2>

    <div class="grid md:grid-cols-2 gap-6">
      <?php if ($result && $result->num_rows > 0): ?>
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
              onclick="checkCourseAndRedirect('<?= trim(strtoupper($row['course'])) ?>', <?= $row['id'] ?>)">
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
    const studentCourse = <?= json_encode($studentCourse) ?>;

    function checkCourseAndRedirect(electionCourse, electionId) {
      const allowedCourse = electionCourse.trim().toUpperCase();
      const userCourse = studentCourse.trim().toUpperCase();

      console.log("Student course:", userCourse);
      console.log("Election course:", allowedCourse);

      if (userCourse === allowedCourse) {
        window.location.href = 'candidates.php?election_id=' + electionId;
      } else {
        
        alert("Only students from the '" + electionCourse + allowedCourse + "  jjj"+userCourse+"' course can vote in this election.");
      }
    }

    lucide.createIcons();
  </script>
</body>
</html>
