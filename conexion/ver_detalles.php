<?php
session_start();
require_once "../conexion/conexion.php";
require_once "../conexion/metodosCrud.php";


// $persona = $_SESSION['correo'];

// $id = $_GET["id"];

// // crear el objeto de metodos.
// $objeto=new metodos();
// $sql="SELECT ID from usuarios WHERE correo = '$persona'";
// $datos=$objeto->mostrarDatos($sql);
// $id_persona = json_encode($datos[0]["ID"]);
// $valor = $objeto->guardarIdEstudiante($id_persona);


// if($valor == true){
//     header("Location: ../Frontend/Bienvenido_estu.php");
// }else{
//     echo "Error al guardar los datos";
// }


?>
<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Materia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 60%;
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #0056b3;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        .back-button {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #0056b3;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .back-button:hover {
            background-color: #003d80;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles de la Materia</h1>
        <p><strong>Nombre de la Materia:</strong> <?= $materia['materia']; ?></p>
        <p><strong>Descripción:</strong> <?= $materia['descripcion']; ?></p> <!-- Asegúrate de que la columna 'descripcion' exista -->
        <p><strong>Créditos:</strong> <?= $materia['creditos']; ?></p> <!-- Asegúrate de que la columna 'creditos' exista -->
        <p><strong>Profesor:</strong> <?= $materia['profesor']; ?></p> <!-- Asegúrate de que la columna 'profesor' exista -->

        <a href="../Frontend/tabla_cuenta_estud.php" class="back-button">Volver a la lista</a>
    </div>
</body>
</html> -->
