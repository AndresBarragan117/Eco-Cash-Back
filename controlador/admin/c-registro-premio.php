<?php
include '../../modelo/conexion.php'; // Conexión a la base de datos

if (!empty($_POST['btn-ingresar'])) {
    if (!empty($_POST['nombre_recompensa_rec']) && !empty($_POST['descripcion_rec']) && 
        !empty($_POST['costo_puntos_rec']) && !empty($_POST['stock_disponible_rec']) && 
        !empty($_POST['tipo_premio']) && !empty($_POST['tipo_estado_premio'])) {
        
        // Datos del formulario
        $nombre_recompensa_rec = $_POST['nombre_recompensa_rec'];
        $descripcion_rec = $_POST['descripcion_rec'];
        $costo_puntos_rec = $_POST['costo_puntos_rec'];
        $stock_disponible_rec = $_POST['stock_disponible_rec'];
        $tipo_premio = $_POST['tipo_premio'];
        $tipo_estado_premio = $_POST['tipo_estado_premio'];

        // Manejo de la imagen
        $imagen_rec = '';
        if (!empty($_FILES['imagen_rec']['name'])) {
            $imagen_rec = $_FILES['imagen_rec']['name'];
            $ruta_imagen = "../../img/img-catalogo/" . basename($imagen_rec);

            // Subir la imagen al servidor
            if (!move_uploaded_file($_FILES['imagen_rec']['tmp_name'], $ruta_imagen)) {
                echo "<script>
                        alert('Error al subir la imagen.');
                        window.location.href = '../../views/admin/agregar-premio.php';
                    </script>";
                exit();
            }
        }

        // Insertar los datos en la base de datos
        $insertar_premio = "INSERT INTO recompensas (nombre_recompensa_rec, descripcion_rec, costo_puntos_rec, stock_disponible_rec, tipo_recompensa_rec, estado_rec, imagen_rec) 
                            VALUES ('$nombre_recompensa_rec', '$descripcion_rec', $costo_puntos_rec, $stock_disponible_rec, '$tipo_premio', '$tipo_estado_premio', '$imagen_rec')";

        if ($conn->query($insertar_premio) === TRUE) {
            echo "<script>
                    alert('Premio agregado correctamente.');
                    window.location.href = '../../views/admin/catalogo.php';
                </script>";
        } else {
            echo "<script>
                    alert('Error al agregar el premio: " . $conn->error . "');
                    window.location.href = '../../views/admin/agregar-premio.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Por favor, complete todos los campos.');
                window.location.href = '../../views/admin/agregar-premio.php';
            </script>";
    }
}
?>