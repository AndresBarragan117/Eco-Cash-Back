<?php
    include "../../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
    include "../../controlador/admin/c-modificar-usuario.php"; // Incluir el archivo de controlador para modificar usuario
    
    $id_usuario = $_GET['id']; // Obtener el ID del usuario desde la URL
    $consulta = "SELECT * FROM usuarios WHERE id_usuario_usr = $id_usuario"; // Consulta para obtener los datos del usuario
    $resultado = $conn->query($consulta); // Ejecutar la consulta
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/modificar-usuario.css">
    <link rel="icon" href="../../img/titulo-logo.ico">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <title>Actualizar Usuario</title>
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
        <form action="" method="POST" class="formulario">
            <h1 class="title-registro">Modificar Usuario</h1>
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>"> <!-- Campo oculto para el ID del usuario -->
            
            <?php
                while($datos = $resultado->fetch_object()) 
                {
            ?>
                    <div class="contenedor-entrada">
                        <input type="text" id="primer_nombre_usr" name="primer_nombre_usr" class="recibir" placeholder="a" required value="<?= $datos->primer_nombre_usr ?>">
                        <label for="primer_nombre_usr" class="etiqueta">Primer Nombre de Usuario</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="text" id="segundo_nombre_usr" name="segundo_nombre_usr" class="recibir" placeholder="a" value="<?= $datos->segundo_nombre_usr ?>">
                        <label for="segundo_nombre_usr" class="etiqueta">Segundo Nombre de Usuario</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="text" id="primer_apellido_usr" name="primer_apellido_usr" class="recibir" placeholder="a" required value="<?= $datos->primer_apellido_usr ?>">
                        <label for="primer_apellido_usr" class="etiqueta">Primer Apellido de Usuario</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="text" id="segundo_apellido_usr" name="segundo_apellido_usr" class="recibir" placeholder="a" value="<?= $datos->segundo_apellido_usr ?>">
                        <label for="segundo_apellido_usr" class="etiqueta">Segundo Apellido de Usuario</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="tel" id="telefono_usr" name="telefono_usr" class="recibir" placeholder="a" required value="<?= $datos->telefono_usr ?>">
                        <label for="telefono_usr" class="etiqueta">Telefono</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="text" id="cedula_usr" name="cedula_usr" class="recibir" placeholder="a" required value="<?= $datos->cedula_usr ?>">
                        <label for="cedula_usr" class="etiqueta">Cedula</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="email" id="correo_electronico_usr" name="correo_electronico_usr" class="recibir" placeholder="a" required value="<?= $datos->correo_electronico_usr ?>">
                        <label for="correo_electronico_usr" class="etiqueta">Correo Electrónico</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="text" id="contrasena_hash_usr" name="contrasena_hash_usr" class="recibir" placeholder="a" minlength="8" required value="<?= $datos->contrasena_hash_usr ?>">
                        <label for="contrasena_hash_usr" class="etiqueta">Contraseña</label>
                    </div>
                    
                    <div class="contenedor-entrada">
                        <select name="rol_usr" class="recibir" required value="<?= $datos->rol_usr ?>">
                            <option value="estudiante" <?= $datos->rol_usr == 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
                            <option value="administrador" <?= $datos->rol_usr == 'administrador' ? 'selected' : '' ?>>Administrador</option>
                        </select>
                        <label for="rol_usr" class="etiqueta">Tipo de Usuario</label>
                    </div>

                    <div class="contenedor-entrada">
                        <select id="estado_cuenta_usr" name="estado_cuenta_usr" class="recibir" required>
                            <option value="activo" <?= $datos->estado_cuenta_usr == 'activo' ? 'selected' : '' ?>>Activo</option>
                            <option value="suspendido" <?= $datos->estado_cuenta_usr == 'suspendido' ? 'selected' : '' ?>>Suspendido</option>
                            <option value="inactivo" <?= $datos->estado_cuenta_usr == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                        <label for="estado_cuenta_usr" class="etiqueta">Estado Cuenta</label>
                    </div>

                    <div class="contenedor-entrada">
                        <input type="text" id="puntos_acumulados_usr" name="puntos_acumulados_usr" class="recibir" placeholder="a" required value="<?= $datos->puntos_acumulados_usr ?>">
                        <label for="puntos_acumulados_usr" class="etiqueta">Puntos Acumulados</label>
                    </div>
            <?php
                }
            ?>
  
            <input id="btn-registro" name="btn-actualizar-usuario" type="submit" class="boton-registro" value="Actualizar Usuario">
        </form>
    </div>
</body>
</html>