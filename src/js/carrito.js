(function() {
    const botonesMas = document.querySelectorAll('.carrito__mas');
    const botonesMenos = document.querySelectorAll('.carrito__menos');
    const cantidades = document.querySelectorAll('.carrito__cantidad');
    const precios = document.querySelectorAll('.precio_final');
    const cajonTotal = document.querySelector('.pago_total');
    const camposFormulario = {
        pais: document.getElementById('pais'),
        provincia: document.getElementById('provincia'),
        ciudad: document.getElementById('ciudad'),
        canton: document.getElementById('canton'),
        calles: document.getElementById('calles'),
        casa: document.getElementById('casa'),
        nombre: document.getElementById('nombre'),
        apellido: document.getElementById('apellido'),
        telefono: document.getElementById('telefono')
    };
    const btnPaypal = document.querySelector('#paypal-button-container');

    // Función para validar los campos del formulario y detectar cuál está vacío
    function validarCamposFormulario() {

        for (let campo in camposFormulario) {
            if (camposFormulario[campo].value.trim() === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo vacío',
                    text: `El campo "${campo}" está vacío. Por favor, rellénalo.`,
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#d33',
                });
                return false; // Detener el proceso si hay un campo vacío
            }
        }
        return true; // Todos los campos están completos
    }

    function actualizarTotalCarrito() {
        let total = 0;

        precios.forEach(precio => {
            const precioValue = parseFloat(precio.textContent.replace('$ ', '').replace(',', '')) || 0;
            total += precioValue;
        });

        cajonTotal.textContent = `$ ${total.toFixed(2)}`;
        return total; // Para usar el total en el pago de PayPal
    }

    if (botonesMas) {
        botonesMas.forEach(e => {
            e.addEventListener('click', () => {
                let cantidadElem = e.previousElementSibling;
                let cantidad = parseInt(cantidadElem.textContent) || 1;
                let botonMasidentificador = e.getAttribute('data-identificador');
                cantidad++;

                const data = new FormData();
                data.append('id', botonMasidentificador);
                data.append('cantidad', cantidad);

                fetch('/carrito/comprobar', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(respuesta => {
                    if (respuesta) {
                        let $precioFinal = respuesta * cantidad;

                        cantidades.forEach(cantidadProducto => {
                            if (cantidadProducto.getAttribute('data-identificador') === botonMasidentificador) {
                                cantidadProducto.textContent = cantidad;
                            }
                        });

                        precios.forEach(precio => {
                            if (precio.getAttribute('data-identificador') === botonMasidentificador) {
                                precio.textContent = `$ ${$precioFinal.toFixed(2)}`;
                            }
                        });

                        actualizarTotalCarrito();
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Stock agotado',
                            text: 'No hay más de este producto en stock',
                            confirmButtonText: 'Entendido',
                            confirmButtonColor: '#3085d6',
                            timer: 3000
                        });
                    }
                })
                .catch(error => console.error('Hubo un problema con la petición fetch:', error));
            });
        });

        botonesMenos.forEach(e => {
            e.addEventListener('click', () => {
                let cantidadElem = e.nextElementSibling;
                let cantidad = parseInt(cantidadElem.textContent) || 1;
                if (cantidad > 1) {
                    let botonMenosidentificador = e.getAttribute('data-identificador');
                    cantidad--;

                    const data = new FormData();
                    data.append('id', botonMenosidentificador);
                    data.append('cantidad', cantidad);

                    fetch('/carrito/comprobar', {
                        method: 'POST',
                        body: data
                    })
                    .then(response => response.json())
                    .then(respuesta => {
                        if (respuesta) {
                            let $precioFinal = respuesta * cantidad;

                            cantidades.forEach(cantidadProducto => {
                                if (cantidadProducto.getAttribute('data-identificador') === botonMenosidentificador) {
                                    cantidadProducto.textContent = cantidad;
                                }
                            });

                            precios.forEach(precio => {
                                if (precio.getAttribute('data-identificador') === botonMenosidentificador) {
                                    precio.textContent = `$ ${$precioFinal.toFixed(2)}`;
                                }
                            });

                            actualizarTotalCarrito();
                        }
                    })
                    .catch(error => console.error('Hubo un problema con la petición fetch:', error));
                }
            });
        });

        if(btnPaypal) {

            paypal.Buttons({
                style: {
                    layout: 'vertical',
                    color:  'blue',
                    shape:  'rect',
                    label:  'paypal'
                },
                createOrder: function(data, actions) {
                    if (!validarCamposFormulario()) {
                        return; // Evita continuar con el pago si los campos no están completos
                    }
    
                    const total = actualizarTotalCarrito();
    
                    // Crear el pedido de PayPal
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: total.toFixed(2)
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    // Capturar el pago
                    return actions.order.capture().then(function(details) {
                        // Recopilar productos con su ID y cantidad
                        let productos = [];
                        cantidades.forEach(cantidadElem => {
                            let productoID = cantidadElem.getAttribute('data-identificador');
                            let cantidad = parseInt(cantidadElem.textContent) || 1;
                            productos.push({ id: productoID, cantidad: cantidad });
                        });
    
                        const data = new FormData();
                        data.append('orderID', details.id);
                        data.append('payerID', details.payer.payer_id);
                        data.append('productos', JSON.stringify(productos));
    
                        data.append('pais', camposFormulario.pais.value);
                        data.append('provincia', camposFormulario.provincia.value);
                        data.append('ciudad', camposFormulario.ciudad.value);
                        data.append('canton', camposFormulario.canton.value);
                        data.append('calles', camposFormulario.calles.value);
                        data.append('casa', camposFormulario.casa.value);
                        data.append('nombre', camposFormulario.nombre.value);
                        data.append('apellido', camposFormulario.apellido.value);
                        data.append('telefono', camposFormulario.telefono.value);
    
                        return fetch('/carrito/pagoExitoso', {
                            method: 'POST',
                            body: data
                        })
                        .then(response => response.json())
                        .then(result => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Compra realizada',
                                text: `Gracias por tu compra, ${details.payer.name.given_name}. El tiempo estimado de envío es de hasta 2 semanas.`,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6',
                                preConfirm: () => {
                                    window.location.href = '/';
                                }
                            });                        
                        })
                        .catch(error => {
                            console.error('Error en la confirmación del pago:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error en el pago',
                                text: 'Hubo un problema procesando tu pago. Intenta nuevamente.',
                                confirmButtonText: 'Entendido',
                                confirmButtonColor: '#d33'
                            });
                        });
                        
    
                    });
                },
            }).render('#paypal-button-container');

        }
    }
})();
