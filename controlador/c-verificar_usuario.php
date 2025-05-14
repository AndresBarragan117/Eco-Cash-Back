<?php
    include "../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
    session_start(); // Iniciar la sesión
    
    if(!empty($_POST['btn-iniciar-sesion'])){
        if(empty($_POST['email']) || empty($_POST['password'])){
            // Si los campos de email o contraseña están vacíos, redirigir a la página de inicio de sesión con un mensaje de error
            echo "<script>
                    alert('Por favor, completa todos los campos.');
                    window.location.href = '../views/inicio-sesion.php';
                </script>";
            exit();
        }else{
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user_type = $_POST['user_type'];

            $verificar = $conn->query("SELECT * FROM usuarios WHERE correo_electronico_usr = '$email' AND contrasena_hash_usr = '$password' AND rol_usr = '$user_type'");

            if($datos = $verificar->fetch_object()){
                $_SESSION['id_usuario_usr'] = $datos->id_usuario_usr; // Asegúrate de guardar el ID del usuario
                $_SESSION['primer_nombre_usr'] = $datos->primer_nombre_usr;
                $_SESSION['primer_apellido_usr'] = $datos->primer_apellido_usr;
                $_SESSION['puntos_acumulados_usr'] = $datos->puntos_acumulados_usr;
                $_SESSION['codigo_qr_usr'] = $datos->codigo_qr_usr; // Guardar el QR en la sesión

                if ($datos->rol_usr === 'estudiante') {
                    header("Location: ../views/usuario/entrar-usuario.php");
                    exit();
                } elseif ($datos->rol_usr === 'administrador') {
                    header("Location: ../views/admin/entrar-administrador.php");
                    exit();
                }
            } else {
                // Si no se encuentra el usuario, redirigir a la página de inicio de sesión con un mensaje de error
                echo "<script>
                        alert('Usuario o contraseña incorrectos.');
                        window.location.href = '../views/inicio-sesion.php';
                    </script>";
                exit();
            }
        }
    }
?>