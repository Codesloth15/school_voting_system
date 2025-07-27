<?php
session_start();

// If already logged in, redirect
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Replace with actual DB check or more secure auth system
    $validAdmin = [
        'username' => 'admin',
        'password' => 'password123', // Use hashed passwords in production!
        'name'     => 'Administrator'
    ];

    if ($username === $validAdmin['username'] && $password === $validAdmin['password']) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $validAdmin['name'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
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
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

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

</body>
</html>
