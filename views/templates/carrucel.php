<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php 
        // Arreglo auxiliar para controlar las categorías mostradas
        $categoriasMostradas = [];
        
        foreach($productos as $producto) { 
            // Verificar si la categoría del producto ya fue mostrada
            if(!in_array($producto->categoria_id, $categoriasMostradas)) {
                // Agregar la categoría al arreglo de categorías mostradas
                $categoriasMostradas[] = $producto->categoria_id;
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

                        <div class="slide__secundario--telefono">
                            <div class="slide__descripcion">
                            <span class="slide__descripcion--bold">Descripción:</span> <br>
                            <?php
                            $descripcion = htmlspecialchars($producto->descripcion);
                            if (strlen($descripcion) > 300) {
                                $descripcion = substr($descripcion, 0, 300) . "...";
                            }
                            echo $descripcion;
                            ?>
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
                            <span class="slide__moneda">$</span> <?php echo htmlspecialchars($producto->precio); ?>
                        </div>
                    </div>

                </div>
            </div>
        <?php 
            } // Fin del if para verificar categoría mostrada
        } // Fin del foreach productos
        ?>
    </div>
</div>
