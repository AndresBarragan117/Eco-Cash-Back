<?php
    include_once "../../modelo/conexion.php";
    
    if(!empty($_POST["btn-ingresar"])){
        if (!empty($_POST["nombre_recompensa_rec"]) && !empty($_POST["descripcion_rec"]) && !empty($_POST["costo_puntos_rec"]) && !empty($_POST["stock_disponible_rec"]) && !empty($_POST["tipo_premio"]) && !empty($_POST["tipo_estado_premio"]) && !empty($_POST["imagen_rec"])){
            
            $nombre_recompensa_rec = $_POST["nombre_recompensa_rec"];
            $descripcion_rec = $_POST["descripcion_rec"];
            $costo_puntos_rec = $_POST["costo_puntos_rec"];
            $stock_disponible_rec = $_POST["stock_disponible_rec"];
            $tipo_recompensa_rec = $_POST["tipo_premio"];
            $estado_rec = $_POST["tipo_estado_premio"];
            $imagen_rec = $_POST['imagen_rec'];
            
            $insertar_premio = "INSERT INTO recompensas (nombre_recompensa_rec, descripcion_rec, costo_puntos_rec, stock_disponible_rec, tipo_recompensa_rec, estado_rec, imagen_rec) 
            VALUES ('$nombre_recompensa_rec', '$descripcion_rec', '$costo_puntos_rec', '$stock_disponible_rec', '$tipo_recompensa_rec', '$estado_rec', '$imagen_rec')";

            if ($conn->query($insertar_premio) === TRUE) {
                echo "<script>
                        alert('Premio registrado correctamente.');
                        window.location.href = '../../views/admin/catalogo.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error: " . $conn->error . "');
                        window.history.back();
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Error: Todos los campos son obligatorios.');
                    window.history.back();
                  </script>";
        }
    }
?>