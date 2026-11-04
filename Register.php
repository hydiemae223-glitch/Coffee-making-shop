<?php
require "db.php";
$msg = ""; $ok = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  if ($_POST["password"] !== $_POST["confirm"]) {
    $msg = "Passwords do not match.";
  } else {
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
    if ($check->fetch()) {
      $msg = "Email already registered.";
    } else {
      $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
      $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)")
          ->execute([$name, $email, $hash]);
      $msg = "Registered! You can now sign in."; $ok = true;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Brew & Co.</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="card">
    <h1>Brew & Co.</h1>
    <p class="sub">Create your account</p>
    <form method="POST">
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" placeholder="Juan Dela Cruz" required>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="you@email.com" required>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" minlength="6" placeholder="At least 6 characters" required>
      <label for="confirm">Confirm Password</label>
      <input type="password" id="confirm" name="confirm" placeholder="Re-enter password" required>
      <button type="submit">Register</button>
      <div class="msg <?= $ok ? 'ok' : '' ?>"><?= htmlspecialchars($msg) ?></div>
    </form>
    <div class="link">Already have an account? <a href="index.php">Sign In</a></div>
  </div>
</body>
</html>
