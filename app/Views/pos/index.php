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
    <!-- COLUMNA IZQUIERDA: Búsqueda y carrito -->
    <div class="col-lg-8">
        <!-- Tarjeta de búsqueda de productos -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-2">
                    <!-- Campo de búsqueda -->
                    <div class="col-md-9" style="position: relative;">
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
                        <div id="resultadosBusqueda"></div>
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
                                <th width="100">Descuento</th>
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
<!-- Tarjeta de selección de cliente -->
<div class="card mb-3">
    <div class="card-header bg-white">
        <i class="bi bi-person"></i> Cliente
    </div>
    <div class="card-body">
        <!-- Búsqueda por documento -->
        <label class="form-label">Buscar por documento:</label>
        <div class="input-group mb-2">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" 
                   class="form-control" 
                   id="buscarClienteDocumento" 
                   placeholder="Ej: 1234567890"
                   autocomplete="off">
        </div>
        <div id="resultadoBusquedaCliente"></div>
        
        <div class="text-center my-2">
            <small class="text-muted">o</small>
        </div>
        
        <!-- Select tradicional -->
        <label class="form-label">Seleccionar de la lista:</label>
        <select class="form-select" id="clienteSelect">
            <option value="">Seleccionar cliente...</option>
            <?php foreach($clientes as $cliente): ?>
                <option value="<?= $cliente['id_cliente'] ?>" 
                        data-nombre="<?= esc($cliente['nombre']) ?>"
                        data-documento="<?= esc($cliente['documento']) ?>">
                    <?= $cliente['nombre'] ?> - <?= $cliente['documento'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <!-- Cliente seleccionado -->
        <div id="clienteSeleccionado" class="mt-2" style="display: none;">
            <div class="alert alert-success mb-0">
                <strong><i class="bi bi-person-check"></i> Cliente:</strong> <span id="nombreClienteSeleccionado"></span><br>
                <small>Documento: <span id="documentoClienteSeleccionado"></span></small>
            </div>
        </div>
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
                
            <!-- Descuento global -->
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Descuento adicional:</span>
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <span class="input-group-text">$</span>
                        <input type="number" 
                               class="form-control" 
                               id="descuentoGlobal"
                               value="0"
                               min="0"
                               step="100">
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
<select class="form-select mb-3" id="metodoPago">
    <option value="efectivo">Efectivo</option>
    <option value="tarjeta">Tarjeta</option>
    <option value="transferencia">Transferencia</option>
    <option value="mixto">Pago Mixto</option>
</select>

<!-- Sección de efectivo (solo efectivo) -->
<div id="seccionEfectivo" style="display: none;">
    <label class="form-label">Monto recibido en efectivo:</label>
    <input type="number" class="form-control mb-2" id="montoRecibido" placeholder="0" step="0.01">
    
    <div class="d-flex justify-content-between mb-3">
        <span class="text-muted">Cambio:</span>
        <strong id="cambio">$0</strong>
    </div>
</div>

<!-- Sección de pago mixto -->
<div id="seccionPagoMixto" style="display: none;">
    <div class="alert alert-info mb-2">
        <small><i class="bi bi-info-circle"></i> Divida el pago en dos métodos diferentes</small>
    </div>
    
    <!-- Primer método -->
    <label class="form-label">Primer método:</label>
    <select class="form-select mb-2" id="metodoPago1">
        <option value="efectivo">Efectivo</option>
        <option value="tarjeta">Tarjeta</option>
        <option value="transferencia">Transferencia</option>
    </select>
    <div class="input-group mb-3">
        <span class="input-group-text">$</span>
        <input type="number" 
               class="form-control" 
               id="montoPago1" 
               placeholder="0"
               step="0.01"
               min="0">
    </div>
    
    <!-- Segundo método -->
    <label class="form-label">Segundo método:</label>
    <select class="form-select mb-2" id="metodoPago2">
        <option value="tarjeta">Tarjeta</option>
        <option value="transferencia">Transferencia</option>
        <option value="efectivo">Efectivo</option>
    </select>
    <div class="input-group mb-3">
        <span class="input-group-text">$</span>
        <input type="number" 
               class="form-control" 
               id="montoPago2" 
               placeholder="0"
               step="0.01"
               min="0">
    </div>
    
    <!-- Resumen de pago mixto -->
    <div class="alert alert-light border">
        <div class="d-flex justify-content-between">
            <span>Total a pagar:</span>
            <strong id="totalPagoMixto">$0</strong>
        </div>
        <div class="d-flex justify-content-between">
            <span>Total recibido:</span>
            <strong id="totalRecibidoMixto">$0</strong>
        </div>
        <hr class="my-2">
        <div class="d-flex justify-content-between">
            <span><strong>Diferencia:</strong></span>
            <strong id="diferenciaPagoMixto" class="text-danger">$0</strong>
        </div>
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

// Variable global para el cliente seleccionado
let clienteSeleccionadoId = null;

// Función para buscar cliente por documento
function buscarClientePorDocumento() {
    const documento = document.getElementById('buscarClienteDocumento').value.trim();
    const contenedor = document.getElementById('resultadoBusquedaCliente');
    
    if (documento.length < 3) {
        contenedor.innerHTML = '';
        return;
    }
    
    // Buscar en el select (como ya están cargados todos los clientes)
    const selectClientes = document.getElementById('clienteSelect');
    const opciones = selectClientes.options;
    let encontrados = [];
    
    for (let i = 1; i < opciones.length; i++) {
        const opcion = opciones[i];
        const docCliente = opcion.getAttribute('data-documento');
        const nombreCliente = opcion.getAttribute('data-nombre');
        
        if (docCliente && docCliente.includes(documento)) {
            encontrados.push({
                id: opcion.value,
                nombre: nombreCliente,
                documento: docCliente
            });
        }
    }
    
    // Mostrar resultados
    if (encontrados.length === 0) {
        contenedor.innerHTML = '<small class="text-muted">No se encontró ningún cliente con ese documento</small>';
        return;
    }
    
    let html = '<div class="list-group">';
    encontrados.forEach(cliente => {
        html += `
            <button type="button" 
                    class="list-group-item list-group-item-action"
                    onclick="seleccionarCliente(${cliente.id}, '${cliente.nombre}', '${cliente.documento}')">
                <strong>${cliente.nombre}</strong><br>
                <small class="text-muted">Doc: ${cliente.documento}</small>
            </button>
        `;
    });
    html += '</div>';
    
    contenedor.innerHTML = html;
}

// Función para seleccionar un cliente
function seleccionarCliente(id, nombre, documento) {
    clienteSeleccionadoId = id;
    
    // Actualizar el select
    document.getElementById('clienteSelect').value = id;
    
    // Mostrar cliente seleccionado
    document.getElementById('nombreClienteSeleccionado').textContent = nombre;
    document.getElementById('documentoClienteSeleccionado').textContent = documento;
    document.getElementById('clienteSeleccionado').style.display = 'block';
    
    // Limpiar búsqueda
    document.getElementById('buscarClienteDocumento').value = '';
    document.getElementById('resultadoBusquedaCliente').innerHTML = '';
}

// Función para formatear números como moneda colombiana
function formatearMoneda(numero) {
    return '$' + Number(numero).toLocaleString('es-CO');
}

// Función para buscar productos
function buscarProductos() {
    const termino = document.getElementById('buscarProducto').value.trim();
    const contenedor = document.getElementById('resultadosBusqueda');
    
    // Si el término está vacío, limpiar resultados
    if (termino.length < 2) {
        document.getElementById('resultadosBusqueda').innerHTML = '';
        contenedor.style.display = 'none';
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
        contenedor.style.display = 'block';
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
    contenedor.style.display = 'block';
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
            stock: stock,
            descuento: 0
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
                <td colspan="6" class="text-center text-muted py-5">
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
        const descuento = item.descuento || 0;
        const subtotal = (item.precio * item.cantidad) - descuento;
        
        html += `
            <tr>
                <td>
                    <strong>${item.nombre}</strong><br>
                    <small class="text-muted">Stock disponible: ${item.stock}</small>
                </td>
                <td>
                    <input type="number" 
                           class="form-control form-control-sm" 
                           value="${item.cantidad}" 
                           min="1" 
                           max="${item.stock}"
                           onchange="cambiarCantidad(${index}, this.value)">
                </td>
                <td>${formatearMoneda(item.precio)}</td>
                <td>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">$</span>
                        <input type="number" 
                               class="form-control" 
                               value="${descuento}"
                               min="0"
                               max="${item.precio * item.cantidad}"
                               step="100"
                               onchange="cambiarDescuento(${index}, this.value)"
                               title="Descuento en pesos">
                    </div>
                </td>
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

// Función para cambiar descuento de un producto
function cambiarDescuento(index, nuevoDescuento) {
    nuevoDescuento = parseFloat(nuevoDescuento) || 0;
    
    // El descuento no puede ser mayor al subtotal del producto
    const maxDescuento = carrito[index].precio * carrito[index].cantidad;
    
    if (nuevoDescuento > maxDescuento) {
        alert('El descuento no puede ser mayor al subtotal del producto');
        nuevoDescuento = maxDescuento;
    }
    
    if (nuevoDescuento < 0) {
        nuevoDescuento = 0;
    }
    
    carrito[index].descuento = nuevoDescuento;
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
    
    // Sumar todos los productos (con sus descuentos individuales)
    carrito.forEach(item => {
        const descuentoItem = item.descuento || 0;
        subtotal += (item.precio * item.cantidad) - descuentoItem;
    });
    
    // Aplicar descuento global
    const descuentoGlobal = parseFloat(document.getElementById('descuentoGlobal').value) || 0;
    const subtotalConDescuento = subtotal - descuentoGlobal;
    
    // Calcular IVA sobre el subtotal con descuento
    const iva = subtotalConDescuento * 0.19;
    const total = subtotalConDescuento + iva;
    
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
    } else if (metodoPago === 'mixto') {
        calcularPagoMixto();
    }
}

// Función para calcular pago mixto
function calcularPagoMixto() {
    const totalText = document.getElementById('total').textContent.replace('$', '').replace(/\./g, '');
    const total = parseFloat(totalText);
    
    const montoPago1 = parseFloat(document.getElementById('montoPago1').value) || 0;
    const montoPago2 = parseFloat(document.getElementById('montoPago2').value) || 0;
    const totalRecibido = montoPago1 + montoPago2;
    const diferencia = totalRecibido - total;
    
    // Actualizar valores
    document.getElementById('totalPagoMixto').textContent = formatearMoneda(total);
    document.getElementById('totalRecibidoMixto').textContent = formatearMoneda(totalRecibido);
    
    // Mostrar diferencia con color
    const elementoDiferencia = document.getElementById('diferenciaPagoMixto');
    elementoDiferencia.textContent = formatearMoneda(Math.abs(diferencia));
    
    if (diferencia < 0) {
        elementoDiferencia.className = 'text-danger';
        elementoDiferencia.textContent = '-' + formatearMoneda(Math.abs(diferencia)) + ' (Falta)';
    } else if (diferencia > 0) {
        elementoDiferencia.className = 'text-success';
        elementoDiferencia.textContent = '+' + formatearMoneda(diferencia) + ' (Exceso)';
    } else {
        elementoDiferencia.className = 'text-success';
        elementoDiferencia.textContent = formatearMoneda(0) + ' (Exacto)';
    }
}

function finalizarVenta() {
    // Validaciones
    if (carrito.length === 0) {
        alert('Debe agregar al menos un producto al carrito');
        return;
    }
    
    const clienteId = clienteSeleccionadoId || document.getElementById('clienteSelect').value;
    if (!clienteId) {
        alert('Debe seleccionar un cliente');
        return;
    }
    
    const metodoPago = document.getElementById('metodoPago').value;
    let montoRecibido = 0;
    let cambio = 0;
    let datosPagoMixto = null;
    
    // Obtener total
    const totalText = document.getElementById('total').textContent.replace('$', '').replace(/\./g, '');
    const total = parseFloat(totalText);
    
    // Validar según método de pago
    if (metodoPago === 'efectivo') {
        montoRecibido = parseFloat(document.getElementById('montoRecibido').value) || 0;
        
        if (montoRecibido < total) {
            alert('El monto recibido es insuficiente');
            return;
        }
        
        cambio = montoRecibido - total;
        
    } else if (metodoPago === 'mixto') {
        // Validar pago mixto
        const montoPago1 = parseFloat(document.getElementById('montoPago1').value) || 0;
        const montoPago2 = parseFloat(document.getElementById('montoPago2').value) || 0;
        const totalRecibido = montoPago1 + montoPago2;
        
        if (totalRecibido < total) {
            alert('El monto total recibido es insuficiente\n\nTotal: ' + formatearMoneda(total) + '\nRecibido: ' + formatearMoneda(totalRecibido));
            return;
        }
        
        // Preparar datos del pago mixto
        const metodoPago1 = document.getElementById('metodoPago1').value;
        const metodoPago2 = document.getElementById('metodoPago2').value;
        
        datosPagoMixto = {
            metodo1: metodoPago1,
            monto1: montoPago1,
            metodo2: metodoPago2,
            monto2: montoPago2
        };
        
        montoRecibido = totalRecibido;
        cambio = totalRecibido - total;
    }
    
    // Obtener valores
    const subtotalText = document.getElementById('subtotal').textContent.replace('$', '').replace(/\./g, '');
    const ivaText = document.getElementById('iva').textContent.replace('$', '').replace(/\./g, '');

    const subtotal = parseFloat(subtotalText);
    const iva = parseFloat(ivaText);
    const descuentoGlobal = parseFloat(document.getElementById('descuentoGlobal').value) || 0;

    // Calcular descuento total (suma de descuentos individuales + descuento global)
    let descuentoIndividual = 0;
    carrito.forEach(item => {
        descuentoIndividual += (item.descuento || 0);
    });
    const descuentoTotal = descuentoIndividual + descuentoGlobal;

    // Preparar datos para enviar
    const datos = new FormData();
    datos.append('id_cliente', clienteId);
    datos.append('id_usuario', 1);
    datos.append('productos', JSON.stringify(carrito));
    datos.append('subtotal', subtotal);
    datos.append('descuento_total', descuentoTotal);  // ← CAMBIAR ESTO (antes era 0)
    datos.append('iva', iva);
    datos.append('total', total);
    datos.append('metodo_pago', metodoPago);
    datos.append('monto_recibido', montoRecibido);
    datos.append('cambio', cambio);
    
    // Si es pago mixto, agregar los detalles
    if (datosPagoMixto) {
        datos.append('pago_mixto', JSON.stringify(datosPagoMixto));
    }
    
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
    console.log('Respuesta del servidor:', resultado); // ← DEBUG
    
    if (resultado.success) {
        // Mostrar recibo bonito
        mostrarReciboVenta(resultado);
        
        // Limpiar todo
        carrito = [];
        actualizarCarrito();
        document.getElementById('clienteSelect').value = '';
        document.getElementById('montoRecibido').value = '';
        document.getElementById('descuentoGlobal').value = '0';
        document.getElementById('clienteSeleccionado').style.display = 'none';
        clienteSeleccionadoId = null;
        
        // Limpiar campos de pago mixto
        document.getElementById('montoPago1').value = '';
        document.getElementById('montoPago2').value = '';
        
        // Resetear método de pago
        document.getElementById('metodoPago').value = 'efectivo';
        document.getElementById('seccionEfectivo').style.display = 'none';
        document.getElementById('seccionPagoMixto').style.display = 'none';
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
    // Búsqueda de cliente en tiempo real
    document.getElementById('buscarClienteDocumento').addEventListener('input', buscarClientePorDocumento);

    // Calcular totales cuando cambie el descuento global
    document.getElementById('descuentoGlobal').addEventListener('input', calcularTotales);

    // Al cambiar el select tradicional
    document.getElementById('clienteSelect').addEventListener('change', function() {
        if (this.value) {
            const opcion = this.options[this.selectedIndex];
            const nombre = opcion.getAttribute('data-nombre');
            const documento = opcion.getAttribute('data-documento');
            seleccionarCliente(this.value, nombre, documento);
        } else {
            document.getElementById('clienteSeleccionado').style.display = 'none';
            clienteSeleccionadoId = null;
        }
    });

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
    
    // Mostrar/ocultar sección según método de pago
    document.getElementById('metodoPago').addEventListener('change', function() {
        const seccionEfectivo = document.getElementById('seccionEfectivo');
        const seccionPagoMixto = document.getElementById('seccionPagoMixto');
    
        // Ocultar ambas secciones primero
        seccionEfectivo.style.display = 'none';
        seccionPagoMixto.style.display = 'none';
    
        // Mostrar según selección
        if (this.value === 'efectivo') {
            seccionEfectivo.style.display = 'block';
        } else if (this.value === 'mixto') {
            seccionPagoMixto.style.display = 'block';
            calcularPagoMixto();
        }
    });

// Calcular pago mixto en tiempo real
document.getElementById('montoPago1').addEventListener('input', calcularPagoMixto);
document.getElementById('montoPago2').addEventListener('input', calcularPagoMixto);
    
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

// Aplicar estilos forzados al contenedor de resultados
document.addEventListener('DOMContentLoaded', function() {
    const resultados = document.getElementById('resultadosBusqueda');
    
    // Aplicar estilos con cssText (máxima prioridad)
    resultados.style.cssText = `
        position: fixed !important;
        background: white !important;
        border: 1px solid #ddd !important;
        border-radius: 0.5rem !important;
        max-height: 300px !important;
        overflow-y: auto !important;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3) !important;
        z-index: 99999 !important;
        display: none !important;
        width: auto !important;
        min-width: 300px !important;
    `;
});

// Modificar función de búsqueda para posicionar el dropdown
function buscarProductos() {
    const termino = document.getElementById('buscarProducto').value.trim();
    const contenedor = document.getElementById('resultadosBusqueda');
    const input = document.getElementById('buscarProducto');
    
    // Si el término está vacío, ocultar
    if (termino.length < 2) {
        contenedor.style.display = 'none';
        contenedor.innerHTML = '';
        return;
    }
    
    // Posicionar el dropdown justo debajo del input
    const rect = input.getBoundingClientRect();
    contenedor.style.top = (rect.bottom + window.scrollY + 5) + 'px';
    contenedor.style.left = rect.left + 'px';
    contenedor.style.width = rect.width + 'px';
    
    // Realizar petición AJAX
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
        mostrarResultados(productos);
    })
    .catch(error => {
        console.error('Error al buscar productos:', error);
    });
}

// Función para mostrar resultados
function mostrarResultados(productos) {
    const contenedor = document.getElementById('resultadosBusqueda');
    
    if (productos.length === 0) {
        contenedor.innerHTML = '<div style="padding: 1rem; color: #666;">No se encontraron productos</div>';
        contenedor.style.display = 'block';
        return;
    }
    
    let html = '';
    productos.forEach(producto => {
        html += `
            <button type="button" 
                    onclick="agregarAlCarrito(${producto.id_producto}, '${producto.nombre}', ${producto.precio}, ${producto.stock})"
                    style="display: block; width: 100%; padding: 0.75rem 1rem; border: none; border-bottom: 1px solid #eee; background: white; cursor: pointer; text-align: left; transition: background 0.2s;"
                    onmouseover="this.style.background='#f7fafc'"
                    onmouseout="this.style.background='white'">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <strong style="color: #2d3748;">${producto.codigo}</strong>
                        <span style="color: #4a5568;"> - ${producto.nombre}</span>
                    </div>
                    <div>
                        <span style="background: #4a5568; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.875rem; margin-right: 0.5rem;">
                            ${formatearMoneda(producto.precio)}
                        </span>
                        <span style="background: #718096; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.875rem;">
                            Stock: ${producto.stock}
                        </span>
                    </div>
                </div>
            </button>
        `;
    });
    
    contenedor.innerHTML = html;
    contenedor.style.display = 'block';
}

// Función para mostrar recibo después de venta
function mostrarReciboVenta(datos) {
    console.log('Datos para recibo:', datos);
    
    if (!datos || !datos.datos_venta) {
        alert('✅ Venta guardada correctamente (Factura: ' + datos.numero_factura + ')');
        return;
    }
    
    const ventana = window.open('', 'Recibo', 'width=350,height=700');
    
    if (!ventana) {
        alert('✅ Venta guardada (Factura: ' + datos.numero_factura + ')\n\n⚠️ Permite ventanas emergentes para ver el recibo.');
        return;
    }
    
    // Generar líneas de productos con formato correcto
    let productosLineas = '';
    let numeroLinea = 1;
    
    datos.datos_venta.productos.forEach(prod => {
        const precioUnit = Number(prod.precio);
        const cantidad = Number(prod.cantidad);
        const descuento = Number(prod.descuento || 0);
        const subtotalLinea = (precioUnit * cantidad) - descuento;
        
        // Acortar nombre si es muy largo (máximo 20 caracteres)
        let nombreProducto = prod.nombre.toUpperCase();
        if (nombreProducto.length > 20) {
            nombreProducto = nombreProducto.substring(0, 20);
        }
        
        // Formatear cada columna con ancho fijo
        const col1 = String(numeroLinea).padStart(2, ' ');  // 2 caracteres
        const col2 = String(cantidad).padStart(2, ' ');      // 2 caracteres
        const col3 = 'UN';                                   // 2 caracteres
        const col4 = String(precioUnit.toLocaleString('es-CO')).padStart(8, ' '); // 8 caracteres
        const col5 = nombreProducto.padEnd(20, ' ');        // 20 caracteres
        const col6 = String(subtotalLinea.toLocaleString('es-CO')).padStart(8, ' '); // 8 caracteres
        const col7 = 'A';                                    // 1 caracter
        
        productosLineas += `${col1} ${col2} ${col3} ${col4} ${col5} ${col6} ${col7}\n`;
        numeroLinea++;
    });
    
    // Calcular totales
    const subtotal = Number(datos.datos_venta.subtotal);
    const descuento = Number(datos.datos_venta.descuento);
    const iva = Number(datos.datos_venta.iva);
    const total = Number(datos.datos_venta.total);
    const baseGravable = subtotal - descuento;
    
    // Fecha actual formateada
    const ahora = new Date();
    const fecha = `${ahora.getFullYear()}/${String(ahora.getMonth()+1).padStart(2,'0')}/${String(ahora.getDate()).padStart(2,'0')}`;
    const hora = `${String(ahora.getHours()).padStart(2,'0')}:${String(ahora.getMinutes()).padStart(2,'0')}:${String(ahora.getSeconds()).padStart(2,'0')}`;
    
    ventana.document.write(`
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Factura ${datos.numero_factura}</title>
    <style>
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        
        @page { 
            margin: 0; 
            size: 80mm auto; 
        }
        
        body {
            font-family: 'Courier New', 'Courier', monospace;
            font-size: 10px;
            line-height: 1.2;
            padding: 3mm;
            background: white;
            width: 80mm;
            margin: 0 auto;
        }
        
        .recibo {
            width: 100%;
        }
        
        .header {
            text-align: center;
            margin-bottom: 3mm;
            border-bottom: 1px dashed #000;
            padding-bottom: 3mm;
        }
        
        .empresa {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 2px;
        }
        
        .nit, .direccion { 
            font-size: 9px; 
            line-height: 1.3;
        }
        
        .factura-num {
            text-align: center;
            font-weight: bold;
            margin: 3mm 0;
            font-size: 11px;
        }
        
        .info-line {
            font-size: 9px;
            margin: 1px 0;
            word-wrap: break-word;
        }
        
        .separador {
            border-bottom: 1px dashed #000;
            margin: 2mm 0;
        }
        
        .productos {
            margin: 2mm 0;
        }
        
        .productos-header {
            font-weight: bold;
            font-size: 8px;
            margin-bottom: 1mm;
            white-space: pre;
            font-family: 'Courier New', monospace;
        }
        
        .producto-linea {
            font-size: 9px;
            white-space: pre;
            font-family: 'Courier New', monospace;
            line-height: 1.3;
        }
        
        .totales {
            margin-top: 2mm;
            font-size: 9px;
            border-top: 1px dashed #000;
            padding-top: 2mm;
        }
        
        .total-line {
            display: flex;
            justify-content: space-between;
            margin: 1mm 0;
        }
        
        .total-line span:first-child {
            flex: 1;
            text-align: left;
        }
        
        .total-line span:last-child {
            text-align: right;
            min-width: 60px;
        }
        
        .resumen-impuestos {
            margin: 2mm 0;
            padding: 2mm 0;
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            font-size: 8px;
        }
        
        .resumen-titulo {
            text-align: center;
            font-weight: bold;
            margin-bottom: 2mm;
        }
        
        .impuesto-header, .impuesto-line {
            display: flex;
            justify-content: space-between;
            margin: 1mm 0;
        }
        
        .impuesto-header {
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 1mm;
        }
        
        .impuesto-header > span,
        .impuesto-line > span {
            text-align: right;
            min-width: 50px;
        }
        
        .impuesto-header > span:first-child,
        .impuesto-line > span:first-child {
            text-align: left;
            min-width: 60px;
        }
        
        .footer {
            text-align: center;
            margin-top: 3mm;
            font-size: 8px;
            border-top: 1px dashed #000;
            padding-top: 2mm;
        }
        
        .footer-bold {
            font-weight: bold;
            margin-bottom: 2mm;
        }
        
        .botones {
            margin-top: 5mm;
            display: flex;
            gap: 3mm;
        }
        
        .btn {
            flex: 1;
            padding: 8px;
            border: 1px solid #333;
            background: #f0f0f0;
            cursor: pointer;
            font-size: 10px;
            border-radius: 3px;
            font-weight: bold;
            font-family: Arial, sans-serif;
        }
        
        .btn:hover {
            background: #e0e0e0;
        }
        
        @media print {
            .botones { 
                display: none !important; 
            }
            body { 
                padding: 0; 
            }
        }
    </style>
</head>
<body>
<div class="recibo">
    <!-- HEADER -->
    <div class="header">
        <div class="empresa">SISTEMA DE FACTURACION</div>
        <div class="nit">NIT 123456789-0</div>
        <div class="direccion">CR 19 23 64 PAIPA</div>
        <div class="direccion">TEL: 018000120201</div>
    </div>
    
    <!-- FACTURA -->
    <div class="factura-num">FACTURA: ${datos.numero_factura}</div>
    
    <div class="separador"></div>
    
    <!-- INFO -->
    <div class="info-line">Generacion: ${fecha} ${hora}</div>
    <div class="info-line">CLIENTE: ${datos.datos_venta.cliente}</div>
    <div class="info-line">FORMA DE PAGO: ${datos.datos_venta.metodo_pago.toUpperCase()}</div>
    
    <div class="separador"></div>
    
    <!-- PRODUCTOS -->
    <div class="productos">
        <div class="productos-header">MI CA UN   VALOR U DESCRIPCION           VALOR TO</div>
        <div class="producto-linea">${productosLineas}</div>
    </div>
    
    <!-- TOTALES -->
    <div class="totales">
        <div class="total-line">
            <span>TOTAL</span>
            <span>${total.toLocaleString('es-CO')}</span>
        </div>
        <div class="total-line">
            <span>FORMA DE PAGO: ${datos.datos_venta.metodo_pago.toUpperCase()}</span>
            <span>${total.toLocaleString('es-CO')}</span>
        </div>
        <div class="total-line">
            <span>CAMBIO</span>
            <span>0</span>
        </div>
    </div>
    
    <!-- RESUMEN IMPUESTOS -->
    <div class="resumen-impuestos">
        <div class="resumen-titulo">RESUMEN DE IMPUESTOS</div>
        <div class="impuesto-header">
            <span>ID</span>
            <span>TOTAL</span>
            <span>BASE</span>
            <span>IVA</span>
        </div>
        <div class="impuesto-line">
            <span>A = 19%</span>
            <span>${total.toLocaleString('es-CO')}</span>
            <span>${baseGravable.toLocaleString('es-CO')}</span>
            <span>${iva.toLocaleString('es-CO')}</span>
        </div>
    </div>
    
    <!-- FOOTER -->
    <div class="footer">
        <div class="footer-bold">¡GRACIAS POR SU COMPRA!</div>
        <div>SISTEMA SENA</div>
        <div>Factura Electronica de Venta</div>
        <div style="margin-top: 2mm;">Generado: ${fecha} ${hora}</div>
    </div>
    
    <!-- BOTONES -->
    <div class="botones">
        <button class="btn" onclick="window.print()">🖨️ IMPRIMIR</button>
        <button class="btn" onclick="window.close()">✓ CERRAR</button>
    </div>
</div>
</body>
</html>
    `);
    
    ventana.document.close();
}
</script>

<?php
// Incluye el footer
echo $this->include('layouts/footer');
?>