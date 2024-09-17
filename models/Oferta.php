<?php

namespace Model;

class Oferta extends ActiveRecord {
    protected static $tabla = 'ofertas';
    protected static $columnasDB = ['id', 'producto_id', 'oferta'];

    public $id;
    public $producto_id;
    public $oferta;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->producto_id = $args['producto_id'] ?? '';
        $this->oferta = $args['oferta'] ?? '';
    }

    // Valigar Categoria
    public function validar() {
        if(!$this->oferta) {
            self::$alertas['error'][] = 'El Porcentaje de la Oferta es Obligatoria';
        }
        return self::$alertas;

    }

}