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
$routes->get('productos/crear', 'Productos::crear');
$routes->post('productos/guardar', 'Productos::guardar');
$routes->get('productos/editar/(:num)', 'Productos::editar/$1');
$routes->post('productos/actualizar/(:num)', 'Productos::actualizar/$1');
$routes->get('productos/eliminar/(:num)', 'Productos::eliminar/$1');

// Ventas
$routes->get('ventas', 'Ventas::index');

// Clientes
$routes->get('clientes', 'Clientes::index');
$routes->get('clientes/crear', 'Clientes::crear');
$routes->post('clientes/guardar', 'Clientes::guardar');
$routes->get('clientes/editar/(:num)', 'Clientes::editar/$1');
$routes->post('clientes/actualizar/(:num)', 'Clientes::actualizar/$1');
$routes->get('clientes/eliminar/(:num)', 'Clientes::eliminar/$1');

//Compras
$routes->get('compras', 'Compras::index');

//Invenatrio
$routes->get('inventario', 'Inventario::index');

//Proveedores
$routes->get('proveedores', 'Proveedores::index');

//Reportes
$routes->get('reportes', 'Reportes::index');

//Usuarios
$routes->get('usuarios', 'Usuarios::index');

// Rutas del Punto de Venta
$routes->get('pos', 'POS::index');
$routes->post('pos/buscarProducto', 'POS::buscarProducto');
$routes->post('pos/guardarVenta', 'POS::guardarVenta');
$routes->post('pos/verificarStock', 'POS::verificarStock');

// Test (prueba para la base de datos)
$routes->get('/test', 'Test::index');
