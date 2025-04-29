<?php 
    include_once ('conexion.php');

    $id_usuario_usr = null;
    $primer_nombre_usr = $_POST['primer_nombre_usr'];
    $segundo_nombre_usr = $_POST['segundo_nombre_usr'];
    $primer_apellido_usr = $_POST['primer_apellido_usr'];
    $segundo_apellido_usr = $_POST['segundo_apellido_usr'];
    $cedula_usr = $_POST['cedula_usr'];
    $telefono_usr = $_POST['telefono_usr'];
    $correo_electronico_usr = $_POST['correo_electronico_usr'];
    $contrasena_hash_usr = $_POST['contrasena_hash_usr'];
    $codigo_qr_usr = null; // Inicializar como null
    $fecha_registro_usr = date("Y-m-d H:i:s");
    $rol_usr = "estudiante"; // Rol por defecto
    $estado_cuenta_usr = "activo"; // Activo por defecto
    $puntos_acumulados_usr = 0; // Inicializar puntos en 0
    //$contrasena_hash = password_hash($contrasena_hash_usr, PASSWORD_DEFAULT); // Hashear la contraseña de forma segura

    $insertar_usuario = "INSERT INTO usuarios (id_usuario_usr, primer_nombre_usr, segundo_nombre_usr, primer_apellido_usr, segundo_apellido_usr, cedula_usr, telefono_usr, correo_electronico_usr, contrasena_hash_usr, codigo_qr_usr, fecha_registro_usr, rol_usr, estado_cuenta_usr, puntos_acumulados_usr) 
    VALUES ('$id_usuario_usr','$primer_nombre_usr','$segundo_nombre_usr','$primer_apellido_usr','$segundo_apellido_usr','$cedula_usr','$telefono_usr','$correo_electronico_usr','$contrasena_hash_usr','$codigo_qr_usr','$fecha_registro_usr','$rol_usr','$estado_cuenta_usr', '$puntos_acumulados_usr')";
    
    $query = mysqli_query($conexion, $insertar_usuario);// Preparar la consulta SQL

    // Verificar si la consulta se ejecutó correctamente
    if ($query) {
        echo "<script> 
            alert('Usuario registrado correctamente'); 
            window.location.href = '../views/inicio-sesion.html'; // Redirigir a la página de inicio de sesión
        </script>";
    }else {
        echo "<script> 
            alert('Error al registrar el usuario: " . mysqli_error($conexion) . "'); 
            window.location.href = '../views/registro.html'; // Redirigir a la página de registro
        </script>";
    }
    
    mysqli_close($conexion); // Cerrar la conexión a la base de datos

    /*
    if (isset($_POST['registrar'])) {
        // Aquí puedes agregar cualquier lógica adicional que necesites al guardar el usuario
        $insertar_usuario = "INSERT INTO usuarios (id_usuario_usr, primer_nombre_usr, segundo_nombre_usr, primer_apellido_usr, segundo_apellido_usr, cedula_usr, telefono_usr, correo_electronico_usr, contrasena_hash_usr, codigo_qr_usr, fecha_registro_usr, rol_usr, estado_cuenta_usr, puntos_acumulados_usr) 
        VALUES ('$id_usuario_usr','$primer_nombre_usr','$segundo_nombre_usr','$primer_apellido_usr','$segundo_apellido_usr','$cedula_usr','$telefono_usr','$correo_electronico_usr','$contrasena_hash_usr','$codigo_qr_usr','$fecha_registro_usr','$rol_usr','$estado_cuenta_usr', '$puntos_acumulados_usr')";
        
        $query = mysqli_query($conexion, $insertar_usuario);// Preparar la consulta SQL

        // Verificar si la consulta se ejecutó correctamente
        if ($query) {
            header('Location: ../views/inicio-sesion.html'); // Redirigir a la página de inicio de sesión
            exit();
        } else {
            header('Location: ../views/registro.html'); // Redirigir a la página de registro
            exit();
        }
    }
    */
?>