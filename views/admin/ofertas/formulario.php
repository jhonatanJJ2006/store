<fieldset class="formulario__fieldset">
    <legend class="formulario__legend"><?php echo $producto->nombre ?></legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="precio">Precio Actual del Producto</label>
        <p id="precioActual">$<?php echo $producto->precio ?></p>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="barraPorcentaje">Porcentaje</label>
        <input class="formulario__input" id="barraPorcentaje" type="range" min="0" max="100" value="<?php echo $oferta->oferta ?? '0' ?>" name="oferta">
        <span id="porcentajeSeleccionado"><?php echo $oferta->oferta ?? '0' ?>%</span>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="precioFinal">Precio Final:</label>
        <input class="formulario__input" id="precioFinal" type="text" readonly value="<?php echo isset($oferta->precio_final) ? number_format($oferta->precio_final, 2) : number_format($producto->precio - ($oferta->oferta ?? 0) / 100 * $producto->precio, 2) ?>">
    </div>

    <input type="hidden" id="porcentajeDescuento">
</fieldset>
    