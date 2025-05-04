<?php
    include "../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
    include_once('../controlador/c-registro-usuario.php'); // Incluir el archivo de controlador para registro de usuario
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="icon" href="../img/titulo-logo.ico">
    <title>Registrarse</title>
</head>
<body>
    <header class="header">
        <img class="logo" src="../img/titulo-logo.png" alt="">
        <h1 class="title-header">Eco Cash Back</h1>
    </header>

    <nav class="nav">
        <ul class="barnav">
            <a class="menu" href="../index.php">Inicio</a>
            <a class="menu" href="../index.php#nosotros">Nosotros</a>
            <a class="menu" href="../index.php#premios">Premios</a>
            <a class="menu" href="../index.php#como-participar">Cómo Participar</a>
            <a class="menu" href="registro.php">Registrarse</a>
            <a class="menu" href="../views/inicio-sesion.php">Iniciar Sesión</a>
        </ul>
    </nav>

    <div class="form-resgistro">
        <form action="" method="POST" class="formulario">
            <h1 class="title-registro">Registrarse</h1>

            <div class="contenedor-entrada">
                <input type="text" id="primer_nombre_usr" name="primer_nombre_usr" class="recibir" placeholder="a" required>
                <label for="primer_nombre_usr" class="etiqueta">Primer Nombre de Usuario</label>
            </div>

            <div class="contenedor-entrada">
                <input type="text" id="segundo_nombre_usr" name="segundo_nombre_usr" class="recibir" placeholder="a">
                <label for="segundo_nombre_usr" class="etiqueta">Segundo Nombre de Usuario</label>
            </div>

            <div class="contenedor-entrada">
                <input type="text" id="primer_apellido_usr" name="primer_apellido_usr" class="recibir" placeholder="a" required>
                <label for="primer_apellido_usr" class="etiqueta">Primer Apellido de Usuario</label>
            </div>

            <div class="contenedor-entrada">
                <input type="text" id="segundo_apellido_usr" name="segundo_apellido_usr" class="recibir" placeholder="a">
                <label for="segundo_apellido_usr" class="etiqueta">Segundo Apellido de Usuario</label>
            </div>

            <div class="contenedor-entrada">
                <input type="tel" id="telefono_usr" name="telefono_usr" class="recibir" placeholder="a" required>
                <label for="telefono_usr" class="etiqueta">Telefono</label>
            </div>

            <div class="contenedor-entrada">
                <input type="text" id="cedula_usr" name="cedula_usr" class="recibir" placeholder="a" required>
                <label for="cedula_usr" class="etiqueta">Cedula</label>
            </div>

            <div class="contenedor-entrada">
                <input type="email" id="correo_electronico_usr" name="correo_electronico_usr" class="recibir" placeholder="a" required>
                <label for="correo_electronico_usr" class="etiqueta">Correo Electrónico</label>
            </div>

            <div class="contenedor-entrada">
                <input type="password" id="contrasena_hash_usr" name="contrasena_hash_usr" class="recibir" placeholder="a" minlength="8" required>
                <label for="contrasena_hash_usr" class="etiqueta">Contraseña</label>
            </div>
            
            <input id="btn-registro" name="btn-registrarse" type="submit" class="boton-registro" value="registrarse">
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