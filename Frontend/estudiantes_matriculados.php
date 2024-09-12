<?php
session_start(); // Iniciar la sesión
require_once "../conexion/conexion.php";
require_once "../conexion/metodosCrud.php";

$correo = $_SESSION["correo"];
$objeto = new metodos();

// Obtener el id del profesor que inició sesión
$sql = "SELECT id, nombre, apellido FROM usuarios WHERE correo = '$correo'";
$profesor = $objeto->mostrarDatos($sql);

$id_profesor = $profesor[0]['id'];
$nombre_profesor = $profesor[0]['nombre'];
$apellido_profesor = $profesor[0]['apellido'];

// Obtener los estudiantes asociados al profesor
$sql_estudiantes = "SELECT usuarios.nombre, usuarios.apellido 
                    FROM usuarios 
                    INNER JOIN estudiantes ON usuarios.id = estudiantes.id_estudiantes 
                    WHERE usuarios.rol = 'Estudiante'";
$estudiantes = $objeto->mostrarDatos($sql_estudiantes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes asociados</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>

    <h1>Profesor: <?php echo $nombre_profesor . " " . $apellido_profesor; ?></h1>

    <h2>Estudiantes asociados:</h2>
    
    <?php if (!empty($estudiantes)) { ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $estudiante) { ?>
                    <tr>
                        <td><?php echo $estudiante['nombre']; ?></td>
                        <td><?php echo $estudiante['apellido']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No hay estudiantes asociados.</p>
    <?php } ?>

</body>


</html>
