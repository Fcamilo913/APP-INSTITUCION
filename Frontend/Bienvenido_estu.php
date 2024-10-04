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
        /* Estilos generales */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #e9ebee;
            margin: 0;
            padding: 0;
        }

        /* Barra de navegación superior */
        .navbar {
            background-color: blue;
            color: white;
            padding: 15px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .navbar h1 {
            display: inline-block;
            margin: 0;
            font-size: 24px;
        }

        /* Estilo del contenedor principal */
        .container {
            margin-top: 80px;
            padding: 20px;
        }

        /* Contenedor del perfil */
        .profile-container {
            background-color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .profile-container img {
            border-radius: 50%;
            margin-bottom: 15px;
            width: 150px;
            height: 150px;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn-wrapper .button {
            border: 1px solid blue; /* Azul estilo Facebook */
            background-color: white;
            color: blue;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .upload-btn-wrapper input[type="file"] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        .profile-container h1 {
            margin-top: 0;
            font-size: 22px;
        }

        .profile-container h1 span {
            font-weight: normal;
            color: #333;
        }

        /* Tabla de materias */
        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        a {
            color: blue;
        }

        th {
            background-color: blue; /* Azul estilo Facebook */
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Botones */
        .button {
            padding: 10px 20px;
            background-color: blue; /* Azul estilo Facebook */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0b60c8; /* Azul más oscuro */
        }

        .profile-button {
            display: inline-block;
            text-decoration: none;
            font-size: 16px;
        }

        .profile-container .profile-button {
            margin-top: 20px;
        }

        /* Ajustar para dispositivos móviles */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            table {
                font-size: 14px;
            }

            .navbar h1 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <!-- Barra de navegación superior -->
    <div class="navbar">
        <h1>Bienvenido Estudiante</h1>
    </div>

    <!-- Contenedor principal -->
    <div class="container">
        <!-- Contenedor del perfil -->
        <div class="profile-container">
            <img id="profile-pic" src="https://via.placeholder.com/150" alt="Foto de Perfil">
            <div class="upload-btn-wrapper">
                <button class="button">Subir Foto</button>
                <input type="file" name="file" id="fileInput" accept="image/*">
            </div>
            <h1>USUARIO: <span><?= $_SESSION['correo']; ?></span></h1>
            <p><a href="login.html">Cerrar Sesion</a></p>
        </div>

        <!-- Tabla de materias y docentes -->
        <table>
            <thead>
                <tr>
                    <th> Materia (s) Disponible (s)</th>
                    <th>Estado</th>
                    <th>Accion</th>
                    <th>Docente</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Crear instancia de la clase metodos
                $objeto = new metodos();

                // Obtener el correo del usuario desde la sesión
                $correo = $_SESSION['correo'];

                // Obtener el ID del usuario actual
                $sql1 = "SELECT id FROM usuarios WHERE correo = '$correo'";
                $datos1 = $objeto->mostrarDatos($sql1);
                $id = $datos1[0]['id'];

                // Consulta SQL corregida para evitar la duplicación
                $sql = "SELECT materias.*, usuarios.nombre, usuarios.apellido 
                        FROM materias
                        LEFT JOIN usuarios ON usuarios.id = materias.id_profesor
                        GROUP BY materias.id_profesor, materias.materia";

                // Obtener los datos de las materias y profesores
                $datos = $objeto->mostrarDatos($sql);

                // Obtener las materias en las que el estudiante está matriculado
                $sql2 = "SELECT id_estudiante FROM profe_estudiante WHERE id_estudiante = $id";
                $datos2 = $objeto->mostrarDatos($sql2);

                // Mostrar las materias y docentes
                foreach ($datos as $key) {
                    // Revisar si el estudiante está matriculado
                    $matriculado = false;  // Por defecto, no está matriculado
                    
                    // Verificar si el estudiante aparece en los datos obtenidos
                    foreach ($datos2 as $dato) {
                        if ($dato['id_estudiante'] == $id) { // Comparar con el id del estudiante actual
                            $matriculado = true;
                            break;
                        }
                    }
                ?>
                <tr>
                    <td><?= $key['materia'] ?></td>
                    <td><?= $matriculado ? "Matriculado" : "No matriculado"; ?></td>
                    <td>
                        <a class="button edit-button" href="../conexion/matricular.php?id=<?= $key['id_profesor'] ?>">Matricular</a>
                    </td>
                    <td><?= $key['nombre'] . " " . $key['apellido'] ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <!-- Botón para ir al perfil del estudiante -->
        <a href="perfil_estudiante.php?id=<?= $id; ?>" class="button profile-button">Ver Notas</a>
    </div>
</body>
</html>
