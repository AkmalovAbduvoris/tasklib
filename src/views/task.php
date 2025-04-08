<?php
declare(strict_types=1);

use App\Controllers\Task;

$task = (new Task())->fetchTaskById($_GET['id']);
//echo "<pre>";
//var_dump($task);
//echo "</pre>";
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
      .delete{
        width: 100%;
        height: 50px;
      }
      .edit{
        width: 100%;
        height: 50px;
      }
      .task{
        margin-top: 60px;
      }
      .status{
        margin-top: 60px;
      }
      .desc{
        margin-top: 100px;
        margin-right: 160px;
      }
      .req{
        margin-top: 80px;
      }
      .req_a{
        text-decoration: none;
      }
    </style>
  </head>
  <body class="mt-4 mb-4">
    <div class="container task">
        <div class="row">
            <div class="col-10">
                <h1><?= htmlspecialchars($task['task_title']) ?></h1>
                <p class="desc fs-3"><?= htmlspecialchars($task['task_description']) ?></p>
                <div class="d-flex justify-content-between">
                <div>
                <h2 class="req">Requirements:</h2>
                <ul class="text-secondary fs-5">
                  <?php foreach ($task['requirements'] as $requirement): ?>
                  <li style="font-size: 1.5em; color: black; text-primary req_a">
                  <a href="<?php echo $requirement['requirement_resourse']; ?>" target="_blank">
                    <?= htmlspecialchars($requirement['requirement_title']) ?>
                  </a>
                  </li>
                  <?php endforeach; ?>
                </ul>
                </div>
                <div>
                <h2 class="req">Resources:</h2>
                <ul class="text-secondary fs-5">
                  <?php foreach ($task['knowledge'] as $knowledge): ?>
                  <li style="font-size: 1.5em; color: black; text-primary req_a">
                    <a href="<?php echo $knowledge['knowledge_resourse']; ?>" target="_blank">
                      <?= htmlspecialchars($knowledge['knowledge_title']) ?>
                    </a>
                  </li>
                  <?php endforeach; ?>
                </ul>
                </div>
                </div>
                <h2 class="req">Solutions:</h2>
            </div>
            <div class="col">
              <h4 class="mt-5 fst-italic">difficulty level:</h4>
              <h3 align="center" class="mt-1 border border-3 border-dark text-danger"><?= htmlspecialchars($task['task_difficulty']) ?></h3>
              <h4 class="mt-4 fst-italic">status:</h4>
              <h3 align="center" class="mt-1 border border-3 border-dark text-warning">in progress</h3>
              <h4 class="mt-4 fst-italic">deadline:</h4>
              <i class="bi bi-hourglass text-danger fs-3"></i>
              <span class="ms-2 fw-bold text-secondary fs-4">24h</span>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
