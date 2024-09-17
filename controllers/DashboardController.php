<?php

namespace Controllers;

use Classes\EmailContacto;
use Model\Categoria;
use Model\Compra;
use Model\Envio;
use Model\Oferta;
use Model\Producto;
use Model\Usuario;
use MVC\Router;

class DashboardController {

    public static function index(Router $router) {
        session_start();

        $productos = Producto::all();
        $categorias = Categoria::all();
        $ultimosProductos = array();
    
        foreach ($categorias as $categoria) {
            $ultimoProducto = Producto::whereDesc('categoria_id', $categoria->id);
    
            if ($ultimoProducto) {
                $ultimosProductos[$categoria->id] = $ultimoProducto;
            }
        }
    
        $ofertas = Oferta::all();

        if($_SESSION) {
            $compras = Compra::whereDoble('usuario_id', $_SESSION['id'], 'confirmado', '0');
        }
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();

            if($_SESSION) {                                       
    
                if(isset($_POST['oferta'])) {

                    $id = $_POST['oferta'];
                    if(!$id) {
                        header('Location: /');
                    }
    
                    $oferta = Oferta::find($id);
                    if(!$oferta) {
                        header('Location: /');
                    }
                    
                    $producto = Producto::find($oferta->producto_id);

                    if($producto->cantidad == 0) {

                        $_SESSION['mensaje'] = 'Producto sin Stock por el Momento';

                    } else {

                        $compra = new Compra;
                        $compra->usuario_id = $_SESSION['id'];
                        $compra->producto_id = $oferta->producto_id;
                        
                        $existeCompra = Compra::whereDoble('producto_id', $oferta->producto_id, 'usuario_id', $_SESSION['id']);
                        
                        if(!$existeCompra) {
                            // Guardar la nueva compra
                            $resultado = $compra->guardar();
                
                            if($resultado) {
        
                                // La compra se guardó correctamente
                                $_SESSION['mensaje'] = 'Producto Añadido al Carrito';
        
                            }
        
                        } else {
                            $_SESSION['mensaje'] = 'Producto ya Añadido al Carrito';
                        }

                    }
    
                }
            } else {
                session_start();
                $_SESSION['mensaje'] = 'Primero debe Iniciar Sesión';
            }


        }
    
        $router->render('dashboard/index',[
            'titulo' => 'Home',
            'productos'  => $productos,
            'categorias' => $categorias,
            'ultimosProductos' => $ultimosProductos,
            'ofertas' => $ofertas,
            'compras' => $compras
        ]);
    }
    
    

    public static function tienda(Router $router) {

        session_start();

        $productos = Producto::all();

        if($_SESSION) {
            $compras = Compra::whereDoble('usuario_id', $_SESSION['id'], 'confirmado', '0');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            session_start();

            if($_SESSION) {

                $compras = Compra::whereDoble('usuario_id', $_SESSION['id'], 'confirmado', '0');

                if(isset($_POST['producto'])) {
                    $id = $_POST['producto'];
                    $producto = Producto::find($id);
        
                    if(!$producto) {
                        header('Location: /');
                        exit;
                    }

                    if($producto->cantidad == 0) {

                        $_SESSION['mensaje'] = 'Producto sin Stock por el Momento';

                    } else {

                        $compra = new Compra;
                        $compra->usuario_id = $_SESSION['id'];
                        $compra->producto_id = $id;
            
                        // Verificar si ya existe una compra para este usuario y producto
                        $existeCompra = Compra::whereDoble('producto_id', $compra->producto_id, 'usuario_id', $compra->usuario_id);
        
                        if(!$existeCompra) {
                            // Guardar la nueva compra
                            $resultado = $compra->guardar();
                
                            if($resultado) {
        
                                // La compra se guardó correctamente
                                $_SESSION['mensaje'] = 'Producto Añadido al Carrito';
        
                            }
        
                        } else {
                            $_SESSION['mensaje'] = 'Producto ya Añadido al Carrito';
                        }

                    }
        
                }

            } else {
                $_SESSION['mensaje'] = 'Primero debe Iniciar Sesión';
            }

        }

        $router->render('dashboard/tienda/index', [
            'titulo' => 'Tienda',
            'productos' => $productos,
            'compras' => $compras
        ]);
    }

    public static function tiendaProducto(Router $router) {

        session_start();

        $id = s($_GET['id']);
        if(!$id) {
            header('Location: /');
        }

        $producto = Producto::find($id);
        if(!$producto) {
            header('Location: /');
        }

        $titulo = $producto->nombre;
        $categoria = Categoria::find($producto->categoria_id);
        $oferta = Oferta::where('producto_id', $producto->id);

        if($oferta) {
            $total = $producto->precio * ($oferta->oferta/100);
        }


        if($_SESSION) {
            $compras = Compra::whereDoble('usuario_id', $_SESSION['id'], 'confirmado', '0');   
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            session_start();

            if($_SESSION) {

                $compras = Compra::whereDoble('usuario_id', $_SESSION['id'], 'confirmado', '0');

                if(isset($_POST['producto'])) {
                    $id = $_POST['producto'];
                    $producto = Producto::find($id);
        
                    if(!$producto) {
                        header('Location: /');
                        exit;
                    }

                    if($producto->cantidad == 0) {

                        $_SESSION['mensaje'] = 'Producto sin Stock por el Momento';

                    } else {

                        $compra = new Compra;
                        $compra->usuario_id = $_SESSION['id'];
                        $compra->producto_id = $id;
            
                        // Verificar si ya existe una compra para este usuario y producto
                        $existeCompra = Compra::whereDoble('producto_id', $compra->producto_id, 'usuario_id', $compra->usuario_id);
        
                        if(!$existeCompra) {
                            // Guardar la nueva compra
                            $resultado = $compra->guardar();
                
                            if($resultado) {
        
                                // La compra se guardó correctamente
                                $_SESSION['mensaje'] = 'Producto Añadido al Carrito';
        
                            }
        
                        } else {
                            $_SESSION['mensaje'] = 'Producto ya Añadido al Carrito';
                        }

                    }
        
                }

            } else {
                $_SESSION['mensaje'] = 'Primero debe Iniciar Sesión';
            }

        }

        $router->render('dashboard/tienda/producto', [
            'titulo' => $titulo,
            'producto' => $producto,
            'compras' => $compras,
            'categoria' => $categoria,
            'total' => $total,
            'oferta' => $oferta
        ]);
    }

    public static function categoria(Router $router) {

        session_start();

        $id = s($_GET['id']);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!$id) {
            header('Location: /');
        }

        $categoria = Categoria::find($id);

        if(!$categoria) {
            header('Location: /');
        }

        $titulo = $categoria->nombre;
        $productos = Producto::all();
        $productos = Producto::wheret('categoria_id', $categoria->id);

        if($_SESSION) {
            $compras = Compra::whereDoble('usuario_id', $_SESSION['id'], 'confirmado', '0');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            session_start();

            if($_SESSION) {

                if(isset($_POST['producto'])) {
                    $id = $_POST['producto'];
                    $producto = Producto::find($id);
        
                    if(!$producto) {
                        header('Location: /');
                        exit;
                    }

                    if($producto->cantidad == 0) {

                        $_SESSION['mensaje'] = 'Producto sin Stock por el Momento';

                    } else {

                        $compra = new Compra;
                        $compra->usuario_id = $_SESSION['id'];
                        $compra->producto_id = $id;
            
                        // Verificar si ya existe una compra para este usuario y producto
                        $existeCompra = Compra::whereDoble('producto_id', $compra->producto_id, 'usuario_id', $compra->usuario_id);
        
                        if(!$existeCompra) {
                            // Guardar la nueva compra
                            $resultado = $compra->guardar();
                
                            if($resultado) {
        
                                // La compra se guardó correctamente
                                $_SESSION['mensaje'] = 'Producto Añadido al Carrito';
        
                            }
        
                        } else {
                            $_SESSION['mensaje'] = 'Producto ya Añadido al Carrito';
                        }
                        
                    }
        
                }

            } else {
                $_SESSION['mensaje'] = 'Primero debe Iniciar Sesión';
            }

        }

        $router->render('dashboard/categoria/index', [
            'titulo' => $titulo,
            'productos' => $productos,
            'compras' => $compras
        ]);
    }

    public static function contacto(Router $router) {

        session_start();

        if($_SESSION) {
            $compras = Compra::whereDoble('usuario_id', $_SESSION['id'], 'confirmado', '0');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario POST
            $datos = json_decode(file_get_contents('php://input'), true);
        
            // Verificar si se recibieron los datos correctamente
            if (!$datos || empty($datos['nombre']) || empty($datos['apellido']) || empty($datos['email']) || empty($datos['mensaje'])) {
                http_response_code(400); // Bad Request
                echo json_encode(["error" => "Todos los campos son requeridos"]);
                exit;
            }
        
            // Enviar email
            $email = new EmailContacto($datos['email'], $datos['nombre'], $datos['mensaje']);
            $resultado = $email->enviar();
        
            // Verificar el resultado del envío
            if ($resultado) {
                echo json_encode(["message" => "Email enviado correctamente"]);
            } else {
                http_response_code(500); // Internal Server Error
                echo json_encode(["error" => "Error al enviar el email"]);
            }
            exit;
        }
        
        // Renderizar la página de contacto si no es una solicitud POST
        $router->render('dashboard/contacto/index', [
            'titulo' => 'Contacto',
            'compras' => $compras
        ]);
    }    
    

    public static function carrito(Router $router) {

        session_start();
    
        $ofertas = Oferta::all();
    
        if($_SESSION) {
            $compras = Compra::whereDoble('usuario_id', $_SESSION['id'], 'confirmado', '0');
            $productos = [];
            $total = 0;
            foreach ($compras as $compra) {
                $producto = Producto::find($compra->producto_id);
                if ($producto) {
                    $precioFinal = $producto->precio;
                    foreach ($ofertas as $oferta) {
                        if ($oferta->producto_id === $producto->id) {
                            // Aplicar descuento
                            $precioFinal -= ($precioFinal * ($oferta->oferta / 100));
                        }
                    }
                    $total += $precioFinal;
                    $productos[] = $producto;
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if($_POST['menos']) {
                $id = $_POST['menos'];
                if(!$id) {
                    header('Location: /carrito');
                }
                $producto = Producto::find($id);
                if(!$producto) {
                    header('Location: /carrito');
                }
                $producto->cantidad = $producto->cantidad-1;

                $resultado = $producto->guardar();

                if($resultado) {
                    header('Location: /carrito');
                }
            }
        }
    
        $router->render('dashboard/carrito/index', [
            'titulo' => 'Carrito',
            'productos' => $productos,
            'compras' => $compras,
            'ofertas' => $ofertas,
            'total' => $total
        ]);
    }

    public static function carritoComprobar() {

        if ($_POST['id']) {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            $cantidad = $_POST['cantidad'];

            $producto = Producto::find($id);

            if ($cantidad <= $producto->cantidad) {

                $oferta = Oferta::where('producto_id', $producto->id);

                if(!$oferta) {

                    $cantidadExistente = $producto->precio;    

                } else {

                    $cantidadExistente = $producto->precio * (1 - ($oferta->oferta / 100));                

                }

            } else {
                $cantidadExistente = false;
            }


            echo json_encode($cantidadExistente, JSON_UNESCAPED_UNICODE);
        }

    }

    public static function carritoComprobarTotal() {

        session_start();

        $total = 0;

        $compras = Compra::whereDoble('usuario_id', $_SESSION['id'], 'confirmado', 0);

        if($compras) {

            foreach($compras as $compra) {

                $producto = Producto::find($compra->producto_id);

                $oferta = Oferta::where('producto_id', $producto->id);

                if($oferta) {

                    $precio = $producto->precio * (1 - ($oferta->oferta / 100));

                } else {

                    $precio = $producto->precio;

                }

                $total += $precio;
                
            }
            
        }

        echo json_encode($total, JSON_UNESCAPED_UNICODE);

    }

    public static function carritoValidar() {
        
        session_start();
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datos = $_POST;

            $compra = Compra::whereTriple('usuario_id', $_SESSION['id'], 'producto_id', $datos['producto_id'], 'confirmado', '0');
            $compra = reset($compra);
            $compra->confirmado = 1;
            $compra->guardar();

            $producto = Producto::find($datos['producto_id']);
            $producto->cantidad = $producto->cantidad - $datos['cantidad'];
            $producto->guardar();


            try {

                $envio = new Envio($datos);
                $envio->usuario_id = $_SESSION['id'];
                date_default_timezone_set('America/Guayaquil');
                $envio->fecha = date('d-m-Y');
                $resultado = $envio->guardar();
                echo json_encode($resultado);

            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }
            
        }
    }

    public static function carritoOfertas() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = file_get_contents('php://input');
            
            $oferta = Oferta::where('producto_id', $id);

            echo json_encode($oferta);

        } else {
            // Si la solicitud no es POST, devolvemos un mensaje de error
            echo json_encode(['error' => 'Método no permitido']);
        }
    }     
    
    public static function carritoEliminar() {
        session_start();

        if($_SESSION) {
            
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
                $id = $_POST['producto_id'];
                if(!$id) {
                    header('Location: /carrito');
                }

                $compra = Compra::whereDoble('producto_id', $id, 'usuario_id', $_SESSION['id']);
                $compra = reset($compra);
                $resultado = $compra->eliminar();

                if($resultado) {
                    header('Location: /carrito');
                    $_SESSION['mensaje'] = 'Eliminado del Carrito Exitosamente';
                }
            }

        }

    }

    public static function carritoNuevoProducto()
    {

        session_start();

        if (isset($_POST['id'])) {
    
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    
            if (!$id) {
                echo json_encode(['mensaje' => 'ID de producto no válido']);
                return;
            }
    
            $producto = Producto::find($id);
    
            if ($producto->cantidad == 0) {
                echo json_encode(['mensaje' => 'Producto sin Stock por el Momento']);
                return;
            }
    
            $compra = new Compra;
            $compra->usuario_id = $_SESSION['id'];
            $compra->producto_id = $id;
    
            // Verificar si ya existe una compra para este usuario y producto
            $existeCompra = Compra::whereTriple('producto_id', $compra->producto_id, 'usuario_id', $compra->usuario_id, 'confirmado', '0');
    
            if (!$existeCompra) {
                $resultado = $compra->guardar();
                if ($resultado) {
                    echo json_encode(['mensaje' => 'Producto Añadido al Carrito', 'exito' => true]);
                } else {
                    echo json_encode(['mensaje' => 'Error al añadir el producto al carrito', 'exito' => false]);
                }
            } else {
                echo json_encode(['mensaje' => 'Producto ya Añadido al Carrito', 'exito' => false]);
            }
        } else {
            echo json_encode(['mensaje' => 'ID de producto no proporcionado', 'exito' => false]);
        }
    }    

    public static function carritoPagoExitoso()
    {
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productos'])) {
            // Obtener los productos desde el POST
            $productos = $_POST['productos'];
    
            // Decodificar el JSON en un array de PHP
            $productos = json_decode($productos, true);
    
            // Verificar si la decodificación fue exitosa
            if (is_array($productos)) {
                foreach ($productos as $producto) {
                    // Validar datos del producto
                    if (isset($producto['id']) && isset($producto['cantidad'])) {
                        $id = $producto['id'];
                        $cantidad = $producto['cantidad'];
    
                        // Actualizar la cantidad del producto
                        $productoCarrito = Producto::find($id);
                        if ($productoCarrito) {
                            $productoCarrito->cantidad -= $cantidad;
                            $productoCarrito->guardar();
    
                            // Confirmar la compra
                            $compra = Compra::whereTriple('usuario_id', $_SESSION['id'], 'producto_id', $id, 'confirmado', 0);

                            if ($compra) {
                                $compra = reset($compra);
                                $compra->confirmado = 1;
                                $compra->guardar();
                            }
    
                            // Guardar la información del envío
                            $envio = new Envio();
                            $envio->pais = $_POST['pais'] ?? '';
                            $envio->provincia = $_POST['provincia'] ?? '';
                            $envio->ciudad = $_POST['ciudad'] ?? '';
                            $envio->canton = $_POST['canton'] ?? '';
                            $envio->calles = $_POST['calles'] ?? '';
                            $envio->casa = $_POST['casa'] ?? '';
                            $envio->nombre = $_POST['nombre'] ?? '';
                            $envio->apellido = $_POST['apellido'] ?? '';
                            $envio->telefono = $_POST['telefono'] ?? '';
                            $envio->usuario_id = $_SESSION['id'];
                            $envio->cantidad = $cantidad;
                            $envio->producto_id = $id;
                            $envio->fecha = date('d-m-Y');
                            $envio->guardar();
                        } else {
                            echo json_encode(['mensaje' => 'Producto no encontrado', 'exito' => false]);
                            return;
                        }
                    } else {
                        echo json_encode(['mensaje' => 'Datos del producto inválidos', 'exito' => false]);
                        return;
                    }
                }
    
                echo json_encode(['mensaje' => 'Pago exitoso', 'exito' => true]);
            } else {
                echo json_encode(['mensaje' => 'Error al decodificar los productos', 'exito' => false]);
            }
        } else {
            echo json_encode(['mensaje' => 'Datos POST no proporcionados', 'exito' => false]);
        }
    }        
    
}