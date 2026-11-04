<?php
require "db.php";
$msg = ""; $ok = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$_POST["email"]]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user && password_verify($_POST["password"], $user["password"])) {
    $msg = "Welcome back, " . $user["name"] . "!"; $ok = true;
  } else {
    $msg = "Invalid email or password.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In | Brew & Co.</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="card">
    <h1>Brew & Co.</h1>
    <p class="sub">Sign in to your account</p>
    <form method="POST">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="you@email.com" required>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter password" required>
      <button type="submit">Sign In</button>
      <div class="msg <?= $ok ? 'ok' : '' ?>"><?= htmlspecialchars($msg) ?></div>
    </form>
    <div class="link">No account yet? <a href="register.php">Register</a></div>
  </div>
</body>
</html>
