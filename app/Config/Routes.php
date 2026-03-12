<?php

use CodeIgniter\Router\RouteCollection;

// RUTAS PÚBLICAS
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->post('login/autenticar', 'Login::autenticar');
$routes->get('logout', 'Login::logout');

// RUTAS PROTEGIDAS
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // DASHBOARD - Admin y Gerente (Cajero NO)
    $routes->get('dashboard', 'Dashboard::index', ['filter' => 'role:admin,gerente']);
    
    // Punto de Venta - Admin y Cajero (sin filtro adicional porque ya está en auth)
    $routes->get('pos', 'POS::index');
    $routes->post('pos/buscarProducto', 'POS::buscarProducto');
    $routes->post('pos/guardarVenta', 'POS::guardarVenta');
    $routes->post('pos/verificarStock', 'POS::verificarStock');
    
    // VENTAS - Todos
    $routes->get('ventas', 'Ventas::index');
    $routes->get('ventas/detalle/(:num)', 'Ventas::detalle/$1');
    $routes->get('ventas/imprimir/(:num)', 'Ventas::imprimir/$1');
    $routes->post('ventas/anular/(:num)', 'Ventas::anular/$1');
    
    // PRODUCTOS - Admin y Gerente
    $routes->get('productos', 'Productos::index', ['filter' => 'role:admin,gerente']);
    $routes->get('productos/crear', 'Productos::crear', ['filter' => 'role:admin,gerente']);
    $routes->post('productos/guardar', 'Productos::guardar', ['filter' => 'role:admin,gerente']);
    $routes->get('productos/editar/(:num)', 'Productos::editar/$1', ['filter' => 'role:admin,gerente']);
    $routes->post('productos/actualizar/(:num)', 'Productos::actualizar/$1', ['filter' => 'role:admin,gerente']);
    $routes->get('productos/eliminar/(:num)', 'Productos::eliminar/$1', ['filter' => 'role:admin,gerente']);
    
    // CLIENTES - Admin y Gerente
    $routes->get('clientes', 'Clientes::index', ['filter' => 'role:admin,gerente']);
    $routes->get('clientes/crear', 'Clientes::crear', ['filter' => 'role:admin,gerente']);
    $routes->post('clientes/guardar', 'Clientes::guardar', ['filter' => 'role:admin,gerente']);
    $routes->get('clientes/editar/(:num)', 'Clientes::editar/$1', ['filter' => 'role:admin,gerente']);
    $routes->post('clientes/actualizar/(:num)', 'Clientes::actualizar/$1', ['filter' => 'role:admin,gerente']);
    $routes->get('clientes/eliminar/(:num)', 'Clientes::eliminar/$1', ['filter' => 'role:admin,gerente']);
    
    // INVENTARIO - Admin y Gerente
    $routes->get('inventario', 'Inventario::index', ['filter' => 'role:admin,gerente']);
    
    // COMPRAS y PROVEEDORES - Admin y Gerente
    $routes->get('compras', 'Compras::index', ['filter' => 'role:admin,gerente']);
    $routes->get('proveedores', 'Proveedores::index', ['filter' => 'role:admin,gerente']);
    
    // REPORTES - Admin y Gerente
    $routes->get('reportes/ventas', 'Reportes::ventas', ['filter' => 'role:admin,gerente']);
    $routes->get('reportes/clientes', 'Reportes::clientes', ['filter' => 'role:admin,gerente']);
    $routes->get('reportes/inventario', 'Reportes::inventario', ['filter' => 'role:admin,gerente']);
    
    // USUARIOS - Solo Admin
    $routes->get('usuarios', 'Usuarios::index', ['filter' => 'role:admin']);
    $routes->get('usuarios/crear', 'Usuarios::crear', ['filter' => 'role:admin']);
    $routes->post('usuarios/guardar', 'Usuarios::guardar', ['filter' => 'role:admin']);
    $routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1', ['filter' => 'role:admin']);
    $routes->post('usuarios/actualizar/(:num)', 'Usuarios::actualizar/$1', ['filter' => 'role:admin']);
    $routes->get('usuarios/eliminar/(:num)', 'Usuarios::eliminar/$1', ['filter' => 'role:admin']);
});