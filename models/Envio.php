<?php

namespace Model;

class Envio extends ActiveRecord {
    protected static $tabla = 'envios';
    protected static $columnasDB = ['id', 'pais', 'provincia', 'ciudad', 'canton', 'calles', 'casa', 'nombre', 'apellido', 'telefono', 'usuario_id', 'cantidad', 'producto_id', 'fecha'];

    public $id;
    public $pais;
    public $provincia;
    public $ciudad;
    public $canton;
    public $calles;
    public $casa;
    public $nombre;
    public $apellido;
    public $telefono;
    public $usuario_id;
    public $cantidad;
    public $producto_id;
    public $fecha;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->pais = $args['pais'] ?? '';
        $this->provincia = $args['provincia'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->canton = $args['canton'] ?? '';
        $this->calles = $args['calles'] ?? '';
        $this->casa = $args['casa'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? null;
        $this->cantidad = $args['cantidad'] ?? '';
        $this->producto_id = $args['producto_id'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
    }

}