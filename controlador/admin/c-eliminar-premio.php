<?php
    if(!empty($_GET["id"])) {
        
        include "../../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
        
        $id_recompensa = $_GET["id"];
        $eliminar_premio = "DELETE FROM recompensas WHERE id_recompensa_rec = $id_recompensa";
        $resultado = $conn->query($eliminar_premio);
        
        if($resultado) {
            //header('Location: catalogo.php?mensaje=Premio eliminado correctamente');
            echo "<script>alert('Premio eliminado correctamente'); location.href='../../views/admin/catalogo.php?mensaje=Premio eliminado correctamente';</script>";
        } else {
            //header('Location: catalogo.php?mensaje=Error al eliminar el premio');
            echo "<script>alert('Error al eliminar el premio'); location.href='../../views/admin/catalogo.php?mensaje=Error al eliminar el premio';</script>";
        }
    } else {
        header('Location: ../../views/admin/catalogo.php?mensaje=ID de premio no proporcionado');
    }
?>