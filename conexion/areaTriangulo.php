<?php

/* ----------------------------------------------------------------
ejercicio No. 2
Calcular el area de un Triangulo.
Formula area Triangulo=base*altura / 2
*/

// 1 - crear la clase.
class Trigonometria{
    // 2 - Creamos los atributos.
    private $base;
    private $altura;
    private $areaTriangulo;

    // 3 - Creo el método constructor.
    function __construct($valorBase,$valorAltura){
        // 4 - Asignacion de las variables en el metodo constructor.
        $this->base=$valorBase;
        $this->altura=$valorAltura;
    }

    // 5- crear un metodo publico que realice el calculo del area.
    public function calcularAreaTriangulo(){
        // 6 - Se realiza las operaciones.
        $this->areaTriangulo=(($this->base*$this->altura)/2);
        return $this->areaTriangulo;
    }
}




?>