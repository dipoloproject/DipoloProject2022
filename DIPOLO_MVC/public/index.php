<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
use Controllers\ProductoController;

$router = new Router();

$router->get('/admin', [ProductoController::class, 'index']);
$router->get('/productos/crear', [ProductoController::class, 'crear']);
$router->post('/productos/crear', [ProductoController::class, 'crear']);
$router->get('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/eliminar', [ProductoController::class, 'eliminar']);

// Login, Autenticacion y Logout
$router->get('/login', [LoginController::class, 'login']);  //para mostrar formulario
$router->post('/login', [LoginController::class, 'login']); //para enviar datos al formulario
$router->get('/logout', [LoginController::class, 'logout']);    //para cerrar sesion


$router->comprobarRutas();

?>