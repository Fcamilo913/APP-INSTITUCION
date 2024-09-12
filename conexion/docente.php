<?php

require_once("Persona.php");

class Docente extends Persona{
// Atributos:
public $Especialidad;

function __construct($nombre,$edad,$pais,$Especialidad){
parent::__construct($nombre,$edad,$pais);

    $this->Especialidad = $Especialidad;
}

public function registroDocente(){
    return "Nombre del Docente: $this->nombre y su Nacionalidad: $this->pais y su Especialidad: $this->Especialidad";
}
}

?>
