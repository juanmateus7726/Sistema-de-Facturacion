<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Facturación</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
</style>

</head>
<body>
    <!-- Navbar Moderna -->
    <nav class="navbar navbar-expand-lg navbar-modern sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('dashboard') ?>">
                <i class="bi bi-receipt-cutoff"></i>
                <span>Sistema de Facturación</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard') ?>">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('pos') ?>">
                <i class="bi bi-calculator"></i> Punto de Venta
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('productos') ?>">
                <i class="bi bi-box-seam"></i> Productos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('clientes') ?>">
                <i class="bi bi-people"></i> Clientes
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('inventario') ?>">
                <i class="bi bi-boxes"></i> Inventario
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('ventas') ?>">
                <i class="bi bi-clock-history"></i> Ventas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('usuarios') ?>">
                <i class="bi bi-person-badge"></i> Usuarios
            </a>
        </li>
    </ul>
</div>
    </nav>
    
    <!-- Contenedor Principal -->
    <div class="main-container">