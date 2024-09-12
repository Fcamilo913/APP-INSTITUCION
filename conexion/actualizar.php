<?php

// Modulo PHP:
require_once "conexion.php";
require_once "metodosCrud.php";

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$pass = $_POST['contraseña'];
$rol = $_POST['rol'];

$datos = array($nombre, $apellido, $correo, $pass, $rol, $id);

// Crear el objeto.
$objeto = new metodos();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Usuario</title>
    <style>
        .message-box {
            margin: 50px auto;
            padding: 20px;
            width: 300px;
            text-align: center;
            border: 2px solid #4CAF50;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .message-box h1 {
            color: #4CAF50;
        }
        .message-box a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .message-box a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <?php
        if ($objeto->actualizarUsuario($datos) == 1) {
            echo "<h1>Registro actualizado con éxito</h1>";
        } else {
            echo "<h1>Error al actualizar el registro</h1>";
        }
        ?>
        <a href="../Frontend/tabla_cuenta_estud.php">Volver</a>
    </div>
</body>
</html>
