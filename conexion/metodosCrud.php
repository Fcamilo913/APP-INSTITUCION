<?php
class metodos {

    public function actualizarUsuario($datos){
        $dato = new conectar();
        $conexion = $dato->conexion();
        $sql = "UPDATE usuarios 
                SET nombre='$datos[0]', apellido='$datos[1]', correo='$datos[2]', 
                    contraseña='$datos[3]', rol='$datos[4]'
                WHERE id='$datos[5]'";
        return mysqli_query($conexion, $sql);
    }


    public function mostrarDatos($sql){
        $dato = new conectar();
        $conexion = $dato->conexion();

        $resultado = mysqli_query($conexion, $sql);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    public function insertarUsuario($datos){
        $dato = new conectar();
        $conexion = $dato->conexion();

        $sql = "INSERT INTO usuarios(nombre, apellido, correo, contraseña, Rol) 
                VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]')";

        if (mysqli_query($conexion, $sql)) {
            return mysqli_insert_id($conexion);
        } else {
            return false;
        }
    }

    public function insertarMateria($datos){
        $dato = new conectar();
        $conexion = $dato->conexion();

        $sql = "INSERT INTO materias(id_profesor, materia) VALUES ('$datos[0]', '$datos[1]')";
        return mysqli_query($conexion, $sql);
    }

    public function insertarEstudiante($datos){
        $dato = new conectar();
        $conexion = $dato->conexion();

        $sql = "INSERT INTO estudiantes (id_estudiantes) VALUES ('$datos[0]')";
        return mysqli_query($conexion, $sql);
    }

    public function eliminarUsuarios($id){
        $dato = new conectar();
        $conexion = $dato->conexion();
    
        $sql = "DELETE FROM usuarios WHERE id='$id'";
        return mysqli_query($conexion, $sql);
    }
    public function guardarIdEstudiante($id, $datos){
        // Conexion con la base de datos
        $dato = new conectar();
        $conexion = $dato->conexion();
    
        // sentencia de insercion de datos
        $sql = "UPDATE registro_academico 
                SET id_estudiante=$datos
                WHERE id='$id'";
    
        // envio de los datos del registro.
        return mysqli_query($conexion, $sql);
    }

    public function ValidarUsuario($datos) {
        // Crear una conexión usando MySQLi
        $dato = new conectar();
        $conexion = $dato->conexion();
    
        $correo = mysqli_real_escape_string($conexion, $datos[0]);
        $contrasena = mysqli_real_escape_string($conexion, $datos[1]);
        $rol = mysqli_real_escape_string($conexion, $datos[2]);
    
        $sql = "SELECT correo, contraseña, rol FROM usuarios 
                WHERE correo = '$correo' AND rol = '$rol'";
        $resultado = mysqli_query($conexion, $sql);
    
        $data = array();
        while ($fila = mysqli_fetch_assoc($resultado)) {
            if (password_verify($contrasena, $fila['contraseña'])) {
                $_SESSION["correo"] = $correo;
                $data[] = $fila;
            }

        }
    
        mysqli_free_result($resultado);
        mysqli_close($conexion);
        return $data;
    }



    public function insertarRelacion($datos) {
        $dato = new conectar();  // Crear una nueva conexión
        $conexion = $dato->conexion();  // Obtener la conexión
    
        // Preparar la consulta SQL con marcadores de posición (?)
        $sql = "INSERT INTO relacion_profesor (id_profesor, id_estudiantes) VALUES (?, ?)";
    
        // Preparar la sentencia
        $stmt = mysqli_prepare($conexion, $sql);
    
        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            // Enlazar los parámetros (en este caso ambos son enteros)
            mysqli_stmt_bind_param($stmt, "ii", $datos[0], $datos[1]);
    
            // Ejecutar la consulta
            if (mysqli_stmt_execute($stmt)) {
                // Devolver el último ID insertado si la consulta fue exitosa
                return mysqli_insert_id($conexion);
            } else {
                // Si falla la ejecución
                return false;
            }
        } else {
            // Si la preparación de la consulta falla
            return false;
        }
    }
    
    public function insertarProfeEstudiante($id_profesor, $id_estudiante) {
        $conexion = new Conectar();
        $conn = $conexion->conexion();
    
        $sql = "INSERT INTO profe_estudiante (id_profesor, id_estudiante) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_profesor, $id_estudiante);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function asignarProfesorEstudiante($id_estud, $id_prof) {
        $dato = new conectar();
        $conexion = $dato->conexion();

        try {
            $sql_insertar = "INSERT INTO profe_estudiante (id_profesor, id_estudiante) VALUES ($id_estud, $id_prof)";
            if (mysqli_query($conexion, $sql_insertar)) {
                return true;
            } else {
                echo "Error en la consulta: " . mysqli_error($conexion);
                return false;
            }
        } catch (Exception) {
            echo "Error ya te encuentras matriculado";
        }

    }

    public function insertarNota($id_profesor, $id, $nota){
        $dato = new conectar();
        $conexion = $dato->conexion();
    
        $sql = "INSERT INTO notas (id_profesor, id_estudiante ,nota) VALUES ('$id_profesor', '$id', '$nota')";
        return mysqli_query($conexion, $sql);
    }



    function protegerSesion() {
        // Configuraciones iniciales para la sesión
        ini_set('session.cookie_httponly', 1); // Previene el acceso a la cookie por JavaScript
        ini_set('session.cookie_secure', 1);   // Solo permite cookies de sesión a través de HTTPS
        ini_set('session.use_strict_mode', 1); // Solo acepta IDs de sesión generados por el servidor
        ini_set('session.use_only_cookies', 1); // Desactiva el uso de IDs de sesión en la URL
    
        // Si la sesión ya está iniciada, protege los datos
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Regenerar el ID de sesión para prevenir fijación de sesión
        if (!isset($_SESSION['session_regenerated'])) {
            session_regenerate_id(true);
            $_SESSION['session_regenerated'] = true;
        }
    
        // Verificar IP y User-Agent
        if (!isset($_SESSION['ip_address'])) {
            $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR']; // Almacenar la IP
        }
    
        if (!isset($_SESSION['user_agent'])) {
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT']; // Almacenar el User-Agent
        }
    
        // Comparar la IP y el User-Agent para detectar posibles secuestros de sesión
        if ($_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
            session_unset(); // Limpiar los datos de la sesión
            session_destroy(); // Destruir la sesión
            header("Location: login.html"); // Redirigir al login o mostrar un mensaje de error
            exit();
        }
    }
    



    

}

    
    






?>
