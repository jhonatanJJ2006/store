<?php include_once __DIR__ . '/../../templates/barra.php'; ?>

<main class="dashboard">
    
    <div class="dashboard__producto">
    
        <div class="dashboard__producto--imagen">

            <picture>
                <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.webp'?>" type="image/webp">
                <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" type="image/png">
                <img class="slide__imagen--tamaño" src="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" alt="Imagen Producto">
            </picture>
            
        </div>

        <div class="dashboard__producto--contenido">

            <h1 class="dashboard__producto--titulo"><?php echo $producto->nombre ?></h1>

            <a href="/categoria?id=<?php echo $categoria->id ?>"><p class="dashboard__producto--categoria"><?php echo $categoria->nombre ?></p></a>

            <div class="dashboard__producto--div">
                
                <?php if($oferta) { ?>

                    <div class="dashboard__producto--linea">

                        <div class="dashboard__producto--descuento">

                            <p>Precio Inicial: <span class="dashboard__producto--precio-d">$<?php echo $producto->precio ?></span></p>
                            
                            <p class="dashboard__producto--descuento-d">- <?php echo $oferta->oferta ?>%</p>                            
                    
                        </div>                      

                        <p>Precio Final: <span class="dashboard__producto--precio-t">$<?php echo $producto->precio - $total ?></span></p>

                    </div>

                    

                <?php } else { ?>
                                        
                    <p class="dashboard__producto--precio">$<?php echo $producto->precio ?></p>

                <?php } ?>

                <p class="dashboard__producto--categoria-d">Sobre el Artículo</p>

                <p><?php echo $producto->descripcion ?></p>

                <form class="dashboard__cursos--producto" method="POST">
                    <input type="hidden" name="producto" value="<?php echo $producto->id ?>">
                    <button class="admin__boton--carrucel" type="submit">
                        <i class="fa-solid fa-cart-plus"></i>
                        Añadir a Carrito
                    </button>
                </form>
                    
            </div>

        </div>

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

