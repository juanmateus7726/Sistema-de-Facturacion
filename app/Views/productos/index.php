<?php
// Incluye el header
echo $this->include('layouts/header');
?>

<!-- Encabezado de la página -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-box-seam"></i> Gestión de Productos</h2>
    <a href="<?= base_url('productos/crear') ?>" class="btn btn-success-custom">
        <i class="bi bi-plus-circle"></i> Nuevo Producto
    </a>
</div>

<!-- Mensajes de éxito o error -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Tarjeta con la tabla de productos -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-list-ul"></i> Lista de Productos
    </div>
    <div class="card-body">
        <?php if (empty($productos)): ?>
            <!-- Si no hay productos -->
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> 
                No hay productos registrados. <a href="<?= base_url('productos/crear') ?>">Crear el primero</a>
            </div>
        <?php else: ?>
            <!-- Tabla de productos -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio Venta</th>
                            <th>Precio Compra</th>
                            <th>Stock</th>
                            <th>Stock Mín.</th>
                            <th>Estado</th>
                            <th width="180">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($productos as $producto): ?>
                        <tr>
                            <!-- Código del producto -->
                            <td><strong><?= esc($producto['codigo']) ?></strong></td>
                            
                            <!-- Nombre del producto -->
                            <td><?= esc($producto['nombre']) ?></td>
                            
                            <!-- Categoría -->
                            <td>
                                <?php if ($producto['categoria_nombre']): ?>
                                    <span class="badge bg-secondary"><?= esc($producto['categoria_nombre']) ?></span>
                                <?php else: ?>
                                    <span class="badge bg-light text-dark">Sin categoría</span>
                                <?php endif; ?>
                            </td>
                            
                            <!-- Precio de venta -->
                            <td>$<?= number_format($producto['precio'], 0, ',', '.') ?></td>
                            
                            <!-- Precio de compra -->
                            <td class="text-muted">$<?= number_format($producto['precio_compra'], 0, ',', '.') ?></td>
                            
                            <!-- Stock con alerta si está bajo -->
                            <td>
                                <?php if ($producto['stock'] <= 0): ?>
                                    <span class="badge bg-danger"><?= $producto['stock'] ?> (Agotado)</span>
                                <?php elseif ($producto['stock'] <= $producto['stock_minimo']): ?>
                                    <span class="badge bg-warning text-dark"><?= $producto['stock'] ?> (Bajo)</span>
                                <?php else: ?>
                                    <span class="badge bg-success"><?= $producto['stock'] ?></span>
                                <?php endif; ?>
                            </td>
                            
                            <!-- Stock mínimo -->
                            <td class="text-muted"><?= $producto['stock_minimo'] ?></td>
                            
                            <!-- Estado -->
                            <td>
                                <?php if ($producto['estado'] == 1): ?>
                                    <span class="badge bg-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            
                            <!-- Botones de acción -->
                            <td>
                                <!-- Botón Editar -->
                                <a href="<?= base_url('productos/editar/'.$producto['id_producto']) ?>" 
                                   class="btn btn-sm btn-primary" 
                                   title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <!-- Botón Eliminar -->
                                <a href="<?= base_url('productos/eliminar/'.$producto['id_producto']) ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('¿Está seguro de eliminar este producto?\n\nNota: El producto se desactivará pero se mantendrá en el historial de ventas.')"
                                   title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Información adicional -->
            <div class="mt-3">
                <small class="text-muted">
                    <i class="bi bi-info-circle"></i> 
                    Total de productos: <strong><?= count($productos) ?></strong>
                </small>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
// Incluye el footer
echo $this->include('layouts/footer');
?>