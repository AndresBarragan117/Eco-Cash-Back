<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <h1>Listas De Usuarios</h1>
    <?php
        include_once '../php/conexion.php';
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
    ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Primer Nombre</th>
                <th>Segundo Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Cedula</th>
                <th>Correo</th>
                <th>QR</th>
                <th>Fecha de Registro</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Puntos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>datos 1</td>
                <td>datos 2</td>
                <td>datos 3</td>
                <td>datos 4</td>
                <td>datos 5</td>
                <td>datos 6</td>
                <td>datos 7</td>
                <td>datos 8</td>
                <td>datos 9</td>
                <td>datos 10</td>
                <td>datos 11</td>
                <td>datos 12</td>
            </tr>
        </tbody>
    </table>
</body>
</html>