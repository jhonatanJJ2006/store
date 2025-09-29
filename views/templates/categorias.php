<div class="dashboard__wrapper">
    <?php foreach($ultimosProductos as $ultimo) { ?>
        <div class="tarjeta" style="max-width: 20rem;">
            <div class="tarjeta__face tarjeta__front">
                <picture>
                    <source srcset="<?php echo '/build/img/productos/' . $ultimo->imagen . '.webp'?>" type="image/webp">
                    <source srcset="<?php echo '/build/img/productos/' . $ultimo->imagen . '.png'?>" type="image/png">
                    <img class="tarjeta__face" src="<?php echo '/build/img/productos/' . $ultimo->imagen . '.png'?>" alt="Imagen curso">
                </picture>
                <div class="tarjeta__contenido">
                    <?php foreach($categorias as $categoria) { 
                        if($ultimo->categoria_id == $categoria->id) { ?>
                            <p class="tarjeta__texto"><?php echo $categoria->nombre ?></p>
                        <?php }
                    } ?>
                </div>
            </div>
            <div class="tarjeta__face tarjeta__back">
                <div class="tarjeta__contenido tarjeta__centrar table__carrito">
                    <?php foreach($categorias as $categoria) { 
                        if($ultimo->categoria_id == $categoria->id) { ?>
                            <a class="table__accion--seleccionar" href="/categoria?id=<?php echo $categoria->id ?>">Acceder</a>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
