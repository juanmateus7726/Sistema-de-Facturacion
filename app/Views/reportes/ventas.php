<?php
echo $this->include('layouts/header');
?>

<div class="page-header">
    <h2><i class="bi bi-cash-coin"></i> Reporte de Ventas</h2>
</div>

<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('ventas') ?>">
            <i class="bi bi-list-ul"></i> Historial
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('reportes/ventas') ?>">
            <i class="bi bi-graph-up"></i> Reportes
        </a>
    </li>
</ul>

<!-- Filtros -->
<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-funnel"></i> Filtros
    </div>
    <div class="card-body">
        <form method="GET" action="<?= base_url('reportes/ventas') ?>">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" 
                           value="<?= $filtros['fecha_inicio'] ?>">
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" name="fecha_fin" 
                           value="<?= $filtros['fecha_fin'] ?>">
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Cliente</label>
                    <select class="form-select" name="id_cliente">
                        <option value="">Todos</option>
                        <?php foreach($clientes as $cliente): ?>
                            <option value="<?= $cliente['id_cliente'] ?>" 
                                    <?= $filtros['id_cliente'] == $cliente['id_cliente'] ? 'selected' : '' ?>>
                                <?= esc($cliente['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Método de Pago</label>
                    <select class="form-select" name="metodo_pago">
                        <option value="">Todos</option>
                        <option value="efectivo" <?= $filtros['metodo_pago'] == 'efectivo' ? 'selected' : '' ?>>Efectivo</option>
                        <option value="tarjeta" <?= $filtros['metodo_pago'] == 'tarjeta' ? 'selected' : '' ?>>Tarjeta</option>
                        <option value="transferencia" <?= $filtros['metodo_pago'] == 'transferencia' ? 'selected' : '' ?>>Transferencia</option>
                        <option value="mixto" <?= $filtros['metodo_pago'] == 'mixto' ? 'selected' : '' ?>>Mixto</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Buscar
                </button>
                <a href="<?= base_url('reportes/ventas') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Limpiar
                </a>
                <button type="button" onclick="window.print()" class="btn btn-info ms-auto">
                    <i class="bi bi-printer"></i> Imprimir
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Estadísticas -->
<div class="row mb-4">
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-receipt"></i>
            </div>
            <div class="stat-value"><?= $estadisticas['total_ventas'] ?></div>
            <div class="stat-label">Total Ventas</div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-icon" style="background: #f0fff4; color: #48bb78;">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div class="stat-value" style="color: #48bb78;">
                $<?= number_format($estadisticas['monto_total'], 0, ',', '.') ?>
            </div>
            <div class="stat-label">Monto Total</div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-value">$<?= number_format($estadisticas['total_efectivo'], 0, ',', '.') ?></div>
            <div class="stat-label">Efectivo</div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-value">$<?= number_format($estadisticas['total_tarjeta'], 0, ',', '.') ?></div>
            <div class="stat-label">Tarjeta</div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-value">$<?= number_format($estadisticas['total_transferencia'], 0, ',', '.') ?></div>
            <div class="stat-label">Transferencia</div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-value">$<?= number_format($estadisticas['total_mixto'], 0, ',', '.') ?></div>
            <div class="stat-label">Mixto</div>
        </div>
    </div>
</div>

<!-- Tabla de ventas -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-table"></i> Detalle de Ventas
    </div>
    <div class="card-body">
        <?php if (empty($ventas)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No hay ventas para mostrar
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Factura</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Cajero</th>
                            <th>Método</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ventas as $venta): ?>
                        <tr>
                            <td><strong><?= esc($venta['numero_factura']) ?></strong></td>
                            <td><?= date('d/m/Y H:i', strtotime($venta['fecha_hora'])) ?></td>
                            <td><?= esc($venta['cliente_nombre']) ?></td>
                            <td><?= esc($venta['cajero_nombre']) ?></td>
                            <td>
                                <span class="badge bg-<?= 
                                    $venta['metodo_pago'] == 'efectivo' ? 'success' : 
                                    ($venta['metodo_pago'] == 'tarjeta' ? 'primary' : 
                                    ($venta['metodo_pago'] == 'transferencia' ? 'info' : 'warning')) 
                                ?>">
                                    <?= ucfirst($venta['metodo_pago']) ?>
                                </span>
                            </td>
                            <td class="text-end"><strong>$<?= number_format($venta['total'], 0, ',', '.') ?></strong></td>
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