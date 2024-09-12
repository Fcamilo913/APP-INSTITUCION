<?php
class pagoSalario{
    //atributos.
    private $netoPagar=0;

    // metodo.
    public function calcularPago($valorhora,$diasTrabajados){
        $this->netoPagar=($valorhora*$diasTrabajados);
        return $this->netoPagar;
    }

}
# Crear el objeto.
$pedro=new pagoSalario();
echo $pedro->calcularPago(10,5);
echo "<br>";

$bula=new pagoSalario();
echo $bula->calcularPago(100,5);

?>