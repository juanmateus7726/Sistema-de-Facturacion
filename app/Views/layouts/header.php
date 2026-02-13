<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Sistema de Facturación' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Estilos personalizados -->
    <style>
        /* Paleta de colores del sistema */
        :root {
            --color-primario: #2C3E50;      /* Gris oscuro para navbar */
            --color-secundario: #34495E;    /* Gris azulado */
            --color-acento: #3498DB;        /* Azul para botones */
            --color-exito: #27AE60;         /* Verde para crear/guardar */
            --color-peligro: #E74C3C;       /* Rojo para eliminar */
            --color-advertencia: #F39C12;   /* Naranja para advertencias */
            --color-fondo: #ECF0F1;         /* Gris claro para fondo */
            --color-texto: #2C3E50;         /* Gris oscuro para texto */
        }

        /* Aplicar color de fondo a todo el body */
        body {
            background-color: var(--color-fondo);
            color: var(--color-texto);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar personalizado con color primario */
        .navbar-custom {
            background-color: var(--color-primario) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Enlaces del navbar en blanco */
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        /* Efecto hover en enlaces del navbar */
        .navbar-custom .nav-link:hover {
            opacity: 0.8;
        }

        /* Enlace activo en el navbar */
        .navbar-custom .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        /* Contenedor principal con margen superior */
        .main-container {
            margin-top: 20px;
            margin-bottom: 40px;
        }

        /* Tarjetas con sombra suave */
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        /* Encabezado de tarjetas */
        .card-header {
            background-color: #ffffff;
            border-bottom: 2px solid var(--color-primario);
            font-weight: 600;
        }

        /* Botones personalizados con colores de la paleta */
        .btn-primary-custom {
            background-color: var(--color-acento);
            border-color: var(--color-acento);
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #2980B9;
            border-color: #2980B9;
        }

        .btn-success-custom {
            background-color: var(--color-exito);
            border-color: var(--color-exito);
            color: white;
        }

        .btn-success-custom:hover {
            background-color: #229954;
            border-color: #229954;
        }

        /* Tablas con diseño limpio */
        .table {
            background-color: white;
        }

        .table thead {
            background-color: var(--color-primario);
            color: white;
        }

        /* Filas de tabla con hover */
        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar principal del sistema -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <!-- Logo/Nombre del sistema -->
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="bi bi-shop"></i> Sistema de Facturación
            </a>
            
            <!-- Botón hamburguesa para móvil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pos') ?>">
                            <i class="bi bi-calculator"></i> Punto de Ventas
                        </a>
                    </li>
                    
                    <!-- Productos -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('productos') ?>">
                            <i class="bi bi-box-seam"></i> Productos
                        </a>
                    </li>
                    
                    <!-- Ventas -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('ventas') ?>">
                            <i class="bi bi-cart-check"></i> Historial de Ventas
                        </a>
                    </li>
                    
                    <!-- Clientes -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('clientes') ?>">
                            <i class="bi bi-people"></i> Clientes
                        </a>
                    </li>
                    
                    <!-- Proveedores -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('proveedores') ?>">
                            <i class="bi bi-truck"></i> Proveedores
                        </a>
                    </li>
                    
                    <!-- Compras -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('compras') ?>">
                            <i class="bi bi-bag"></i> Compras
                        </a>
                    </li>
                    
                    <!-- Inventario -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('inventario') ?>">
                            <i class="bi bi-clipboard-data"></i> Inventario
                        </a>
                    </li>
                    
                    <!-- Reportes -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('reportes') ?>">
                            <i class="bi bi-graph-up"></i> Reportes
                        </a>
                    </li>
                    
                    <!-- Usuarios -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('usuarios') ?>">
                            <i class="bi bi-person-gear"></i> Usuarios
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal donde va el contenido de cada página -->
    <div class="container main-container"></div>