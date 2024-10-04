<?php
session_start(); // Iniciar la sesión

require_once "../conexion/conexion.php";
require_once "../conexion/metodosCrud.php";

$correo = $_SESSION["correo"];
$objeto = new metodos();

// Obtener el id del profesor que inició sesión
$sql_profesor = "SELECT id, nombre, apellido FROM usuarios WHERE correo = '$correo' AND rol = 'Profesor'";
$profesor = $objeto->mostrarDatos($sql_profesor);

// Verificar si se encontró al profesor
if (empty($profesor)) {
    echo "Error: No se pudo obtener los datos del profesor.";
    exit;
}

$id_profesor = $profesor[0]['id']; // El ID del profesor que inicia sesión
$nombre_profesor = $profesor[0]['nombre'];
$apellido_profesor = $profesor[0]['apellido'];

// Consulta para obtener la asignatura asociada al profesor
$sql_asignatura = "SELECT materia FROM materias WHERE id_profesor = $id_profesor LIMIT 1";
$asignatura = $objeto->mostrarDatos($sql_asignatura);

// Obtener la asignatura
$nombre_asignatura = !empty($asignatura) ? $asignatura[0]['materia'] : 'Asignatura no encontrada';

// Consulta para obtener los estudiantes asociados a este profesor junto con las notas
$sql_estudiantes = "SELECT usuarios.id, usuarios.nombre, usuarios.apellido, IFNULL(notas.nota, 'No asignada') AS nota
                    FROM usuarios 
                    INNER JOIN estudiantes ON usuarios.id = estudiantes.id_estudiantes 
                    INNER JOIN profe_estudiante ON estudiantes.id_estudiantes = profe_estudiante.id_estudiante 
                    LEFT JOIN notas ON notas.id_estudiante = estudiantes.id_estudiantes AND notas.id_profesor = $id_profesor
                    WHERE profe_estudiante.id_profesor = $id_profesor AND usuarios.rol = 'Estudiante'";

$estudiantes = $objeto->mostrarDatos($sql_estudiantes); // Obtener los estudiantes y sus notas

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes asociados</title>
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

        .container {
            background-color: #002366;
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h1, h2 {
            text-align: center;
        }

        a {
            text-align: center;
            color: aliceblue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid white;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #003399;
        }

        tr:nth-child(even) {
            background-color: #003399;
        }

        tr:nth-child(odd) {
            background-color: #0044cc;
        }

        p {
            text-align: center;
            font-size: 1.2em;
        }

        .profile-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
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

        form {
            margin-top: 20px;
        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
            text-align: center;
        }

        button {
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="profile-container">
            <img id="profile-pic" src="https://via.placeholder.com/150" alt="Foto de Perfil">
            <div class="upload-btn-wrapper">
                <button class="button">Subir Foto</button>
                <input type="file" name="file" id="fileInput" accept="image/*">
            </div>
        </div>

        <h1>Profesor: <?php echo $nombre_profesor . " " . $apellido_profesor; ?></h1>
        <h2>Asignatura: <?php echo $nombre_asignatura; ?></h2>
        <p><a href="login.html">Cerrar sesion</a></p>
        
        <?php if (!empty($estudiantes)) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nota actual</th>
                        <th>Nueva nota</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estudiantes as $estudiante) { ?>
                        <tr>
                            <form action="../conexion/subir_nota.php" method="POST">
                                <input type="hidden" name="id_estudiante" value="<?= $estudiante['id']; ?>">
                                <td><?php echo $estudiante['nombre']; ?></td>
                                <td><?php echo $estudiante['apellido']; ?></td>
                                <td><?php echo $estudiante['nota']; ?></td> <!-- Mostrar la nota actual -->
                                <td>
                                    <input type="number" name="nota" min="0" max="100" placeholder="Nota">
                                </td>
                                <td>
                                    <button type="submit">Subir Nota</button>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No hay estudiantes asociados a este profesor.</p>
        <?php } ?>
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
