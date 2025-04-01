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

  public function addNewUser($username, $email, $password): void {
    $stmt = $this->pdo->prepare("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");
    $stmt->bindParam(':name', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
  }

  public function getUserByEmailAndPassword($email, $password): ?array {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch();
    return $user ? $user : null;
  }
}