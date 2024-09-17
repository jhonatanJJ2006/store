<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<main class="dashboard">
    
    <?php include_once __DIR__ . '/../templates/carrucel.php'; ?>

    <?php include_once __DIR__ . '/../templates/categorias.php'; ?>

    <div class="dashboard__ventajas">

        <div class="dashboard__ventajas--contenido">

            <i class="dashboard__ventajas--icono fa-solid fa-wallet"></i>
            <p class="dashboard__centajas--texto">Pagos Seguros</p>

        </div>

        <div class="dashboard__ventajas--contenido">

            <i class="dashboard__ventajas--icono fa-solid fa-headphones"></i>
            <p class="dashboard__centajas--texto">Soporte en Linea</p>

        </div>

        <div class="dashboard__ventajas--contenido">

            <i class="dashboard__ventajas--icono fa-solid fa-truck"></i>
            <p class="dashboard__centajas--texto">Envios Seguros</p>

        </div>

    </div>

    <?php include_once __DIR__ . '/../templates/ofertas.php'; ?>

    <?php include_once __DIR__ . '/../templates/productos.php'; ?>

    <h1 style="font-size: 5rem; margin-top: 5rem;" class="auth__heading">Contactenos</h1>

    <form class="formulario-admin"  method="POST">

        <?php include_once __DIR__ . '/contacto.php' ?>
        
    </form>

    
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php 
if(isset($_SESSION['mensaje'])) { 
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);

    if($mensaje == 'Primero debe Iniciar Sesión') { ?>
        <script>
            Swal.fire({
                title: 'Primero debe Iniciar Sesión',
                icon: 'error',
                showConfirmButton: true,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/auth/login';
                }
            });
        </script>
    <?php } else if($mensaje == 'Producto sin Stock por el Momento') { ?>

        <script>
            Swal.fire({
                title: '<?php echo $mensaje; ?>',
                icon: 'error',
                showConfirmButton: true,
                allowOutsideClick: false
            }).then(() => {
                window.location.href = window.location.href;
            });
        </script>

    <?php } else { ?>
        <script>
            Swal.fire({
                title: '<?php echo $mensaje; ?>',
                icon: 'success',
                showConfirmButton: true,
                allowOutsideClick: false
            }).then(() => {
                window.location.href = window.location.href;
            });
        </script>
    <?php }
?>
<?php } ?>

