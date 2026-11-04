<?php
$pdo = new PDO("mysql:host=YOUR_HOST;dbname=YOUR_DB;charset=utf8mb4", "YOUR_USER", "YOUR_PASS");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
)");
