<?php
    include "../../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
    session_start(); // Iniciar la sesión
    // Verifica si la sesión está activa y si el usuario ha iniciado sesión. Si no, redirige a la página de inicio de sesión.
    if (!isset($_SESSION['id_usuario_usr'])) {
        header("Location: ../../views/inicio-sesion.php"); // Redirigir a la página de inicio de sesión si no hay sesión activa
        exit();
    }

    $id_maquina = $_GET['id']; // Obtener el ID de la máquina desde la URL
    $consulta = "SELECT * FROM maquinas_reciclaje WHERE id_maquina_mac = $id_maquina"; // Consulta para obtener los datos de la máquina
    $resultado = $conn->query($consulta); // Ejecutar la consulta

    if ($resultado->num_rows == 0) {
        echo "<script>
                alert('Máquina no encontrada.');
                window.location.href = '../../views/admin/maquinas-reciclaje.php';
            </script>";
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
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../../css/admin/modificar-maquina.css">
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
        <form action="../../controlador/admin/c-modificar-maquina.php" method="POST" class="formulario" enctype="multipart/form-data">
            <h1 class="title-registro">Modificar Máquina</h1>
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>"> <!-- Campo oculto para el ID de la máquina -->

            <?php
            while ($datos = $resultado->fetch_object()) {
            ?>

                <!-- Ubicación -->
                <div class="contenedor-entrada">
                    <input type="text" id="ubicacion_mac" name="ubicacion_mac" class="recibir" placeholder="Ubicación" required value="<?= $datos->ubicacion_mac ?>">
                    <label for="ubicacion_mac" class="etiqueta">Ubicación de la Máquina</label>
                </div>

                <!-- Estado -->
                <div class="contenedor-entrada">
                    <select id="estado_mac" name="estado_mac" class="recibir" required>
                        <option value="funcionando" <?= $datos->estado_mac == 'funcionando' ? 'selected' : '' ?>>Funcionando</option>
                        <option value="en mantenimiento" <?= $datos->estado_mac == 'en mantenimiento' ? 'selected' : '' ?>>En Mantenimiento</option>
                        <option value="fuera de servicio" <?= $datos->estado_mac == 'fuera de servicio' ? 'selected' : '' ?>>Fuera de Servicio</option>
                    </select>
                    <label for="estado_mac" class="etiqueta">Estado de la Máquina</label>
                </div>

                <!-- Última Fecha de Mantenimiento -->
                <div class="contenedor-entrada">
                    <input type="date" id="ultima_mantenimiento_mac" name="ultima_mantenimiento_mac" class="recibir" value="<?= $datos->ultima_mantenimiento_mac ?>">
                    <label for="ultima_mantenimiento_mac" class="etiqueta">Última Fecha de Mantenimiento (opcional)</label>
                </div>

                <!-- Modelo -->
                <div class="contenedor-entrada">
                    <input type="text" id="modelo_maquina_mac" name="modelo_maquina_mac" class="recibir" placeholder="Modelo de la Máquina" required value="<?= $datos->modelo_maquina_mac ?>">
                    <label for="modelo_maquina_mac" class="etiqueta">Modelo de la Máquina</label>
                </div>

                <!-- Capacidad Actual y Máxima (Vidrio) -->
                <div class="contenedor-entrada">
                    <input type="number" id="capacidad_actual_vidrio_mac" name="capacidad_actual_vidrio_mac" class="recibir" placeholder="Capacidad Actual (Vidrio)" value="<?= $datos->capacidad_actual_vidrio_mac ?>">
                    <label for="capacidad_actual_vidrio_mac" class="etiqueta">Capacidad Actual (Vidrio)</label>
                </div>
                <div class="contenedor-entrada">
                    <input type="number" id="capacidad_maxima_vidrio_mac" name="capacidad_maxima_vidrio_mac" class="recibir" placeholder="Capacidad Máxima (Vidrio)" required value="<?= $datos->capacidad_maxima_vidrio_mac ?>">
                    <label for="capacidad_maxima_vidrio_mac" class="etiqueta">Capacidad Máxima (Vidrio)</label>
                </div>

                <!-- Capacidad Actual y Máxima (Plástico) -->
                <div class="contenedor-entrada">
                    <input type="number" id="capacidad_actual_plastico_mac" name="capacidad_actual_plastico_mac" class="recibir" placeholder="Capacidad Actual (Plástico)" value="<?= $datos->capacidad_actual_plastico_mac ?>">
                    <label for="capacidad_actual_plastico_mac" class="etiqueta">Capacidad Actual (Plástico)</label>
                </div>
                <div class="contenedor-entrada">
                    <input type="number" id="capacidad_maxima_plastico_mac" name="capacidad_maxima_plastico_mac" class="recibir" placeholder="Capacidad Máxima (Plástico)" required value="<?= $datos->capacidad_maxima_plastico_mac ?>">
                    <label for="capacidad_maxima_plastico_mac" class="etiqueta">Capacidad Máxima (Plástico)</label>
                </div>

                <!-- Capacidad Actual y Máxima (Metal) -->
                <div class="contenedor-entrada">
                    <input type="number" id="capacidad_actual_metal_mac" name="capacidad_actual_metal_mac" class="recibir" placeholder="Capacidad Actual (Metal)" value="<?= $datos->capacidad_actual_metal_mac ?>">
                    <label for="capacidad_actual_metal_mac" class="etiqueta">Capacidad Actual (Metal)</label>
                </div>
                <div class="contenedor-entrada">
                    <input type="number" id="capacidad_maxima_metal_mac" name="capacidad_maxima_metal_mac" class="recibir" placeholder="Capacidad Máxima (Metal)" required value="<?= $datos->capacidad_maxima_metal_mac ?>">
                    <label for="capacidad_maxima_metal_mac" class="etiqueta">Capacidad Máxima (Metal)</label>
                </div>

                <!-- Capacidad Actual y Máxima (Cartón) -->
                <div class="contenedor-entrada">
                    <input type="number" id="capacidad_actual_carton_mac" name="capacidad_actual_carton_mac" class="recibir" placeholder="Capacidad Actual (Cartón)" value="<?= $datos->capacidad_actual_carton_mac ?>">
                    <label for="capacidad_actual_carton_mac" class="etiqueta">Capacidad Actual (Cartón)</label>
                </div>
                <div class="contenedor-entrada">
                    <input type="number" id="capacidad_maxima_carton_mac" name="capacidad_maxima_carton_mac" class="recibir" placeholder="Capacidad Máxima (Cartón)" required value="<?= $datos->capacidad_maxima_carton_mac ?>">
                    <label for="capacidad_maxima_carton_mac" class="etiqueta">Capacidad Máxima (Cartón)</label>
                </div>

                <!-- Capacidad Actual y Máxima (Pilas) -->
                <div class="contenedor-entrada">
                    <input type="number" id="capacidad_actual_pilas_mac" name="capacidad_actual_pilas_mac" class="recibir" placeholder="Capacidad Actual (Pilas)" value="<?= $datos->capacidad_actual_pilas_mac ?>">
                    <label for="capacidad_actual_pilas_mac" class="etiqueta">Capacidad Actual (Pilas)</label>
                </div>
                <div class="contenedor-entrada">
                    <input type="number" id="capacidad_maxima_pilas_mac" name="capacidad_maxima_pilas_mac" class="recibir" placeholder="Capacidad Máxima (Pilas)" required value="<?= $datos->capacidad_maxima_pilas_mac ?>">
                    <label for="capacidad_maxima_pilas_mac" class="etiqueta">Capacidad Máxima (Pilas)</label>
                </div>

            <?php
            }
            ?>

            <!-- Botón de envío -->
            <input id="btn-actualizar-maquina" name="btn-actualizar-maquina" type="submit" class="boton-actualizar" value="Actualizar Máquina">
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