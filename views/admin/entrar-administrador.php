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
    <!-- data tables -->
    <link href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.min.css" rel="stylesheet" integrity="sha384-xkQqWcEusZ1bIXoKJoItkNbJJ1LG5QwR5InghOwFLsCoEkGcNLYjE0O83wWruaK9" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet" integrity="sha384-DJhypeLg79qWALC844KORuTtaJcH45J+36wNgzj4d1Kv1vt2PtRuV2eVmdkVmf/U" crossorigin="anonymous">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sesión Administrador</title>
</head>
<body>
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>"></script>
    <!-- data tables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha384-+mbV2IY1Zk/X1p/nWllGySJSUN8uMs+gUAN10Or95UBH0fpj6GfKgPmgC5EXieXG" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js" integrity="sha384-ehaRe3xJ0fffAlDr3p72vNw3wWV01C1/Z19X6s//i6hiF8hee+c+rabqObq8YlOk" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.bootstrap5.min.js" integrity="sha384-G85lmdZCo2WkHaZ8U1ZceHekzKcg37sFrs4St2+u/r2UtfvSDQmQrkMsEx4Cgv/W" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.min.js" integrity="sha384-zlMvVlfnPFKXDpBlp4qbwVDBLGTxbedBY2ZetEqwXrfWm+DHPvVJ1ZX7xQIBn4bU" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.bootstrap5.min.js" integrity="sha384-BdedgzbgcQH1hGtNWLD56fSa7LYUCzyRMuDzgr5+9etd1/W7eT0kHDrsADMmx60k" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.colVis.min.js" integrity="sha384-v0wzF6NECWiQyIain/Wacl6wEYr6NDJRus6qpckumPIngNI9Zo0sDMon5lBh9Np1" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.html5.min.js" integrity="sha384-+E6fb8f66UPOVDHKlEc1cfguF7DOTQQ70LNUnlbtywZiyoyQWqtrMjfTnWyBlN/Y" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.print.min.js" integrity="sha384-FvTRywo5HrkPlBKFrm2tT8aKxIcI/VU819roC/K/8UrVwrl4XsF3RKRKiCAKWNly" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/admin/script-ordenar-usuario.js"></script>

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

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead style="background-color: blue; color: white;">
                <tr>
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
                    <td>
                        <?php
                        if ($datos->estado_cuenta_usr === 'activo') {
                            echo '<i class="fa-solid fa-user-check" title="Activo"></i>';
                        } elseif ($datos->estado_cuenta_usr === 'inactivo') {
                            echo '<i class="fa-solid fa-circle-xmark" title="Inactivo"></i>';
                        } elseif ($datos->estado_cuenta_usr === 'suspendido') {
                            echo '<i class="fa-solid fa-ban" title="Suspendido"></i>';
                        }
                        ?>
                    </td>
                    <td><?= $datos->puntos_acumulados_usr ?></td>
                    <td>
                        <a class="btn btn-warning" href="modificar-usuario.php?id=<?= $datos->id_usuario_usr ?>" title="Actualizar"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-danger" href="../../controlador/admin/c-eliminar-usuario.php?id=<?= $datos->id_usuario_usr ?>" title="Eliminar" onclick="return confirmar()"><i class="fa-solid fa-trash"></i></a>
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