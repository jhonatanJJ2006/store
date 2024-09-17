<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sophia Store - <?php echo $titulo; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Comfortaa:wght@300..700&family=Julius+Sans+One&family=Outfit:wght@100..900&family=Rancho&family=Sacramento&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/build/css/app.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo $_ENV['CLIENT_ID'] ?>"></script>
</head>

<body>

    <div class="barra">

        <div class="barra__sitios">

            <a href="/">
                <h1 class="auth__heading barra__heading">Sophia Store</h1>
            </a>

            <div class="barra__sitios--gap">
                <a class="barra__sitios--enlace barra__display <?php echo pagina_actual('/') && $_SERVER['REQUEST_URI'] === '/' ? 'barra__sitios--actual' : '' ?>" href="/">
                    <i class="fa-solid fa-house"></i>
                    Inicio
                </a>
                <a class="barra__sitios--enlace barra__display <?php echo pagina_actual('/tienda') ? 'barra__sitios--actual' : '' ?>" href="/tienda">
                    <i class="fa-solid fa-bag-shopping"></i>
                    Tienda
                </a>
                <a class="barra__sitios--enlace barra__display <?php echo pagina_actual('/contacto') ? 'barra__sitios--actual' : '' ?>" href="/contacto">
                    <i class="fa-solid fa-envelope"></i>
                    Contacto
                </a>
            </div>



        </div>

        <div class="barra__acciones">

            <?php if(is_auth()) { ?>
                <form class="barra__acciones--eliminar" action="/logout" method="POST">
                    <button class="barra__acciones--tamaño table__accion--eliminar" type="submit">
                        Logout
                    </button>
                </form>      

                <a class="barra__acciones--tamaño barra__sitios--actual carrito__contenedor" href="/carrito">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <?php 
                    if($compras) { ?>
                        <div id="numero" class="carrito__contador"><?php echo count($compras) ?></div>
                    <?php } ?>
                </a>
                
            <?php } else { ?>
                <div class="barra__sitios--enlace">
                    <a class="barra__comprobar barra__acciones--tamaño barra__sitios--actual" href="/auth/registro">Registrate</a>
                </div>    
                <div class="barra__sitios--enlace">
                    <a class="barra__comprobar barra__acciones--tamaño barra__sitios--actual" href="/auth/login">Iniciar Sesión</a>
                </div> 
            <?php } ?>

            <div id="menu" class="barra__acciones--tamaño barra__menu"><i class="fa-solid fa-bars"></i></i></div>

        </div>


    </div>

    <div class="barra__movil">

        <div class="barra__movil--acciones">

            <a class="barra__movil--h1" href="/">
                <h1 class="auth__heading barra__heading">Sophia Store</h1>
            </a>
        
            <div class="barra__movil--x">
                <i class="fa-solid fa-x"></i>
            </div>

        </div>

        <div class="barra__movil--enlaces">

            <a class="barra__movil--enlace <?php echo pagina_actual('/') && $_SERVER['REQUEST_URI'] === '/' ? 'barra__movil--actual' : '' ?>" href="/">
                <i class="fa-solid fa-house"></i>
                Inicio
            </a>
            <a class="barra__movil--enlace <?php echo pagina_actual('/tienda') ? 'barra__movil--actual' : '' ?>" href="/tienda">
                <i class="fa-solid fa-bag-shopping"></i>
                Tienda
            </a>
            <a class="barra__movil--enlace <?php echo pagina_actual('/contacto') ? 'barra__movil--actual' : '' ?>" href="/contacto">
                <i class="fa-solid fa-envelope"></i>
                Contacto
            </a>
            
        </div>

        <div class="barra__movil--redes">

            <h3 class="barra__movil--h3">Siguenos en:</h3>

            <a class="footer__redes--enlace" href="https://www.facebook.com/SophiaStoreEC"><i class="fa-brands fa-youtube"></i>Facebook</a>
            <a class="footer__redes--enlace" href="https://www.instagram.com/sophiastoreec?igsh=MW0wYXR0eDRobm03MQ=="><i class="fa-brands fa-instagram"></i></i>Instagram</a>
            <a class="footer__redes--enlace" href="https://t.me/MichaelArcangelus"><i class="fa-brands fa-telegram"></i>Telegram</a>
        
        </div>

        <?php if(is_auth()) { ?>

            <div class="barra__movil--auth">

                <form action="/logout" method="POST">
                    <button class="barra__movil--logout" type="submit">
                        Logout
                    </button>
                </form>    
                
            </div>

        <?php } else { ?>

            <div class="barra__movil--auth">

                <div class="barra__movil--auth-acciones">

                    <a class="barra__movil--accion" href="/auth/registro">Registrate</a>
                    <a class="barra__movil--accion" href="/auth/login">Iniciar Sesión</a>

                </div>
            
            </div>

        <?php } ?>

    </div>

    <div class="barra__opacidad"></div>

    <main class="dashboard">

        <h2 class="auth__heading"><?php echo $titulo ?></h2>
    
        <div class="carrito">
            <div class="carrito__grid">
                <div class="carrito__productos">
                    <h1 class="carrito__h3">Sus productos</h1>
        
                    <?php
                    $total = 0;
                    foreach ($productos as $producto) {
                        $precioFinal = $producto->precio;
                        foreach ($ofertas as $oferta) {
                            if ($oferta->producto_id === $producto->id) {
                                // Aplicar descuento
                                $precioFinal -= ($precioFinal * ($oferta->oferta / 100));
                            }
                        }
                        $total += $precioFinal;
                    ?>
                        <div class="carrito__tarjeta">
                            <picture class="carrito__tarjeta--posicion">
                                <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.webp' ?>" type="image/webp">
                                <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.png' ?>" type="image/png">
                                <img class="carrito__imagen" src="<?php echo '/build/img/productos/' . $producto->imagen . '.png' ?>" alt="Imagen producto">
                            </picture>
        
                            <div class="carrito__descripcion">
                                <div class="carrito__descripcion--caracteristicas">
                                    <p class="carrito__descripcion--nombre"><?php echo $producto->nombre ?></p>
                                </div>
        
                                <div class="carrito__descripcion--caracteristicas">
                                    <form class="carrito__descripcion--cantidad" method="POST">
        
                                        <div data-identificador="<?php echo $producto->id ?>" class="carrito__menos">
                                            <i class="fa-solid fa-minus"></i>
                                        </div>
                                        <div data-identificador="<?php echo $producto->id ?>" class="carrito__cantidad">
                                            1
                                        </div>
                                        <div data-identificador="<?php echo $producto->id ?>" class="carrito__mas">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
        
                                    </form>
                                </div>
        
                                <div class="carrito__descripcion--precio">
                                    <p class="precio_final" data-identificador="<?php echo $producto->id ?>">$ <?php echo number_format($precioFinal, 2, '.', '') ?></p>
                                    
                                    <form action="/carrito-eliminar" method="POST">
                                        <input type="hidden" name="producto_id" value="<?php echo $producto->id ?>">
                                        <button class="carrito__descripcion--eliminar" type="submit">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
        
                    <?php if (empty($productos)) { ?>
                        <p class="carrito__descripcion--nombre carrito__descripcion--centrar">No hay Ningun Producto por el Momento</p>
                    <?php } ?>
                </div>
        
                <div class="carrito__pago">
                    <div class="formulario-admin">
        
                        <fieldset class="formulario-admin__fieldset">
                            <legend class="formulario-admin__legend">Confirmar Compra</legend>
                            <div class="formulario-admin__campo">
                                <label class="formulario-admin__label--contacto" for="cantidad">Total a Pagar</label>
                                <div class="formulario__monto">
                                    <div class="formulario__monto--opcion"><p class="codepen-button"><span class="pago_total">$ <?php echo number_format($total, 2, '.', '') ?></span></p></div>
                                    <input id="total" type="hidden" value="<?php echo $total ?>">
                                </div>
                            </div>
                        </fieldset>
        
                    </div>
        
                    <form class="formulario-admin__gap" method="POST">
        
                        <?php include_once __DIR__ . '/../../templates/alertas.php' ?>
        
                        <div class="formulario-admin">
        
                            <fieldset class="formulario-admin__fieldset">
                                
                                <legend class="formulario-admin__lengend">Datos de Entrega</legend>
        
                                <div class="formulario-admin__campo">
                                    <label class="formulario-admin__label--contacto" for="pais">País</label>
                                    <input class="formulario__input" id="pais" type="text" name="pais" placeholder="País de Residencia">
                                </div>
        
                                <div class="formulario-admin__campo">
                                    <label class="formulario-admin__label--contacto" for="provincia">Provincia</label>
                                    <input class="formulario__input" id="provincia" type="text" name="provincia" placeholder="Provincia de Residencia">
                                </div>
        
                                <div class="formulario-admin__campo">
                                    <label class="formulario-admin__label--contacto" for="ciudad">Ciudad</label>
                                    <input class="formulario__input" id="ciudad" type="text" name="ciudad" placeholder="Ciudad de Residencia">
                                </div>
        
                                <div class="formulario-admin__campo">
                                    <label class="formulario-admin__label--contacto" for="canton">Canton</label>
                                    <input class="formulario__input" id="canton" type="text" name="canton" placeholder="Canton de Residencia">
                                </div>
        
                                <div class="formulario-admin__campo">
                                    <label class="formulario-admin__label--contacto" for="calles">Calles</label>
                                    <input class="formulario__input" id="calles" type="text" name="calles" placeholder="Calles de Residencia">
                                </div>
        
                                <div class="formulario-admin__campo">
                                    <label class="formulario-admin__label--contacto" for="casa">Casa</label>
                                    <input class="formulario__input" id="casa" type="number" name="casa" placeholder="Número de Casa">
                                </div>
        
                                <input id="monto" type="hidden" value="<?php echo $total ?>">
        
                            </fieldset>
        
                        </div>
        
                        <div class="formulario-admin">
        
                            <fieldset class="formulario-admin__fieldset">
        
                                <legend class="formulario-admin__legend">Datos de Destinatario</legend>
        
                                <div class="formulario-admin__campo">
                                    <label class="formulario-admin__label--contacto" for="nombre">Nombre</label>
                                    <input class="formulario__input" id="nombre" type="text" name="nombre" placeholder="Nombre de Destinatario">
                                </div>
        
                                <div class="formulario-admin__campo">
                                    <label class="formulario-admin__label--contacto" for="apellido">Apellido</label>
                                    <input class="formulario__input" id="apellido" type="text" name="apellido" placeholder="Apellido de Destinatario">
                                </div>
        
                                <div class="formulario-admin__campo">
                                    <label class="formulario-admin__label--contacto" for="telefono">Teléfono</label>
                                    <input class="formulario__input" id="telefono" type="text" name="telefono" placeholder="Teléfono de Destinatario">
                                </div>
        
                            </fieldset>
        
        
                        </div>
        
                        <div id="paypal-button-container"></div>
                        <p id="result-message"></p>
        
                    </form>
                    
                </div>
            </div>
        </div>
            
    </main>
    



    <?php 
        if(isset($_SESSION['mensaje'])) { 
            $mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);

            if($mensaje) { ?>
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
        }
    ?>

</body>





