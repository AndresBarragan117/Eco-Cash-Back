<?php
    include '../../modelo/conexion.php'; // Conexión a la base de datos

    if (!empty($_POST['btn-ingresar'])) {
        if (!empty($_POST['ubicacion_mac']) && !empty($_POST['estado_mac']) && 
            !empty($_POST['capacidad_maxima_vidrio_mac']) && 
            !empty($_POST['capacidad_maxima_plastico_mac']) && 
            !empty($_POST['capacidad_maxima_metal_mac']) && 
            !empty($_POST['capacidad_maxima_carton_mac']) && 
            !empty($_POST['capacidad_maxima_pilas_mac']) && 
            !empty($_POST['modelo_maquina_mac'])) {
            
            // Datos del formulario
            $ubicacion_mac = $_POST['ubicacion_mac'];
            $estado_mac = $_POST['estado_mac'];
            $ultima_mantenimiento_mac = !empty($_POST['ultima_mantenimiento_mac']) ? $_POST['ultima_mantenimiento_mac'] : date("Y-m-d H:i:s");
            $modelo_maquina_mac = $_POST['modelo_maquina_mac'];

            // Capacidad actual (si no se ingresa, se registra como 0)
            $capacidad_actual_vidrio_mac = !empty($_POST['capacidad_actual_vidrio_mac']) ? $_POST['capacidad_actual_vidrio_mac'] : 0;
            $capacidad_actual_plastico_mac = !empty($_POST['capacidad_actual_plastico_mac']) ? $_POST['capacidad_actual_plastico_mac'] : 0;
            $capacidad_actual_metal_mac = !empty($_POST['capacidad_actual_metal_mac']) ? $_POST['capacidad_actual_metal_mac'] : 0;
            $capacidad_actual_carton_mac = !empty($_POST['capacidad_actual_carton_mac']) ? $_POST['capacidad_actual_carton_mac'] : 0;
            $capacidad_actual_pilas_mac = !empty($_POST['capacidad_actual_pilas_mac']) ? $_POST['capacidad_actual_pilas_mac'] : 0;

            // Capacidad máxima
            $capacidad_maxima_vidrio_mac = $_POST['capacidad_maxima_vidrio_mac'];
            $capacidad_maxima_plastico_mac = $_POST['capacidad_maxima_plastico_mac'];
            $capacidad_maxima_metal_mac = $_POST['capacidad_maxima_metal_mac'];
            $capacidad_maxima_carton_mac = $_POST['capacidad_maxima_carton_mac'];
            $capacidad_maxima_pilas_mac = $_POST['capacidad_maxima_pilas_mac'];

            // Insertar los datos en la base de datos
            $insertar_maquina = "INSERT INTO maquinas_reciclaje (
                ubicacion_mac, estado_mac, ultima_mantenimiento_mac, modelo_maquina_mac, 
                capacidad_actual_vidrio_mac, capacidad_maxima_vidrio_mac, 
                capacidad_actual_plastico_mac, capacidad_maxima_plastico_mac, 
                capacidad_actual_metal_mac, capacidad_maxima_metal_mac, 
                capacidad_actual_carton_mac, capacidad_maxima_carton_mac, 
                capacidad_actual_pilas_mac, capacidad_maxima_pilas_mac
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($insertar_maquina);
            $stmt->bind_param(
                "ssssiiiiiiiiii", 
                $ubicacion_mac, $estado_mac, $ultima_mantenimiento_mac, $modelo_maquina_mac, 
                $capacidad_actual_vidrio_mac, $capacidad_maxima_vidrio_mac, 
                $capacidad_actual_plastico_mac, $capacidad_maxima_plastico_mac, 
                $capacidad_actual_metal_mac, $capacidad_maxima_metal_mac, 
                $capacidad_actual_carton_mac, $capacidad_maxima_carton_mac, 
                $capacidad_actual_pilas_mac, $capacidad_maxima_pilas_mac
            );

            if ($stmt->execute()) {
                echo "<script>
                        alert('Máquina registrada correctamente.');
                        window.location.href = '../../views/admin/maquinas-reciclaje.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Error al registrar la máquina: " . $conn->error . "');
                        window.location.href = '../../views/admin/agregar-maquina.php';
                    </script>";
            }

            $stmt->close();
        } else {
            echo "<script>
                    alert('Por favor, complete todos los campos obligatorios.');
                    window.location.href = '../../views/admin/agregar-maquina.php';
                </script>";
        }
    }
?>