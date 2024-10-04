<?php

session_start(); // Iniciar la sesión
require_once "conexion.php";
require_once "metodosCrud.php";

$correo = $_SESSION["correo"];
$objeto = new metodos();

// Obtener el id del profesor que inició sesión
$sql = "SELECT id FROM usuarios WHERE correo = '$correo'";
$datos = $objeto->mostrarDatos($sql);
$id_profesor = $datos[0]['id'];

// Verificar si se enviaron notas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nota'])) {
    $notas = $_POST['nota'];

    foreach ($notas as $id_estudiante => $nota) {
        // Insertar o actualizar la nota del estudiante en la tabla notas
        $sql_insert = "INSERT INTO notas (id_estudiante, id_profesor, nota) 
                       VALUES ('$id_estudiante', '$id_profesor', '$nota')
                       ON DUPLICATE KEY UPDATE nota = '$nota'";
        $objeto->insertarNota($sql_insert, $id_profesor, $id_estudiante);
    }
    // Redirigir para evitar el reenvío de formularios
    header("Location: ../Frontend/Bienvenido_estu.php");
    exit();
} else {
    // Redirigir si no se envió el formulario
    header("Location: ../Frontend/Bienvenido_estu.php");
    exit();
}
