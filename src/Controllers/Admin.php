<?php
declare(strict_types=1);

namespace App\Controllers;

use \App\Models\Tasks;

require 'src/views/admin.php';

echo "<pre>";
var_dump($_POST);
echo "</pre>";

class Admin {
  public function __construct() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->handleNewTask();
    } 
  }

  public function handleNewTask() {
    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $status = $_POST['status'] ?? null;
    $difficulty = $_POST['difficulty'] ?? null;
    $deadline = $_POST['deadline'] ?? null;
    $requirements_titles = $_POST['requirements_titles'] ?? [];
    $requirements_resourse = $_POST['requirements_resourse'] ?? [];
    $knowledges_titles = $_POST['knowledges_titles'] ?? [];
    $knowledges_resourse = $_POST['knowledges_resourse'] ?? [];
    if ($title && $description && $status && $difficulty && $deadline) {
      try {
          (new Tasks())->addTask($title, $description, $status, $difficulty, $deadline, $requirements_titles, $requirements_resourse, $knowledges_titles, $knowledges_resourse);
          header("Location: /");
      } catch (\Exception $e) {
          echo "Error: " . $e->getMessage();
      }
  } else {
      echo "Missing required fields.";

  }
  }
}
