<?php echo $this->include('layouts/header'); ?>

<div class="mb-4">
    <h2><i class="bi bi-pencil-square"></i> Editar Usuario</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('usuarios') ?>">Usuarios</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= base_url('usuarios/actualizar/'.$usuario['id_usuario']) ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control" required 
                               value="<?= esc($usuario['nombre']) ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Usuario (login) <span class="text-danger">*</span></label>
                        <input type="text" name="usuario" class="form-control" required 
                               value="<?= esc($usuario['usuario']) ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password" class="form-control" 
                               placeholder="Dejar en blanco para no cambiar">
                        <small class="text-muted">Solo llenar si desea cambiar la contraseña</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Rol <span class="text-danger">*</span></label>
                        <select name="rol" class="form-select" required>
                            <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
                            <option value="gerente" <?= $usuario['rol'] == 'gerente' ? 'selected' : '' ?>>Gerente</option>
                            <option value="cajero" <?= $usuario['rol'] == 'cajero' ? 'selected' : '' ?>>Cajero</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="1" <?= $usuario['estado'] == 1 ? 'selected' : '' ?>>Activo</option>
                            <option value="0" <?= $usuario['estado'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Actualizar Usuario
                        </button>
                        <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $this->include('layouts/footer'); ?>