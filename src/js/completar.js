(function() {

    const completar = document.querySelectorAll('.compra-eliminar');

    if(completar) {

        completar.forEach(completa => {
            completa.addEventListener('click', function() {
                Swal.fire({
                    title: '¿Está seguro de eliminar el registro?',
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const datos = new FormData();
                        datos.append('id', completa.dataset.usuarioId);
                        datos.append('fecha', completa.dataset.envioFecha);

                        fetch('/admin/compras/eliminar', {
                            method: 'POST',
                            body: datos
                        })
                        .then( respuesta => respuesta.json() )
                        .then(resultado => {
                            if(resultado) {
                                window.location.href = '/admin/compras';
                            }
                        }) 
                    }
                });
            });
        });        
        
    }
  
})();
