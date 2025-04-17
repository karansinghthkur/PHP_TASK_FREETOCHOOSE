<?php
require 'config.php';
$title = $description = $due_date = '';
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = trim($_POST['title']);
  $description = trim($_POST['description']);
  $due_date = $_POST['due_date'];
  // Validate inputs
  if (empty($title)) $errors[] = "Title is required.";
  if (empty($description)) $errors[] = "Description is required.";
  if (!DateTime::createFromFormat('Y-m-d', $due_date)) {
    $errors[] = "Invalid date format.";
  } else {
    $enteredDate = new DateTime($due_date);
    $today = new DateTime();
    $today->setTime(0, 0);
    if ($enteredDate < $today) {
      $errors[] = "Due date cannot be in the past.";
    }
  }
  if (empty($errors)) {
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description, due_date, completed) VALUES (?, ?, ?, 0)");
    $stmt->execute([$title, $description, $due_date]);
    header("Location: list_tasks.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Add Task</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
  <div class="container">
    <h1 class="mb-4">Add New Task</h1>
    <?php foreach ($errors as $error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endforeach; ?>
    <form method="post" class="mb-4">
      <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($title) ?>">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea id="description" name="description" class="form-control" rows="4"><?= htmlspecialchars($description) ?></textarea>
      </div>
      <div class="mb-3">
        <label for="due_date" class="form-label">Due Date:</label>
        <input type="date" id="due_date" name="due_date" class="form-control" value="<?= htmlspecialchars($due_date) ?>" min="<?= date('Y-m-d') ?>">
      </div>
      <button type="submit" class="btn btn-primary">+ Add Task</button>
      <a href="list_tasks.php" class="btn btn-outline-secondary ms-2">📋 View Tasks</a>
    </form>
  </div>
</body>

</html>