<?php
declare(strict_types=1);

namespace App\Controllers;

use \App\Models\Tasks;

require "src/views/task.php";

class Task {
  public function fetchTaskById($id = 1) {
    $task = (new Tasks())->getTaskById($id);
    return $task;
  }
}
