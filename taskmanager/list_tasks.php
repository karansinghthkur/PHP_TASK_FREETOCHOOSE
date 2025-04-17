<?php
require 'config.php';
// Fetch tasks
$stmt = $pdo->query("SELECT * FROM tasks ORDER BY due_date ASC");
$tasks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Task List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <body class="p-4">
    <div class="container">
      <h1 class="mb-4">All Tasks</h1>
      <a href="add_task.php" class="btn btn-primary mb-3">+ Add New Task</a>
      <br><br>
      <?php if (empty($tasks)): ?>
        <p style="color: gray;">No tasks found. Start by adding one!</p>
      <?php else: ?>
        <table border="1" cellpadding="8">
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Actions</th>
          </tr>
          <?php foreach ($tasks as $task): ?>
            <tr>
              <td style="<?= $task['completed'] ? 'text-decoration: line-through; color: green;' : '' ?>">
                <?= htmlspecialchars($task['title']) ?>
              </td>
              <td><?= htmlspecialchars($task['description']) ?></td>
              <td><?= htmlspecialchars($task['due_date']) ?></td>
              <td>
                <?php if (!$task['completed']): ?>
                  <a href="mark_complete.php?id=<?= $task['id'] ?>" class="btn btn-success btn-sm me-1">Complete</a>
                <?php else: ?>
                  <span class="badge bg-success">Completed</span>
                <?php endif; ?>
                <a href="delete_task.php?id=<?= $task['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">🗑 Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php endif; ?>
  </body>

</html>