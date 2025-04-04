<?php
declare(strict_types=1);

use App\Controllers\Task;

$task = (new Task())->fetchTaskById($_GET['id']);
//echo "<pre>";
//var_dump($task);
//echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <h2><?= htmlspecialchars($task['task_title']) ?></h2>
  <p><?= htmlspecialchars($task['task_description']) ?></p>
  <div style="display: flex; justify-content: space-between;">
    <div>
        <h3>Requirements:</h3>
        <ul>
            <?php foreach ($task['requirements'] as $requirement): ?>
            <li>
                <a href="<?php echo $requirement['requirement_resourse']; ?>" target="_blank">
                    <?= htmlspecialchars($requirement['requirement_title']) ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div>
        <h3>Required knowledge: </h3>
        <ul>
            <?php foreach ($task['knowledge'] as $knowledge): ?>
            <li>
                <a href="<?php echo $knowledge['knowledge_resourse']; ?>" target="_blank">
                    <?= htmlspecialchars($knowledge['knowledge_title']) ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
  </div>
</body>
</html>
