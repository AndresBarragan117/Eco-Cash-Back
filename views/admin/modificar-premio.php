<?php
    include "../../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
    session_start(); // Iniciar la sesión
    // Verifica si la sesión está activa y si el usuario ha iniciado sesión. Si no, redirige a la página de inicio de sesión.
    if (!isset($_SESSION['id_usuario_usr'])) {
        header("Location: ../../views/inicio-sesion.php"); // Redirigir a la página de inicio de sesión si no hay sesión activa
        exit();
    }

    $id_premio = $_GET['id'];
    $consulta = "SELECT * FROM recompensas WHERE id_recompensa_rec = $id_premio"; // Consulta para obtener los datos del premio
    $resultado = $conn->query($consulta); // Ejecutar la consulta
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../../css/admin/modificar-premio.css">
    <link rel="icon" href="../../img/titulo-logo.ico">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <title>Sesión Administrador</title>
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
            <a class="menu" href="../../views/admin/entrar-administrador.php">Usuarios</a>
            <a class="menu" href="../../views/admin/catalogo.php">Catálogo De Premios</a>
            <a class="menu" href="../../views/admin/maquinas-reciclaje.php">Maquinas De Reciclaje</a>
            <a class="menu" href="../../views/admin/cambio-contra.php">Cambio de Contraseña</a>
            <a class="menu" href="../../controlador/c-cerrar-sesion.php">Cerrar Sesión</a>
        </ul>
    </nav>

    <div class="form-resgistro">
        <form action="../../controlador/admin/c-modificar-premio.php" method="POST" class="formulario" enctype="multipart/form-data">
            <h1 class="title-registro">Modificar Premio</h1>
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>"> <!-- Campo oculto para el ID del premio -->

            <?php
                while($datos = $resultado->fetch_object()) 
                {
            ?>

                    <div class="contenedor-entrada">
                        <input type="text" id="nombre_recompensa_rec" name="nombre_recompensa_rec" class="recibir" placeholder="a" required value="<?= $datos->nombre_recompensa_rec ?>">
                        <label for="nombre_recompensa_rec" class="etiqueta">Nombre del Premio</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="text" id="descripcion_rec" name="descripcion_rec" class="recibir" placeholder="a" value="<?= $datos->descripcion_rec ?>">
                        <label for="descripcion_rec" class="etiqueta">Descripcion del Premio</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="number" id="costo_puntos_rec" name="costo_puntos_rec" class="recibir" placeholder="0" required value="<?= $datos->costo_puntos_rec ?>">
                        <label for="costo_puntos_rec" class="etiqueta">Costo de Puntos</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="number" id="stock_disponible_rec" name="stock_disponible_rec" class="recibir" placeholder="a" required value="<?= $datos->stock_disponible_rec ?>">
                        <label for="stock_disponible_rec" class="etiqueta">Stock Disponible</label>
                    </div>

                    <div class="contenedor-entrada">
                        <select name="tipo_recompensa_rec" class="recibir">
                            <option value="descuento" <?= $datos->tipo_recompensa_rec == 'descuento' ? 'selected' : '' ?>>Descuento</option>
                            <option value="producto fisico" <?= $datos->tipo_recompensa_rec == 'producto fisico' ? 'selected' : '' ?>>Producto Fisico</option>
                            <option value="donacion" <?= $datos->tipo_recompensa_rec == 'donacion' ? 'selected' : '' ?>>Donación</option>
                        </select>
                        <label for="tipo_recompensa_rec" class="etiqueta">Tipo de Premio</label>
                    </div>

                    <div class="contenedor-entrada">
                        <select name="estado_rec" class="recibir">
                            <option value="disponible" <?= $datos->estado_rec == 'disponible' ? 'selected' : '' ?>>Disponible</option>
                            <option value="agotado" <?= $datos->estado_rec == 'agotado' ? 'selected' : '' ?>>Agotado</option>
                            <option value="inactivo" <?= $datos->estado_rec == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                        <label for="estado_rec" class="etiqueta">Estado Premio</label>
                    </div>
                    
                    <div class="contenedor-entrada">
                        <input type="file" id="imagen_rec" name="imagen_rec">
                        <img src="../../img/img-catalogo/<?= $datos->imagen_rec ?>" alt="Imagen actual" width="100">
                        <input type="hidden" name="imagen_actual" value="<?= $datos->imagen_rec ?>"> <!-- Campo oculto para la imagen actual -->
                    </div>
            <?php
                }
            ?>
                
            <input id="btn-actualizar-premio" name="btn-actualizar-premio" type="submit" class="boton-actualizar" value="Actualizar Premio">
        </form>
    </div>

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