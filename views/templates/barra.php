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

        <?php if (is_admin()) { ?>

            <a class="barra__movil--enlace <?php echo pagina_actual('/admin/dashboard') ? 'barra__movil--actual' : '' ?>" href="/admin/dashboard">
                <i class="fa-solid fa-user"></i>
                Admin
            </a>

        <?php } ?>
        
    </div>

    <div class="barra__movil--redes">

        <h3 class="barra__movil--h3">Siguenos en:</h3>

        <a class="footer__redes--enlace" href="https://www.facebook.com/SophiaStoreEC"><i class="fa-brands fa-facebook"></i></i>Facebook</a>
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
