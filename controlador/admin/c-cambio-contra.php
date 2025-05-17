<?php
    include '../../modelo/conexion.php';
    session_start();

    if (!empty($_POST['btn-cambiar-contra'])) {
        $id_usuario = $_SESSION['id_usuario_usr'];
        $contra_actual = $_POST['contra_actual'];
        $nueva_contra = $_POST['nueva_contra'];
        $confirmar_contra = $_POST['confirmar_contra'];

        if ($nueva_contra !== $confirmar_contra) {
            echo "<script>
                    alert('Las contraseñas no coinciden.');
                    window.location.href = '../../views/admin/cambio-contra.php';
                </script>";
            exit();
        }

        $sql_verificar = "SELECT * FROM usuarios WHERE id_usuario_usr='$id_usuario'";
        $resultado = $conn->query($sql_verificar);
        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            // Verificar la contraseña actual sin hash
            if ($contra_actual === $row['contrasena_hash_usr']) {
                $sql_actualizar = "UPDATE usuarios SET contrasena_hash_usr='$nueva_contra' WHERE id_usuario_usr='$id_usuario'";
                if ($conn->query($sql_actualizar) === TRUE) {
                    echo "<script>
                            alert('Contraseña cambiada correctamente.');
                            window.location.href = '../../views/admin/entrar-administrador.php';
                        </script>";
                    exit();
                } else {
                    echo "<script>
                            alert('Error al actualizar la contraseña.');
                            window.location.href = '../../views/admin/cambio-contra.php';
                        </script>";
                    exit();
                }
            } else {
                echo "<script>
                        alert('La contraseña actual es incorrecta.');
                        window.location.href = '../../views/admin/cambio-contra.php';
                    </script>";
                exit();
            }
        } else {
            echo "<script>
                    alert('Usuario no encontrado.');
                    window.location.href = '../../views/admin/cambio-contra.php';
                </script>";
            exit();
        }
    }
?>
