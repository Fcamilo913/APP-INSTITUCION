<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tabla de Usuarios</h2>
        <table>
            <thead>
                <tr>
                    <th>Rol</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Clave</th>
                    <th class="hidden">Asignatura</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí irían los datos de la tabla. Ejemplo: -->
                <tr>
                    <td>Estudiante</td>
                    <td>Juan</td>
                    <td>Pérez</td>
                    <td>juan.perez@example.com</td>
                    <td>******</td>
                    <td class="hidden"></td>
                </tr>
             
            </tbody>
        </table>
    </div>
</body>
</html>
