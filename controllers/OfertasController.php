<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Oferta;
use Model\Producto;
use MVC\Router;

class OfertasController {
    
    public static function crear(Router $router) {

        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        if(!$id) {
            header('Location: /admin/productos');
        }

        $producto = Producto::find($id);

        if(!$producto) {
            header('Location: /admin/productos');
        }

        $oferta = Oferta::where('producto_id', $id);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!$oferta) {
                $oferta = new Oferta;
            }
            $_POST['producto_id'] = $id;
            $oferta->sincronizar($_POST);
            $alertas = $oferta->validar();

            if(empty($alertas)) {
                $resultado = $oferta->guardar();

                if($resultado) {
                    header('Location: /admin/productos');
                }
            }
        }

        $router->render('admin/ofertas/crear', [
            'titulo' => 'Nueva Oferta',
            'producto' => $producto,
            'oferta' => $oferta
        ]);
    }

    public static function eliminar() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];

            $oferta = Oferta::where('producto_id', $id);
            $resultado = $oferta->eliminar();

            if($resultado) {
                header('Location: /admin/productos');
            }
        }
    }
}
