(function() {
    document.addEventListener('DOMContentLoaded', () => {
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('imagen');
        const form = document.getElementById('formulario-administrador');
        const preview = document.getElementById('preview');

        if(dropzone) {

            // Abre el selector de archivos al hacer clic en el área de la dropzone
            dropzone.addEventListener('click', () => {
                fileInput.click();
            });
    
            // Manejando el arrastre y suelta de archivos
            dropzone.addEventListener('dragover', (event) => {
                event.preventDefault();
                dropzone.classList.add('dragging');
            });
    
            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('dragging');
            });
    
            dropzone.addEventListener('drop', (event) => {
                event.preventDefault();
                dropzone.classList.remove('dragging');
                const files = event.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files; // Asigna el archivo al input
                    showPreview(files[0]); // Muestra la vista previa de la imagen
                }
            });
    
            // Muestra la vista previa de la imagen seleccionada
            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    showPreview(file);
                }
            });
    
            // Función para mostrar la vista previa de la imagen
            function showPreview(file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = 'block'; // Muestra la imagen en el cuadro
                    dropzone.classList.add('has-image'); // Oculta el ícono y el texto
                };
                reader.readAsDataURL(file); // Lee la imagen como una URL de datos
            }
    
            // Envío del formulario con solo la imagen
            form.addEventListener('submit', (event) => {
                event.preventDefault();
    
                const formData = new FormData();
                const file = fileInput.files[0]; // Obtén solo el archivo
    
                if (file) {
                    formData.append('imagen', file); // Añade solo la imagen al FormData
                } else {
                    alert('No has seleccionado ninguna imagen');
                    return;
                }
    
                fetch('/admin/imagenes/nuevo', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
    
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Imagen subida exitosamente',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/admin/imagenes';
                    });
    
                })
                .catch(error => {
                    alert('Error al subir la imagen');
                    console.error(error);
                });
            });
            
        }

    });
})();
