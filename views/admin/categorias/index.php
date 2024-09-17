<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="admin__contenedor-boton">
    <a class="admin__boton" href="/admin/categorias/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Categoria
    </a>
</div>

<div class="admin__contenedor">
    <?php if(!empty($categorias)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th-display" scope="col">Categoria</th>
                    <th class="table__th table__th--ponentes" scope="col">Nombre</th>
                    <th class="table__th table__th--acciones" scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($categorias as $categoria) { ?>
                    <tr class="table__tr">

                        <td class="table__td">
                            <?php echo $categoria->nombre ?? '' ?>
                        </td>

                        <td class="table__td--acciones">

                            <div class="table__td--flex">

                                <a class="table__accion--editar" href="/admin/categorias/editar?id=<?php echo $categoria->id ?>">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar
                                </a>
    
                                <form class="table__formulario" action="/admin/categorias/eliminar" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $categoria->id ?>">
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
        <p class="text-center">No hay categorias Aún</p>
    <?php } ?>    
</div>

<?php
    echo $paginacion;
?>