<?php
    include '../../modelo/conexion.php'; // Ruta corregida
    session_start(); // Iniciar la sesión

    if (!empty($_POST['btn-actualizar-usuario'])) {
        if (!empty($_POST['primer_nombre_usr']) && !empty($_POST['primer_apellido_usr']) && !empty($_POST['cedula_usr']) && !empty($_POST['correo_electronico_usr']) && !empty($_POST['contrasena_hash_usr']) && !empty($_POST['rol_usr']) && !empty($_POST['estado_cuenta_usr'])) {
            
            $id_usuario_usr = $_POST['id'];
            $primer_nombre_usr = $_POST["primer_nombre_usr"];
            $segundo_nombre_usr = !empty($_POST["segundo_nombre_usr"]) ? $_POST["segundo_nombre_usr"] : NULL;
            $primer_apellido_usr = $_POST["primer_apellido_usr"];
            $segundo_apellido_usr = !empty($_POST["segundo_apellido_usr"]) ? $_POST["segundo_apellido_usr"] : NULL;
            $telefono_usr = $_POST["telefono_usr"];
            $cedula_usr = $_POST["cedula_usr"];
            $correo_electronico_usr = $_POST["correo_electronico_usr"];
            $contrasena_hash_usr = $_POST["contrasena_hash_usr"];
            $rol_usr = $_POST['rol_usr'];
            $estado_cuenta_usr = $_POST['estado_cuenta_usr'];
            $puntos_acumulados_usr = $_POST['puntos_acumulados_usr'];
        
            $actualizar_usuario = "UPDATE usuarios SET primer_nombre_usr='$primer_nombre_usr', segundo_nombre_usr='$segundo_nombre_usr', primer_apellido_usr='$primer_apellido_usr', segundo_apellido_usr='$segundo_apellido_usr', telefono_usr='$telefono_usr', cedula_usr='$cedula_usr', correo_electronico_usr='$correo_electronico_usr', contrasena_hash_usr='$contrasena_hash_usr', rol_usr='$rol_usr', estado_cuenta_usr='$estado_cuenta_usr', puntos_acumulados_usr='$puntos_acumulados_usr' WHERE id_usuario_usr=$id_usuario_usr";

            if ($conn->query($actualizar_usuario) === TRUE) {
                header("Location: ../../views/admin/entrar-administrador.php"); // Redirigir a la página de administración
            } else {
                echo "<script>
                    alert('Error: " . $actualizar_usuario . "\\n" . $conn->error . "');
                    window.location.href = '../../views/admin/modificar-usuario.php?id=" . $_POST['id'] . "'; // Redirigir a la página de modificación
                </script>";
            }
        } else {
            echo "<script>
                alert('Error: Todos los campos son obligatorios.');
                window.location.href = '../../views/admin/modificar-usuario.php?id=" . $_POST['id'] . "'; // Redirigir a la página de modificación
            </script>";
        }
    }
?>