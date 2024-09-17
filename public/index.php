<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use MVC\Router;
use Controllers\AuthController;
use Controllers\CategoriasController;
use Controllers\ComprasController;
use Controllers\DashboardController;
use Controllers\OfertasController;
use Controllers\ProductosController;
use Controllers\UsuariosController;

$router = new Router();

// AUTH

    // Login
$router->get('/auth/login', [AuthController::class, 'login']);
$router->post('/auth/login', [AuthController::class, 'login']);
$router->post('/auth/logout', [AuthController::class, 'logout']);

    // Crear Cuenta
$router->get('/auth/registro', [AuthController::class, 'registro']);
$router->post('/auth/registro', [AuthController::class, 'registro']);

    // Formulario de olvide mi password
$router->get('/auth/olvide', [AuthController::class, 'olvide']);
$router->post('/auth/olvide', [AuthController::class, 'olvide']);

    // Colocar el nuevo password
$router->get('/auth/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/auth/reestablecer', [AuthController::class, 'reestablecer']);

    // Confirmación de Cuenta
$router->get('/auth/mensaje', [AuthController::class, 'mensaje']);
$router->get('/auth/confirmar-cuenta', [AuthController::class, 'confirmar']);

$router->post('/logout', [AuthController::class, 'logout']);


// DASHBOARD

$router->get('/', [DashboardController::class, 'index']);
$router->post('/', [DashboardController::class, 'index']);

    // Tienda
$router->get('/tienda', [DashboardController::class, 'tienda']);
$router->post('/tienda', [DashboardController::class, 'tienda']);

$router->get('/tienda/producto', [DashboardController::class, 'tiendaProducto']);
$router->post('/tienda/producto', [DashboardController::class, 'tiendaProducto']);

    // Categoria
$router->get('/categoria', [DashboardController::class, 'categoria']);
$router->post('/categoria', [DashboardController::class, 'categoria']);

    // Contacto
$router->get('/contacto', [DashboardController::class, 'contacto']);
$router->post('/contacto', [DashboardController::class, 'contacto']);

    // Carrito
$router->get('/carrito', [DashboardController::class, 'carrito']);
$router->post('/carrito', [DashboardController::class, 'carrito']);

$router->post('/carrito/comprobar', [DashboardController::class, 'carritoComprobar']);

$router->post('/carrito/comprobar/total', [DashboardController::class, 'carritoComprobarTotal']);

$router->post('/carrito/ofertas', [DashboardController::class, 'carritoOfertas']);

$router->post('/carrito/validar', [DashboardController::class, 'carritoValidar']);

$router->post('/carrito-eliminar', [DashboardController::class, 'carritoEliminar']);

$router->post('/carrito/nuevoProducto', [DashboardController::class, 'carritoNuevoProducto']);

$router->post('/carrito/pagoExitoso', [DashboardController::class, 'carritoPagoExitoso']);

// ADMIN
$router->get('/admin/dashboard', [AdminController::class, 'index']);

    // Categorias
$router->get('/admin/categorias', [CategoriasController::class, 'index']);

$router->get('/admin/categorias/crear', [CategoriasController::class, 'crear']);
$router->post('/admin/categorias/crear', [CategoriasController::class, 'crear']);

$router->get('/admin/categorias/editar', [CategoriasController::class, 'editar']);
$router->post('/admin/categorias/editar', [CategoriasController::class, 'editar']);

$router->post('/admin/categorias/eliminar', [CategoriasController::class, 'eliminar']);

    // Productos
$router->get('/admin/productos', [ProductosController::class, 'index']);

$router->get('/admin/productos/crear', [ProductosController::class, 'crear']);
$router->post('/admin/productos/crear', [ProductosController::class, 'crear']);

$router->get('/admin/productos/editar', [ProductosController::class, 'editar']);
$router->post('/admin/productos/editar', [ProductosController::class, 'editar']);

$router->post('/admin/productos/eliminar', [ProductosController::class, 'eliminar']);

    // Ofertas
$router->get('/admin/productos/ofertas/crear', [OfertasController::class, 'crear']);
$router->post('/admin/productos/ofertas/crear', [OfertasController::class, 'crear']);

$router->post('/admin/productos/ofertas/eliminar', [OfertasController::class, 'eliminar']);

    // Usuarios
$router->get('/admin/usuarios', [UsuariosController::class, 'index']);

    // Compras
$router->get('/admin/compras', [ComprasController::class, 'index']);
$router->get('/admin/compras/informacion', [ComprasController::class, 'informacion']);

$router->get('/admin/compras/eliminar', [ComprasController::class, 'eliminar']);
$router->post('/admin/compras/eliminar', [ComprasController::class, 'eliminar']);

    // Auth Imagenes
$router->get('/admin/imagenes', [AdminController::class, 'imagenes']);
$router->get('/admin/imagenes/crear', [AdminController::class, 'imagenesCrear']);
$router->post('/admin/imagenes/nuevo', [AdminController::class, 'imagenesNuevo']);
$router->post('/admin/imagenes/eliminar', [AdminController::class, 'imagenesEliminar']);

$router->comprobarRutas();