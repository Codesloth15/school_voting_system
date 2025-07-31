<?php
session_start();
$adminName = $_SESSION['admin_name'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Voter Manager</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Header -->
<!-- Header -->
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

<!-- Main Content -->
<main class="max-w-6xl mx-auto px-4 pt-24 pb-10">
  <h2 class="text-2xl font-bold text-gray-800 mb-6">Manage Voters</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    
    <!-- Students Card -->
    <a href="students.php" class="bg-white border shadow hover:shadow-lg p-6 rounded-xl transition transform hover:-translate-y-1">
      <div class="flex items-center space-x-4">
        <div class="bg-blue-100 p-4 rounded-full">
          <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Students" class="w-10 h-10">
        </div>
        <div>
          <h3 class="text-xl font-bold text-blue-800">Students</h3>
          <p class="text-gray-600 text-sm mt-1">View and manage student voters</p>
        </div>
      </div>
    </a>

    <!-- Colleges Card -->
    <a href="voters.php" class="bg-white border shadow hover:shadow-lg p-6 rounded-xl transition transform hover:-translate-y-1">
      <div class="flex items-center space-x-4">
        <div class="bg-green-100 p-4 rounded-full">
          <img src="https://cdn-icons-png.flaticon.com/512/1975/1975638.png" alt="Colleges" class="w-10 h-10">
        </div>
        <div>
          <h3 class="text-xl font-bold text-green-800">Colleges</h3>
          <p class="text-gray-600 text-sm mt-1">View and manage colleges</p>
        </div>
      </div>
    </a>

  </div>
</main>

</body>
</html>
