<?php
declare(strict_types=1);

namespace App\Controllers;

use \App\Models\Users;

require 'src/views/login.php';

class Login {
  public function __construct() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->handleLogin();
    }
  }
  private function handleLogin() {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? ''; 
    if (empty($email) || empty($password)) {
      echo "Email and password are required"; 
      return;
    }
    $user = (new Users())->getUserByEmailAndPassword($email, $password);
      $_SESSION['user'] = [
        'id'    => $user['id'],
        'name'  => $user['name'],
        'email' => $user['email'],
        'role'  => $user['role'],
      ];
      var_dump($_SESSION['user']);
      if ($user['role'] == 'admin') {
        header("Location: /admin");
        exit;
      }
      if ($user['role'] == 'user') {
        header("Location: /");
        exit;
      }
  }
}