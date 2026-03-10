<?php
echo $this->include('layouts/header');
?>

<div class="page-header">
    <h2><i class="bi bi-people"></i> Reporte de Clientes</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('reportes') ?>">Reportes</a></li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
    </nav>
</div>

<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('clientes') ?>">
            <i class="bi bi-list-ul"></i> Listado de Clientes
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('reportes/clientes') ?>">
            <i class="bi bi-trophy"></i> Top Clientes
        </a>
    </li>
</ul>

<!-- Filtros -->
<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-funnel"></i> Período
    </div>
    <div class="card-body">
        <form method="GET" action="<?= base_url('reportes/clientes') ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" 
                           value="<?= $filtros['fecha_inicio'] ?>">
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" name="fecha_fin" 
                           value="<?= $filtros['fecha_fin'] ?>">
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-50">
                            <i class="bi bi-search"></i> Buscar
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

<!-- Top clientes -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-trophy"></i> Top 20 Clientes
    </div>
    <div class="card-body">
        <?php if (empty($clientes)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No hay datos en el período seleccionado
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th>Cliente</th>
                            <th>Documento</th>
                            <th class="text-center">Compras</th>
                            <th class="text-end">Monto Total</th>
                            <th class="text-end">Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $pos = 1;
                        foreach($clientes as $cliente): 
                            $promedio = $cliente['monto_total'] / $cliente['total_compras'];
                        ?>
                        <tr>
                            <td>
                                <?php if ($pos <= 3): ?>
                                    <i class="bi bi-trophy-fill" style="color: <?= $pos == 1 ? '#ffd700' : ($pos == 2 ? '#c0c0c0' : '#cd7f32') ?>;"></i>
                                <?php endif; ?>
                                <?= $pos ?>
                            </td>
                            <td><strong><?= esc($cliente['nombre']) ?></strong></td>
                            <td><?= esc($cliente['documento']) ?></td>
                            <td class="text-center">
                                <span class="badge bg-primary"><?= $cliente['total_compras'] ?></span>
                            </td>
                            <td class="text-end">
                                <strong style="color: #48bb78;">$<?= number_format($cliente['monto_total'], 0, ',', '.') ?></strong>
                            </td>
                            <td class="text-end text-muted">
                                $<?= number_format($promedio, 0, ',', '.') ?>
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

<?php
echo $this->include('layouts/footer');
?>