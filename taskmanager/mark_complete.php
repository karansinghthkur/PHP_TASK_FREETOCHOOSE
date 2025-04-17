<?php
require 'config.php';
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $stmt = $pdo->prepare("UPDATE tasks SET completed = NOT completed WHERE id = ?");
  $stmt->execute([$id]);
}
header("Location: list_tasks.php");
exit();
