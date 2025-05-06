<?php
    include_once "../modelo/conexion.php";
    
    if (!empty($_POST["btn-registrarse"])){
        if (!empty($_POST["primer_nombre_usr"]) && !empty($_POST["segundo_nombre_usr"]) && !empty($_POST["primer_apellido_usr"]) && !empty($_POST["segundo_apellido_usr"]) && !empty($_POST["telefono_usr"]) && !empty($_POST["cedula_usr"]) && !empty($_POST["correo_electronico_usr"]) && !empty($_POST["contrasena_hash_usr"])){
            
            $primer_nombre_usr = $_POST["primer_nombre_usr"];
            $segundo_nombre_usr = $_POST["segundo_nombre_usr"];
            $primer_apellido_usr = $_POST["primer_apellido_usr"];
            $segundo_apellido_usr = $_POST["segundo_apellido_usr"];
            $telefono_usr = $_POST["telefono_usr"];
            $cedula_usr = $_POST["cedula_usr"];
            $correo_electronico_usr = $_POST["correo_electronico_usr"];
            $contrasena_hash_usr = $_POST["contrasena_hash_usr"];
            $codigo_qr_usr = NULL; // Generar el nombre del archivo QR
            $fecha_registro_usr = date("Y-m-d H:i:s");
            $rol_usr = "estudiante";
            $estado_cuenta_usr = "activo";
            $puntos_acumulados_usr = 0;

            $insertar_usuario = "INSERT INTO usuarios (primer_nombre_usr, segundo_nombre_usr, primer_apellido_usr, segundo_apellido_usr, telefono_usr, cedula_usr, correo_electronico_usr, contrasena_hash_usr, codigo_qr_usr, fecha_registro_usr, rol_usr, estado_cuenta_usr, puntos_acumulados_usr) 
            VALUES ('$primer_nombre_usr', '$segundo_nombre_usr', '$primer_apellido_usr', '$segundo_apellido_usr', '$telefono_usr', '$cedula_usr', '$correo_electronico_usr', '$contrasena_hash_usr', '$codigo_qr_usr', '$fecha_registro_usr', '$rol_usr', '$estado_cuenta_usr', $puntos_acumulados_usr)";

            if ($conn->query($insertar_usuario) === TRUE) {
                echo "<script>
                        alert('Usuario registrado correctamente.');
                        window.location.href = '../views/inicio-sesion.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error: " . $conn->error . "');
                        window.history.back();
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Error: Todos los campos son obligatorios.');
                    window.history.back();
                  </script>";
        }
    }
?>