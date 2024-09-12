<?php

// Herencia en POO.

// clase Padre
class Persona{
    // Atributos o Propiedades.
    public $nombre;
    public $edad;
    public $pais;

    // contructor
    function __construct($nombre,$edad,$pais){
        $this->nombre=$nombre;
        $this->edad=$edad;
        $this->pais=$edad;
    }
}




?>