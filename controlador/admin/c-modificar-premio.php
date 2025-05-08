<?php
include '../../modelo/conexion.php'; // Ruta corregida
session_start(); // Iniciar la sesión

if (!empty($_POST['btn-actualizar-premio'])) {
    $id_recompensa_rec = isset($_POST['id']) ? intval($_POST['id']) : 0;
    if ($id_recompensa_rec <= 0) {
        echo "<script>
                alert('ID de premio no válido.');
                window.location.href = '../../views/admin/catalogo.php';
            </script>";
        exit();
    }

    if (
        isset($_POST['nombre_recompensa_rec'], $_POST['descripcion_rec'], $_POST['costo_puntos_rec'], 
              $_POST['stock_disponible_rec'], $_POST['tipo_recompensa_rec'], $_POST['estado_rec']) &&
        !empty($_POST['nombre_recompensa_rec']) && !empty($_POST['descripcion_rec']) &&
        is_numeric($_POST['costo_puntos_rec']) && is_numeric($_POST['stock_disponible_rec'])
    ) {
        // Obtener los datos del formulario
        $nombre_recompensa_rec = $_POST["nombre_recompensa_rec"];
        $descripcion_rec = $_POST["descripcion_rec"];
        $costo_puntos_rec = $_POST["costo_puntos_rec"];
        $stock_disponible_rec = $_POST["stock_disponible_rec"];
        $tipo_recompensa_rec = $_POST['tipo_recompensa_rec'];
        $estado_rec = $_POST['estado_rec'];

        // Manejo de la imagen
        $imagen_rec = $_POST['imagen_actual']; // Usar la imagen actual por defecto
        if (!empty($_FILES['imagen_rec']['name'])) {
            $imagen_rec = $_FILES['imagen_rec']['name'];
            $ruta_imagen = "../../img/img-catalogo/" . basename($imagen_rec);

            // Subir la imagen al servidor
            if (!move_uploaded_file($_FILES['imagen_rec']['tmp_name'], $ruta_imagen)) {
                echo "<script>
                        alert('Error al subir la imagen.');
                        window.location.href = '../../views/admin/modificar-premio.php?id=" . $_POST['id'] . "';
                    </script>";
                exit();
            }
        }

        // Actualizar los datos en la base de datos
        $actualizar_premio = "UPDATE recompensas SET 
            nombre_recompensa_rec='$nombre_recompensa_rec', 
            descripcion_rec='$descripcion_rec', 
            costo_puntos_rec=$costo_puntos_rec, 
            stock_disponible_rec=$stock_disponible_rec, 
            tipo_recompensa_rec='$tipo_recompensa_rec', 
            estado_rec='$estado_rec', 
            imagen_rec='$imagen_rec' 
            WHERE id_recompensa_rec=$id_recompensa_rec";

        if ($conn->query($actualizar_premio) === TRUE) {
            echo "<script>
                    alert('Premio actualizado correctamente.');
                    window.location.href = '../../views/admin/catalogo.php';
                </script>";
            exit();
        } else {
            echo "<script>
                    alert('Error al actualizar el premio: " . $conn->error . "');
                    window.location.href = '../../views/admin/modificar-premio.php?id=" . $_POST['id'] . "';
                </script>";
        }
    } else {
        echo "<script>
                alert('Error: Todos los campos son obligatorios y deben ser válidos.');
                window.location.href = '../../views/admin/modificar-premio.php?id=" . $_POST['id'] . "';
            </script>";
    }
}
?>