<?php

namespace Model;

class ImagenAuth extends ActiveRecord {
    protected static $tabla = 'imagenesauth';
    protected static $columnasDB = ['id', 'token'];

    public $id;
    public $token;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->token = $args['token'] ?? '';
    }

}