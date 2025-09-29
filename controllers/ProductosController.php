<?php

namespace Controllers;

use Classes\Paginacion;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Categoria;
use Model\Compra;
use Model\Oferta;
use Model\Producto;
use MVC\Router;

class ProductosController {

    public static function index(Router $router) {

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        $registros_por_pagina = 5;
        $total = Producto::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        
        if(!$pagina_actual || $pagina_actual < 1) {
            header('location: /admin/productos?page=1');
        }
        
        $productos = Producto::paginar($registros_por_pagina, $paginacion->offset());
        $ofertas = Oferta::all();

        $router->render('admin/productos/index', [
            'titulo' => 'Productos',
            'productos' => $productos,
            'ofertas' => $ofertas,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {

        $alertas = [];
        $producto = new Producto();
        $categorias = Categoria::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Procesar múltiples imágenes
            if(!empty($_FILES['imagenes']['tmp_name'][0])) {
                $carpeta_imagenes = '../public/build/img/productos';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $anchoDeseado = 800; // Define el ancho deseado
                $altoDeseado = 600;  // Define el alto deseado

                $imagenes_procesadas = [];
                $imagenes_webp = [];
                $imagenes_png = [];

                // Procesar cada imagen
                $total_imagenes = count($_FILES['imagenes']['tmp_name']);
                
                for($i = 0; $i < $total_imagenes; $i++) {
                    if($_FILES['imagenes']['error'][$i] === UPLOAD_ERR_OK) {
                        
                        // Generar nombre único para cada imagen
                        $nombre_imagen = md5(uniqid(rand(), true)) . '_' . $i;
                        
                        // Procesar imagen PNG
                        $imagen_png = Image::make($_FILES['imagenes']['tmp_name'][$i])
                                            ->resize($anchoDeseado, $altoDeseado, function ($constraint) {
                                                $constraint->aspectRatio(); // Mantiene la relación de aspecto
                                                $constraint->upsize();      // Evita que la imagen sea más grande que el tamaño original
                                            })
                                            ->encode('png', 80);

                        // Procesar imagen WebP
                        $imagen_webp = Image::make($_FILES['imagenes']['tmp_name'][$i])
                                            ->resize($anchoDeseado, $altoDeseado, function ($constraint) {
                                                $constraint->aspectRatio(); // Mantiene la relación de aspecto
                                                $constraint->upsize();      // Evita que la imagen sea más grande que el tamaño original
                                            })
                                            ->encode('webp', 80);

                        // Guardar las imágenes
                        $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                        $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");

                        // Agregar a la lista de imágenes procesadas
                        $imagenes_procesadas[] = $nombre_imagen;
                        $imagenes_png[] = $imagen_png;
                        $imagenes_webp[] = $imagen_webp;
                    }
                }

                // Convertir array de nombres a JSON para guardar en BD
                $_POST['imagenes'] = json_encode($imagenes_procesadas);
                
                // Si quieres mantener compatibilidad con el campo 'imagen' original
                // puedes usar la primera imagen como imagen principal
                if(!empty($imagenes_procesadas)) {
                    $_POST['imagen'] = $imagenes_procesadas[0]; // Primera imagen como principal
                }
            }

            $producto->sincronizar($_POST);

            // Validar
            $alertas = $producto->validar();

            // Guardar el registro
            if(empty($alertas)) {
                
                // Guardar en la base de datos
                $resultado = $producto->guardar();

                if($resultado) {
                    header('Location: /admin/productos');
                }
            }
        }

        $alertas = Producto::getAlertas();

        $router->render('admin/productos/crear', [
            'titulo' => 'Registrar Producto',
            'producto' => $producto,
            'categorias' => $categorias,
            'alertas' => $alertas
        ]);
    }

    public static function editar(Router $router) {

        $id = s($_GET['id']);
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $alertas = [];

        if(!$id) {
            header('Location: /admin/productos');
        }

        $producto = Producto::find($id);
        $categorias = Categoria::all();

        if(!$producto) {
            header('Location: /admin/productos');
        }

        $producto->imagen_Actual = $producto->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Leer Imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/build/img/productos';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }
                
                $anchoDeseado = 800; // Define el ancho deseado
                $altoDeseado = 600;  // Define el alto deseado

                // Procesar imagen PNG
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])
                                    ->resize($anchoDeseado, $altoDeseado, function ($constraint) {
                                        $constraint->aspectRatio(); // Mantiene la relación de aspecto
                                        $constraint->upsize();      // Evita que la imagen sea más grande que el tamaño original
                                    })
                                    ->encode('png', 80);

                // Procesar imagen WebP
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])
                                    ->resize($anchoDeseado, $altoDeseado, function ($constraint) {
                                        $constraint->aspectRatio(); // Mantiene la relación de aspecto
                                        $constraint->upsize();      // Evita que la imagen sea más grande que el tamaño original
                                    })
                                    ->encode('webp', 80);

                
                $nombre_imagen = md5(uniqid(rand(), true));
                
                $_POST['imagen'] = $nombre_imagen;
                
                unlink(__DIR__ . '/' . $carpeta_imagenes . '/' . $producto->imagen . '.png');
                unlink(__DIR__ . '/' . $carpeta_imagenes . '/' . $producto->imagen . '.webp');

            } else {
                $_POST['imagen'] = $producto->imagen_actual;
            }

            $producto->sincronizar($_POST);

            $alertas = $producto->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");    
                }

                $resultado = $producto->guardar();

                if($resultado) {
                    header('location: /admin/productos');
                }
            }
        }


        $router->render('admin/productos/editar', [
            'titulo' => 'Actualizar Producto',
            'producto' => $producto,
            'categorias' => $categorias,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $carpeta_imagenes = '../public/build/img/productos';
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);            

            if(!$id) {
                header('Location: /admin/productos');
            }

            $producto = Producto::find($id);

            if(isset($producto)) {
                header('Location: /admin/productos');
            }

            $compras = Compra::all();

            if($compras) {

                foreach($compras as $compra) {
    
                    if ($compra->producto_id === $producto->id && $compra->confirmado !== 1) {
                        $compra->eliminar();
                    }
    
                }

            }


            $resultado = $producto->eliminar();

            unlink(__DIR__ . '/' . $carpeta_imagenes . '/' . $producto->imagen . '.png');
            unlink(__DIR__ . '/' . $carpeta_imagenes . '/' . $producto->imagen . '.webp');

            if($resultado) {
                header('Location: /admin/productos');
            }
        }
    }
    
}