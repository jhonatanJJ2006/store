<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="admin__contenedor">
    <?php if(!empty($envios)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th-display" scope="col">Compras</th>
                    <th class="table__th" scope="col">Nombre</th>
                    <th class="table__th" scope="col">Teléfono</th>
                    <th class="table__th" scope="col">Email</th>
                    <th class="table__th" scope="col">Fecha</th>
                    <th class="table__th table__th--acciones" scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php
                $agrupados = [];
                foreach ($envios as $envio) {
                    $key = $envio->usuario_id . '-' . $envio->fecha;
                    if (!isset($agrupados[$key])) {
                        $agrupados[$key] = $envio;
                        $agrupados[$key]->telefonos = [$envio->telefono];
                    } else {
                        if (!in_array($envio->telefono, $agrupados[$key]->telefonos)) {
                            $agrupados[$key]->telefonos[] = $envio->telefono;
                        }
                    }
                }

                foreach ($agrupados as $envio) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php foreach($usuarios as $usuario) {

                                if($envio->usuario_id == $usuario->id) {                                    
                                    echo $usuario->nombre . ' ' . $usuario->apellido;
                                }
                                
                            } ?>

                        </td>
                        <td class="table__td">

                            <?php foreach($usuarios as $usuario) {

                                if($envio->usuario_id == $usuario->id) {                                    
                                    echo $usuario->telefono;
                                }

                            } ?>

                        </td>
                        <td class="table__td">

                            <?php foreach($usuarios as $usuario) {

                                if($envio->usuario_id == $usuario->id) {                                    
                                    echo $usuario->email;
                                }

                            } ?>

                        </td>
                        <td class="table__td">
                            <?php echo $envio->fecha ?>
                        </td>
                        <td class="table__td table__td--acciones">

                        <?php foreach($usuarios as $usuario) { 

                            if($envio->usuario_id == $usuario->id) { ?>
                                <a class="table__accion--editar" href="/admin/compras/informacion?id=<?php echo $usuario->id ?>&fecha=<?php echo $envio->fecha ?>">
                                    <i class="fa-solid fa-plus"></i>
                                    Ver Más
                                </a>

                                <div class="compra-eliminar table__accion--eliminar" href="/admin/compras/eliminar" data-usuario-id="<?php echo $usuario->id ?>" data-envio-fecha="<?php echo $envio->fecha ?>">
                                    Eliminar
                                </div>

                            <?php }

                        } ?>
                            
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay Compras Aún</p>
    <?php } ?>
</div>
