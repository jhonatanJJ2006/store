document.addEventListener('DOMContentLoaded', function() {
    const enviarMensaje = document.getElementById('enviarMensaje');

    if (enviarMensaje) {
        enviarMensaje.addEventListener('click', function() {
            // Obtener los datos del formulario
            const nombre = document.getElementById('nombre').value;
            const apellido = document.getElementById('apellido').value;
            const email = document.getElementById('email').value;
            const mensaje = document.getElementById('mensaje').value;

            // Verificar si los campos están vacíos
            if (!nombre || !apellido || !email || !mensaje) {
                Swal.fire({
                    title: "Todos los campos son requeridos",
                    icon: "error"
                });
                return; // Detener el proceso si algún campo está vacío
            }

            // Enviar los datos por AJAX
            fetch('/contacto', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    nombre: nombre,
                    apellido: apellido,
                    email: email,
                    mensaje: mensaje
                }),
            })
            .then(response => response.json())
            .then(data => {
                let title = "Email Enviado Correctamente";
                let icon = "success";

                if (data.message) {
                    title = data.message;
                    icon = "success";

                } else {
                    Swal.fire({
                        title: title,
                        icon: icon,
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed && icon === "success") {
                            window.location.href = '/contacto';
                        }
                    });
                }

            })
        });
    }

});
