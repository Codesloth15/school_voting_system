<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "voting_system");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Basic SQL query (not secure for production)
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $admin = mysqli_fetch_assoc($result);

        // Simple password match (not hashed)
        if ($password == $admin['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['username'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Username not found.";
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<header class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
  <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <img src="https://cdn-icons-png.flaticon.com/512/201/201818.png" class="h-10 w-10" alt="Logo">
      <span class="text-xl font-bold text-blue-900">Admin Panel</span>
    </div>
  </div>
</header>

<main class="flex items-center justify-center pt-32 px-4">
  <div class="bg-white shadow-md rounded-xl p-8 max-w-md w-full">
    <h2 class="text-2xl font-bold text-center text-blue-800 mb-6">Admin Login</h2>

    <?php if ($error): ?>
      <div class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <div>
        <label class="block text-gray-700 font-medium mb-1">Username</label>
        <input type="text" name="username" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <button type="submit"
              class="w-full bg-blue-700 text-white font-semibold py-2 rounded-lg hover:bg-blue-800 transition">
        Log In
      </button>
    </form>
  </div>
</main>

</body>
</html>
