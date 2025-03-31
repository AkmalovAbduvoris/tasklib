<?php
declare(strict_types=1);
ok
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Models\DB;
use App\Models\Users;

$usersModel = new Users();
$users = $usersModel->getAllUsers();
print_r($users);
require 'router.php';
