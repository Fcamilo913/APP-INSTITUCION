<?php
session_start();
require_once "../conexion/conexion.php";
require_once "../conexion/metodosCrud.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Estudiante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #0056b3;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #0056b3;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .button {
            padding: 8px 16px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #003d80;
        }

        .profile-button {
            display: block;
            width: 150px;
            margin: 20px auto;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Bienvenido Estudiante</h1>
    <h1>USUARIO : <?=$_SESSION['correo']; ?></h1>

    <table>
        <thead>
            <tr>
                <th>Nombre del Profesor</th>
                <th>Apellido del Profesor</th>
                <th>Materia</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            // Crear el objeto de métodos
            $objeto = new metodos();

            // Consulta para obtener nombre, apellido y materia de los profesores
            $sql = "SELECT u.nombre, u.apellido, m.materia
                    FROM profe_estudiante pe
                    JOIN usuarios u ON pe.id_profesor = u.id
                    JOIN materias m ON m.id_profesor = u.id
                    WHERE u.rol = 'Profesor'";
                    
            // Obtener los datos
            $datos = $objeto->mostrarDatos($sql);

            // Recorrer los resultados y mostrarlos en la tabla
            foreach ($datos as $key) {
            ?>
            <tr>
                <td><?= $key['nombre'] ?></td>
                <td><?= $key['apellido'] ?></td>
                <td><?= $key['materia'] ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <a href="perfil_estudiante.php?id=<?= $id; ?>" class="button profile-button">Ir al Perfil</a>
</body>
</html>
