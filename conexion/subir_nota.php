<?php

session_start();
require_once "../conexion/conexion.php";
require_once "../conexion/metodosCrud.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST["id_estudiante"];
    $correo = $_SESSION["correo"];
    $objeto = new metodos();
    
    $sql = "SELECT id FROM usuarios WHERE correo = '$correo'";
    $datos = $objeto->mostrarDatos($sql);
    $id_profesor = $datos[0]['id'];
    $nota = $_POST['nota'];
    
    if($id !== "" && $id_profesor !== ""){
        $meto = new metodos();
        $data = $meto->insertarNota($id_profesor, $id, $nota);
        header("Location: ../Frontend/estudiantes_matriculados.php");
    }
}