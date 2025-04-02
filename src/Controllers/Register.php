<?php
declare(strict_types=1);

namespace App\Controllers;

use \App\Models\Users;

require 'src/views/register.php';

class Register {
  public function __construct() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->handleLogin();
    }
  }
  private function handleLogin() {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $username = $_POST['username'] ?? '';
    if (empty($email) || empty($password) || empty($username)) {
      echo "Email and password are required.";
      return;
    }
    (new Users())->addNewUser($username, $email, $password);
    header("Location: /");
  }
}
