<?php
echo $this->include('layouts/header');

// Detectar qué tab está activo
$currentTab = uri_string() == 'inventario' ? 'stock' : 'analisis';
?>

<div class="page-header">
    <h2><i class="bi bi-clipboard-data"></i> Top Productos</h2>
</div>

<!-- Tabs como links -->
<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link <?= $currentTab == 'stock' ? 'active' : '' ?>" 
           href="<?= base_url('inventario') ?>">
            <i class="bi bi-boxes"></i> Estado del Stock
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $currentTab == 'analisis' ? 'active' : '' ?>" 
           href="<?= base_url('reportes/inventario') ?>">
            <i class="bi bi-graph-up"></i> Análisis de Productos
        </a>
    </li>
</ul>

<!-- Filtros -->
<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-funnel"></i> Filtros
    </div>
    <div class="card-body">
        <form method="GET" action="<?= base_url('reportes/inventario') ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Mes a analizar</label>
                    <input type="month" class="form-control" name="mes" 
                           value="<?= $filtros['mes'] ?>">
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">Tipo de análisis</label>
                    <select class="form-select" name="tipo">
                        <option value="mas_vendidos" <?= $filtros['tipo'] == 'mas_vendidos' ? 'selected' : '' ?>>
                            Más vendidos
                        </option>
                        <option value="menos_vendidos" <?= $filtros['tipo'] == 'menos_vendidos' ? 'selected' : '' ?>>
                            Menos vendidos
                        </option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-50">
                            <i class="bi bi-search"></i> Analizar
                        </button>
                        <button type="button" onclick="window.print()" class="btn btn-info w-50">
                            <i class="bi bi-printer"></i> Imprimir
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Estadísticas del período -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(72, 187, 120, 0.1); color: #48bb78;">
                <i class="bi bi-cart-check"></i>
            </div>
            <div class="stat-value"><?= $stats['total_ventas_periodo'] ?></div>
            <div class="stat-label">
                Ventas <?= !empty($filtros['mes']) ? 'en el período' : 'totales' ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(245, 101, 101, 0.1); color: #f56565;">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div class="stat-value"><?= $stats['productos_sin_movimiento'] ?></div>
            <div class="stat-label">
                Productos sin movimiento <?= !empty($filtros['mes']) ? 'en el período' : '' ?>
            </div>
        </div>
    </div>
</div>

<!-- Tabla de productos -->
<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-graph-up"></i> 
        Top 20 Productos <?= $filtros['tipo'] == 'mas_vendidos' ? 'Más Vendidos' : 'Menos Vendidos' ?>
        <?php if (!empty($filtros['mes'])): ?>
            - <?= date('F Y', strtotime($filtros['mes'] . '-01')) ?>
        <?php else: ?>
            - Histórico General
        <?php endif; ?>
    </div>
    <div class="card-body">
        <?php if (empty($productos)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No hay ventas en el período seleccionado
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th class="text-center">Unidades Vendidas</th>
                            <th class="text-center">Nº Ventas</th>
                            <th class="text-end">Ingresos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $pos = 1;
                        foreach($productos as $prod): 
                        ?>
                        <tr>
                            <td>
                                <?php if ($filtros['tipo'] == 'mas_vendidos' && $pos <= 3): ?>
                                    <i class="bi bi-trophy-fill" style="color: <?= $pos == 1 ? '#ffd700' : ($pos == 2 ? '#c0c0c0' : '#cd7f32') ?>;"></i>
                                <?php endif; ?>
                                <?= $pos ?>
                            </td>
                            <td><strong><?= esc($prod['codigo']) ?></strong></td>
                            <td><?= esc($prod['nombre']) ?></td>
                            <td>
                                <span class="badge bg-secondary"><?= esc($prod['categoria_nombre'] ?? 'Sin categoría') ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary"><?= number_format($prod['total_vendido']) ?></span>
                            </td>
                            <td class="text-center"><?= $prod['num_ventas'] ?></td>
                            <td class="text-end">
                                <strong style="color: #48bb78;">$<?= number_format($prod['ingresos_generados'], 0, ',', '.') ?></strong>
                            </td>
                        </tr>
                        <?php 
                        $pos++;
                        endforeach; 
                        ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Productos sin movimiento -->
<?php if (!empty($productos_sin_ventas)): ?>
<div class="card">
    <div class="card-header" style="background: #f56565;">
        <i class="bi bi-exclamation-triangle"></i> Productos Sin Ventas
    </div>
    <div class="card-body">
        <div class="alert alert-warning">
            <i class="bi bi-info-circle"></i> 
            Considera hacer promociones o ajustar el stock de estos productos.
        </div>
        
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($productos_sin_ventas as $prod): ?>
                    <tr>
                        <td><strong><?= esc($prod['codigo']) ?></strong></td>
                        <td><?= esc($prod['nombre']) ?></td>
                        <td><span class="badge bg-warning"><?= $prod['stock'] ?></span></td>
                        <td>
                            <a href="<?= base_url('productos/editar/'.$prod['id_producto']) ?>" 
                               class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
echo $this->include('layouts/footer');
?>