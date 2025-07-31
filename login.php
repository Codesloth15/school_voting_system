<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "voting_system");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get values from form safely
    $student_id = trim($_POST['student_id']);
    $password = trim($_POST['password']);

    // Use prepared statement for security
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ? AND password = ? AND status = 'active'");
    $stmt->bind_param("ss", $student_id, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // If student is found and active
    if ($result->num_rows === 1) {
        $student = $result->fetch_assoc();

        // ✅ Store student ID in session
        $_SESSION['student_id'] = $student['student_id'];
        $_SESSION['student_db_id'] = $student['id']; // if you need database ID too
        $_SESSION['student_name'] = $student['first_name'] . ' ' . $student['last_name'];
 $_SESSION['student_course'] = $student['course'];
        // ✅ Now safely access and use it
        $studentId = $_SESSION['student_id'];
        echo "<script>alert('Student ID: $studentId'); window.location.href = 'colleges.php';</script>";
        exit();
    } else {
        echo "<script>alert('Invalid Student ID or Password.'); window.location.href='login.php';</script>";
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>School Voting System Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Top Navbar -->
   <header class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <div class="flex items-center space-x-3">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="School Logo" class="w-10 h-10">
        <span class="text-xl font-bold text-blue-900">School Voting System</span>
      </div>
      <nav class="hidden md:flex space-x-6 text-sm text-gray-700">
   
        <a href="#" class="hover:text-blue-700 flex items-center"><i data-lucide="vote" class="w-4 h-4 mr-1"></i>How to Vote</a>
        <a href="#" class="hover:text-blue-700 flex items-center"><i data-lucide="help-circle" class="w-4 h-4 mr-1"></i>Help</a>
      </nav>
    </div>
  </header>

  <!-- Login Box -->
  <main class="flex items-center justify-center min-h-[calc(100vh-4rem)] px-4 py-10">
    <div class="bg-white rounded-2xl shadow-md w-full max-w-md p-8">
      <div class="text-center mb-6">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="School Logo" class="mx-auto w-20 mb-4">
        <h2 class="text-2xl font-bold text-blue-900">Student Login</h2>
        <p class="text-sm text-gray-600">Login to cast your vote securely</p>
      </div>

      <form method="POST" action="login.php"  class="space-y-5">
        <div>
          <label class="block text-gray-700 font-medium mb-1">Student ID</label>
          <div class="relative">
            <i data-lucide="user" class="absolute left-3 top-3.5 w-4 h-4 text-gray-400"></i>
            <input type="text" name="student_id" required class="pl-10 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
          </div>
        </div>

        <div>
          <label class="block text-gray-700 font-medium mb-1">Password</label>
          <div class="relative">
            <i data-lucide="lock" class="absolute left-3 top-3.5 w-4 h-4 text-gray-400"></i>
            <input type="password" name="password" required class="pl-10 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
          </div>
        </div>

        <button type="submit" class="w-full bg-blue-800 hover:bg-blue-900 text-white py-2 rounded-lg font-semibold shadow">
          Login
        </button>
      </form>

      <div class="text-sm text-center mt-4 text-gray-500">
   
      </div>
    </div>
  </main>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>