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
  <h2 class="text-3xl font-semibold text-gray-800 mb-10">Manage the Voting System</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
    <!-- Elections -->
    <a href="elections.php" class="block bg-white shadow-lg rounded-2xl p-8 hover:bg-blue-50 transition">
      <div class="flex items-center space-x-5">
        <i data-lucide="calendar" class="w-10 h-10 text-blue-600"></i>
        <div>
          <h3 class="text-xl font-semibold">Elections</h3>
          <p class="text-base text-gray-500">Create and manage elections</p>
        </div>
      </div>
    </a>

    <!-- Candidates (In Development) -->
    <div onclick="showDevModal('Candidates')" class="cursor-pointer bg-white shadow-lg rounded-2xl p-8 hover:bg-green-50 transition">
      <div class="flex items-center space-x-5">
        <i data-lucide="users" class="w-10 h-10 text-green-600"></i>
        <div>
          <h3 class="text-xl font-semibold">Candidates</h3>
          <p class="text-base text-gray-500">Add and organize candidates</p>
        </div>
      </div>
    </div>

    <!-- Voters -->
    <a href="voter_manager.php" class="block bg-white shadow-lg rounded-2xl p-8 hover:bg-purple-50 transition">
      <div class="flex items-center space-x-5">
        <i data-lucide="user-check" class="w-10 h-10 text-purple-600"></i>
        <div>
          <h3 class="text-xl font-semibold">Voters</h3>
          <p class="text-base text-gray-500">Manage student access</p>
        </div>
      </div>
    </a>

    <!-- Results -->
    <a href="all_election.php" class="block bg-white shadow-lg rounded-2xl p-8 hover:bg-yellow-50 transition">
      <div class="flex items-center space-x-5">
        <i data-lucide="bar-chart-3" class="w-10 h-10 text-yellow-600"></i>
        <div>
          <h3 class="text-xl font-semibold">Results</h3>
          <p class="text-base text-gray-500">View election results</p>
        </div>
      </div>
    </a>

    <!-- Settings (In Development) -->
    <div onclick="showDevModal('Settings')" class="cursor-pointer bg-white shadow-lg rounded-2xl p-8 hover:bg-gray-50 transition">
      <div class="flex items-center space-x-5">
        <i data-lucide="settings" class="w-10 h-10 text-gray-700"></i>
        <div>
          <h3 class="text-xl font-semibold">Settings</h3>
          <p class="text-base text-gray-500">Change system configuration</p>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Development Modal -->
<div id="devModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-lg relative animate-fadeIn">
    <button onclick="hideDevModal()" class="absolute top-2 right-3 text-gray-600 hover:text-black text-2xl">&times;</button>
    <div class="flex items-center space-x-4 mb-4">
      <i data-lucide="alert-circle" class="w-8 h-8 text-red-500"></i>
      <h2 id="modalTitle" class="text-xl font-bold text-gray-800">Still in Development</h2>
    </div>
    <p class="text-gray-600 mb-4">
      The <span id="modalFeature" class="font-semibold text-gray-800">feature</span> module is still being built. Please check back later.
    </p>
    <div class="text-right">
      <button onclick="hideDevModal()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Got it</button>
    </div>
  </div>
</div>

<script>
  lucide.createIcons();

  function showDevModal(feature) {
    document.getElementById("modalFeature").textContent = feature;
    document.getElementById("devModal").classList.remove("hidden");
    document.getElementById("devModal").classList.add("flex");
  }

  function hideDevModal() {
    document.getElementById("devModal").classList.remove("flex");
    document.getElementById("devModal").classList.add("hidden");
  }
</script>

<style>
  .animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>
</body>
</html>
