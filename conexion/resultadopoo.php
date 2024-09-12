<?php

// requiere el archivo.
require_once ("areaTriangulo.php");

// Creo el objeto.
$triangulo1=new Trigonometria(20,5); // Creo el objeto
$totalArea=$triangulo1->calcularAreaTriangulo();
echo 'El total del area del Triangulo: '.$totalArea;

?>