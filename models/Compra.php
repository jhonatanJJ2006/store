<?php

namespace Model;

class Compra extends ActiveRecord {

    protected static $tabla = 'compras';
    protected static $columnasDB = ['id', 'producto_id', 'usuario_id', 'confirmado'];

    public $id;
    public $producto_id;
    public $usuario_id;
    public $confirmado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->producto_id = $args['producto_id'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }
}