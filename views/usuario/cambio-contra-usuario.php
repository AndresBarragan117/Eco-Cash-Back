<?php
    include "../../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
    session_start(); // Iniciar la sesión

    // Verifica si la sesión está activa y si el usuario ha iniciado sesión. Si no, redirige a la página de inicio de sesión.
    if (!isset($_SESSION['id_usuario_usr'])) {
        header("Location: ../../views/inicio-sesion.php"); // Redirigir a la página de inicio de sesión si no hay sesión activa
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
    <link rel="stylesheet" href="../../css/admin/cambio-contra.css">
    <link rel="icon" href="../../img/titulo-logo.ico">
    <!-- data tables -->
    <link href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.min.css" rel="stylesheet" integrity="sha384-xkQqWcEusZ1bIXoKJoItkNbJJ1LG5QwR5InghOwFLsCoEkGcNLYjE0O83wWruaK9" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet" integrity="sha384-DJhypeLg79qWALC844KORuTtaJcH45J+36wNgzj4d1Kv1vt2PtRuV2eVmdkVmf/U" crossorigin="anonymous">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cambio de Contraseña</title>
</head>
<body>
    <header class="header">
        <img class="logo" src="../../img/titulo-logo.png" alt="">
        <h1 class="title-header">Eco Cash Back</h1>
    </header>

    <nav class="nav">
        <ul class="barnav">
            <a class="menu" href="../../views/usuario/entrar-usuario.php">Puntos</a>
            <a class="menu" href="../../views/usuario/catalogo-usuario.php">Catálogo De Premios</a>
            <a class="menu" href="../../views/usuario/historial-material.php">Materiales Reciclados</a>
            <a class="menu" href="../../views/usuario/cambio-contra-usuario.php">Cambio de Contraseña</a>
            <a class="menu" href="../../controlador/c-cerrar-sesion.php">Cerrar Sesión</a>
        </ul>
    </nav>

    <section class="form-cambio">
        <form action="../../controlador/usuario/c-cambio-contra-usuario.php" method="POST" class="formulario">
            <h2 class="title-registro">Cambio de Contraseña</h2>

            <div class="contenedor-entrada">
                <input type="password" name="contra_actual" id="contra_actual" class="recibir" placeholder=" " required>
                <label for="contra_actual" class="etiqueta">Contraseña Actual</label>
            </div>

            <div class="contenedor-entrada">
                <input type="password" name="nueva_contra" id="nueva_contra" class="recibir" placeholder=" " required>
                <label for="nueva_contra" class="etiqueta">Nueva Contraseña</label>
            </div>
            <div class="contenedor-entrada">
                <input type="password" name="confirmar_contra" id="confirmar_contra" class="recibir" placeholder=" " required>
                <label for="confirmar_contra" class="etiqueta">Confirmar Nueva Contraseña</label>
            </div>

            <input type="submit" name="btn-cambiar-contra" value="Cambiar Contraseña" class="boton-cambiar">
        </form>
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