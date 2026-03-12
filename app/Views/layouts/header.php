<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Facturación</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4a5568;
            --primary-dark: #2d3748;
            --primary-light: #718096;
            --secondary: #a0aec0;
            --success: #48bb78;
            --danger: #f56565;
            --warning: #ed8936;
            --info: #4299e1;
            --light: #f7fafc;
            --dark: #1a202c;
            --border: #e2e8f0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #edf2f7;
            min-height: 100vh;
            font-size: 14px;
            color: var(--dark);
        }
        
        /* Navbar Profesional */
        .navbar-modern {
            background: #2d3748;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .navbar-brand i {
            font-size: 1.5rem;
            color: #4299e1;
        }
        
        .nav-link {
            color: #cbd5e0 !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 0.375rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }
        
        .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .nav-link.active {
            color: white !important;
            background: var(--primary);
        }
        
        /* Dropdown en navbar */
        .navbar .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
        }
        
        .navbar .dropdown-item {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .navbar .dropdown-item:hover {
            background: var(--light);
        }
        
        /* Contenedor Principal */
        .main-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }
        
        /* Cards Profesionales */
        .card {
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            background: white;
            transition: all 0.2s;
            overflow: hidden;
        }
        
        .card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background: var(--primary-dark);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 600;
            font-size: 1rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Botones Profesionales */
        .btn {
            padding: 0.625rem 1.25rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .btn-success {
            background: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background: #38a169;
            transform: translateY(-1px);
        }
        
        .btn-danger {
            background: var(--danger);
            color: white;
        }
        
        .btn-danger:hover {
            background: #e53e3e;
            transform: translateY(-1px);
        }
        
        .btn-warning {
            background: var(--warning);
            color: white;
        }
        
        .btn-warning:hover {
            background: #dd6b20;
        }
        
        .btn-info {
            background: var(--info);
            color: white;
        }
        
        .btn-info:hover {
            background: #3182ce;
        }
        
        .btn-secondary {
            background: var(--light);
            color: var(--dark);
            border: 1px solid var(--border);
        }
        
        .btn-secondary:hover {
            background: #e2e8f0;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .btn-lg {
            padding: 0.875rem 1.5rem;
            font-size: 1rem;
        }
        
        /* Tablas Profesionales */
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background: #f7fafc;
            color: var(--dark);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border: none;
            padding: 1rem;
            border-bottom: 2px solid var(--border);
        }
        
        .table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: all 0.15s;
        }
        
        .table tbody tr:hover {
            background: #f7fafc;
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }
        
        /* Badges Profesionales */
        .badge {
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            font-weight: 500;
            font-size: 0.75rem;
        }
        
        .bg-primary {
            background: var(--primary) !important;
        }
        
        .bg-success {
            background: var(--success) !important;
        }
        
        .bg-danger {
            background: var(--danger) !important;
        }
        
        .bg-warning {
            background: var(--warning) !important;
        }
        
        .bg-info {
            background: var(--info) !important;
        }
        
        .bg-secondary {
            background: var(--secondary) !important;
        }
        
        /* Forms Profesionales */
        .form-control, .form-select {
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            padding: 0.625rem 0.875rem;
            transition: all 0.2s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 85, 104, 0.1);
            outline: none;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-size: 0.9rem;
        }
        
        /* Alerts Profesionales */
        .alert {
            border: 1px solid;
            border-radius: 0.375rem;
            padding: 1rem 1.25rem;
        }
        
        .alert-success {
            background: #f0fff4;
            border-color: #9ae6b4;
            color: #22543d;
        }
        
        .alert-danger {
            background: #fff5f5;
            border-color: #fc8181;
            color: #742a2a;
        }
        
        .alert-info {
            background: #ebf8ff;
            border-color: #90cdf4;
            color: #2c5282;
        }
        
        .alert-warning {
            background: #fffaf0;
            border-color: #fbd38d;
            color: #7c2d12;
        }
        
        /* Page Header */
        .page-header {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
        }
        
        .page-header h2 {
            font-weight: 700;
            color: var(--dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .page-header h2 i {
            color: var(--primary);
        }
        
        /* Stats Cards */
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border);
            transition: all 0.2s;
        }
        
        .stat-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card .stat-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            background: #edf2f7;
            color: var(--primary);
        }
        
        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }
        
        .stat-card .stat-label {
            color: #718096;
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0;
        }
        
        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0.5rem 0 0 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .breadcrumb-item a:hover {
            color: var(--primary-dark);
        }
        
        .breadcrumb-item.active {
            color: #718096;
        }
        
        /* Fix para tabs de Bootstrap */
        .nav-tabs .nav-item .nav-link {
            color: #4a5568 !important;
            font-weight: 600 !important;
            font-size: 0.95rem !important;
            padding: 0.75rem 1.25rem !important;
            border: 1px solid transparent !important;
            border-radius: 0.5rem 0.5rem 0 0 !important;
            background: transparent !important;
            transition: all 0.2s ease !important;
        }
        
        .nav-tabs .nav-item .nav-link:hover {
            color: #2d3748 !important;
            background: rgba(74, 85, 104, 0.08) !important;
            border-color: transparent !important;
        }
        
        .nav-tabs .nav-item .nav-link.active {
            color: #2d3748 !important;
            background: white !important;
            border-color: #e2e8f0 #e2e8f0 white !important;
            font-weight: 700 !important;
            border-bottom: 2px solid var(--primary) !important;
        }
        
        .nav-tabs {
            border-bottom: 2px solid #e2e8f0 !important;
            margin-bottom: 0 !important;
        }
        
        /* Colores de texto */
        .text-primary {
            color: var(--primary) !important;
        }
        
        .text-success {
            color: var(--success) !important;
        }
        
        .text-danger {
            color: var(--danger) !important;
        }
        
        .text-muted {
            color: #718096 !important;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                padding: 0 1rem;
                margin: 1rem auto;
            }
            
            .page-header {
                padding: 1.5rem;
            }
            
            .card-body {
                padding: 1rem;
            }
        }
        
        /* Print */
        @media print {
            body {
                background: white;
            }
            
            .navbar-modern, .btn, .breadcrumb {
                display: none !important;
            }
            
            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        /* ========================================
   NAVBAR MODERNO - Estilos Adicionales
======================================== */

.navbar-modern {
    background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%) !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

/* Brand Moderno */
.navbar-brand-modern {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    padding: 8px 0;
}

.brand-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(66, 153, 225, 0.3);
    transition: all 0.3s ease;
}

.brand-icon i {
    font-size: 24px;
    color: white;
}

.navbar-brand-modern:hover .brand-icon {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(66, 153, 225, 0.4);
}

.brand-text {
    display: flex;
    flex-direction: column;
}

.brand-title {
    font-size: 16px;
    font-weight: 700;
    color: white;
    line-height: 1.2;
    letter-spacing: -0.3px;
}

.brand-subtitle {
    font-size: 11px;
    font-weight: 500;
    color: #a0aec0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Nav Links Modernos */
.nav-link-modern {
    color: #cbd5e0 !important;
    font-weight: 500;
    padding: 10px 16px !important;
    border-radius: 10px;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    margin: 0 4px;
    position: relative;
}

.nav-link-modern i {
    font-size: 18px;
    transition: transform 0.2s ease;
}

.nav-link-modern:hover {
    color: white !important;
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-1px);
}

.nav-link-modern:hover i {
    transform: scale(1.1);
}

.nav-link-modern.active {
    color: white !important;
    background: rgba(66, 153, 225, 0.2);
    box-shadow: inset 0 0 0 1px rgba(66, 153, 225, 0.3);
}

.nav-link-modern.active::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 16px;
    right: 16px;
    height: 2px;
    background: #4299e1;
    border-radius: 2px 2px 0 0;
}

/* Dropdown Moderno */
.dropdown-modern {
    background: white;
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    padding: 8px;
    margin-top: 8px;
    min-width: 220px;
}

.dropdown-modern .dropdown-item {
    padding: 10px 14px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    color: #2d3748;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
}

.dropdown-modern .dropdown-item:hover {
    background: #f7fafc;
    color: #4a5568;
    transform: translateX(4px);
}

.dropdown-modern .dropdown-item i {
    font-size: 16px;
}

.dropdown-modern .dropdown-divider {
    margin: 8px 0;
    border-color: #e2e8f0;
}

.dropdown-modern .dropdown-header {
    padding: 12px 14px;
    font-size: 13px;
}

/* User Menu Moderno */
.user-menu {
    margin-left: 20px;
}

.user-dropdown-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 8px 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: white;
    font-weight: 500;
    transition: all 0.2s ease;
    cursor: pointer;
}

.user-dropdown-btn:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-1px);
}

.user-avatar {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user-avatar i {
    font-size: 20px;
    color: white;
}

.user-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    line-height: 1.3;
}

.user-name {
    font-size: 14px;
    font-weight: 600;
    color: white;
}

.user-role {
    font-size: 11px;
    font-weight: 500;
    color: #a0aec0;
    text-transform: capitalize;
}

.user-dropdown-menu {
    min-width: 240px;
}

/* Responsive */
@media (max-width: 991px) {
    .navbar-modern {
        padding: 1rem 0;
    }
    
    .nav-link-modern {
        margin: 4px 0;
    }
    
    .user-menu {
        margin-left: 0;
        margin-top: 12px;
    }
    
    .brand-subtitle {
        display: none;
    }
}
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-modern">
    <div class="container-fluid px-4">
        <a class="navbar-brand-modern" href="<?= base_url('dashboard') ?>">
            <div class="brand-icon">
                <i class="bi bi-shop"></i>
            </div>
            <div class="brand-text">
                <span class="brand-title">Sistema de Facturación</span>
                <span class="brand-subtitle">Gestión Comercial</span>
            </div>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-4">
                <?php 
                $rol = session()->get('rol');
                $current_url = uri_string();
                ?>
                
                <!-- DASHBOARD - Admin y Gerente -->
                <?php if (in_array($rol, ['admin', 'gerente'])): ?>
                <li class="nav-item">
                    <a class="nav-link-modern <?= ($current_url == 'dashboard') ? 'active' : '' ?>" 
                       href="<?= base_url('dashboard') ?>">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <!-- POS - Admin y Cajero -->
                <?php if (in_array($rol, ['admin', 'cajero'])): ?>
                <li class="nav-item">
                    <a class="nav-link-modern <?= ($current_url == 'pos') ? 'active' : '' ?>" 
                       href="<?= base_url('pos') ?>">
                        <i class="bi bi-calculator"></i>
                        <span>Punto de Venta</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <!-- VENTAS - Todos -->
                <li class="nav-item">
                    <a class="nav-link-modern <?= (strpos($current_url, 'ventas') !== false) ? 'active' : '' ?>" 
                       href="<?= base_url('ventas') ?>">
                        <i class="bi bi-receipt"></i>
                        <span>Ventas</span>
                    </a>
                </li>
                
                <!-- PRODUCTOS - Admin y Gerente -->
                <?php if (in_array($rol, ['admin', 'gerente'])): ?>
                <li class="nav-item">
                    <a class="nav-link-modern <?= (strpos($current_url, 'productos') !== false) ? 'active' : '' ?>" 
                       href="<?= base_url('productos') ?>">
                        <i class="bi bi-box-seam"></i>
                        <span>Productos</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <!-- CLIENTES - Admin y Gerente -->
                <?php if (in_array($rol, ['admin', 'gerente'])): ?>
                <li class="nav-item">
                    <a class="nav-link-modern <?= (strpos($current_url, 'clientes') !== false) ? 'active' : '' ?>" 
                       href="<?= base_url('clientes') ?>">
                        <i class="bi bi-people"></i>
                        <span>Clientes</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <!-- INVENTARIO - Admin y Gerente -->
                <?php if (in_array($rol, ['admin', 'gerente'])): ?>
                <li class="nav-item">
                    <a class="nav-link-modern <?= (strpos($current_url, 'inventario') !== false) ? 'active' : '' ?>" 
                       href="<?= base_url('inventario') ?>">
                        <i class="bi bi-boxes"></i>
                        <span>Inventario</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <!-- REPORTES - Admin y Gerente -->
                <?php if (in_array($rol, ['admin', 'gerente'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link-modern dropdown-toggle <?= (strpos($current_url, 'reportes') !== false) ? 'active' : '' ?>" 
                       href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>Reportes</span>
                    </a>
                    <ul class="dropdown-menu dropdown-modern">
                        <li>
                            <a class="dropdown-item" href="<?= base_url('reportes/ventas') ?>">
                                <i class="bi bi-graph-up me-2"></i>Reporte de Ventas
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('reportes/clientes') ?>">
                                <i class="bi bi-people me-2"></i>Top Clientes
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('reportes/inventario') ?>">
                                <i class="bi bi-box me-2"></i>Análisis de Inventario
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                
                <!-- PROVEEDORES - Admin y Gerente -->
                <?php if (in_array($rol, ['admin', 'gerente'])): ?>
                <li class="nav-item">
                    <a class="nav-link-modern <?= (strpos($current_url, 'proveedores') !== false) ? 'active' : '' ?>" 
                       href="<?= base_url('proveedores') ?>">
                        <i class="bi bi-truck"></i>
                        <span>Proveedores</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <!-- COMPRAS - Admin y Gerente -->
                <?php if (in_array($rol, ['admin', 'gerente'])): ?>
                <li class="nav-item">
                    <a class="nav-link-modern <?= (strpos($current_url, 'compras') !== false) ? 'active' : '' ?>" 
                       href="<?= base_url('compras') ?>">
                        <i class="bi bi-cart-plus"></i>
                        <span>Compras</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <!-- USUARIOS - Solo Admin -->
                <?php if ($rol === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link-modern <?= (strpos($current_url, 'usuarios') !== false) ? 'active' : '' ?>" 
                       href="<?= base_url('usuarios') ?>">
                        <i class="bi bi-person-gear"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            
            <!-- Usuario logueado -->
            <div class="user-menu">
                <div class="dropdown">
                    <button class="user-dropdown-btn" type="button" id="dropdownUser" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="user-info">
                            <span class="user-name"><?= esc(session()->get('nombre')) ?></span>
                            <span class="user-role"><?= ucfirst(session()->get('rol')) ?></span>
                        </div>
                        <i class="bi bi-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-modern user-dropdown-menu">
                        <li class="dropdown-header">
                            <div class="text-center">
                                <strong><?= esc(session()->get('nombre')) ?></strong><br>
                                <small class="text-muted">@<?= esc(session()->get('usuario')) ?></small>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Alertas globales -->
<div class="container-fluid mt-3">
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Error:</strong> <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        <?= session()->getFlashdata('warning') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
</div>

<div class="main-container">