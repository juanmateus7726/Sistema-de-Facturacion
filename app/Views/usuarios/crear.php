<?php echo $this->include('layouts/header'); ?>

<div class="mb-4">
    <h2><i class="bi bi-person-plus"></i> Crear Nuevo Usuario</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('usuarios') ?>">Usuarios</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= base_url('usuarios/guardar') ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control" required 
                               value="<?= old('nombre') ?>"
                               placeholder="Ej: Juan Pérez">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Usuario (login) <span class="text-danger">*</span></label>
                        <input type="text" name="usuario" class="form-control" required 
                               value="<?= old('usuario') ?>"
                               placeholder="Ej: jperez">
                        <small class="text-muted">Sin espacios, solo letras y números</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Contraseña <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required 
                               placeholder="Mínimo 6 caracteres">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Rol <span class="text-danger">*</span></label>
                        <select name="rol" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <option value="admin" <?= old('rol') == 'admin' ? 'selected' : '' ?>>Administrador</option>
                            <option value="gerente" <?= old('rol') == 'gerente' ? 'selected' : '' ?>>Gerente</option>
                            <option value="cajero" <?= old('rol') == 'cajero' ? 'selected' : '' ?>>Cajero</option>
                        </select>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Guardar Usuario
                        </button>
                        <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-info-circle"></i> Información de Roles</h5>
                
                <div class="mb-3">
                    <strong class="text-danger">👑 Administrador</strong>
                    <p class="mb-0 small">Acceso completo al sistema. Puede gestionar usuarios.</p>
                </div>
                
                <div class="mb-3">
                    <strong class="text-warning">📊 Gerente</strong>
                    <p class="mb-0 small">Acceso a reportes, inventario, productos y clientes.</p>
                </div>
                
                <div>
                    <strong class="text-info">💵 Cajero</strong>
                    <p class="mb-0 small">Solo acceso al POS y ventas.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->include('layouts/footer'); ?>