<?php
declare(strict_types=1);
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Models\DB;
use App\Models\Users;

$usersModel = new Users();
$users = $usersModel->getAllUsers();
require 'router.php';
