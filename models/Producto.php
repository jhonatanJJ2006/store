<?php

namespace Model;

class Producto extends ActiveRecord {
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre', 'imagen', 'descripcion', 'precio', 'cantidad', 'categoria_id'];

    public $id;
    public $nombre;
    public $imagen;
    public $descripcion;
    public $precio;
    public $cantidad;
    public $categoria_id;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->categoria_id = $args['categoria_id'] ?? '';
    }

    // Valigar Categoria
    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre de la Categoria es Obligatoria';
        }
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'La Descripción es Obligatoria';
        }
        if(!$this->imagen) {
            self::$alertas['error'][] = 'La Imagen es Obligatoria';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'El Precio es Obligatoria';
        }
        if(!$this->cantidad) {
            self::$alertas['error'][] = 'La Cantidad es Obligatoria';
        }
        if(!$this->categoria_id) {
            self::$alertas['error'][] = 'La Categoria es Obligatoria';
        }
        return self::$alertas;

    }

}