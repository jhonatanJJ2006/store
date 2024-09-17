<?php foreach($categorias as $categoria) { ?>

<?php
// Verificar si hay productos en esta categoría
$productosEnCategoria = array_filter($productos, function($producto) use ($categoria) {
    return $producto->categoria_id == $categoria->id;
});
?>

<?php if (!empty($productosEnCategoria)) { ?>
    <h1 class="dashboard__heading"><?php echo $categoria->nombre ?></h1>

    <div class="dashboard__wrapper">
        <?php foreach($productos as $producto) { 
            if($producto->categoria_id == $categoria->id) { ?>
                <div class="tarjeta">
                    <div class="tarjeta__face tarjeta__front">
                        <picture>
                            <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.webp'?>" type="image/webp">
                            <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" type="image/png">
                            <img class="tarjeta__face" src="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" alt="Imagen producto">
                        </picture>
                        <div class="tarjeta__contenido">
                            <p class="tarjeta__texto"><?php echo $producto->nombre ?></p>
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
        <?php } ?>
    </div>
<?php } ?>

<?php } ?>
