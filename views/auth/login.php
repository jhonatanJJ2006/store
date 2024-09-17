<div class="auth__contenido">
    <h1 class="auth__heading"><?php echo $titulo ?></h1>
    <h2 class="auth__texto">Inicia Sesión en Sophia Store</h2>

    <?php
        include_once __DIR__ .  '/../templates/alertas.php';
    ?>

    <form class="formulario" method="POST">

        <div class="formulario__campo">
            <label class="formulario__label" for="email">Email</label>
            <input id="email" class="formulario__input" type="email" name="email" placeholder="Tu Email" value="<?php echo $usuario->email ?>">
        </div>
        
        <div class="formulario__campo">
            <label class="formulario__label" for="password">Password</label>
            <input id="password" class="formulario__input" type="password" name="password" placeholder="Tu Password">
        </div>

        <input class="auth__Btn" type="submit" value="Iniciar Sesión">
    </form>

    <div class="acciones">
        <a class="acciones__enlace" href="/auth/registro">¿Aún no Tienes un Cuenta? Crea una</a>
        <a class="acciones__enlace" href="/auth/olvide">¿Olvidaste tu password?</a>
    </div>

</div>

