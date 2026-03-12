<?php echo $this->include('layouts/header'); ?>

<style>
    .dashboard-welcome {
        background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
        border-radius: 20px;
        padding: 3rem 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-welcome::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }
    
    .dashboard-welcome::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
    }
    
    .welcome-content {
        position: relative;
        z-index: 1;
    }
    
    .welcome-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .welcome-title i {
        font-size: 2.5rem;
        color: #4299e1;
    }
    
    .welcome-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        font-weight: 400;
    }
    
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .action-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        text-decoration: none;
        color: inherit;
        display: block;
    }
    
    .action-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        border-color: #4a5568;
    }
    
    .action-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .action-card:hover .action-icon {
        background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
        transform: scale(1.1) rotate(5deg);
    }
    
    .action-icon i {
        font-size: 2.5rem;
        color: #4a5568;
        transition: color 0.3s ease;
    }
    
    .action-card:hover .action-icon i {
        color: white;
    }
    
    .action-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }
    
    .action-description {
        font-size: 0.9rem;
        color: #718096;
        margin-bottom: 1rem;
    }
    
    .action-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #4a5568;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    
    .action-card:hover .action-link {
        color: #2d3748;
        gap: 0.75rem;
    }
    
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card-modern {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
    }
    
    .stat-card-modern:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }
    
    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    
    .stat-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .stat-icon-wrapper.primary {
        background: rgba(74, 85, 104, 0.1);
        color: #4a5568;
    }
    
    .stat-icon-wrapper.success {
        background: rgba(72, 187, 120, 0.1);
        color: #48bb78;
    }
    
    .stat-icon-wrapper.info {
        background: rgba(66, 153, 225, 0.1);
        color: #4299e1;
    }
    
    .stat-icon-wrapper.warning {
        background: rgba(237, 137, 54, 0.1);
        color: #ed8936;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.25rem;
    }
    
    .stat-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<!-- Welcome Banner -->
<div class="dashboard-welcome">
    <div class="welcome-content">
        <h1 class="welcome-title">
            <i class="bi bi-hand-wave-fill"></i>
            ¡Bienvenido, <?= esc(session()->get('nombre')) ?>!
        </h1>
        <p class="welcome-subtitle">
            <?php
            $hora = date('H');
            if ($hora < 12) {
                echo 'Buenos días';
            } elseif ($hora < 19) {
                echo 'Buenas tardes';
            } else {
                echo 'Buenas noches';
            }
            ?>, aquí está tu resumen del sistema
        </p>
    </div>
</div>

<!-- Estadísticas Rápidas -->
<?php 
$rol = session()->get('rol');
if (in_array($rol, ['admin', 'gerente'])):
?>
<div class="stats-row">
    <div class="stat-card-modern">
        <div class="stat-header">
            <div class="stat-icon-wrapper success">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
        </div>
        <div class="stat-value">$<?= number_format($ventas_hoy, 0, ',', '.') ?></div>
        <div class="stat-label">Ventas Hoy</div>
    </div>
    
    <div class="stat-card-modern">
        <div class="stat-header">
            <div class="stat-icon-wrapper primary">
                <i class="bi bi-receipt"></i>
            </div>
        </div>
        <div class="stat-value"><?= $facturas_hoy ?></div>
        <div class="stat-label">Facturas Hoy</div>
    </div>
    
    <div class="stat-card-modern">
        <div class="stat-header">
            <div class="stat-icon-wrapper info">
                <i class="bi bi-box-seam"></i>
            </div>
        </div>
        <div class="stat-value"><?= $total_productos ?></div>
        <div class="stat-label">Productos</div>
    </div>
    
    <div class="stat-card-modern">
        <div class="stat-header">
            <div class="stat-icon-wrapper warning">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
        </div>
        <div class="stat-value"><?= $stock_bajo ?></div>
        <div class="stat-label">Stock Bajo</div>
    </div>
</div>
<?php endif; ?>

<!-- Acciones Rápidas -->
<h3 class="mb-4" style="color: #2d3748; font-weight: 700;">
    <i class="bi bi-lightning-fill me-2" style="color: #4299e1;"></i>Acciones Rápidas
</h3>

<div class="quick-actions">
    
    <?php if (in_array($rol, ['admin', 'cajero'])): ?>
    <!-- POS -->
    <a href="<?= base_url('pos') ?>" class="action-card">
        <div class="action-icon">
            <i class="bi bi-calculator"></i>
        </div>
        <h4 class="action-title">Punto de Venta</h4>
        <p class="action-description">Realizar ventas y facturación rápida</p>
        <span class="action-link">
            Ir al POS <i class="bi bi-arrow-right"></i>
        </span>
    </a>
    <?php endif; ?>
    
    <!-- Ventas -->
    <a href="<?= base_url('ventas') ?>" class="action-card">
        <div class="action-icon">
            <i class="bi bi-receipt"></i>
        </div>
        <h4 class="action-title">Ventas</h4>
        <p class="action-description">Ver historial y detalles de ventas</p>
        <span class="action-link">
            Ver ventas <i class="bi bi-arrow-right"></i>
        </span>
    </a>
    
    <?php if (in_array($rol, ['admin', 'gerente'])): ?>
    <!-- Productos -->
    <a href="<?= base_url('productos') ?>" class="action-card">
        <div class="action-icon">
            <i class="bi bi-box-seam"></i>
        </div>
        <h4 class="action-title">Productos</h4>
        <p class="action-description">Gestionar catálogo de productos</p>
        <span class="action-link">
            Gestionar <i class="bi bi-arrow-right"></i>
        </span>
    </a>
    
    <!-- Clientes -->
    <a href="<?= base_url('clientes') ?>" class="action-card">
        <div class="action-icon">
            <i class="bi bi-people"></i>
        </div>
        <h4 class="action-title">Clientes</h4>
        <p class="action-description">Administrar base de clientes</p>
        <span class="action-link">
            Ver clientes <i class="bi bi-arrow-right"></i>
        </span>
    </a>
    
    <!-- Inventario -->
    <a href="<?= base_url('inventario') ?>" class="action-card">
        <div class="action-icon">
            <i class="bi bi-boxes"></i>
        </div>
        <h4 class="action-title">Inventario</h4>
        <p class="action-description">Control de stock y alertas</p>
        <span class="action-link">
            Ver inventario <i class="bi bi-arrow-right"></i>
        </span>
    </a>
    
    <!-- Reportes -->
    <a href="<?= base_url('reportes/ventas') ?>" class="action-card">
        <div class="action-icon">
            <i class="bi bi-graph-up-arrow"></i>
        </div>
        <h4 class="action-title">Reportes</h4>
        <p class="action-description">Análisis y estadísticas de ventas</p>
        <span class="action-link">
            Ver reportes <i class="bi bi-arrow-right"></i>
        </span>
    </a>
    <?php endif; ?>
    
</div>

<?php echo $this->include('layouts/footer'); ?>