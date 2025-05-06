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
    <link rel="stylesheet" href="../../css/admin/agregar-premio.css">
    <link rel="icon" href="../../img/titulo-logo.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Sesión Administrador</title>
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

    <div class="form-resgistro">
        <form action="../../controlador/admin/c-registro-premio.php" method="POST" class="formulario">
            <h1 class="title-registro">Agregar Premio</h1>

            <div class="contenedor-entrada">
                <input type="text" id="nombre_recompensa_rec" name="nombre_recompensa_rec" class="recibir" placeholder="a" required>
                <label for="nombre_recompensa_rec" class="etiqueta">Nombre del Premio</label>
            </div>

            <div class="contenedor-entrada">
                <textarea type="text" id="descripcion_rec" name="descripcion_rec" class="recibir" placeholder="a"></textarea>
                <label for="descripcion_rec" class="etiqueta">Descripcion del Premio</label>
            </div>

            <div class="contenedor-entrada">
                <input type="number" id="costo_puntos_rec" name="costo_puntos_rec" class="recibir" placeholder="0" required>
                <label for="costo_puntos_rec" class="etiqueta">Costo de Puntos</label>
            </div>

            <div class="contenedor-entrada">
                <input type="number" id="stock_disponible_rec" name="stock_disponible_rec" class="recibir" placeholder="a" required>
                <label for="stock_disponible_rec" class="etiqueta">Stock Disponible</label>
            </div>

            <div class="contenedor-entrada">
                <select name="tipo_premio" class="recibir">
                    <option value="descuento">Descuento</option>
                    <option value="producto fisico">Producto Fisico</option>
                    <option value="donacion">Donación</option>
                </select>
                <label for="tipo_premio" class="etiqueta">Tipo de Premio</label>
            </div>

            <div class="contenedor-entrada">
                <select name="tipo_estado_premio" class="recibir">
                    <option value="disponible">Disponible</option>
                    <option value="agotado">Agotado</option>
                    <option value="inactivo">Inactivo</option>
                </select>
                <label for="tipo_estado_premio" class="etiqueta">Estado Premio</label>
            </div>

            <div class="contenedor-entrada">
                <input type="text" id="imagen_rec" name="imagen_rec" class="recibir" placeholder="a" required>
                <label for="imagen_rec" class="etiqueta">Imagen Premio</label>
            </div>
                
            <input id="btn-ingresar" name="btn-ingresar" type="submit" class="boton-registro" value="agregar premio">
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