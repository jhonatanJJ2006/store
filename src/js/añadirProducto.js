(function() {
    const añadirCarrito = document.querySelectorAll('.swiper__boton');

    if (añadirCarrito.length > 0) {
        añadirCarrito.forEach((e) => {
            e.addEventListener('click', () => {
                let id = e.getAttribute('data-id');

                let data = new FormData();
                data.append('id', id);

                fetch('/carrito/nuevoProducto', {
                    method: 'POST',
                    body: data
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la red');
                    }
                    return response.json();
                })
                .then(producto => {
                    if (producto.exito) {
                        Swal.fire({
                            title: 'Éxito',
                            text: producto.mensaje,
                            icon: 'success'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });                        
                    } else {
                        console.log(producto.mensaje); // Producto ya Añadido o sin stock
                        Swal.fire('Aviso', producto.mensaje, 'warning');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Hubo un problema al añadir el producto', 'error');
                });
            });
        });
    }
})();
