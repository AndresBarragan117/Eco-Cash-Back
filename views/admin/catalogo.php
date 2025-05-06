<?php
    include "../../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
    session_start(); // Iniciar la sesión
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../../css/catalogo-admin.css">
    <link rel="icon" href="../../img/titulo-logo.ico">
    <title>Catálogo Administrador</title>
</head>
<body>
    <header class="header">
        <img class="logo" src="../../img/titulo-logo.png" alt="">
        <h1 class="title-header">Eco Cash Back</h1>
    </header>

    <nav class="nav">
        <ul class="barnav">
            <a class="menu" href="../../views/admin/entrar-administrador.php">Usuarios</a>
            <a class="menu" href="../../views/admin/catalogo.php">Catálogo De Premios</a>
            <a class="menu" href="">Materiales Reciclados</a>
            <a class="menu" href="">Cambio de Contraseña</a>
            <a class="menu" href="../../controlador/c-cerrar-sesion.php">Cerrar Sesión</a>
        </ul>
    </nav>

    <section class="catalogo">
        <h1>Catálogo de Premios</h1>
        <div class="caja-boton">
            <a class="btn-ingresar" href="../../views/admin/agregar-premio.php">Ingresar Premio</a>
        </div>
        <div class="premios">
            <table border="1" cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Premio</th>
                        <th>Descripción</th>
                        <th>Costo de Puntos</th>
                        <th>Stock Disponible</th>
                        <th>Tipo de Premio</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $consulta = "SELECT * FROM recompensas";
                        $resultado = mysqli_query($conn, $consulta);

                        while ($datos = $resultado->fetch_object()) 
                        {
                    ?>
                        <tr>
                            <td><?= $datos->id_recompensa_rec; ?></td>
                            <td width="200"><?= $datos->nombre_recompensa_rec; ?></td>
                            <td width="250"><?= $datos->descripcion_rec; ?></td>
                            <td><?= $datos->costo_puntos_rec; ?></td>
                            <td><?= $datos->stock_disponible_rec; ?></td>
                            <td><?= $datos->tipo_recompensa_rec; ?></td>
                            <td width="100"><?= $datos->estado_rec; ?></td>
                            <td><img src="../../img/img-catalogo/<?= $datos->imagen_rec; ?>" alt="Imagen del Premio" width="100"></td>
                            <td>
                                <a href="../controlador/c-editar-recompensa.php?id=<?php echo $datos->id_recompensa; ?>">Editar</a>
                                <a href="../controlador/c-eliminar-recompensa.php?id=<?php echo $datos->id_recompensa; ?>" onclick="return confirmar();">Eliminar</a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
            </table>
        </div>
    </section>

    <footer class="footer">
        <section class="icono-redes">
            <div class="redes-sociales">
                <a href="https://www.google.com" target="_blank"><i class="fa-brands fa-facebook"></i></i></a>
                <a href="https://www.google.com" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.google.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.google.com" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.google.com" target="_blank"><i class="fa-brands fa-google-plus"></i></a>
            </div>
        </section>
        <section class="avisos">
            <a href="#">Avisos Legales</a>
            <a href="#">Políticas de Privacidad</a>
            <a href="#">Políticas de Cookies</a> 
        </section>
        <div class="derechos">
            <p>&copy; 2025 - Eco Cash Back | Todos los Derechos Reservados</p>
        </div>
    </footer>
</body>
</html>