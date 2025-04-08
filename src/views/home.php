<?php
declare(strict_types=1);
use App\Controllers\Home;

$tasks = (new Home())->fetchAllTasks();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Status</th>
        <th scope="col">Difficuly</th>
        <th scope="col">Deadline</th>
        <th scope="col">View</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($tasks as $task) {
        echo "<tr>";
        echo "<td>{$task['id']}</td>";
        echo "<td>{$task['title']}</td>";
        echo "<td>{$task['status']}</td>";
        echo "<td>{$task['difficulty']}</td>";
        echo "<td>{$task['deadline']}</td>";
        echo "<td>
          <a href='/task?id={$task['id']}'>View</a>
        </td>";
        echo "</tr>";
      }
      ?>
  </table>
</body>
</html>
