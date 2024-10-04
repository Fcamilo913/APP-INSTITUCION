<?php

// Crear la clase.
class conectar{
    // Atributos de la conexion de la base de datos.
    private $servidor="localhost";
    private $usuario="root";
    private $bd="instituto";
    private $password="";

    // Metodo de la conexion de la base de datos.
    public function conexion(){
        // Permite la conexion con la base de datos.
        $conexion=mysqli_connect
        (
            $this->servidor,
            $this->usuario,
            $this->password,
            $this->bd);
            
            return $conexion;
    }
}
?>