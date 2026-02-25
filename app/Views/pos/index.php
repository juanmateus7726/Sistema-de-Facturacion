<?php
// Incluye el header
echo $this->include('layouts/header');
?>

<!-- Título de la página -->
<div class="mb-4">
    <h2><i class="bi bi-calculator"></i> Punto de Venta (POS)</h2>
    <p class="text-muted">Interfaz para registro rápido de ventas</p>
</div>

<div class="row">
    <!-- COLUMNA IZQUIERDA: Búsqueda y carrito -->
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
                                   autocomplete="off">
                        </div>
                        <!-- Contenedor para resultados de búsqueda -->
                        <div id="resultadosBusqueda" class="list-group mt-2" style="max-height: 300px; overflow-y: auto; position: absolute; z-index: 1000; width: 92%;"></div>
                    </div>
                    
                    <!-- Botón de búsqueda -->
                    <div class="col-md-3">
                        <button class="btn btn-primary-custom btn-lg w-100" id="btnBuscar">
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
                    <button class="btn btn-sm btn-outline-danger" id="btnVaciarCarrito">
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
                            <!-- Los productos se agregarán dinámicamente con JavaScript -->
                            <tr id="carritoVacio">
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-cart-x" style="font-size: 3rem;"></i>
                                    <p class="mt-2">El carrito está vacío</p>
                                    <small>Busca y agrega productos para iniciar la venta</small>
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
                <select class="form-select" id="clienteSelect">
                    <option value="">Seleccionar cliente...</option>
                    <?php foreach($clientes as $cliente): ?>
                        <option value="<?= $cliente['id_cliente'] ?>">
                            <?= $cliente['nombre'] ?> - <?= $cliente['documento'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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
                <select class="form-select mb-3" id="metodoPago">
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="transferencia">Transferencia</option>
                </select>
                
                <!-- Monto recibido (solo para efectivo) -->
                <div id="seccionEfectivo" style="display: none;">
                    <label class="form-label">Monto recibido:</label>
                    <input type="number" class="form-control mb-2" id="montoRecibido" placeholder="0">
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Cambio:</span>
                        <strong id="cambio">$0</strong>
                    </div>
                </div>
                
                <!-- Botones de acción -->
                <div class="d-grid gap-2">
                    <!-- Botón principal: Finalizar venta -->
                    <button class="btn btn-success btn-lg" id="btnFinalizarVenta">
                        <i class="bi bi-check-circle"></i> Finalizar Venta
                    </button>
                    
                    <!-- Botón secundario: Cancelar -->
                    <button class="btn btn-outline-danger" id="btnCancelarVenta">
                        <i class="bi bi-x-circle"></i> Cancelar Venta
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript del POS -->
<script>
// Variable global para almacenar el carrito
let carrito = [];

// Función para formatear números como moneda colombiana
function formatearMoneda(numero) {
    return '$' + Number(numero).toLocaleString('es-CO');
}

// Función para buscar productos
function buscarProductos() {
    const termino = document.getElementById('buscarProducto').value.trim();
    
    // Si el término está vacío, limpiar resultados
    if (termino.length < 2) {
        document.getElementById('resultadosBusqueda').innerHTML = '';
        return;
    }
    
    // Realizar petición AJAX para buscar productos
    fetch('<?= base_url('pos/buscarProducto') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'termino=' + encodeURIComponent(termino)
    })
    .then(response => response.json())
    .then(productos => {
        console.log('Productos encontrados:', productos);
        console.log('Tipo de Dato:', typeof productos);
        console.log('¿Es un array?', Array.isArray(productos));
        mostrarResultados(productos);
    })
    .catch(error => {
        console.error('Error al buscar productos:', error);
    });
}

// Función para mostrar resultados de búsqueda
function mostrarResultados(productos) {
    const contenedor = document.getElementById('resultadosBusqueda');
    
    if (productos.length === 0) {
        contenedor.innerHTML = '<div class="list-group-item">No se encontraron productos</div>';
        return;
    }
    
    let html = '';
    productos.forEach(producto => {
        html += `
            <button type="button" class="list-group-item list-group-item-action" 
                    onclick="agregarAlCarrito(${producto.id_producto}, '${producto.nombre}', ${producto.precio}, ${producto.stock})">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>${producto.codigo}</strong> - ${producto.nombre}
                    </div>
                    <div>
                        <span class="badge bg-primary">${formatearMoneda(producto.precio)}</span>
                        <span class="badge bg-secondary">Stock: ${producto.stock}</span>
                    </div>
                </div>
            </button>
        `;
    });
    
    contenedor.innerHTML = html;
}

// Función para agregar producto al carrito
function agregarAlCarrito(id_producto, nombre, precio, stock) {
    // Verifica si el producto ya está en el carrito
    const productoExistente = carrito.find(item => item.id_producto === id_producto);
    
    if (productoExistente) {
        // Si ya existe, aumentar cantidad (si hay stock)
        if (productoExistente.cantidad < stock) {
            productoExistente.cantidad++;
        } else {
            alert('No hay suficiente stock disponible');
            return;
        }
    } else {
        // Si no existe, agregarlo al carrito
        carrito.push({
            id_producto: id_producto,
            nombre: nombre,
            precio: precio,
            cantidad: 1,
            stock: stock
        });
    }
    
    // Limpiar búsqueda
    document.getElementById('buscarProducto').value = '';
    document.getElementById('resultadosBusqueda').innerHTML = '';
    
    // Actualizar vista del carrito
    actualizarCarrito();
}

// Función para actualizar la visualización del carrito
function actualizarCarrito() {
    const tbody = document.getElementById('carritoProductos');
    
    // Si el carrito está vacío
    if (carrito.length === 0) {
        tbody.innerHTML = `
            <tr id="carritoVacio">
                <td colspan="5" class="text-center text-muted py-5">
                    <i class="bi bi-cart-x" style="font-size: 3rem;"></i>
                    <p class="mt-2">El carrito está vacío</p>
                    <small>Busca y agrega productos para iniciar la venta</small>
                </td>
            </tr>
        `;
        calcularTotales();
        return;
    }
    
    // Generar HTML para cada producto
    let html = '';
    carrito.forEach((item, index) => {
        const subtotal = item.precio * item.cantidad;
        html += `
            <tr>
                <td>
                    <strong>${item.nombre}</strong><br>
                    <small class="text-muted">Stock disponible: ${item.stock}</small>
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm" 
                           value="${item.cantidad}" 
                           min="1" 
                           max="${item.stock}"
                           onchange="cambiarCantidad(${index}, this.value)">
                </td>
                <td>${formatearMoneda(item.precio)}</td>
                <td><strong>${formatearMoneda(subtotal)}</strong></td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="eliminarDelCarrito(${index})">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });
    
    tbody.innerHTML = html;
    calcularTotales();
}

// Función para cambiar cantidad de un producto
function cambiarCantidad(index, nuevaCantidad) {
    nuevaCantidad = parseInt(nuevaCantidad);
    
    if (nuevaCantidad < 1) {
        nuevaCantidad = 1;
    }
    
    if (nuevaCantidad > carrito[index].stock) {
        alert('No hay suficiente stock. Disponible: ' + carrito[index].stock);
        nuevaCantidad = carrito[index].stock;
    }
    
    carrito[index].cantidad = nuevaCantidad;
    actualizarCarrito();
}

// Función para eliminar producto del carrito
function eliminarDelCarrito(index) {
    carrito.splice(index, 1);
    actualizarCarrito();
}

// Función para vaciar todo el carrito
function vaciarCarrito() {
    if (carrito.length === 0) return;
    
    if (confirm('¿Está seguro de vaciar el carrito?')) {
        carrito = [];
        actualizarCarrito();
    }
}

// Función para calcular totales
function calcularTotales() {
    let subtotal = 0;
    
    // Sumar todos los productos
    carrito.forEach(item => {
        subtotal += item.precio * item.cantidad;
    });
    
    // Calcular IVA (19%)
    const iva = subtotal * 0.19;
    const total = subtotal + iva;
    
    // Actualizar valores en pantalla
    document.getElementById('subtotal').textContent = formatearMoneda(subtotal);
    document.getElementById('iva').textContent = formatearMoneda(iva);
    document.getElementById('total').textContent = formatearMoneda(total);
    
    // Calcular cambio si es efectivo
    calcularCambio();
}

// Función para calcular cambio
function calcularCambio() {
    const metodoPago = document.getElementById('metodoPago').value;
    
    if (metodoPago === 'efectivo') {
        const totalText = document.getElementById('total').textContent.replace('$', '').replace(/\./g, '');
        const total = parseFloat(totalText);
        const montoRecibido = parseFloat(document.getElementById('montoRecibido').value) || 0;
        const cambio = montoRecibido - total;
        
        document.getElementById('cambio').textContent = formatearMoneda(cambio >= 0 ? cambio : 0);
    }
}

// Función para finalizar la venta
function finalizarVenta() {
    // Validaciones
    if (carrito.length === 0) {
        alert('Debe agregar al menos un producto al carrito');
        return;
    }
    
    const clienteId = document.getElementById('clienteSelect').value;
    if (!clienteId) {
        alert('Debe seleccionar un cliente');
        return;
    }
    
    const metodoPago = document.getElementById('metodoPago').value;
    let montoRecibido = 0;
    let cambio = 0;
    
    // Si es efectivo, validar monto recibido
    if (metodoPago === 'efectivo') {
        const totalText = document.getElementById('total').textContent.replace('$', '').replace(/\./g, '');
        const total = parseFloat(totalText);
        montoRecibido = parseFloat(document.getElementById('montoRecibido').value) || 0;
        
        if (montoRecibido < total) {
            alert('El monto recibido es insuficiente');
            return;
        }
        
        cambio = montoRecibido - total;
    }
    
    // Obtener valores
    const subtotalText = document.getElementById('subtotal').textContent.replace('$', '').replace(/\./g, '');
    const ivaText = document.getElementById('iva').textContent.replace('$', '').replace(/\./g, '');
    const totalText = document.getElementById('total').textContent.replace('$', '').replace(/\./g, '');
    
    const subtotal = parseFloat(subtotalText);
    const iva = parseFloat(ivaText);
    const total = parseFloat(totalText);
    
    // Preparar datos para enviar
    const datos = new FormData();
    datos.append('id_cliente', clienteId);
    datos.append('id_usuario', 1); // TODO: Obtener del usuario logueado (Semana 8)
    datos.append('productos', JSON.stringify(carrito));
    datos.append('subtotal', subtotal);
    datos.append('descuento_total', 0);
    datos.append('iva', iva);
    datos.append('total', total);
    datos.append('metodo_pago', metodoPago);
    datos.append('monto_recibido', montoRecibido);
    datos.append('cambio', cambio);
    
    // Enviar venta al servidor
    fetch('<?= base_url('pos/guardarVenta') ?>', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: datos
    })
    .then(response => response.json())
    .then(resultado => {
        if (resultado.success) {
            alert('✅ Venta registrada exitosamente!\nFactura: ' + resultado.numero_factura);
            
            // Limpiar todo
            carrito = [];
            actualizarCarrito();
            document.getElementById('clienteSelect').value = '';
            document.getElementById('montoRecibido').value = '';
            
            // Aquí podrías abrir ventana para imprimir ticket
            // window.open('<?= base_url('pos/imprimirTicket/') ?>' + resultado.id_venta, '_blank');
        } else {
            alert('❌ Error: ' + resultado.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('❌ Error al procesar la venta');
    });
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    // Búsqueda en tiempo real
    document.getElementById('buscarProducto').addEventListener('input', buscarProductos);
    document.getElementById('btnBuscar').addEventListener('click', buscarProductos);
    
    // Búsqueda al presionar Enter
    document.getElementById('buscarProducto').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            buscarProductos();
        }
    });
    
    // Vaciar carrito
    document.getElementById('btnVaciarCarrito').addEventListener('click', vaciarCarrito);
    
    // Mostrar/ocultar sección de efectivo
    document.getElementById('metodoPago').addEventListener('change', function() {
        const seccion = document.getElementById('seccionEfectivo');
        if (this.value === 'efectivo') {
            seccion.style.display = 'block';
        } else {
            seccion.style.display = 'none';
        }
    });
    
    // Calcular cambio al escribir monto recibido
    document.getElementById('montoRecibido').addEventListener('input', calcularCambio);
    
    // Finalizar venta
    document.getElementById('btnFinalizarVenta').addEventListener('click', finalizarVenta);
    
    // Cancelar venta
    document.getElementById('btnCancelarVenta').addEventListener('click', function() {
        if (carrito.length > 0 && confirm('¿Está seguro de cancelar la venta?')) {
            carrito = [];
            actualizarCarrito();
            document.getElementById('clienteSelect').value = '';
            document.getElementById('montoRecibido').value = '';
        }
    });
});
</script>

<?php
// Incluye el footer
echo $this->include('layouts/footer');
?>