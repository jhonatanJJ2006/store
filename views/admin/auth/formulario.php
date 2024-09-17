<fieldset class="formulario__fieldset">

    <legend class="formulario__legend">Información</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input class="formulario__input" id="nombre" type="text" placeholder="Nombre Categoria" name="nombre" value="<?php echo $categoria->nombre ?? '' ?>">
    </div>


</fieldset>
