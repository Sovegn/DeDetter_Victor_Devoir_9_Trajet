<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Buki\Router\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\TrajetController;
use App\Controllers\AdminController;

$router = new Router([
    'paths' => [
        'controllers' => '../app/Controllers',
    ],
    'namespaces' => [
        'controllers' => 'App\Controllers',
    ]
]);

// Routes publiques
$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

// Routes utilisateur
$router->get('/trajet/create', [TrajetController::class, 'createForm']);
$router->post('/trajet/create', [TrajetController::class, 'create']);
$router->get('/trajet/edit/:id', [TrajetController::class, 'editForm']);
$router->post('/trajet/edit/:id', [TrajetController::class, 'edit']);
$router->post('/trajet/delete/:id', [TrajetController::class, 'delete']);

// Routes admin
$router->get('/admin', [AdminController::class, 'dashboard']);
$router->get('/admin/utilisateurs', [AdminController::class, 'utilisateurs']);
$router->get('/admin/agences', [AdminController::class, 'agences']);
$router->post('/admin/agences/create', [AdminController::class, 'createAgence']);
$router->post('/admin/agences/delete/:id', [AdminController::class, 'deleteAgence']);
$router->get('/admin/trajets', [AdminController::class, 'trajets']);

$router->run();