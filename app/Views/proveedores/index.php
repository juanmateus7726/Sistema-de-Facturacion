<?php
// Incluye el header con navbar
echo $this->include('layouts/header');
?>

<!-- Encabezado de la página -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-truck"></i> Gestión de Proveedores</h2>
    <a href="<?= base_url('proveedores/crear') ?>" class="btn btn-success-custom">
        <i class="bi bi-plus-circle"></i> Nuevo Proveedor
    </a>
</div>

<!-- Tarjeta con la tabla de proveedores -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-list-ul"></i> Lista de Proveedores
    </div>
    <div class="card-body">
        <!-- Mensaje informativo sobre desarrollo futuro -->
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> 
            <strong>Módulo en construcción:</strong> La funcionalidad completa CRUD se implementará en Semana 6
        </div>
        
        <!-- Vista previa de estructura de tabla -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>RUT/NIT</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mensaje cuando no hay datos -->
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        <i class="bi bi-inbox"></i> No hay proveedores registrados
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