<?php
declare(strict_types=1);

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
  '/'         => 'src/Controllers/Home.php',
  '/admin'    => 'src/Controllers/Admin.php',
  '/login'    => 'src/Controllers/Login.php',
  '/register' => 'src/Controllers/Register.php',
  '/task'     => 'src/Controllers/Task.php',
];


function routeToController($uri, $routes) {
  if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
  }
  else {
    echo "<pre>";
    var_dump($_SERVER);
    echo "</pre>";
  }
}

routeToController($uri, $routes);
