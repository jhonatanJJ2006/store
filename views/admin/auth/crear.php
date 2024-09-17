<div class="dashboard__contenedor--formulario">
    <h2 class="dashboard__heading"><?php echo $titulo ?></h2> 
    
    <div class="admin__contenedor-boton">
        <a class="admin__boton" href="/admin/imagenes">
            &lt; Volver
        </a>
    </div>                

    <!-- Formulario que envía la imagen -->
    <form id="formulario-administrador" enctype="multipart/form-data">
        <div class="formulario-administrador__crear"></div>
        
        <div class="formulario-administrador__dropzone" id="dropzone">
            <i class="fa-solid fa-upload"></i>
            <p>Arrastra o selecciona una imagen</p>
            <!-- Asegúrate de que el ID sea el mismo que en el script -->
            <input type="file" id="imagen" accept="image/*" style="display: none;">
            <!-- Contenedor de vista previa de la imagen -->
            <img id="preview" style="display: none; width: 100%; height: 100%; object-fit: cover;" />
        </div>
        
        <!-- Botón para enviar el formulario -->
        <input class="btn btn-primary auth__boton auth__Btn" type="submit" value="Registrar Categoria">
    </form>
</div>
