<?php
echo $this->include('layouts/header');

// Detectar qué tab está activo
$currentTab = uri_string() == 'ventas' ? 'historial' : 'reportes';
?>

<div class="page-header">
    <h2><i class="bi bi-clock-history"></i> Ventas</h2>
</div>

<!-- Tabs como links -->
<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link <?= $currentTab == 'historial' ? 'active' : '' ?>" 
           href="<?= base_url('ventas') ?>">
            <i class="bi bi-list-ul"></i> Historial
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $currentTab == 'reportes' ? 'active' : '' ?>" 
           href="<?= base_url('reportes/ventas') ?>">
            <i class="bi bi-graph-up"></i> Reportes
        </a>
    </li>
</ul>

<!-- Contenido: Historial de Ventas -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-clock-history"></i> Historial de Ventas
    </div>
    <div class="card-body">
        <?php if (empty($ventas)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No hay ventas registradas
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>N° Factura</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Cajero</th>
                            <th>Total</th>
                            <th>Método Pago</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ventas as $venta): ?>
                        <tr>
                            <td><strong><?= esc($venta['numero_factura']) ?></strong></td>
                            <td><?= date('d/m/Y H:i', strtotime($venta['fecha_hora'])) ?></td>
                            <td><?= esc($venta['cliente_nombre'] ?? 'N/A') ?></td>
                            <td><?= esc($venta['cajero_nombre'] ?? 'N/A') ?></td>
                            <td><strong>$<?= number_format($venta['total'], 0, ',', '.') ?></strong></td>
                            <td>
                                <?php 
                                $badges = [
                                    'efectivo' => 'success',
                                    'tarjeta' => 'primary',
                                    'transferencia' => 'info',
                                    'mixto' => 'warning'
                                ];
                                $badge = $badges[$venta['metodo_pago']] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?= $badge ?>">
                                    <?= ucfirst($venta['metodo_pago']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($venta['estado'] == 1): ?>
                                    <span class="badge bg-success">Completada</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Anulada</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('ventas/detalle/'.$venta['id_venta']) ?>" 
                                   class="btn btn-sm btn-info"
                                   title="Ver detalle">
                                    <i class="bi bi-eye"></i>
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