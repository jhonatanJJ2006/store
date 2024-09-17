<div class="auth__contenido">

    <h2 class="auth__heading"><?php echo $titulo ?></h2>
    <p class="auth__texto">Tu Cuenta Sophia Store</p>

    <?php
        include_once __DIR__ . '/../templates/alertas.php';
    ?> 

    <?php if(isset($alertas['exito'])) { ?>

    <div class=" acciones acciones--centrar">
        <a class="auth__Btn" href="/auth/login">Inicias Sesión</a>
    </div>

    <?php } ?>

</div>