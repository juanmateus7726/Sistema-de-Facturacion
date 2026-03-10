<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recibo - <?= $venta['numero_factura'] ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Courier New', monospace;
            padding: 20px;
            max-width: 80mm;
            margin: 0 auto;
        }
        .recibo {
            border: 2px dashed #333;
            padding: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 12px;
        }
        .productos {
            margin: 15px 0;
            border-top: 1px solid #333;
            border-bottom: 1px solid #333;
            padding: 10px 0;
        }
        .producto-item {
            margin: 8px 0;
            font-size: 11px;
        }
        .totales {
            margin-top: 10px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 13px;
        }
        .total-final {
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #333;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px dashed #333;
            font-size: 11px;
        }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 14px; cursor: pointer;">
            🖨️ Imprimir
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; font-size: 14px; cursor: pointer;">
            ❌ Cerrar
        </button>
    </div>

    <div class="recibo">
        <div class="header">
            <h1>SISTEMA DE FACTURACIÓN</h1>
            <div>NIT: 123456789-0</div>
            <div>Paipa, Boyacá</div>
        </div>
        
        <div class="info-row">
            <strong>Factura:</strong>
            <span><?= $venta['numero_factura'] ?></span>
        </div>
        <div class="info-row">
            <strong>Fecha:</strong>
            <span><?= date('d/m/Y H:i', strtotime($venta['fecha_hora'])) ?></span>
        </div>
        <div class="info-row">
            <strong>Cliente:</strong>
            <span><?= esc($venta['cliente_nombre']) ?></span>
        </div>
        <div class="info-row">
            <strong>Doc:</strong>
            <span><?= esc($venta['documento']) ?></span>
        </div>
        <div class="info-row">
            <strong>Cajero:</strong>
            <span><?= esc($venta['cajero_nombre']) ?></span>
        </div>

        <div class="productos">
            <?php foreach($detalles as $det): ?>
            <div class="producto-item">
                <div><strong><?= esc($det['producto_nombre']) ?></strong></div>
                <div style="display: flex; justify-content: space-between;">
                    <span><?= $det['cantidad'] ?> x $<?= number_format($det['precio_unitario'], 0, ',', '.') ?></span>
                    <strong>$<?= number_format($det['subtotal_linea'], 0, ',', '.') ?></strong>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="totales">
            <div class="total-row">
                <span>Subtotal:</span>
                <span>$<?= number_format($venta['subtotal'], 0, ',', '.') ?></span>
            </div>
            <?php if ($venta['descuento_total'] > 0): ?>
            <div class="total-row">
                <span>Descuento:</span>
                <span>-$<?= number_format($venta['descuento_total'], 0, ',', '.') ?></span>
            </div>
            <?php endif; ?>
            <div class="total-row">
                <span>IVA (19%):</span>
                <span>$<?= number_format($venta['iva'], 0, ',', '.') ?></span>
            </div>
            <div class="total-row total-final">
                <span>TOTAL:</span>
                <span>$<?= number_format($venta['total'], 0, ',', '.') ?></span>
            </div>
            <div class="total-row" style="margin-top: 10px;">
                <span>Pago:</span>
                <span><?= ucfirst($venta['metodo_pago']) ?></span>
            </div>
        </div>

        <div class="footer">
            <div>¡Gracias por su compra!</div>
            <div>Sistema - 2026</div>
        </div>
    </div>
</body>
</html>