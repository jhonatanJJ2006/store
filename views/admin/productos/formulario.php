<style>
.formulario__campo {
    margin-bottom: 20px;
}

.formulario__label {
    display: block;
    margin-bottom: 8px;
    color: #E91E63;
    font-weight: 500;
    font-size: 14px;
}

.file-input-container {
    position: relative;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
}

.formulario__input--file {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
    overflow: hidden;
}

.file-input-button {
    display: inline-block;
    padding: 8px 16px;
    background-color: #f5f5f5;
    border: 1px solid #d0d0d0;
    border-radius: 4px;
    color: #333;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.file-input-button:hover {
    background-color: #e8e8e8;
    border-color: #b0b0b0;
}

.file-input-text {
    color: #333;
    font-size: 14px;
    font-weight: 400;
}

.selected-files-list {
    margin-top: 10px;
}

.file-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 12px;
    background-color: #f9f9f9;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    margin-bottom: 5px;
    font-size: 14px;
}

.file-name {
    color: #333;
    flex: 1;
}

.file-size {
    color: #666;
    font-size: 12px;
    margin-left: 10px;
}

.remove-file {
    background: none;
    border: none;
    color: #e74c3c;
    cursor: pointer;
    font-size: 16px;
    margin-left: 10px;
    padding: 0;
}

.remove-file:hover {
    color: #c0392b;
}

.file-count {
    color: #666;
    font-size: 12px;
    margin-top: 5px;
}
</style>

<fieldset class="formulario__fieldset">

    <legend class="formulario__legend">Información</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input class="formulario__input" id="nombre" type="text" placeholder="Nombre Producto" name="nombre" value="<?php echo $producto->nombre ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="descripcion">Descripción</label>
        <textarea class="formulario__input" placeholder="Una pequeña descripción del producto" name="descripcion" id="descripcion" rows="10"><?php echo $producto->descripcion ?? '' ?></textarea>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="imagenes">Imágenes</label>
        <div class="file-input-container">
            <input class="formulario__input formulario__input--file" id="imagenes" type="file" name="imagenes[]" accept="image/*" multiple>
            <label for="imagenes" class="file-input-button">Seleccionar archivos</label>
            <span class="file-input-text">Ningún archivo seleccionado</span>
        </div>
        <div class="selected-files-list" id="selected-files-list"></div>
    </div>

    <?php if($producto->imagen) { ?>
        <p class="formulario__label">Imagen Actual:</p>

        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.webp'?>" type="image/webp">
                <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" type="image/png">
                <img src="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" alt="Imagen producto">
            </picture>
        </div>
    <?php } ?>

    <div class="formulario__campo">
        <label class="formulario__label" for="precio">Precio Producto</label>
        <input class="formulario__input" id="precio" type="number" name="precio" placeholder="ejm. 80" min="0" value="<?php echo $producto->precio ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="cantidad">Cantidad Producto</label>
        <input class="formulario__input" id="cantidad" type="number" name="cantidad" placeholder="ejm. 80" min="0" value="<?php echo $producto->cantidad ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Categoria Producto</label>
        <select class="formulario__input" id="categoria" name="categoria_id">
            <option disabled selected>-- Categoria --</option>
            <?php foreach($categorias as $categoria) { ?>
                <option value="<?php echo $categoria->id ?>" <?php echo ($producto->categoria_id == $categoria->id) ? 'selected' : '' ?>><?php echo $categoria->nombre ?></option>
            <?php } ?>
        </select>
            
    </div>

</fieldset>

<script>
    document.getElementById('imagenes').addEventListener('change', function(e) {
        const textElement = document.querySelector('.file-input-text');
        const filesList = document.getElementById('selected-files-list');
        const files = e.target.files;
        
        // Limpiar lista anterior
        filesList.innerHTML = '';
        
        if (files.length > 0) {
            if (files.length === 1) {
                textElement.textContent = '1 archivo seleccionado';
            } else {
                textElement.textContent = files.length + ' archivos seleccionados';
            }
            
            // Mostrar lista de archivos seleccionados
            Array.from(files).forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                
                const fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                
                fileItem.innerHTML = `
                    <span class="file-name">${file.name}</span>
                    <span class="file-size">${fileSize}</span>
                    <button type="button" class="remove-file" onclick="removeFile(${index})">×</button>
                `;
                
                filesList.appendChild(fileItem);
            });
            
            // Mostrar contador de archivos
            const countElement = document.createElement('div');
            countElement.className = 'file-count';
            countElement.textContent = `Total: ${files.length} archivo(s) seleccionado(s)`;
            filesList.appendChild(countElement);
            
        } else {
            textElement.textContent = 'Ningún archivo seleccionado';
        }
    });

    function removeFile(index) {
        const input = document.getElementById('imagenes');
        const dt = new DataTransfer();
        const files = Array.from(input.files);
        
        files.splice(index, 1);
        
        files.forEach(file => {
            dt.items.add(file);
        });
        
        input.files = dt.files;
        
        // Disparar el evento change para actualizar la interfaz
        input.dispatchEvent(new Event('change'));
    }
</script>