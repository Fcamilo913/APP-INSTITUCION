<?php

session_start(); // Iniciar la sesión

require_once "conexion.php";
require_once "metodosCrud.php";

$correo = $_SESSION["correo"];
$objeto = new metodos();

$sql = "SELECT id FROM usuarios WHERE correo = '$correo'";
$datos = $objeto->mostrarDatos($sql);
$id_estud = json_encode($datos[0]['id']);
$id_profesor = $_GET["id"];


if($id_estud !== "" && $id_profesor !== ""){
    $meto = new metodos();
    $data = $meto->asignarProfesorEstudiante($id_profesor, $id_estud);
    header("Location: ../Frontend/Bienvenido_estu.php");
}

?>


