<?php
echo $this->include('layouts/header');
?>

<div class="mb-4">
    <h2><i class="bi bi-pencil"></i> Editar Cliente</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('clientes') ?>">Clientes</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </nav>
</div>

<!-- Errores de validación -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5><i class="bi bi-exclamation-triangle"></i> Errores de validación:</h5>
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <i class="bi bi-file-earmark-text"></i> Datos del Cliente
    </div>
    <div class="card-body">
        <form action="<?= base_url('clientes/actualizar/'.$cliente['id_cliente']) ?>" method="POST">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="documento" class="form-label">Documento de Identidad <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control" 
                           id="documento" 
                           name="documento" 
                           value="<?= old('documento', $cliente['documento']) ?>"
                           required>
                    <small class="text-muted">Cédula, NIT o documento de identificación</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control" 
                           id="nombre" 
                           name="nombre" 
                           value="<?= old('nombre', $cliente['nombre']) ?>"
                           required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" 
                           class="form-control" 
                           id="telefono" 
                           name="telefono" 
                           value="<?= old('telefono', $cliente['telefono']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="correo" class="form-label">Email</label>
                    <input type="email" 
                           class="form-control" 
                           id="correo" 
                           name="correo" 
                           value="<?= old('correo', $cliente['correo']) ?>">
                </div>
            </div>
            
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" 
                       class="form-control" 
                       id="direccion" 
                       name="direccion" 
                       value="<?= old('direccion', $cliente['direccion']) ?>">
            </div>
            
            <hr>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Guardar Cambios
                </button>
                <a href="<?= base_url('clientes') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
            </div>
            
        </form>
    </div>
</div>

<?php
echo $this->include('layouts/footer');
?>