<div class="auth__contenido">
    <h1 class="auth__heading"><?php echo $titulo ?></h1>
    <h2 class="auth__texto">Recupera tu Acceso a Sophia Store</h2>

    <?php
        include_once __DIR__ .  '/../templates/alertas.php';
    ?>

    <form class="formulario" method="POST">

        <div class="formulario__campo">
            <label class="formulario__label" for="email">Email</label>
            <input id="email" class="formulario__input" type="email" name="email" placeholder="Tu Email" value="<?php echo $usuario->email ?>">
        </div>

        <input class="auth__Btn" type="submit" value="Enviar Instrucciones">
    </form>

    <div class="acciones">
        <a class="acciones__enlace" href="/auth/login">¿Ya tienes cuenta? Inicia Sesión</a>
        <a class="acciones__enlace" href="/auth/registro">¿Aún no tienes cuenta? Obtener una</a>
    </div>
    
</div>