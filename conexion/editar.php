<?php
// 1. Conectar a la base de datos y obtener los datos actuales del usuario
require_once "conexion.php";
require_once "metodosCrud.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $metodos = new metodos();
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $usuario = $metodos->mostrarDatos($sql);

    if(count($usuario) > 0){
        $usuario = $usuario[0];
    } else {
        echo "Usuario no encontrado";
        exit;
    }
} else {
    echo "ID de usuario no proporcionado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Frontend/estilo.css">
    <title></title>
    <style>
      /* restro.css */

/* Reset de márgenes y padding para todos los elementos */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Estilo general del cuerpo */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #74ebd5, #acb6e5);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
}

/* Estilo del contenedor del formulario */
.form-container {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    padding: 30px;
    max-width: 450px;
    width: 100%;
    transform: scale(1);
    transition: transform 0.3s;
}

/* Animación al pasar el mouse sobre el contenedor del formulario */
.form-container:hover {
    transform: scale(1.02);
}

/* Estilo del encabezado del formulario */
.form-container h1 {
    font-size: 28px;
    margin-bottom: 20px;
    text-align: center;
    color: #333;
    font-weight: 600;
}

/* Estilo de las etiquetas del formulario */
form label {
    display: block;
    font-size: 14px;
    margin-bottom: 8px;
    color: #555;
}

/* Estilo de los campos de entrada */
form input[type="text"],
form input[type="password"],
form select {
    width: calc(100% - 22px);
    padding: 12px;
    margin-bottom: 20px;
    border: none;
    border-radius: 8px;
    background: #f9f9f9;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
    font-size: 16px;
    transition: box-shadow 0.3s;
}

/* Efecto al enfocar los campos de entrada */
form input[type="text"]:focus,
form input[type="password"]:focus,
form select:focus {
    outline: none;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
}

/* Estilo del botón de envío */
form button {
    width: 100%;
    padding: 15px;
    background: #007bff;
    border: none;
    border-radius: 8px;
    color: #ffffff;
    font-size: 18px;
    cursor: pointer;
    transition: background 0.3s, transform 0.3s;
}

/* Cambia el color de fondo y aplica una animación al pasar el mouse sobre el botón */
form button:hover {
    background: #0056b3;
    transform: translateY(-2px);
}

form button:active {
    transform: translateY(1px);
}

    </style>
</head>
<body>
    <h1></h1>
    <!-- 2. Crear un formulario para editar los datos del usuario -->
    <form action="actualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" value="<?php echo $usuario['apellido']; ?>" required><br>

        <label for="correo">Correo:</label>
        <input type="text" name="correo" value="<?php echo $usuario['correo']; ?>" required><br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" value="<?php echo $usuario['contraseña']; ?>" required><br>

        <label for="rol">Rol:</label>
        <select name="rol" required>
        <option value="Profesor">Docente</option>
        <option value="estudiante">>Estudiante</option>
        <option value="administrador">Administrador</option>
        </select><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>