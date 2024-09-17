<?php

namespace Controllers;

use Classes\Paginacion;
use Model\ImagenAuth;
use Intervention\Image\ImageManagerStatic as Image;
use Exception;
use MVC\Router;

class AdminController {
    
    public static function index(Router $router) {
        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administración'
        ]);
    }

    public static function imagenes(Router $router) {

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        $registros_por_pagina = 5;
        $total = ImagenAuth::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        
        if(!$pagina_actual || $pagina_actual < 1) {
            header('location: /admin/imagenes?page=1');
        }
        
        $imagenes = ImagenAuth::paginar($registros_por_pagina, $paginacion->offset());

        $router->render('admin/auth/index', [
            'titulo' => 'Images Auth',
            'imagenes' => $imagenes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function imagenesCrear(Router $router) {
        $alertas = [];        
    
        // Obtener las alertas para mostrar en la vista
        $alertas = ImagenAuth::getAlertas();
    
        // Renderizar la vista
        $router->render('admin/auth/crear', [
            'titulo' => 'Registrar Imagen',
            'alertas' => $alertas
        ]);
    }      

    public static function imagenesNuevo() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $carpeta_imagenes = '../public/build/img/auth';
    
            // Crear la carpeta si no existe
            if (!is_dir($carpeta_imagenes)) {
                if (mkdir($carpeta_imagenes, 0755, true)) {
                    echo "Carpeta creada: $carpeta_imagenes\n";
                } else {
                    echo "Error al crear la carpeta: $carpeta_imagenes\n";
                    return; // Salir si no se puede crear la carpeta
                }
            }
    
            // Verificar que un archivo fue enviado
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['imagen'];
    
                echo "Archivo recibido: \n";
                echo "Nombre: " . $file['name'] . "\n";
                echo "Tipo: " . $file['type'] . "\n";
                echo "Tamaño: " . $file['size'] . " bytes\n";
                echo "Temporal: " . $file['tmp_name'] . "\n";
    
                try {
                    // Procesar imagen PNG
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
                                        
                    // Generar un nombre único para la imagen
                    $nombre_imagen = md5(uniqid(rand(), true));
    
                    // Guardar ambas versiones (PNG y WebP)
                    $path_png = $carpeta_imagenes . '/' . $nombre_imagen . '.png';
                    $path_webp = $carpeta_imagenes . '/' . $nombre_imagen . '.webp';
    
                    if ($imagen_png->save($path_png)) {
                        echo "Imagen PNG guardada en: $path_png\n";
                    } else {
                        echo "Error al guardar la imagen PNG.\n";
                    }
    
                    if ($imagen_webp->save($path_webp)) {
                        echo "Imagen WebP guardada en: $path_webp\n";
                    } else {
                        echo "Error al guardar la imagen WebP.\n";
                    }
    
                    // Crear un nuevo objeto ImagenAuth para la imagen
                    $imagen = new ImagenAuth();
                    $imagen->sincronizar($_POST);  // Sincroniza los datos POST con el modelo
                    $imagen->token = $nombre_imagen;  // Asigna el token generado
    
                    // Guardar la información de la imagen en la base de datos
                    if ($imagen->guardar()) {
                        echo "Imagen guardada en la base de datos exitosamente.\n";
                        // Redirigir si se guarda exitosamente
                        header('Location: /admin/imagenes');
                        exit(); // Detiene el script después de redirigir
                    } else {
                        echo "Error al guardar la imagen en la base de datos.\n";
                    }
                } catch (Exception $e) {
                    echo 'Error al procesar la imagen: ' . $e->getMessage() . "\n";
                }
            } else {
                echo 'No se ha enviado ninguna imagen o hubo un error al subirla.' . "\n";
            }
        }
    }

    public static function imagenesEliminar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $imagen = ImagenAuth::find($id);
            $nombre = $imagen->token;
    
            // Define la ruta de la carpeta de imágenes
            $carpetaImagenes = '../public/build/img/auth';
    
            // Define las extensiones de las imágenes a eliminar
            $extensiones = ['png', 'webp'];
    
            // Recorre cada extensión y elimina el archivo correspondiente
            foreach ($extensiones as $ext) {
                $archivo = $carpetaImagenes . '/' . $nombre . '.' . $ext;
                if (file_exists($archivo)) {
                    unlink($archivo); // Elimina el archivo
                }
            }

            $resultado = $imagen->eliminar();

            if($resultado) {
                header('Location: /admin/imagenes');
            }

        }
    }    
    
}