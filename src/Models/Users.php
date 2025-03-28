<?php
declare(strict_types=1);

namespace App\Models;

class Users {
  public \PDO $pdo;

  public function __construct() {
    $this->pdo = \App\Models\DB::getConnection();
  }

  public function getAllUsers(): array {
      $stmt = $this->pdo->query("SELECT * FROM users");
      return $stmt->fetchAll();
  }
}
