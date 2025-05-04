<?php
    include "../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
    session_start(); // Iniciar la sesión
    
    if(!empty($_POST['btn-iniciar-sesion'])){
        if(empty($_POST['email']) || empty($_POST['password'])){
            echo "<script>alert('Por favor, completa todos los campos.');</script>";
        }else{
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user_type = $_POST['user_type'];

            $verificar = $conn->query("SELECT * FROM usuarios WHERE correo_electronico_usr = '$email' AND contrasena_hash_usr = '$password' AND rol_usr = '$user_type'");

            if($datos = $verificar->fetch_object()){
                $_SESSION['primer_nombre_usr'] = $datos->primer_nombre_usr; // Guardar el primer nombre en la sesión
                $_SESSION['segundo_nombre_usr'] = $datos->segundo_nombre_usr; // Guardar el segundo nombre en la sesión
                $_SESSION['primer_apellido_usr'] = $datos->primer_apellido_usr; // Guardar el primer apellido en la sesión
                $_SESSION['segundo_apellido_usr'] = $datos->segundo_apellido_usr; // Guardar el segundo apellido en la sesión
                $_SESSION['puntos_acumulados_usr'] = $datos->puntos_acumulados_usr; // Guardar los puntos acumulados en la sesión

                if ($datos->rol_usr === 'estudiante') {
                    header("Location: ../views/entrar-usuario.php");
                    exit();
                } elseif ($datos->rol_usr === 'administrador') {
                    header("Location: ../views/entrar-administrador.php");
                    exit();
                }
            } else {
                echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
                header("Location: ../views/inicio-sesion.php"); // Redirigir a la página de inicio de sesión
                exit();
            }
        }
    }
?>