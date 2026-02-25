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

// Clientes
$routes->get('clientes', 'Clientes::index');

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
