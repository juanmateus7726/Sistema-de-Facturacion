<?php
// Incluye el header con navbar
echo $this->include('layouts/header');
?>

<!-- Encabezado de la página -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-bag"></i> Gestión de Compras</h2>
    <a href="<?= base_url('compras/crear') ?>" class="btn btn-success-custom">
        <i class="bi bi-plus-circle"></i> Nueva Compra
    </a>
</div>

<!-- Tarjeta con el historial de compras -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-clock-history"></i> Historial de Compras
    </div>
    <div class="card-body">
        <!-- Mensaje informativo sobre desarrollo futuro -->
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> 
            <strong>Módulo en construcción:</strong> La funcionalidad completa se implementará en semanas posteriores
        </div>
        
        <!-- Vista previa de estructura de tabla -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>N° Compra</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mensaje cuando no hay datos -->
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        <i class="bi bi-inbox"></i> No hay compras registradas
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