<?php

require_once("Persona.php");

// Clase Hijo

class Estudiante extends Persona{
    // Atributos o Propiedades.
    
    public $carrera;

    function __construct($nombre,$edad,$pais,$carrera){
        parent::__construct($nombre,$edad,$pais);
       
        $this->carrera=$carrera;
    }

    public function infoEstudiante(){
        
        // Version 2:
        $datos="
        <h1>Datos del Estudiante: </h1>
        Nombre del Estudiante: {$this->nombre}<br>
        Edad del Estudiante: {$this->edad}<br>
        Pais del Estudiante: {$this->pais}<br>
        Carrera del Estudiante: {$this->carrera}<br>
        ";
        return $datos;

        // return "Nombre del Estudiante: $this->nombre estudia actualmente: $this->carrera ";
    }
}

?>