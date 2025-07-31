<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>School Voting System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

  <!-- Navbar -->
  <header class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
      <div class="flex items-center space-x-3">
        <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" alt="School Logo" class="w-8 h-8 md:w-10 md:h-10">
        <span class="text-lg md:text-xl font-bold text-blue-900">School Voting System</span>
      </div>
      <nav class="hidden md:flex space-x-5 text-sm text-gray-700">
        <a href="#" class="hover:text-blue-700 flex items-center"><i data-lucide="vote" class="w-4 h-4 mr-1"></i>How to Vote</a>
        <a href="#" class="hover:text-blue-700 flex items-center"><i data-lucide="help-circle" class="w-4 h-4 mr-1"></i>Help</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-blue-900 text-white flex-1 flex items-center justify-center">
    <div class="max-w-4xl mx-auto px-4 py-12 text-center">
      <h1 class="text-3xl md:text-4xl font-bold mb-3 leading-tight">Welcome to the School Voting System</h1>
      <p class="text-base md:text-lg mb-5">Vote for your student leaders safely, fairly, and securely.</p>
      <a href="login.php" class="inline-block bg-white text-blue-900 font-semibold px-5 py-2.5 rounded-full shadow hover:bg-gray-100 transition">Login to Vote</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-12 bg-white">
    <div class="max-w-5xl mx-auto px-4 text-center">
      <h2 class="text-2xl font-bold text-blue-900 mb-8">System Features</h2>
      <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 text-left">
        <div class="flex items-start space-x-4">
          <i data-lucide="users" class="w-6 h-6 text-blue-800 mt-1"></i>
          <div>
            <h3 class="text-base font-semibold text-gray-700">Candidate Profiles</h3>
            <p class="text-sm text-gray-600">View complete information about each candidate before voting.</p>
          </div>
        </div>
        <div class="flex items-start space-x-4">
          <i data-lucide="shield-check" class="w-6 h-6 text-blue-800 mt-1"></i>
          <div>
            <h3 class="text-base font-semibold text-gray-700">Secure Voting</h3>
            <p class="text-sm text-gray-600">One vote per student, encrypted and stored securely.</p>
          </div>
        </div>
        <div class="flex items-start space-x-4">
          <i data-lucide="bar-chart-2" class="w-6 h-6 text-blue-800 mt-1"></i>
          <div>
            <h3 class="text-base font-semibold text-gray-700">Live Results</h3>
            <p class="text-sm text-gray-600">Real-time voting results available as soon as voting ends.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-200 text-gray-600 py-4 text-center text-xs">
    &copy; <?= date('Y') ?> School Voting System. All rights reserved.
  </footer>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>
