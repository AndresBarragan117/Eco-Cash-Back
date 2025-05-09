<?php
    if(!empty($_GET["id"])) {
        
        include "../../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
        
        $id_usuario = $_GET["id"];
        $eliminar_usuario = "DELETE FROM usuarios WHERE id_usuario_usr = $id_usuario";
        $resultado = $conn->query($eliminar_usuario);
        
        if($resultado) {
            //header('Location: entrar-administrador.php?mensaje=Usuario eliminado correctamente');
            echo "<script>alert('Usuario eliminado correctamente'); location.href='../../views/admin/entrar-administrador.php?mensaje=Usuario eliminado correctamente';</script>";
        } else {
            //header('Location: entrar-administrador.php?mensaje=Error al eliminar el usuario');
            echo "<script>alert('Error al eliminar el usuario'); location.href='../../views/admin/entrar-administrador.php?mensaje=Error al eliminar el usuario';</script>";
        }
    } else {
        header('Location: ../../views/admin/entrar-administrador.php?mensaje=ID de usuario no proporcionado');
    }
?>