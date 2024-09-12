<?php

// Modulo Eliminar:

$id=$_GET['id'];

require_once "conexion.php";
require_once "metodosCrud.php";


$objeto=new metodos();
if ($objeto->eliminarUsuarios($id)==1){
    header("Location: ../Frontend/tabla_cuenta_estud.php");
}
else
{
    echo "Error al borrar el resgistro";
}



?>