<?php
// Incluye el header con navbar
echo $this->include('layouts/header');
?>

<!-- Encabezado de la página -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-gear"></i> Gestión de Usuarios</h2>
    <a href="<?= base_url('usuarios/crear') ?>" class="btn btn-success-custom">
        <i class="bi bi-plus-circle"></i> Nuevo Usuario
    </a>
</div>

<!-- Tarjeta con la tabla de usuarios -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-list-ul"></i> Lista de Usuarios del Sistema
    </div>
    <div class="card-body">
        <!-- Mensaje informativo sobre desarrollo futuro -->
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> 
            <strong>Módulo en construcción:</strong> La gestión completa de usuarios se implementará en Semana 8 (Seguridad y control de accesos)
        </div>
        
        <!-- Vista previa de estructura de tabla -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mensaje cuando no hay datos -->
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        <i class="bi bi-inbox"></i> No hay usuarios registrados
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