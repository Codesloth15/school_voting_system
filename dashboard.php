<?php
session_start();

$adminName = $_SESSION['admin_name'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Voting System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen">

<!-- Header -->
<header class="bg-white border-b shadow fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="w-10 h-10" alt="Logo">
      <h1 class="text-xl font-bold text-blue-900">Admin Dashboard</h1>
    </div>
    <div class="flex items-center space-x-4">
      <span class="text-gray-700 font-medium">👋 Welcome, <?= htmlspecialchars($adminName) ?></span>
      <a href="logout.php" class="text-red-600 hover:underline">Logout</a>
    </div>
  </div>
</header>

<!-- Main Section -->
<main class="max-w-6xl mx-auto pt-24 pb-10 px-4">
  <h2 class="text-2xl font-semibold text-gray-800 mb-8">Manage the Voting System</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <a href="elections.php" class="block bg-white shadow rounded-2xl p-6 hover:bg-blue-50 transition">
      <div class="flex items-center space-x-4">
        <i data-lucide="calendar" class="w-8 h-8 text-blue-600"></i>
        <div>
          <h3 class="text-lg font-semibold">Elections</h3>
          <p class="text-sm text-gray-500">Create and manage elections</p>
        </div>
      </div>
    </a>

    <a href="candidates.php" class="block bg-white shadow rounded-2xl p-6 hover:bg-blue-50 transition">
      <div class="flex items-center space-x-4">
        <i data-lucide="users" class="w-8 h-8 text-green-600"></i>
        <div>
          <h3 class="text-lg font-semibold">Candidates</h3>
          <p class="text-sm text-gray-500">Add and organize candidates</p>
        </div>
      </div>
    </a>

    <a href="voters.php" class="block bg-white shadow rounded-2xl p-6 hover:bg-blue-50 transition">
      <div class="flex items-center space-x-4">
        <i data-lucide="user-check" class="w-8 h-8 text-purple-600"></i>
        <div>
          <h3 class="text-lg font-semibold">Voters</h3>
          <p class="text-sm text-gray-500">Manage student access</p>
        </div>
      </div>
    </a>

    <a href="results.php" class="block bg-white shadow rounded-2xl p-6 hover:bg-blue-50 transition">
      <div class="flex items-center space-x-4">
        <i data-lucide="bar-chart-3" class="w-8 h-8 text-yellow-600"></i>
        <div>
          <h3 class="text-lg font-semibold">Results</h3>
          <p class="text-sm text-gray-500">View election results</p>
        </div>
      </div>
    </a>

    <a href="settings.php" class="block bg-white shadow rounded-2xl p-6 hover:bg-blue-50 transition">
      <div class="flex items-center space-x-4">
        <i data-lucide="settings" class="w-8 h-8 text-gray-700"></i>
        <div>
          <h3 class="text-lg font-semibold">Settings</h3>
          <p class="text-sm text-gray-500">Change system configuration</p>
        </div>
      </div>
    </a>
  </div>
</main>

<script>
  lucide.createIcons();
</script>
</body>
</html>
