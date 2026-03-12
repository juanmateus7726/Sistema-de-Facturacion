<?php echo $this->include('layouts/header'); ?>

<style>
    .page-header-custom {
        background: white;
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
    }
    
    .page-header-custom h2 {
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .page-header-custom h2 i {
        color: #4a5568;
        font-size: 2rem;
    }
    
    .page-header-custom p {
        color: #718096;
        margin: 0.5rem 0 0 0;
    }
    
    /* Modal Moderno */
    .modal-content {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }
    
    .modal-header {
        border-bottom: 1px solid #e2e8f0;
        padding: 1.5rem 2rem;
        border-radius: 20px 20px 0 0;
    }
    
    .modal-title {
        font-weight: 700;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .modal-title i {
        font-size: 1.5rem;
    }
    
    .modal-body {
        padding: 2rem;
    }
    
    .modal-footer {
        border-top: 1px solid #e2e8f0;
        padding: 1.5rem 2rem;
        border-radius: 0 0 20px 20px;
    }
    
    .user-info-box {
        background: #f7fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
        margin-top: 1rem;
    }
    
    .user-info-box strong {
        color: #2d3748;
        font-size: 1.1rem;
    }
    
    .user-info-box .badge {
        margin-left: 0.5rem;
    }
</style>

<div class="page-header-custom">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-person-gear"></i> Gestión de Usuarios</h2>
            <p>Administrar usuarios del sistema</p>
        </div>
        <a href="<?= base_url('usuarios/crear') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Usuario
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Último Acceso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $user): ?>
                    <tr>
                        <td><?= $user['id_usuario'] ?></td>
                        <td><?= esc($user['nombre']) ?></td>
                        <td><code><?= esc($user['usuario']) ?></code></td>
                        <td>
                            <?php 
                            $badges = [
                                'admin' => 'danger',
                                'gerente' => 'warning',
                                'cajero' => 'info'
                            ];
                            $badge = $badges[$user['rol']] ?? 'secondary';
                            ?>
                            <span class="badge bg-<?= $badge ?>">
                                <?= ucfirst($user['rol']) ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($user['estado'] == 1): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($user['ultimo_acceso']): ?>
                                <small><?= date('d/m/Y H:i', strtotime($user['ultimo_acceso'])) ?></small>
                            <?php else: ?>
                                <small class="text-muted">Nunca</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?= base_url('usuarios/editar/'.$user['id_usuario']) ?>" 
                                   class="btn btn-warning" 
                                   title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <?php if ($user['id_usuario'] != session()->get('id_usuario')): ?>
                                <button type="button"
                                        class="btn btn-danger"
                                        onclick="confirmarDesactivar(<?= $user['id_usuario'] ?>, '<?= esc($user['nombre']) ?>', '<?= $user['rol'] ?>')"
                                        title="Desactivar">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="modalDesactivar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                    Confirmar Desactivación
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">¿Está seguro de desactivar este usuario?</p>
                
                <div class="user-info-box" id="userInfoBox">
                    <!-- Se llenará dinámicamente con JavaScript -->
                </div>
                
                <div class="alert alert-warning mt-3 mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Nota:</strong> El usuario no podrá iniciar sesión hasta que sea reactivado.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancelar
                </button>
                <form id="formDesactivar" method="GET" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Sí, Desactivar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmarDesactivar(id, nombre, rol) {
    // Actualizar la información del usuario en el modal
    const rolBadges = {
        'admin': '<span class="badge bg-danger">Administrador</span>',
        'gerente': '<span class="badge bg-warning">Gerente</span>',
        'cajero': '<span class="badge bg-info">Cajero</span>'
    };
    
    document.getElementById('userInfoBox').innerHTML = `
        <div class="d-flex align-items-center gap-3">
            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-person-fill text-white" style="font-size: 1.5rem;"></i>
            </div>
            <div>
                <strong>${nombre}</strong><br>
                <small class="text-muted">ID: ${id}</small> ${rolBadges[rol] || ''}
            </div>
        </div>
    `;
    
    // Actualizar la acción del formulario
    document.getElementById('formDesactivar').action = '<?= base_url('usuarios/eliminar/') ?>' + id;
    
    // Mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('modalDesactivar'));
    modal.show();
}
</script>

<?php echo $this->include('layouts/footer'); ?>
