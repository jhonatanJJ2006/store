<form class="formulario" method="POST">

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input id="nombre" class="formulario__input" type="text" name="nombre" placeholder="Tu Nombre">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input id="apellido" class="formulario__input" type="text" name="apellido" placeholder="Tu Apellido">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="email">Email</label>
        <input id="email" class="formulario__input" type="email" name="email" placeholder="Tu Email">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="password">Mensaje</label>
        <textarea id="mensaje" class="formulario__input" name="mensaje" cols="30" rows="10" placeholder="Un Pequeño Mensaje"></textarea>
    </div>

    <div id="enviarMensaje" class="auth__Btn">Enviar Mensaje</div>

</form>