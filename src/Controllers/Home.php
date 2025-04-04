<?php
declare(strict_types=1);

namespace App\Controllers;

use \App\Models\Tasks;

require 'src/views/home.php';

class Home {
  public function fetchAllTasks() {
    $tasks = (new Tasks())->getAllTasks();
    return $tasks;
  }
}
