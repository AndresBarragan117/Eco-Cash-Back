<?php
    if(!empty($_POST['btn-iniciar-sesion'])){
        if(empty($_POST['email']) || empty($_POST['password'])){
            echo "<script>alert('Por favor, completa todos los campos.');</script>";
        }else{
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user_type = $_POST['user_type'];

            $verificar = $conn->query("SELECT * FROM usuarios WHERE correo_electronico_usr = '$email' AND contrasena_hash_usr = '$password' AND rol_usr = '$user_type'");

            if($datos = $verificar->fetch_object()){
                if ($datos->rol_usr === 'estudiante') {
                    header("Location: ../views/entrar-usuario.php");
                    exit();
                } elseif ($datos->rol_usr === 'administrador') {
                    header("Location: ../views/entrar-administrador.php");
                    exit();
                }
            } else {
                echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
            }
            
        }
    }
?>