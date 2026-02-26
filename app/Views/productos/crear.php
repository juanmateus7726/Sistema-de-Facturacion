<?php
// Incluye el header
echo $this->include('layouts/header');
?>

<!-- Encabezado de la página -->
<div class="mb-4">
    <h2><i class="bi bi-plus-circle"></i> Nuevo Producto</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('productos') ?>">Productos</a></li>
            <li class="breadcrumb-item active">Nuevo</li>
        </ol>
    </nav>
</div>

<!-- Mostrar errores de validación -->
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

<!-- Formulario de crear producto -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-file-earmark-text"></i> Datos del Producto
    </div>
    <div class="card-body">
        <form action="<?= base_url('productos/guardar') ?>" method="POST">
            
            <div class="row">
                <!-- Código del producto -->
                <div class="col-md-6 mb-3">
                    <label for="codigo" class="form-label">Código <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control" 
                           id="codigo" 
                           name="codigo" 
                           placeholder="Ej: 7501234567890"
                           value="<?= old('codigo') ?>"
                           required>
                    <small class="text-muted">Código de barras o código interno del producto</small>
                </div>
                
                <!-- Nombre del producto -->
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control" 
                           id="nombre" 
                           name="nombre" 
                           placeholder="Ej: Coca Cola 500ml"
                           value="<?= old('nombre') ?>"
                           required>
                </div>
            </div>
            
            <div class="row">
                <!-- Categoría -->
                <div class="col-md-6 mb-3">
                    <label for="id_categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                    <select class="form-select" id="id_categoria" name="id_categoria" required>
                        <option value="">Seleccionar categoría...</option>
                        <?php foreach($categorias as $categoria): ?>
                            <option value="<?= $categoria['id_categoria'] ?>" 
                                    <?= old('id_categoria') == $categoria['id_categoria'] ? 'selected' : '' ?>>
                                <?= esc($categoria['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Precio de venta -->
                <div class="col-md-3 mb-3">
                    <label for="precio" class="form-label">Precio de Venta <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" 
                               class="form-control" 
                               id="precio" 
                               name="precio" 
                               placeholder="0"
                               step="0.01"
                               min="0"
                               value="<?= old('precio') ?>"
                               required>
                    </div>
                </div>
                
                <!-- Precio de compra -->
                <div class="col-md-3 mb-3">
                    <label for="precio_compra" class="form-label">Precio de Compra <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" 
                               class="form-control" 
                               id="precio_compra" 
                               name="precio_compra" 
                               placeholder="0"
                               step="0.01"
                               min="0"
                               value="<?= old('precio_compra') ?>"
                               required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Stock actual -->
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">Stock Actual <span class="text-danger">*</span></label>
                    <input type="number" 
                           class="form-control" 
                           id="stock" 
                           name="stock" 
                           placeholder="0"
                           min="0"
                           value="<?= old('stock', 0) ?>"
                           required>
                    <small class="text-muted">Cantidad disponible en inventario</small>
                </div>
                
                <!-- Stock mínimo -->
                <div class="col-md-6 mb-3">
                    <label for="stock_minimo" class="form-label">Stock Mínimo <span class="text-danger">*</span></label>
                    <input type="number" 
                           class="form-control" 
                           id="stock_minimo" 
                           name="stock_minimo" 
                           placeholder="0"
                           min="0"
                           value="<?= old('stock_minimo', 5) ?>"
                           required>
                    <small class="text-muted">Alerta cuando el stock baje de este nivel</small>
                </div>
            </div>
            
            <hr>
            
            <!-- Botones -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Guardar Producto
                </button>
                <a href="<?= base_url('productos') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
            </div>
            
        </form>
    </div>
</div>

<?php
// Incluye el footer
echo $this->include('layouts/footer');
?>