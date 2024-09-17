<h1 class="dashboard__h1">Ofertas</h1>

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php foreach($ofertas as $oferta) {
            // Buscar el producto correspondiente a esta oferta
            $producto = null;
            foreach($productos as $prod) {
                if ($prod->id == $oferta->producto_id) {
                    $producto = $prod;
                    break;
                }
            }
            if (!$producto) {
                continue; // Si no se encuentra el producto, pasar a la siguiente oferta
            }
            $precioInicial = $producto->precio;
            $porcentajeDescuento = $oferta->oferta;
            $precioConDescuento = $precioInicial - ($precioInicial * ($porcentajeDescuento / 100));
        ?>
        <div class="swiper-slide">
            <div class="swiper__contenedor">
                <div class="swiper__principal">

                    <?php foreach($categorias as $categoria) { 
                        if($producto->categoria_id == $categoria->id) { ?>
                            <h1 class="slide__nombre"><?php echo htmlspecialchars($producto->nombre); ?></h1>
                            <a href="/categoria?id=<?php echo $categoria->id ?>" class="slide__categoria"><?php echo htmlspecialchars($categoria->nombre); ?></a>
                        <?php }
                    } ?>

                    <div data-id="<?php echo $producto->id ?>" class="swiper__boton">
                        <i class="fa-solid fa-cart-plus"></i> Añadir a Carrito
                    </div>
                        
                    <a class="swiper__boton--2" href="/tienda/producto?id=<?php echo htmlspecialchars($producto->id); ?>">Ver Más</a>
                    
                    <div class="slide__secundario">

                        <p class="slide__secundario--telefono">
                            <div class="slide__descripcion">
                                <span class="slide__descripcion--bold">Precio Inicial:</span><span> $<?php echo htmlspecialchars($precioInicial); ?></span>
                            </div>
                        </p>
                        <p class="slide__secundario--telefono">
                            <div class="slide__descripcion">
                                <span class="slide__descripcion--bold">Descuento:</span><span> <?php echo htmlspecialchars($porcentajeDescuento); ?>%</span>
                            </div>
                        </p>
                        <p class="slide__secundario--telefono">
                            <div class="slide__descripcion">
                                <span class="slide__descripcion--bold">Precio con Descuento:</span><span> $<?php echo htmlspecialchars($precioConDescuento); ?></span>
                            </div>
                        </p>              
    
                        <div class="slide__secundario--telefono">
                            <div class="slide__descripcion">
                                <span class="slide__descripcion--bold">Descripción:</span> <br>
                                <?php
                                $descripcion = htmlspecialchars($producto->descripcion);
                                if (strlen($descripcion) > 100) {
                                    $descripcion = substr($descripcion, 0, 100) . "...";
                                }
                                echo $descripcion;
                                ?>
                            </div>
                        </div>

                    </div>

                        
                </div>

                <div class="swiper__imagen">
                    <picture>
                        <source srcset="<?php echo '/build/img/productos/' . htmlspecialchars($producto->imagen) . '.webp' ?>" type="image/webp">
                        <source srcset="<?php echo '/build/img/productos/' . htmlspecialchars($producto->imagen) . '.png' ?>" type="image/png">
                        <img class="slide__imagen--tamaño" src="<?php echo '/build/img/productos/' . htmlspecialchars($producto->imagen) . '.png' ?>" alt="Imagen Producto">
                    </picture>

                    <div class="slide__precio">
                        <span class="slide__moneda">$</span> <?php echo htmlspecialchars($precioConDescuento); ?>
                    </div>
                </div>
                    
            </div>
        </div>
        <?php } ?>
    </div>
</div>
