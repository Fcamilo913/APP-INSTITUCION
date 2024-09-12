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
                <th>Materia</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            $objeto = new metodos();
            $sql = "SELECT * FROM materias";
            $datos = $objeto->mostrarDatos($sql);

            foreach ($datos as $key) {
            ?>
            <tr>
                <td><?= $key['materia'] ?></td>
                <td>
                <a class="button edit-button" href="../conexion/matricular.php?id=<?= $key['id_profesor']?>">Matricular</a>
                <a class="button delete-button" href="../conexion/ver_detalles.php?id=<?= $key['id']?>">Detalles</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <a href="perfil_estudiante.php?id_profesor=<?= $key['id_profesor']?>" class="button profile-button">Ir al Perfil</a>
</body>
</html>
