<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Ruta acceso Login
$routes->get('/', 'Login::index');
$routes->post('login/auth', 'Login::auth');

// Dashboard
$routes->get('dashboard', 'Dashboard::index');

// Productos
$routes->get('productos', 'Productos::index');

// Ventas
$routes->get('ventas', 'Ventas::index');


// Test (prueba para la base de datos)
$routes->get('/test', 'Test::index');
