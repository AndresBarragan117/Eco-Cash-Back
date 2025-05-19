<?php
    if (!empty($_GET["id"])) {
        include "../../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos

        $id_maquina = $_GET["id"]; // Obtener el ID de la máquina desde la URL
        $eliminar_maquina = "DELETE FROM maquinas_reciclaje WHERE id_maquina_mac = $id_maquina"; // Consulta para eliminar la máquina
        $resultado = $conn->query($eliminar_maquina); // Ejecutar la consulta

        if ($resultado) {
            echo "<script>
                    alert('Máquina eliminada correctamente.');
                    location.href='../../views/admin/maquinas-reciclaje.php?mensaje=Máquina eliminada correctamente';
                </script>";
        } else {
            echo "<script>
                    alert('Error al eliminar la máquina.');
                    location.href='../../views/admin/maquinas-reciclaje.php?mensaje=Error al eliminar la máquina';
                </script>";
        }
    } else {
        header('Location: ../../views/admin/maquinas-reciclaje.php?mensaje=ID de máquina no proporcionado');
    }
?>