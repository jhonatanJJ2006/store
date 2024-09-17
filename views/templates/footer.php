<footer class="footer">

    <div class="footer__contenedor">

        <div class="footer__block">

            <div>

                <div>
                    <h3 class="dashboard__h2" style="margin: 0 auto 3rem auto; padding-top:3rem;" class="dashboard__h3">Nuestras Redes</h3>
                    <div class="footer__redes">
                        <a class="footer__redes--enlace" href="https://www.facebook.com/SophiaStoreEC"><i class="fa-brands fa-facebook"></i></i>Facebook</a>
                        <a class="footer__redes--enlace" href="https://www.instagram.com/sophiastoreec?igsh=MW0wYXR0eDRobm03MQ=="><i class="fa-brands fa-instagram"></i></i>Instagram</a>
                        <a class="footer__redes--enlace" href="https://t.me/MichaelArcangelus"><i class="fa-brands fa-telegram"></i>Telegram</a>
                    </div>
                </div>

            </div>

            <div class="footer__nav">
                <div style="padding: .5rem;" class="barra__sitios--footer">
                    <a class="footer__sitios <?php echo pagina_actual('/') ? '' : 'footer__sitios--actual' ?>" href="/">
                        <i class="fa-solid fa-house"></i>
                        home
                    </a>
                    <a class="footer__sitios <?php echo pagina_actual('/tienda') ? 'footer__sitios--actual' : '' ?>" href="/tienda">Tienda</a>
                    <a class="footer__sitios <?php echo pagina_actual('/contacto') ? 'footer__sitios--actual' : '' ?>" href="/contacto">Contacto</a>
                </div>
            </div>

            <div class="footer__permisos">Copyright © <?php echo date('Y') ?> Sophia Store – Desarrollado por<a class="footer__enlace" href="https://detcomputers.com">Det Computers</a></div>

        </div>

    </div>

</footer>

<style>
    .footer__redes {
        display:block;
        text-align:center;
    }

    @media only screen and (min-width: 768px) {
        .footer__redes {
            display: flex;
            justify-content: space-between;
        }
    }
</style>