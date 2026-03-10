<?php
echo $this->include('layouts/header');
?>

<div class="mb-4">
    <h2><i class="bi bi-clipboard-data"></i> Control de Inventario</h2>
</div>

<!-- Tarjetas con estadísticas -->
<div class="row mb-4">
    <!-- Total de productos -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-box-seam" style="font-size: 2rem; color: var(--color-acento);"></i>
                <h3 class="mt-2"><?= $totalProductos ?></h3>
                <p class="text-muted mb-0">Total Productos</p>
            </div>
        </div>
    </div>
    
    <!-- Stock bajo -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-exclamation-triangle" style="font-size: 2rem; color: var(--color-advertencia);"></i>
                <h3 class="mt-2"><?= $stockBajo ?></h3>
                <p class="text-muted mb-0">Stock Bajo</p>
            </div>
        </div>
    </div>
    
    <!-- Sin stock -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-x-circle" style="font-size: 2rem; color: var(--color-peligro);"></i>
                <h3 class="mt-2"><?= $sinStock ?></h3>
                <p class="text-muted mb-0">Sin Stock</p>
            </div>
        </div>
    </div>
</div>

<!-- Tabs como links -->
<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link active" 
            href="<?= base_url('inventario') ?>">
            <i class="bi bi-boxes"></i> Estado del Stock
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" 
            href="<?= base_url('reportes/inventario') ?>">
            <i class="bi bi-graph-up"></i> Análisis de Productos
        </a>
    </li>
</ul>

<!-- Tabla de inventario -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-list-ul"></i> Estado del Inventario
    </div>
    <div class="card-body">
        <?php if (empty($productos)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No hay productos en inventario
            </div>
        <?php else: ?>
            <div class="table-responsive">
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
                        <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><strong><?= esc($producto['codigo']) ?></strong></td>
                            <td><?= esc($producto['nombre']) ?></td>
                            <td>
                                <?php if ($producto['categoria_nombre']): ?>
                                    <span class="badge bg-secondary"><?= esc($producto['categoria_nombre']) ?></span>
                                <?php else: ?>
                                    <span class="badge bg-light text-dark">Sin categoría</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($producto['stock'] <= 0): ?>
                                    <span class="badge bg-danger"><?= $producto['stock'] ?> (Agotado)</span>
                                <?php elseif ($producto['stock'] <= $producto['stock_minimo']): ?>
                                    <span class="badge bg-warning text-dark"><?= $producto['stock'] ?> (Bajo)</span>
                                <?php else: ?>
                                    <span class="badge bg-success"><?= $producto['stock'] ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-muted"><?= $producto['stock_minimo'] ?></td>
                            <td>
                                <?php if ($producto['stock'] <= 0): ?>
                                    <i class="bi bi-x-circle-fill text-danger" title="Agotado"></i>
                                <?php elseif ($producto['stock'] <= $producto['stock_minimo']): ?>
                                    <i class="bi bi-exclamation-triangle-fill text-warning" title="Stock bajo"></i>
                                <?php else: ?>
                                    <i class="bi bi-check-circle-fill text-success" title="Stock normal"></i>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('productos/editar/'.$producto['id_producto']) ?>" 
                                   class="btn btn-sm btn-primary"
                                   title="Ajustar stock">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
echo $this->include('layouts/footer');
?>