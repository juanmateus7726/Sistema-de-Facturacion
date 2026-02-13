<?php
// Incluye el header con navbar
echo $this->include('layouts/header');
?>

<!-- Encabezado de la página -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clipboard-data"></i> Control de Inventario</h2>
    <a href="<?= base_url('inventario/ajustar') ?>" class="btn btn-success-custom">
        <i class="bi bi-pencil-square"></i> Ajustar Stock
    </a>
</div>

<!-- Tarjetas con estadísticas rápidas -->
<div class="row mb-4">
    <!-- Total de productos -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-box-seam" style="font-size: 2rem; color: var(--color-acento);"></i>
                <h3 class="mt-2">0</h3>
                <p class="text-muted mb-0">Total Productos</p>
            </div>
        </div>
    </div>
    
    <!-- Stock bajo -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-exclamation-triangle" style="font-size: 2rem; color: var(--color-advertencia);"></i>
                <h3 class="mt-2">0</h3>
                <p class="text-muted mb-0">Stock Bajo</p>
            </div>
        </div>
    </div>
    
    <!-- Sin stock -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-x-circle" style="font-size: 2rem; color: var(--color-peligro);"></i>
                <h3 class="mt-2">0</h3>
                <p class="text-muted mb-0">Sin Stock</p>
            </div>
        </div>
    </div>
</div>

<!-- Tarjeta con tabla de inventario -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-list-ul"></i> Estado del Inventario
    </div>
    <div class="card-body">
        <!-- Mensaje informativo sobre desarrollo futuro -->
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> 
            <strong>Módulo en construcción:</strong> El control de inventario se desarrollará junto con el módulo de productos en Semana 6
        </div>
        
        <!-- Vista previa de estructura de tabla -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Stock Actual</th>
                    <th>Stock Mínimo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mensaje cuando no hay datos -->
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        <i class="bi bi-inbox"></i> No hay productos en inventario
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
// Incluye el footer
echo $this->include('layouts/footer');
?>