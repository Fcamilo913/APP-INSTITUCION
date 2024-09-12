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
    <title>Tabla de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #020c66;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to right, #74ebd5, #acb6e5);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #0d0046;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
            
        }
        .button {
            padding: 8px 12px;
            font-size: 14px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin: 0 5px;
            display: inline-block;
        }
        .edit-button {
            background-color: #010047;
        }
        .edit-button:hover {
            background-color: #020c66;
        }
        .delete-button {
            background-color: #dc3545;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>USUARIO : <?=$_SESSION['correo']; ?></h1>
    <a href="../conexion/cerrarsession.php">cerrar sesion</a>
    <h1>Bienvenido al modo administrador</h1>
    <h2>Tabla usuarios</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>

<?php
// crear el objeto de metodos.
$objeto=new metodos();
$sql="SELECT * from usuarios";
$datos=$objeto->mostrarDatos($sql);

foreach($datos as $key){

?>

        <tbody>
            <tr>
                <td><?= $key ['nombre']; ?></td>
                <td><?= $key ['apellido']; ?></td>
                <td><?= $key ['correo']; ?></td>
                <td><?= $key ['rol']; ?></td>
                <td>
                    <a class="button edit-button" href="../conexion/editar.php?id=<?= $key['id']?>">Editar</a>
                    <a class="button delete-button" href="../conexion/eliminar.php?id=<?= $key['id']?>">Eliminar</a>
                </td>
            </tr>
            <?php
}

?>
            <!-- Puedes añadir más filas aquí -->
        </tbody>
    </table>
</body>
</html>
