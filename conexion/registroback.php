<?php
require_once "conexion.php";
require_once "metodosCrud.php";

// Activar el reporte de errores y mostrarlos
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica que los campos esperados están presentes en $_POST
if (isset($_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['contraseña'], $_POST['rol'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $pass = $_POST['contraseña'];
    $rol = $_POST['rol'];

    // Hash de la contraseña
    $hassPassword = password_hash($pass, PASSWORD_BCRYPT);

    $objeto = new metodos();

    // Inserción del usuario
    $datos_usuario = array($nombre, $apellido, $correo, $hassPassword, $rol);
    $id_insert = $objeto->insertarUsuario($datos_usuario);

    if ($id_insert) {
        $resultado_insercion = true; // Suponemos éxito a menos que se demuestre lo contrario

        if ($rol === 'Profesor') {
            // Inserción del registro académico para profesores
            if (isset($_POST['materia'])) {
                $nombre_asignatura = $_POST['materia'];
                $datos_academicos = array($id_insert, $nombre_asignatura);
                $resultado_insercion = $objeto->insertarMateria($datos_academicos);
                if ($resultado_insercion > 0){
                    header('Location: ../Frontend/registro_exitoso.html');
                }
            }
        } elseif ($rol === 'Estudiante') {
            // Inserción en la tabla de estudiantes
            $datos_estudiante = array($id_insert);
            $resultado_insercion = $objeto->insertarEstudiante($datos_estudiante);
            if ($resultado_insercion > 0){
                header('Location: ../Frontend/registro_exitoso.html');
            }
        } elseif ($rol === 'Administrador') {
            // No es necesario insertar el usuario de nuevo para los administradores.
            header('Location: ../Frontend/registro_exitoso.html');
        }

        if ($resultado_insercion) {
            $mensaje = "Datos guardados con éxito";
            $mensaje_clase = "success";
        } else {
            $mensaje = "Error al registrar los datos académicos.";
            $mensaje_clase = "error";
        }
    } else {
        $mensaje = "Error al insertar el usuario.";
        $mensaje_clase = "error";
    }
} else {
    $mensaje = "Faltan datos en el formulario.";
    $mensaje_clase = "error";
}

