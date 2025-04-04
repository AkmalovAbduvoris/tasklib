<?php
declare(strict_types=1);
namespace App\Models;

require 'vendor/autoload.php';

use \Dotenv\Dotenv;
use \PDO;
use \PDOException;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class DB {
    private static ?PDO $pdo = null;

    public static function connect(): void {
      if (self::$pdo === null) {
          $host = $_ENV['DB_HOST'];
          $database = $_ENV['DB_NAME'];
          $username = $_ENV['DB_USER'];
          $password = $_ENV['DB_PASSWORD'];
  
          try {
              self::$pdo = new PDO(
                  "mysql:host={$host};dbname={$database};charset=utf8mb4",
                  $username,
                  $password,
                  [
                      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                      PDO::ATTR_EMULATE_PREPARES => false,
                  ]
              );
          } catch (PDOException $e) {
              die("❌ Database connection error: " . $e->getMessage());
          }
      }
  }
  

    public static function getConnection(): PDO {
        if (self::$pdo === null) {
            self::connect();
        }
        return self::$pdo;
    }
}
