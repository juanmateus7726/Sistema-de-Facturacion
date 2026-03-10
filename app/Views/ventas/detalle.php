<?php
echo $this->include('layouts/header');
?>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-receipt"></i> Detalle de Venta</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('ventas') ?>">Ventas</a></li>
                    <li class="breadcrumb-item active">Detalle</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?= base_url('ventas') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Columna izquierda: Info de la venta -->
    <div class="col-lg-8">
        <!-- Card de información -->
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-file-text"></i> Factura: <strong><?= $venta['numero_factura'] ?></strong></span>
                    <?php if ($venta['estado'] == 1): ?>
                        <span class="badge bg-success" style="font-size: 0.9rem;">
                            <i class="bi bi-check-circle"></i> Completada
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger" style="font-size: 0.9rem;">
                            <i class="bi bi-x-circle"></i> Anulada
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-2">
                            <strong><i class="bi bi-calendar"></i> Fecha:</strong><br>
                            <?= date('d/m/Y - H:i:s', strtotime($venta['fecha_hora'])) ?>
                        </p>
                        <p class="mb-2">
                            <strong><i class="bi bi-person"></i> Cliente:</strong><br>
                            <?= esc($venta['cliente_nombre']) ?><br>
                            <small class="text-muted">Doc: <?= esc($venta['documento']) ?></small>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2">
                            <strong><i class="bi bi-person-badge"></i> Cajero:</strong><br>
                            <?= esc($venta['cajero_nombre']) ?>
                        </p>
                        <p class="mb-2">
                            <strong><i class="bi bi-credit-card"></i> Método de pago:</strong><br>
                            <?php 
                            $badges = [
                                'efectivo' => 'success',
                                'tarjeta' => 'primary',
                                'transferencia' => 'info',
                                'mixto' => 'warning'
                            ];
                            $badge = $badges[$venta['metodo_pago']] ?? 'secondary';
                            ?>
                            <span class="badge bg-<?= $badge ?>" style="font-size: 0.9rem; padding: 0.5rem 0.75rem;">
                                <?= ucfirst($venta['metodo_pago']) ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card de productos -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-cart"></i> Productos Vendidos
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio Unit.</th>
                                <th class="text-end">Descuento</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($productos as $prod): ?>
                            <tr>
                                <td><strong><?= esc($prod['codigo']) ?></strong></td>
                                <td><?= esc($prod['producto_nombre']) ?></td>
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $prod['cantidad'] ?></span>
                                </td>
                                <td class="text-end">$<?= number_format($prod['precio_unitario'], 0, ',', '.') ?></td>
                                <td class="text-end">$<?= number_format($prod['descuento_aplicado'], 0, ',', '.') ?></td>
                                <td class="text-end"><strong>$<?= number_format($prod['subtotal_linea'], 0, ',', '.') ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Columna derecha: Resumen y acciones -->
    <div class="col-lg-4">
        <!-- Card de resumen -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="bi bi-calculator"></i> Resumen
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal:</span>
                    <strong>$<?= number_format($venta['subtotal'], 0, ',', '.') ?></strong>
                </div>
                
                <?php if ($venta['descuento_total'] > 0): ?>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Descuento:</span>
                    <strong class="text-danger">-$<?= number_format($venta['descuento_total'], 0, ',', '.') ?></strong>
                </div>
                <?php endif; ?>
                
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">IVA (19%):</span>
                    <strong>$<?= number_format($venta['iva'], 0, ',', '.') ?></strong>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0">TOTAL:</h5>
                    <h4 class="mb-0 text-success">$<?= number_format($venta['total'], 0, ',', '.') ?></h4>
                </div>
            </div>
        </div>

        <!-- Card de acciones -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-gear"></i> Acciones
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <!-- Botón imprimir -->
                    <button onclick="imprimirRecibo()" class="btn btn-primary btn-lg">
                        <i class="bi bi-printer"></i> Imprimir Recibo
                    </button>

                    <!-- Botón anular -->
                    <?php if ($venta['estado'] == 1): ?>
                    <button onclick="anularVenta()" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i> Anular Venta
                    </button>
                    <?php else: ?>
                    <div class="alert alert-danger mb-0">
                        <i class="bi bi-info-circle"></i> Esta venta fue anulada
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function imprimirRecibo() {
    window.open('<?= base_url('ventas/imprimir/'.$venta['id_venta']) ?>', '_blank', 'width=800,height=600');
}

function anularVenta() {
    if (!confirm('⚠️ ¿Está seguro de anular esta venta?\n\n✅ Se devolverán los productos al inventario\n❌ Esta acción no se puede deshacer')) {
        return;
    }
    
    fetch('<?= base_url('ventas/anular/'.$venta['id_venta']) ?>', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(resultado => {
        if (resultado.success) {
            alert('✅ Venta anulada exitosamente');
            location.reload();
        } else {
            alert('❌ Error: ' + resultado.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('❌ Error al procesar la solicitud');
    });
}
</script>

<?php
echo $this->include('layouts/footer');
?>