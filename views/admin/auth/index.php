<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="admin__contenedor-boton">
    <a class="admin__boton" href="/admin/imagenes/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Imagen
    </a>
</div>

<div class="admin__contenedor">
    <?php if(!empty($imagenes)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th-display" scope="col">Imagenes</th>
                    <th class="table__th table__th--ponentes" scope="col">Imagen</th>
                    <th class="table__th table__th--acciones" scope="col">Token</th>
                    <th class="table__th table__th--acciones" scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="table__tbody">                

                <?php foreach($imagenes as $imagen) { ?>
                    <tr class="table__tr">

                        <td class="table__td">
                            <div class="formulario__imagen">
                                <picture>
                                    <source srcset="<?php echo '/build/img/auth/' . trim($imagen->token) . '.webp'; ?>" type="image/webp">
                                    <source srcset="<?php echo '/build/img/auth/' . trim($imagen->token) . '.png'; ?>" type="image/png">
                                    <img class="formulario__imagen--table" src="<?php echo '/build/img/auth/' . trim($imagen->token) . '.png'; ?>" alt="Imagen Producto">
                                </picture>
                            </div>
                        </td>


                        <td class="table__td">
                            <?php echo $imagen->token ?? '' ?>
                        </td>

                        <td class="table__td--acciones">

                            <div class="table__td--flex">
    
                                <form class="table__formulario" action="/admin/imagenes/eliminar" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $imagen->id ?>">
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
        <p class="text-center">No hay Imagenes Aún</p>
    <?php } ?>    
</div>

<?php
    echo $paginacion;
?>