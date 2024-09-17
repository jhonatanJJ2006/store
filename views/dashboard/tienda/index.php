<?php include_once __DIR__ . '/../../templates/barra.php'; ?>

<main class="dashboard">

    <h2 class="auth__heading"><?php echo $titulo ?></h2>
    
    <div class="dashboard__wrapper">
    
        <?php foreach($productos as $producto) { ?>
            <div class="tarjeta">
                <div class="tarjeta__face tarjeta__front">
                    <picture>
                        <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.webp'?>" type="image/webp">
                        <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" type="image/png">
                        <img class="tarjeta__face" src="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" alt="Imagen producto">
                    </picture>
                    <div class="tarjeta__contenido">
                        <p class="tarjeta__texto"><?php echo $producto->nombre ?></p>
                        <p class="tarjeta__nombre">$ <?php echo $producto->precio ?></p>
                    </div>
                </div>

                <div class="tarjeta__face tarjeta__back">
                    <div class="tarjeta__face tarjeta__contenido tarjeta__bg"></div>
                    <p class="tarjeta__descripcion"><?php if(strlen($producto->descripcion) < 1000) {
                        echo $producto->descripcion;
                    } else {
                        echo substr($producto->descripcion, 0, 1000) . "...";
                    } ?></p>

                    <div class="tarjeta__botones">

                        <form class="table__carrito" method="POST">
                            <input type="hidden" name="producto" value="<?php echo $producto->id ?>">
                            <button class="admin__boton--carrucel4" type="submit">
                                <i class="fa-solid fa-cart-plus"></i>
                                Añadir a Carrito
                            </button>
                        </form>   
                        
                        <div class="table__carrito">
                            <a class="admin__boton--carrucel3" href="/tienda/producto?id=<?php echo $producto->id ?>">Ver Más</a>
                        </div>

                    </div>

                </div>
            </div>

        <?php } ?>
    
    </div>

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

