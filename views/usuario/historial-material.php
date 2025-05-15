<?php
    include "../../modelo/conexion.php"; // Asegúrate de incluir la conexión a la base de datos
    session_start(); // Iniciar la sesión
    
    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['id_usuario_usr'])) {
        header("Location: ../../views/usuario/entrar-usuario.php"); // Redirigir al login si no hay sesión
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/entrar.css">
    <link rel="icon" href="../../img/titulo-logo.ico">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <title>Materiales Reciclados</title>
</head>
<body>
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <header class="header">
        <img class="logo" src="../../img/titulo-logo.png" alt="">
        <h1 class="title-header">Eco Cash Back</h1>
    </header>

    <nav class="nav">
        <ul class="barnav">
            <a class="menu" href="../../views/usuario/entrar-usuario.php">Puntos</a>
            <a class="menu" href="../../views/usuario/catalogo-usuario.php">Catálogo De Premios</a>
            <a class="menu" href="../../views/usuario/historial-material.php">Materiales Reciclados</a>
            <a class="menu" href="">Cambio de Contraseña</a>
            <a class="menu" href="../../controlador/c-cerrar-sesion.php">Cerrar Sesión</a>
        </ul>
    </nav>

    <section>
        <div class="container mt-5">
            <h2 class="text-center">Historial de Materiales Reciclados por Categoría</h2>
            <table class="table table-bordered table-striped mt-4">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Total Reciclado (c/u)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id_usuario = $_SESSION['id_usuario_usr'];
                    $query = "
                        SELECT 
                            m.nombre_material_mat AS categoria_material, 
                            SUM(hmr.cantidad_hmr) AS total_cantidad
                        FROM 
                            historial_materiales_reciclados hmr
                        JOIN 
                            materiales_reciclables m 
                        ON 
                            hmr.id_material_hmr = m.id_material_mat
                        WHERE 
                            hmr.id_usuario_hmr = ?
                        GROUP BY 
                            m.nombre_material_mat
                    ";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $id_usuario);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['categoria_material']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['total_cantidad']) . " (c/u)</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2' class='text-center'>No hay registros disponibles</td></tr>";
                    }

                    $stmt->close();
                    ?>
                </tbody>
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