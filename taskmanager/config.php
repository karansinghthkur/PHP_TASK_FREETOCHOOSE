<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'task_db';
try {
  // 1. Connect without selecting a DB
  $pdo = new PDO("mysql:host=$host", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
  // 2.Create database if not exists
  $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
  // 3. Switch to the DB
  $pdo->exec("USE `$db`");
  // 4. Create table if not exists
  $pdo->exec("
          CREATE TABLE IF NOT EXISTS tasks (
          id INT AUTO_INCREMENT PRIMARY KEY,
          title VARCHAR(255) NOT NULL,
          description TEXT NOT NULL,
          due_date DATE NOT NULL,
          completed TINYINT(1) NOT NULL DEFAULT 0,
          INDEX idx_due_date (due_date)
        )
    ");
} catch (PDOException $e) {
  die("Database setup failed: " . $e->getMessage());
}
