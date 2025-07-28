<?php
$conn = new mysqli("localhost", "root", "", "voting_system");

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    exit("❌ Error: Missing or invalid student ID.");
}

$id = (int)$_GET['id'];

// Fetch student
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$studentResult = $stmt->get_result();

if ($studentResult->num_rows === 0) {
    exit("❌ Error: Student not found.");
}

$student = $studentResult->fetch_assoc();

// Fetch colleges
$colleges = $conn->query("SELECT * FROM colleges ORDER BY name")->fetch_all(MYSQLI_ASSOC);

// Fetch courses for selected college (initial load)
$initialCourses = [];
if ($student['college_id']) {
    $stmt = $conn->prepare("SELECT * FROM courses WHERE college_id = ?");
    $stmt->bind_param("i", $student['college_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $initialCourses = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Student</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function fetchCourses(collegeId) {
      const currentCourse = document.getElementById('course').value;
      fetch('get_courses.php?college_id=' + collegeId)
        .then(res => res.json())
        .then(data => {
          const courseSelect = document.getElementById('course');
          courseSelect.innerHTML = '';
          data.forEach(course => {
            const option = document.createElement('option');
            option.value = course.id;
            option.text = course.name;
            if (course.id == currentCourse) {
              option.selected = true;
            }
            courseSelect.appendChild(option);
          });
        });
    }
  </script>
</head>
<body class="bg-gray-100 pt-20">

<!-- Header -->
<header class="bg-white border-b shadow fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-10 h-10" alt="Logo">
      <h1 class="text-xl font-bold text-blue-900">Admin </h1>
    </div>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 font-medium">👋 Welcome, Admin</span>
        <a href="dashboard.php" class="text-blue-600 hover:underline">Dashboard</a>
      <a href="logout.php" class="text-red-600 hover:underline">Logout</a>
    </div>
  </div>
</header>

<!-- Form -->
<div class="max-w-xl mx-auto mt-10 bg-white p-6 shadow">
  <h2 class="text-xl font-bold mb-4 text-blue-700">Edit Student</h2>
  <form action="update_student_save.php" method="POST">
    <input type="hidden" name="id" value="<?= $student['id'] ?>">

    <label class="block mb-2">First Name
      <input name="first_name" class="border px-3 py-2 w-full" value="<?= htmlspecialchars($student['first_name']) ?>">
    </label>

    <label class="block mb-2">Last Name
      <input name="last_name" class="border px-3 py-2 w-full" value="<?= htmlspecialchars($student['last_name']) ?>">
    </label>

    <label class="block mb-2">College
      <select name="college_id" id="college" class="border px-3 py-2 w-full" onchange="fetchCourses(this.value)">
        <?php foreach ($colleges as $c): ?>
          <option value="<?= $c['id'] ?>" <?= $c['id'] == $student['college_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($c['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>

<!-- Course Select -->
<select name="course" id="course" class="border px-3 py-2 w-full" required onchange="updateAltCourseName()">
  <?php foreach ($initialCourses as $course): ?>
    <option value="<?= $course['id'] ?>" <?= $course['id'] == $student['course'] ? 'selected' : '' ?>>
      <?= htmlspecialchars($course['name']) ?>
    </option>
  <?php endforeach; ?>
</select>

<!-- Hidden input to hold selected course name -->
<input type="hidden" name="alt" id="altCourseName">

<!-- JavaScript to update the hidden input -->
<script>
  function updateAltCourseName() {
    const courseSelect = document.getElementById('course');
    const altInput = document.getElementById('altCourseName');
    const selectedOption = courseSelect.options[courseSelect.selectedIndex];
    altInput.value = selectedOption.text;
  }

  // Run on page load too, to set initial value
  document.addEventListener('DOMContentLoaded', updateAltCourseName);
</script>



    <label class="block mb-2">Year Level
      <input name="year_level" class="border px-3 py-2 w-full" value="<?= htmlspecialchars($student['year_level']) ?>">
    </label>

      <div class="flex justify-between items-center pt-4">
        <a href="students.php" class="text-blue-600 hover:underline text-sm">← Back</a>
       <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Changes</button>
      </div>

  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    fetchCourses(<?= (int)$student['college_id'] ?>);
  });
</script>
</body>
</html>
