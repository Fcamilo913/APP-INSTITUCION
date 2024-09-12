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
    <title>Perfil del Estudiante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 20px;
            text-align: center;
        }

        .profile-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .profile-container h2 {
            margin-bottom: 10px;
            color: #0056b3;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
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

        .status {
            font-weight: bold;
            text-align: center;
        }

        .approved {
            color: green;
        }

        .not-approved {
            color: red;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <img id="profile-pic" src="https://via.placeholder.com/150" alt="Foto de Perfil">
        <div class="upload-btn-wrapper">
            <button class="button">Subir Foto</button>
            <input type="file" name="file" id="fileInput" accept="image/*">
        </div>
        <h1>USUARIO : <?=$_SESSION['correo']; ?></h1> 
        <table>
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                          
            <?php

            $id = $_SESSION['correo'];

            $objeto=new metodos();
            $sql="SELECT ID from usuarios WHERE correo = '$id' and rol = 'Estudiante'";
            $datos1=$objeto->mostrarDatos($sql);
            $id_persona = json_encode($datos1[0]["ID"]);

            // Crear el objeto de métodos
            $objeto = new metodos();
            $sql = "SELECT * FROM profe_estudiante INNER JOIN materias ON profe_estudiante.id_profesor = materias.id_profesor INNER JOIN usuarios 
            ON profe_estudiante.id_estudiante = usuarios.id WHERE profe_estudiante.id_estudiante = $id_persona";
            $datos = $objeto->mostrarDatos($sql);

            // Recorrer los datos obtenidos de la consulta
            foreach ($datos as $key) {
            ?>
                <tr>
                    <td><?= $key ['materia']; ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <script>
        // Cargar imagen de perfil
        document.getElementById('fileInput').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-pic').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
