
<?php

// Metodo Constructor en POO.

/*
Ejercicio - 1. Calcular el pago por dias a un o a varios empleados.
Formula del pago por dias -> valor pago mensual / 30(mes)*dias Trabajados
*/

// 1 - Creo la clase
class pagoMensual{
    // 2 - Creo los Atributos de la clase pago mensual.
    private $pagoMensual; // private,public,protected,static
    private $diasTrabajados;
    private $pago;

    // 3 - Crear el método constructor.
    function __construct($valorSalario,$valorDias){
        // Defino las variables a asignar en el método constructor.
        $this->pagoMensual=$valorSalario;
        $this->diasTrabajados=$valorDias;
    }

    // 4 - Crear un método que calcula la operacion.
    public function calcularPago(){
        // Se realiza la operacion para calcular el pago.
        $this->pago=(($this->pagoMensual/30)*$this->diasTrabajados);
        // Se retorna un valor.
        return $this->pago;
    }
}

// # Crear la instancia o objeto.
// $empleado1=new pagoMensual(500000,11); // Creo el objeto
// $totalPago=$empleado1->calcularPago();
// echo 'El total a pagar al empleado: '.'$'.$totalPago;

// echo "<br><br>";

// $empleado2=new pagoMensual(950000,22); // Creo el objeto
// $totalPago=$empleado2->calcularPago();
// echo 'El total a pagar al empleado: '.'$'.$totalPago;
?>