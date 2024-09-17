<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Intervention\Image\ImageManagerStatic as Image;
use MVC\Router;

class CategoriasController {
    
    public static function index(Router $router) {

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        $registros_por_pagina = 5;
        $total = Categoria::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        
        if(!$pagina_actual || $pagina_actual < 1) {
            header('location: /admin/categorias?page=1');
        }
        
        $categorias = Categoria::paginar($registros_por_pagina, $paginacion->offset());

        $router->render('admin/categorias/index', [
            'titulo' => 'Categorias',
            'categorias' => $categorias,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {

        $alertas = [];
        $categoria = new Categoria();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $categoria->sincronizar($_POST);
            $alertas = $categoria->validar();

            if(empty($alertas)) {
                $resultado = $categoria->guardar();

                if($resultado) {
                    header('Location: /admin/categorias');
                }
            }

        }

        $alertas = Categoria::getAlertas();

        $router->render('admin/categorias/crear', [
            'titulo' => 'Registrar Categoria',
            'categoria' => $categoria,
            'alertas' => $alertas
        ]);
    }

    public static function editar(Router $router) {

        $id = s($_GET['id']);
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Locatio: /admin/categorias');
        }

        $categoria = Categoria::find($id);

        if(!$categoria) {
            header('Location: /admin/categorias');
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $categoria->sincronizar($_POST);
            $alertas = $categoria->validar();

            if(empty($alertas)) {
                $resultado = $categoria->guardar();

                if($resultado) {
                    header('Location: /admin/categorias');
                }
            }

        }

        $alertas = Categoria::getAlertas();

        $router->render('admin/categorias/editar', [
            'titulo' => 'Actualizar Categoria',
            'categoria' => $categoria,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if(!$id) {
                header('Location: /admin/categorias');
            }
            
            $categoria = Categoria::find($id);
    
            if(!$categoria) {
                header('Location: admin/categorias');
            }
    
            $resultado = $categoria->eliminar();
    
            if($resultado) {
                header('Location: /admin/categorias');
            }
        }
    }
}