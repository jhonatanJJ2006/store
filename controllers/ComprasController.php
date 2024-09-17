<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Envio;
use Model\Producto;
use Model\Usuario;
use MVC\Router;

class ComprasController {
    
    public static function index(Router $router) {

        $usuarios = Usuario::all();
        
        $envios = Envio::all();

        $router->render('admin/compras/index', [
            'titulo' => 'Registro de Compras',
            'envios' => $envios,
            'usuarios' => $usuarios,
        ]);
    }

    public static function informacion(Router $router) {
        $id = s($_GET['id']);
        $fecha = s($_GET['fecha']);
    
        if (!$id || !$fecha) {
            header('Location: /admin/compras');
            exit;
        }
    
        $envios = Envio::whereDoble('usuario_id', $id, 'fecha', $fecha);
        $envio = Envio::whereDoble('usuario_id', $id, 'fecha', $fecha);
        $envio = reset($envio);
    
        // Agrupar envíos por producto_id y sumar las cantidades
        $enviosAgrupados = [];
    
        foreach ($envios as $envio) {
            if (!isset($enviosAgrupados[$envio->producto_id])) {
                $enviosAgrupados[$envio->producto_id] = 0;
            }
            $enviosAgrupados[$envio->producto_id] += $envio->cantidad;
        }
    
        $categorias = Categoria::all();
        $productos = Producto::all();
        $usuario = Usuario::find($id);
    
        $router->render('admin/compras/informacion', [
            'titulo' => 'Envios Pendientes',
            'enviosAgrupados' => $enviosAgrupados,
            'categorias' => $categorias,
            'usuario' => $usuario,
            'productos' => $productos,
            'envio' => $envio
        ]);
    }    
    
    public static function eliminar() {        

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datos = $_POST;

            $id = $datos['id'];
            $fecha = $datos['fecha'];

            $envios = Envio::whereDoble('usuario_id', $id, 'fecha', $fecha);

            try {

                foreach($envios as $envio) {
                    $resultado = $envio->eliminar();
                }
                echo json_encode($resultado);

            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }

        }
    }
}