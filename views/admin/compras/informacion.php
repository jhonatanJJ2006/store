<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="admin__contenedor">

    <div class="admin__compras">

        <div class="admin__compras--productos">

            <?php
            foreach ($productos as $producto) {
                // Verifica si hay envíos para el producto actual
                if (isset($enviosAgrupados[$producto->id])) { ?>
                    <div class="admin__compras--producto">
                        <div class="formulario__imagen">
                            <picture>
                                <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.webp'?>" type="image/webp">
                                <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" type="image/png">
                                <img class="formulario__imagen--table" src="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" alt="Imagen Producto">
                            </picture>
                        </div>

                        <a class="admin__compras--enlace" href="/tienda/producto?id=<?php echo $producto->id ?>">                
                            <?php echo $producto->nombre ?>
                        </a>

                        <?php foreach ($categorias as $categoria) {
                            if ($categoria->id === $producto->categoria_id) { ?>
                                <a class="admin__compras--enlace" href="/categoria?id=<?php echo $categoria->id ?>"><?php echo $categoria->nombre ?></a>
                        <?php }
                        } ?>

                        <div>
                            <?php echo $enviosAgrupados[$producto->id]; // Muestra la cantidad total ?>
                        </div>
                    </div>
                <?php }
            }
            ?>

        </div>

        <div class="admin__compras--informacion">

            <h2 class="admin__compras--informacion-h2">Información de la Entrega</h2>

            <div>
                <h3 class="admin__compras--informacion-h3">Usuario</h3>
                <p class="admin__compras--informacion-p"><span class="admin__compras--informacion-span">Nombre:</span> <?php echo $usuario->nombre . ' ' . $usuario->apellido ?></p>
                <p class="admin__compras--informacion-p"><span class="admin__compras--informacion-span">Email:</span> <?php echo $usuario->email ?></p>
                <p class="admin__compras--informacion-p"><span class="admin__compras--informacion-span">Teléfono:</span> <?php echo $usuario->telefono ?></p>
            </div>

            <div class="admin__compras--informacion-contenido">
                <h3 class="admin__compras--informacion-h3">Datos de Entrega</h3>
                <p class="admin__compras--informacion-p"><span class="admin__compras--informacion-span">País:</span> <?php echo $envio->pais ?></p>
                <p class="admin__compras--informacion-p"><span class="admin__compras--informacion-span">Provincia:</span> <?php echo $envio->provincia ?></p>
                <p class="admin__compras--informacion-p"><span class="admin__compras--informacion-span">Ciudad:</span> <?php echo $envio->ciudad ?></p>
                <p class="admin__compras--informacion-p"><span class="admin__compras--informacion-span">Canton:</span> <?php echo $envio->canton ?></p>
                <p class="admin__compras--informacion-p"><span class="admin__compras--informacion-span">Calles:</span> <?php echo $envio->calles ?></p>
                <p class="admin__compras--informacion-p"><span class="admin__compras--informacion-span">Casa:</span> <?php echo $envio->casa ?></p>
            </div>

        </div>

    </div>

</div>
