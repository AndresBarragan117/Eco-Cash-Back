<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/inicio-sesion.css">
    <link rel="icon" href="../img/titulo-logo.ico">
    <title>Iniciar Sesión</title>
</head>
<body>
    <header class="header">
        <img class="logo" src="../img/titulo-logo.png" alt="">
        <h1 class="title-header">Eco Cash Back</h1>
    </header>

    <nav class="nav">
        <ul class="barnav">
            <a class="menu" href="../index.html">Inicio</a>
            <a class="menu" href="../index.html#nosotros">Nosotros</a>
            <a class="menu" href="../index.html#como-paricipar">Como Participar</a>
            <a class="menu" href="../views/registro.php">Registrarse</a>
            <a class="menu" href="inicio-sesion.php">Iniciar Sesión</a>
        </ul>
    </nav>

    <div class="form-iniciar-sesion">
        <form action="" class="formulario">
        <h1 class="title-iniciar-sesion">Iniciar Sesión</h1>
    
        <div class="contenedor-entrada">
            <input id="email" type="text" class="recibir" placeholder="a">
            <label for="email" class="etiqueta">Email</label>
        </div>
    
        <div class="contenedor-entrada">
            <input id="password" type="password" class="recibir" placeholder="a">
            <label for="password" class="etiqueta">Contraseña</label>
        </div>
    
        <input id="btn-registro" type="submit" class="boton-iniciar-sesion" value="Iniciar Sesión">
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