<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="admin__contenedor-boton">
    <a class="admin__boton" href="/admin/productos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Producto
    </a>
</div>

<div class="admin__contenedor">
    <?php if(!empty($productos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th-display" scope="col">Productos</th>
                    <th class="table__th" scope="col">Imagen</th>
                    <th class="table__th" scope="col">Nombre</th>
                    <th class="table__th" scope="col">Descripción</th>
                    <th class="table__th" scope="col">Precio</th>
                    <th class="table__th table__th--acciones" scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($productos as $producto) { ?>
                    <tr class="table__tr">

                        <td class="table__td">
                            <div class="formulario__imagen">
                                <picture>
                                    <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.webp'?>" type="image/webp">
                                    <source srcset="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" type="image/png">
                                    <img class="formulario__imagen--table" src="<?php echo '/build/img/productos/' . $producto->imagen . '.png'?>" alt="Imagen Producto">
                                </picture>
                            </div>
                        </td>

                        <td class="table__td">
                            <?php echo $producto->nombre ?? '' ?>
                        </td>

                        <td class="table__td">
                            <?php echo $producto->descripcion ?? '' ?>
                        </td>

                        <td class="table__td table__precio">
                            $ <?php echo $producto->precio ?? '' ?>
                        </td>

                        <td class="table__td--acciones" style="text-align: center;">
                            <div class="table__td--flex">    

                                <?php
                                $ofertaExistente = false; // Supongamos que no existe una oferta para el producto por defecto
                                foreach ($ofertas as $oferta) {
                                    if ($producto->id == $oferta->producto_id) {
                                        $ofertaExistente = true;
                                        break;
                                    }
                                }
                                ?>

                                <?php if ($ofertaExistente) : ?>
                                    <form class="table__formulario" action="/admin/productos/ofertas/eliminar?id=<?php echo $producto->id ?>" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $producto->id ?>">
                                        <button class="table__accion--eliminar" type="submit">
                                            <i class="fa-solid fa-tag"></i>
                                            Oferta
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <a class="table__accion--crear" href="/admin/productos/ofertas/crear?id=<?php echo $producto->id ?>">
                                        <i class="fa-solid fa-tag"></i>
                                        Oferta
                                    </a>
                                <?php endif; ?>

                                <!-- Otros enlaces -->

                                <a class="table__accion--editar" href="/admin/productos/editar?id=<?php echo $producto->id ?>">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar
                                </a>

                                <form class="table__formulario" action="/admin/productos/eliminar" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $producto->id ?>">
                                    <button class="table__accion--eliminar" type="submit">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Eliminar
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>    
        <p class="text-center">No hay Productos Aún</p>
    <?php } ?>    
</div>

<?php
    echo $paginacion;
?>
