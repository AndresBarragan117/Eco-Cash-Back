<?php
include_once "../modelo/conexion.php";
require_once "../librerias/phpqrcode/qrlib.php"; // Incluir la librería QR

if (!empty($_POST["btn-registrarse"])) {
    if (!empty($_POST["primer_nombre_usr"]) && !empty($_POST["primer_apellido_usr"]) && !empty($_POST["telefono_usr"]) && !empty($_POST["cedula_usr"]) && !empty($_POST["correo_electronico_usr"]) && !empty($_POST["contrasena_hash_usr"]) && !empty($_POST["confirmar_contrasena_usr"])) {
        
        // Verificar que las contraseñas coincidan
        if ($_POST["contrasena_hash_usr"] !== $_POST["confirmar_contrasena_usr"]) {
            echo "<script>
                    alert('Las contraseñas no coinciden. Por favor, inténtalo de nuevo.');
                    window.history.back();
                  </script>";
            exit();
        }

        // Datos del formulario
        $primer_nombre_usr = $_POST["primer_nombre_usr"];
        $segundo_nombre_usr = !empty($_POST["segundo_nombre_usr"]) ? $_POST["segundo_nombre_usr"] : NULL;
        $primer_apellido_usr = $_POST["primer_apellido_usr"];
        $segundo_apellido_usr = !empty($_POST["segundo_apellido_usr"]) ? $_POST["segundo_apellido_usr"] : NULL;
        $telefono_usr = $_POST["telefono_usr"];
        $cedula_usr = $_POST["cedula_usr"];
        $correo_electronico_usr = $_POST["correo_electronico_usr"];
        /* $contrasena_hash_usr = password_hash($_POST["contrasena_hash_usr"], PASSWORD_DEFAULT); // Encriptar la contraseña */
        $contrasena_hash_usr = $_POST["contrasena_hash_usr"];
        $fecha_registro_usr = date("Y-m-d H:i:s");
        $rol_usr = "estudiante";
        $estado_cuenta_usr = "activo";
        $puntos_acumulados_usr = 0;

        // Generar el código QR personal
        $qr_dir = '../qrcodes/usuarios/';
        if (!file_exists($qr_dir)) {
            mkdir($qr_dir, 0755, true); // Crear el directorio si no existe
        }

        $qr_filename = $qr_dir . $cedula_usr . '.png'; // Nombre del archivo QR
        $qr_content = "Correo: $correo_electronico_usr\nContraseña: $contrasena_hash_usr\nRol: $rol_usr"; // Contenido del QR
        QRcode::png($qr_content, $qr_filename, QR_ECLEVEL_L, 4); // Generar el QR

        // Insertar usuario en la base de datos
        $codigo_qr_usr = $cedula_usr . '.png'; // Guardar el nombre del archivo QR
        $insertar_usuario = "INSERT INTO usuarios (primer_nombre_usr, segundo_nombre_usr, primer_apellido_usr, segundo_apellido_usr, telefono_usr, cedula_usr, correo_electronico_usr, contrasena_hash_usr, codigo_qr_usr, fecha_registro_usr, rol_usr, estado_cuenta_usr, puntos_acumulados_usr) 
        VALUES ('$primer_nombre_usr', " . ($segundo_nombre_usr ? "'$segundo_nombre_usr'" : "NULL") . ", '$primer_apellido_usr', " . ($segundo_apellido_usr ? "'$segundo_apellido_usr'" : "NULL") . ", '$telefono_usr', '$cedula_usr', '$correo_electronico_usr', '$contrasena_hash_usr', '$codigo_qr_usr', '$fecha_registro_usr', '$rol_usr', '$estado_cuenta_usr', $puntos_acumulados_usr)";

        if ($conn->query($insertar_usuario) === TRUE) {
            echo "<script>
                    alert('Usuario registrado correctamente.');
                    window.location.href = '../views/inicio-sesion.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error al registrar el usuario: " . $conn->error . "');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('Error: Todos los campos obligatorios excepto segundo nombre y segundo apellido.');
                window.history.back();
              </script>";
    }
}
?>