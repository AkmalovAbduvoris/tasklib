<?php
declare(strict_types=1);

namespace App\Controllers;

use \App\Models\Users;

require 'src/views/login.php';

class Login {
  public function __construct() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->handleRegister();
    }
  }
  private function handleRegister() {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? ''; 
    if (empty($email) || empty($password)) {
      echo "Email and password are required"; 
      return;
    }
    $user = (new Users())->getUserByEmailAndPassword($email, $password);
    if ($user) {
        header("Location: /");
    }else {
        echo "Invalid email or password";
    }
  }
}