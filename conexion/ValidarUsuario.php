<?php

session_start(); // Iniciar la sesión



require_once "conexion.php";
require_once "metodosCrud.php";

$correo = $_POST['correo'];
$pass = $_POST['contraseña'];
$rol = $_POST['rol'];

$datos = array($correo, $pass, $rol);

$objeto = new metodos();
$resultado = $objeto->ValidarUsuario($datos);

if (is_array($resultado) && count($resultado) > 0) {
    $_SESSION["correo"] = $correo;
    $_SESSION["rol"] = $rol;  // Guardamos el rol en la sesión también

    // Verificamos el rol para redirigir al lugar correcto
    if ($rol == "estudiante") {
        header('location: ../Frontend/Bienvenido_estu.php');
    } elseif ($rol == "profesor") {
        header('location: ../Frontend/estudiantes_matriculados.php');
    } elseif ($rol == "administrador") {
        header('location: ../Frontend/tabla_cuenta_estud.php');
    } else {
        echo "Rol no reconocido"; // Por si llega un rol inesperado
    }
} else {
    echo "USUARIO O CONTRASEÑA INCORRECTO";
}
?>
