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
        <label class="formulario__label" for="imagen">Imagen</label>
        <input class="formulario__input formulario__input--file" id="imagen" type="file" name="imagen">
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