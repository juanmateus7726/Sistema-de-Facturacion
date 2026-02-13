<?php
// Incluye el header con navbar
echo $this->include('layouts/header');
?>

<!-- Encabezado de la página -->
<div class="mb-4">
    <h2><i class="bi bi-graph-up"></i> Reportes y Estadísticas</h2>
    <p class="text-muted">Genera reportes personalizados del sistema</p>
</div>

<!-- Tarjetas con opciones de reportes disponibles -->
<div class="row">
    <!-- Reporte de ventas -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-cart-check" style="font-size: 2.5rem; color: var(--color-exito);"></i>
                    <div class="ms-3">
                        <h5 class="card-title mb-0">Reporte de Ventas</h5>
                        <p class="text-muted small mb-0">Análisis de ventas por período</p>
                    </div>
                </div>
                <p class="card-text">Genera reportes detallados de ventas filtrados por fecha, cliente o producto.</p>
                <button class="btn btn-primary-custom" disabled>
                    <i class="bi bi-file-earmark-bar-graph"></i> Generar Reporte
                </button>
                <small class="text-muted d-block mt-2">
                    <i class="bi bi-info-circle"></i> Disponible en Semana 7
                </small>
            </div>
        </div>
    </div>
    
    <!-- Reporte de inventario -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-clipboard-data" style="font-size: 2.5rem; color: var(--color-acento);"></i>
                    <div class="ms-3">
                        <h5 class="card-title mb-0">Reporte de Inventario</h5>
                        <p class="text-muted small mb-0">Estado actual del stock</p>
                    </div>
                </div>
                <p class="card-text">Visualiza el estado del inventario, productos con stock bajo y movimientos.</p>
                <button class="btn btn-primary-custom" disabled>
                    <i class="bi bi-file-earmark-bar-graph"></i> Generar Reporte
                </button>
                <small class="text-muted d-block mt-2">
                    <i class="bi bi-info-circle"></i> Disponible en Semana 7
                </small>
            </div>
        </div>
    </div>
    
    <!-- Reporte de clientes -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-people" style="font-size: 2.5rem; color: var(--color-advertencia);"></i>
                    <div class="ms-3">
                        <h5 class="card-title mb-0">Reporte de Clientes</h5>
                        <p class="text-muted small mb-0">Análisis de clientes</p>
                    </div>
                </div>
                <p class="card-text">Consulta el historial de compras y comportamiento de clientes.</p>
                <button class="btn btn-primary-custom" disabled>
                    <i class="bi bi-file-earmark-bar-graph"></i> Generar Reporte
                </button>
                <small class="text-muted d-block mt-2">
                    <i class="bi bi-info-circle"></i> Disponible en Semana 7
                </small>
            </div>
        </div>
    </div>
    
    <!-- Reporte de compras -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-bag" style="font-size: 2.5rem; color: var(--color-secundario);"></i>
                    <div class="ms-3">
                        <h5 class="card-title mb-0">Reporte de Compras</h5>
                        <p class="text-muted small mb-0">Compras a proveedores</p>
                    </div>
                </div>
                <p class="card-text">Analiza las compras realizadas a proveedores por período.</p>
                <button class="btn btn-primary-custom" disabled>
                    <i class="bi bi-file-earmark-bar-graph"></i> Generar Reporte
                </button>
                <small class="text-muted d-block mt-2">
                    <i class="bi bi-info-circle"></i> Disponible en Semana 7
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Mensaje informativo general -->
<div class="alert alert-info mt-4">
    <i class="bi bi-info-circle"></i> 
    <strong>Módulo de Reportes:</strong> La funcionalidad completa de generación de reportes, filtros y exportación se implementará en Semana 7
</div>

<?php
// Incluye el footer
echo $this->include('layouts/footer');
?>
