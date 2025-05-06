<?php
    include "../../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
    session_start(); // Iniciar la sesión

    if (!isset($_SESSION['primer_nombre_usr']) || !isset($_SESSION['primer_apellido_usr'])) {
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
    <link rel="stylesheet" href="../../css/entrar-admin.css">
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

    <section class="caja-usuario">
        <h1>Bienveni@ Admin <?= $_SESSION['primer_nombre_usr'] ." ". $_SESSION['primer_apellido_usr'] ?></h1>
        <h1>Lista de Usuarios</h1>
        
        <script type="text/javascript">
            function confirmar() {
                return confirm("¿Está seguro de que desea eliminar este usuario?");
            }
        </script>

        <table class="table">
            <thead>
                <tr class="bg-primary">
                    <th>ID</th>
                    <th>Nombres Completos de Usuarios</th>
                    <!--<th>Segundo Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>-->
                    <th>Cedula</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>QR</th>
                    <th>Fecha de Registro</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Puntos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $mostrar_usuarios = "SELECT * FROM usuarios";
                    $resultado = $conn->query($mostrar_usuarios);
                    
                    while ($datos = $resultado->fetch_object()) 
                    {
                ?>
                    <tr>
                        <td><?= $datos->id_usuario_usr ?></td>
                        <td><?= $datos->primer_nombre_usr ." ". $datos->segundo_nombre_usr ." ". $datos->primer_apellido_usr ." ". $datos->segundo_apellido_usr ?></td>
                        <!--<td><?= $datos->segundo_nombre_usr ?></td>
                        <td><?= $datos->primer_apellido_usr ?></td>
                        <td><?= $datos->segundo_apellido_usr ?></td>-->
                        <td><?= $datos->cedula_usr ?></td>
                        <td><?= $datos->telefono_usr ?></td>
                        <td><?= $datos->correo_electronico_usr ?></td>
                        <td><?= $datos->contrasena_hash_usr ?></td>
                        <td><?= $datos->codigo_qr_usr ?></td>
                        <td><?= $datos->fecha_registro_usr ?></td>
                        <td><?= $datos->rol_usr ?></td>
                        <td><?= $datos->estado_cuenta_usr ?></td>
                        <td><?= $datos->puntos_acumulados_usr ?></td>
                        <td>
                            <a href="modificar-usuario.php?id=<?= $datos->id_usuario_usr ?>">Actualizar</a>
                            <a href="../../controlador/c-eliminar-usuario.php?id=<?= $datos->id_usuario_usr ?>" onclick="return confirmar()">Borrar</a>
                        </td>
                    </tr>    
                <?php 
                    }
                ?>
            </tbody>
        </table>
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