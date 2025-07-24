<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['election_id'])) {
    echo "Election not specified.";
    exit();
}

$election_id = intval($_GET['election_id']);

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$electionQuery = $conn->query("SELECT title FROM elections WHERE id = $election_id");
$election = $electionQuery->fetch_assoc();

$sql = "SELECT * FROM candidates WHERE election_id = $election_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Candidates</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    /* Line clamp plugin not needed if you're using Tailwind CDN with built-in support */
    .line-clamp-2 {
      overflow: hidden;
      display: -webkit-box;
   
      -webkit-box-orient: vertical;
    }
    .line-clamp-1 {
      overflow: hidden;
      display: -webkit-box;
  
      -webkit-box-orient: vertical;
    }
  </style>
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

  <!-- Main Section -->
  <section class="max-w-6xl mx-auto pt-24 pb-12 px-4">
    <h2 class="text-2xl font-bold text-blue-900 mb-6">Candidates for: <?= htmlspecialchars($election['title']) ?></h2>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="bg-white rounded-2xl shadow p-6 flex flex-col justify-between h-[500px] hover:shadow-lg transition-all duration-300">
            <div>
              <img src="<?= htmlspecialchars($row['photo_url']) ?>" alt="Candidate Photo" class="w-28 h-28 object-cover rounded-full mx-auto mb-4 border">
              <h3 class="text-xl font-semibold text-center text-gray-800 truncate"><?= htmlspecialchars($row['full_name']) ?></h3>
              <p class="text-sm text-center text-gray-600 mb-2">Position: <strong><?= htmlspecialchars($row['position']) ?></strong></p>

              <ul class="text-sm text-gray-600 space-y-1 mt-2">
                <li><strong>Course:</strong> <?= htmlspecialchars($row['course']) ?></li>
                <li><strong>Year:</strong> <?= htmlspecialchars($row['year']) ?></li>
                <li><strong>Age:</strong> <?= htmlspecialchars($row['age']) ?></li>
                <li class="line-clamp-2"><strong>Platform:</strong> <?= htmlspecialchars($row['platform']) ?></li>
                <li class="line-clamp-1"><strong>Motto:</strong> “<?= htmlspecialchars($row['motto']) ?>”</li>
              </ul>
            </div>

            <div class="mt-4 space-y-2">
              <a href="candidate_profile.php?id=<?= $row['id'] ?>" class="block w-full bg-gray-200 hover:bg-gray-300 text-center text-sm text-gray-800 py-2 rounded">View Profile</a>
              <button class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded text-sm">
                Vote for <?= htmlspecialchars($row['full_name']) ?>
              </button>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-gray-600 col-span-3">No candidates available for this election.</p>
      <?php endif; ?>
    </div>
  </section>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>
