<?php include_once __DIR__ . '/../../templates/barra.php'; ?>

<div class="dashboard">
    
    <h2 class="auth__heading"><?php echo $titulo ?></h2>
    
    <a class="dashboard__telefono" href="https://api.whatsapp.com/send?phone=593985930530"><li><i class="fa-brands fa-whatsapp"></i> Watsap</li></a>

    <?php include_once __DIR__ . '/../../templates/alertas.php' ?>

    <form class="formulario-admin" method="POST">

        <?php include_once __DIR__ . '/../contacto.php' ?>

    </form>

</div>
