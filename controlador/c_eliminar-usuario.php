<?php
    if(!empty($_GET["id"])) {
        
        include "../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
        
        $id_usuario = $_GET["id"];
        $eliminar_usuario = "DELETE FROM usuarios WHERE id_usuario_usr = $id_usuario";
        $resultado = $conn->query($eliminar_usuario);
        
        if($resultado) {
            header('Location: entrar-administrador.php?mensaje=Usuario eliminado correctamente');
        } else {
            header('Location: entrar-administrador.php?mensaje=Error al eliminar el usuario');
        }
    } else {
        header('Location: entrar-administrador.php?mensaje=ID de usuario no proporcionado');
    }
?>