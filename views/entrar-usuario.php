<?php
    include "../modelo/conexion.php"; // Asegúrate de incluir la conexión a la base de datos
    session_start(); // Iniciar la sesión

    if (!isset($_SESSION['primer_nombre_usr']) || !isset($_SESSION['segundo_nombre_usr']) || !isset($_SESSION['primer_apellido_usr']) || !isset($_SESSION['segundo_apellido_usr']) || !isset($_SESSION['puntos_acumulados_usr'])) {
        header("Location: ../views/inicio-sesion.php"); // Redirigir a la página de inicio de sesión si no hay sesión activa
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
    <link rel="stylesheet" href="../css/entrar.css">
    <link rel="icon" href="../img/titulo-logo.ico">
    <title>Sesión Estudiante</title>
</head>
<body>
    <header class="header">
        <img class="logo" src="../img/titulo-logo.png" alt="">
        <h1 class="title-header">Eco Cash Back</h1>
    </header>

    <nav class="nav">
        <ul class="barnav">
            <a class="menu" href="../views/entrar-usuario.php">Puntos</a>
            <a class="menu" href="">Catálogo De Premios</a>
            <a class="menu" href="">Materiales Reciclados</a>
            <a class="menu" href="">Cambio de Contraseña</a>
            <a class="menu" href="../controlador/c-cerrar-sesion.php">Cerrar Sesión</a>
        </ul>
    </nav>

    <section>
        <div class="informacion">
            <h2>¡Bienvenid@ <?=  $_SESSION['primer_nombre_usr'] ." ". $_SESSION['segundo_nombre_usr'] ." ". $_SESSION['primer_apellido_usr'] ." ". $_SESSION['segundo_apellido_usr'] ?>!</h2>
            <div class="informacion-usuario">
                <img src="../img/ilustracion-de-botella-de-personaje-de-limpieza.webp" alt="">
                <div>
                    <div class="puntos">
                        <img class="icono" src="../img/icono_hoja.png" alt="icono de hoja">
                        <h3>Puntos Acumulados:</h3>
                        <h2><?= $_SESSION['puntos_acumulados_usr'] ?></h2> 
                    </div>
                    <div class="qr">
                        <img class="img-qr" src="../img/img-qr.png" alt="">
                        <h3>QR Personal</h3>
                    </div>
                </div>
            </div>
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