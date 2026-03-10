<?php
echo $this->include('layouts/header');

// Detectar qué tab está activo
$currentTab = uri_string() == 'clientes' ? 'listado' : 'top';
?>

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-people"></i> Gestión de Clientes</h2>
        <?php if ($currentTab == 'listado'): ?>
        <a href="<?= base_url('clientes/crear') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nuevo Cliente
        </a>
        <?php endif; ?>
    </div>
</div>

<!-- Tabs como links -->
<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link <?= $currentTab == 'listado' ? 'active' : '' ?>" 
           href="<?= base_url('clientes') ?>">
            <i class="bi bi-list-ul"></i> Listado de Clientes
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $currentTab == 'top' ? 'active' : '' ?>" 
           href="<?= base_url('reportes/clientes') ?>">
            <i class="bi bi-trophy"></i> Top Clientes
        </a>
    </li>
</ul>

<!-- Mensajes -->
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

<!-- Tabla de clientes -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-list-ul"></i> Lista de Clientes
    </div>
    <div class="card-body">
        <?php if (empty($clientes)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> 
                No hay clientes registrados. <a href="<?= base_url('clientes/crear') ?>">Crear el primero</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <th width="150">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clientes as $cliente): ?>
                        <tr>
                            <td><strong><?= esc($cliente['documento']) ?></strong></td>
                            <td><?= esc($cliente['nombre']) ?></td>
                            <td><?= esc($cliente['telefono']) ?: '<span class="text-muted">-</span>' ?></td>
                            <td><?= esc($cliente['correo']) ?: '<span class="text-muted">-</span>' ?></td>
                            <td><?= esc($cliente['direccion']) ?: '<span class="text-muted">-</span>' ?></td>
                            <td>
                                <a href="<?= base_url('clientes/editar/'.$cliente['id_cliente']) ?>" 
                                   class="btn btn-sm btn-primary" 
                                   title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('clientes/eliminar/'.$cliente['id_cliente']) ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('¿Está seguro de eliminar este cliente?')"
                                   title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                <small class="text-muted">
                    <i class="bi bi-info-circle"></i> 
                    Total de clientes: <strong><?= count($clientes) ?></strong>
                </small>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
echo $this->include('layouts/footer');
?>