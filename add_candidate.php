<?php
session_start();

$conn = new mysqli("localhost", "root", "", "voting_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$electionId = isset($_GET['election_id']) ? (int)$_GET['election_id'] : 0;
if ($electionId <= 0) die("❌ Invalid election ID.");

// Fetch title and course from election
$stmt = $conn->prepare("SELECT title, course FROM elections WHERE id = ?");
$stmt->bind_param("i", $electionId);
$stmt->execute();
$result = $stmt->get_result();
$election = $result->fetch_assoc() ?: die("❌ Election not found.");
$stmt->close();

// Fetch positions
$positions = [];
$stmt = $conn->prepare("SELECT position FROM election_positions WHERE election_id = ?");
$stmt->bind_param("i", $electionId);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) $positions[] = $row['position'];
$stmt->close();

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name']);
    $course = $election['course']; // Use course from election
    $year = (int)$_POST['year'];
    $position = trim($_POST['position']);
    $platform = trim($_POST['platform']);
    $motto = trim($_POST['motto']);

    // File handling (photo is optional)
    $photoUrl = "";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoTmp = $_FILES['photo']['tmp_name'];
        $photoName = basename($_FILES['photo']['name']);
        $uploadDir = "uploads/";
        $targetPath = $uploadDir . time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $photoName);

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        if (move_uploaded_file($photoTmp, $targetPath)) {
            $photoUrl = $targetPath;
        } else {
            $error = "❌ Failed to upload photo.";
        }
    }

    if (!$error && $fullName && $course && $year && $position) {
        $stmt = $conn->prepare("INSERT INTO candidates (election_id, full_name, course, year, photo_url, position, platform, motto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ississss", $electionId, $fullName, $course, $year, $photoUrl, $position, $platform, $motto);
        if ($stmt->execute()) {
            $success = "✅ Candidate added successfully!";
        } else {
            $error = "❌ Failed to add candidate.";
        }
        $stmt->close();
    } elseif (!$error) {
        $error = "❌ All required fields must be filled.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Candidate - <?= htmlspecialchars($election['title']) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

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

<main class="max-w-2xl mx-auto pt-24 px-4 pb-10">
  <div class="bg-white shadow p-8 rounded-xl space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">Add Candidate - <?= htmlspecialchars($election['title']) ?></h2>

    <?php if ($success): ?>
      <div class="bg-green-100 text-green-700 border border-green-300 px-4 py-3 rounded-lg"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="bg-red-100 text-red-700 border border-red-300 px-4 py-3 rounded-lg"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="space-y-5">
      <input type="text" name="full_name" class="w-full border px-3 py-2 rounded" placeholder="Full Name" required>

      <!-- Auto-filled, read-only course field -->
      <input type="text" name="course" value="<?= htmlspecialchars($election['course']) ?>" class="w-full border px-3 py-2 rounded bg-gray-100 text-gray-700" readonly>

      <!-- Limit year to 4 only -->
      <input type="number" name="year" class="w-full border px-3 py-2 rounded" placeholder="Year Level (1-4)" min="1" max="4" required>

      <label class="block text-sm font-medium text-gray-700">Upload Photo (optional)</label>
      <input type="file" name="photo" accept="image/*" class="w-full border px-3 py-2 rounded bg-white">

      <select name="position" class="w-full border px-3 py-2 rounded" required>
        <option value="">-- Select Position --</option>
        <?php foreach ($positions as $pos): ?>
          <option value="<?= htmlspecialchars($pos) ?>"><?= htmlspecialchars($pos) ?></option>
        <?php endforeach; ?>
      </select>

      <input type="text" name="motto" class="w-full border px-3 py-2 rounded" placeholder="Motto (optional)">
      <textarea name="platform" class="w-full border px-3 py-2 rounded" rows="4" placeholder="Platform (optional)"></textarea>

      <div class="flex justify-between items-center pt-4">
        <a href="elections.php?election_id=<?= $electionId ?>" class="text-blue-600 hover:underline text-sm">← Back</a>
        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded font-semibold">Add Candidate</button>
      </div>
    </form>
  </div>
</main>

</body>
</html>
