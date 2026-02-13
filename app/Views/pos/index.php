<?php
// Incluye el header
echo $this->include('layouts/header');
?>

<!-- Título de la página -->
<div class="mb-4">
    <h2><i class="bi bi-calculator"></i> Punto de Venta</h2>
    <p class="text-muted">Interfaz para registro rápido de ventas</p>
</div>

<div class="row">
    <!-- COLUMNA IZQUIERDA: Búsqueda y productos -->
    <div class="col-lg-8">
        <!-- Tarjeta de búsqueda de productos -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-2">
                    <!-- Campo de búsqueda -->
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" 
                                   class="form-control form-control-lg" 
                                   id="buscarProducto"
                                   placeholder="Buscar producto por código o nombre..."
                                   disabled>
                        </div>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> Funcionalidad de búsqueda se implementará en Semana 5
                        </small>
                    </div>
                    
                    <!-- Botón de búsqueda -->
                    <div class="col-md-3">
                        <button class="btn btn-primary-custom btn-lg w-100" disabled>
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tarjeta con el carrito de compras -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-cart3"></i> Productos en el Carrito</span>
                    <button class="btn btn-sm btn-outline-danger" disabled>
                        <i class="bi bi-trash"></i> Vaciar Carrito
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Tabla de productos en el carrito -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th width="100">Cantidad</th>
                                <th width="120">Precio Unit.</th>
                                <th width="120">Subtotal</th>
                                <th width="80">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="carritoProductos">
                            <!-- Aquí se agregarán los productos dinámicamente con JavaScript en Semana 5 -->
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-cart-x" style="font-size: 3rem;"></i>
                                    <p class="mt-2">El carrito está vacío</p>
                                    <small>Busca y agrega productos para iniciar la venta</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Vista previa de cómo se verán los productos (ejemplo visual) -->
                <div class="alert alert-light border">
                    <strong>Vista previa (Semana 5):</strong>
                    <table class="table table-sm table-borderless mb-0 mt-2">
                        <tbody>
                            <tr class="text-muted">
                                <td>Coca Cola 500ml</td>
                                <td width="100">
                                    <input type="number" class="form-control form-control-sm" value="2" disabled>
                                </td>
                                <td width="120">$2,500</td>
                                <td width="120"><strong>$5,000</strong></td>
                                <td width="80">
                                    <button class="btn btn-sm btn-danger" disabled>
                                        <i class="bi bi-x"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- COLUMNA DERECHA: Resumen y cliente -->
    <div class="col-lg-4">
        <!-- Tarjeta de selección de cliente -->
        <div class="card mb-3">
            <div class="card-header bg-white">
                <i class="bi bi-person"></i> Cliente
            </div>
            <div class="card-body">
                <select class="form-select" id="clienteSelect" disabled>
                    <option>Seleccionar cliente...</option>
                    <!-- En Semana 5 se cargarán los clientes desde la BD -->
                </select>
                <small class="text-muted d-block mt-2">
                    <i class="bi bi-info-circle"></i> O crear cliente rápido
                </small>
                <button class="btn btn-sm btn-outline-primary mt-2 w-100" disabled>
                    <i class="bi bi-plus-circle"></i> Nuevo Cliente
                </button>
            </div>
        </div>
        
        <!-- Tarjeta de resumen de venta -->
        <div class="card">
            <div class="card-header bg-white">
                <i class="bi bi-receipt"></i> Resumen de Venta
            </div>
            <div class="card-body">
                <!-- Subtotal -->
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal:</span>
                    <strong id="subtotal">$0</strong>
                </div>
                
                <!-- Descuento (opcional) -->
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Descuento:</span>
                    <div class="input-group input-group-sm" style="width: 120px;">
                        <input type="number" class="form-control" value="0" min="0" disabled>
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                
                <!-- IVA -->
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">IVA (19%):</span>
                    <strong id="iva">$0</strong>
                </div>
                
                <hr>
                
                <!-- Total a pagar -->
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0">TOTAL:</h5>
                    <h4 class="mb-0 text-success" id="total">$0</h4>
                </div>
                
                <!-- Método de pago -->
                <label class="form-label">Método de pago:</label>
                <select class="form-select mb-3" disabled>
                    <option>Efectivo</option>
                    <option>Tarjeta</option>
                    <option>Transferencia</option>
                </select>
                
                <!-- Botones de acción -->
                <div class="d-grid gap-2">
                    <!-- Botón principal: Finalizar venta -->
                    <button class="btn btn-success btn-lg" disabled>
                        <i class="bi bi-check-circle"></i> Finalizar Venta
                    </button>
                    
                    <!-- Botón secundario: Cancelar -->
                    <button class="btn btn-outline-danger" disabled>
                        <i class="bi bi-x-circle"></i> Cancelar Venta
                    </button>
                </div>
                
                <!-- Mensaje informativo -->
                <div class="alert alert-info mt-3 mb-0">
                    <small>
                        <i class="bi bi-info-circle"></i> 
                        <strong>Funcionalidad completa en Semana 5:</strong><br>
                        • Búsqueda de productos<br>
                        • Cálculo automático de totales<br>
                        • Guardado en base de datos<br>
                        • Impresión de ticket
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Espacio adicional para futuras funcionalidades -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card bg-light">
            <div class="card-body text-center">
                <i class="bi bi-lightbulb" style="font-size: 2rem; color: var(--color-advertencia);"></i>
                <h5 class="mt-2">Características del POS (Semana 5)</h5>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <i class="bi bi-upc-scan" style="font-size: 1.5rem;"></i>
                        <p class="small mb-0 mt-1"><strong>Lectura de códigos</strong></p>
                        <p class="small text-muted">Búsqueda rápida por código de barras</p>
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-calculator" style="font-size: 1.5rem;"></i>
                        <p class="small mb-0 mt-1"><strong>Cálculo automático</strong></p>
                        <p class="small text-muted">Subtotales, IVA y total en tiempo real</p>
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-printer" style="font-size: 1.5rem;"></i>
                        <p class="small mb-0 mt-1"><strong>Impresión de ticket</strong></p>
                        <p class="small text-muted">Ticket térmico o factura PDF</p>
                    </div>
                    <div class="col-md-3">
                        <i class="bi bi-arrow-repeat" style="font-size: 1.5rem;"></i>
                        <p class="small mb-0 mt-1"><strong>Actualización de stock</strong></p>
                        <p class="small text-muted">Inventario actualizado automáticamente</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Incluye el footer
echo $this->include('layouts/footer');
?>