<?php
declare(strict_types=1);

require '../vendor/autoload.php';

use App\Models\DB;

$pdo = DB::getConnection();

$pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS tasks (
     id INT PRIMARY KEY AUTO_INCREMENT,
     title VARCHAR(255),
     descirption VARCHAR(255) NOT NULL,
     status ENUM('published', 'drafted') DEFAULT 'drafted',
     difficuly ENUM('easy','medium','hard') NOT NULL,
     deadline INT NOT NULL,
     created_at TIMESTAMP,
     updated_at TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS requirements (
     id INT PRIMARY KEY AUTO_INCREMENT,
     title VARCHAR(255) NOT NULL,
     resourse VARCHAR(255) NOT NULL,
     task_id INT
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS required_knowledge (
     id INT PRIMARY KEY AUTO_INCREMENT,
     title VARCHAR(255) NOT NULL,
     resourse VARCHAR(255) NOT NULL,
     task_id INT
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS users_tasks (
     user_id INT,
     task_id INT,
     status ENUM('available','inProgress','complated'),
     started_at TIMESTAMP,
     finished_at TIMESTAMP
)");

$pdo->exec("ALTER TABLE requirements ADD FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE");

$pdo->exec("ALTER TABLE required_knowledge ADD FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE");

$pdo->exec("ALTER TABLE users_tasks ADD FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE");

$pdo->exec("ALTER TABLE users_tasks ADD FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE");