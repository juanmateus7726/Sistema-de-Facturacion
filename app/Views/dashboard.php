<?php
// Incluye el header con el navbar
echo $this->include('layouts/header');
?>

<!-- Tarjeta de bienvenida -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-shop" style="font-size: 4rem; color: var(--color-primario);"></i>
                <h1 class="mt-3">Bienvenido al Sistema de Facturación</h1>
                <p class="text-muted">Selecciona un módulo del menú superior para comenzar</p>
            </div>
        </div>
    </div>
</div>

<!-- Tarjetas de acceso rápido a módulos -->
<div class="row mt-4">
    <!-- Productos -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-box-seam" style="font-size: 3rem; color: var(--color-acento);"></i>
                <h5 class="card-title mt-3">Productos</h5>
                <p class="card-text">Gestión de productos del inventario</p>
                <a href="<?= base_url('productos') ?>" class="btn btn-primary-custom">
                    <i class="bi bi-arrow-right"></i> Acceder
                </a>
            </div>
        </div>
    </div>

    <!-- Ventas -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-cart-check" style="font-size: 3rem; color: var(--color-exito);"></i>
                <h5 class="card-title mt-3">Ventas</h5>
                <p class="card-text">Registro de ventas y facturación</p>
                <a href="<?= base_url('pos') ?>" class="btn btn-success-custom">
                    <i class="bi bi-arrow-right"></i> Acceder
                </a>
            </div>
        </div>
    </div>

    <!-- Clientes -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-people" style="font-size: 3rem; color: var(--color-advertencia);"></i>
                <h5 class="card-title mt-3">Clientes</h5>
                <p class="card-text">Gestión de clientes</p>
                <a href="<?= base_url('clientes') ?>" class="btn btn-primary-custom">
                    <i class="bi bi-arrow-right"></i> Acceder
                </a>
            </div>
        </div>
    </div>

    <!-- Inventario -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-clipboard-data" style="font-size: 3rem; color: var(--color-primario);"></i>
                <h5 class="card-title mt-3">Inventario</h5>
                <p class="card-text">Control de stock y alertas</p>
                <a href="<?= base_url('inventario') ?>" class="btn btn-primary-custom">
                    <i class="bi bi-arrow-right"></i> Acceder
                </a>
            </div>
        </div>
    </div>

    <!-- Reportes -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-graph-up" style="font-size: 3rem; color: var(--color-exito);"></i>
                <h5 class="card-title mt-3">Reportes</h5>
                <p class="card-text">Estadísticas y reportes</p>
                <a href="<?= base_url('reportes') ?>" class="btn btn-primary-custom">
                    <i class="bi bi-arrow-right"></i> Acceder
                </a>
            </div>
        </div>
    </div>

    <!-- Compras -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-bag" style="font-size: 3rem; color: var(--color-secundario);"></i>
                <h5 class="card-title mt-3">Compras</h5>
                <p class="card-text">Registro de compras a proveedores</p>
                <a href="<?= base_url('compras') ?>" class="btn btn-primary-custom">
                    <i class="bi bi-arrow-right"></i> Acceder
                </a>
            </div>
        </div>
    </div>
</div>

<?php
// Incluye el footer
echo $this->include('layouts/footer');
?>