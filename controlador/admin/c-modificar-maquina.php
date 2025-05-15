<?php
    include '../../modelo/conexion.php'; // Ruta corregida
    session_start(); // Iniciar la sesión

    if (!empty($_POST['btn-actualizar-maquina'])) {
        $id_maquina_mac = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id_maquina_mac <= 0) {
            echo "<script>
                    alert('ID de máquina no válido.');
                    window.location.href = '../../views/admin/maquinas-reciclaje.php';
                </script>";
            exit();
        }
        if (
            isset($_POST['ubicacion_mac'], $_POST['estado_mac'], $_POST['ultima_mantenimiento_mac'], 
              $_POST['modelo_maquina_mac'], $_POST['capacidad_actual_vidrio_mac'], $_POST['capacidad_maxima_vidrio_mac'], 
              $_POST['capacidad_actual_plastico_mac'], $_POST['capacidad_maxima_plastico_mac'], 
              $_POST['capacidad_actual_metal_mac'], $_POST['capacidad_maxima_metal_mac'], 
              $_POST['capacidad_actual_carton_mac'], $_POST['capacidad_maxima_carton_mac'], 
              $_POST['capacidad_actual_pilas_mac'], $_POST['capacidad_maxima_pilas_mac']) &&
            !empty($_POST['estado_mac']) && !empty($_POST['modelo_maquina_mac']) && 
            is_numeric($_POST['capacidad_actual_vidrio_mac']) && is_numeric($_POST['capacidad_maxima_vidrio_mac']) && 
            is_numeric($_POST['capacidad_actual_plastico_mac']) && is_numeric($_POST['capacidad_maxima_plastico_mac']) && 
            is_numeric($_POST['capacidad_actual_metal_mac']) && is_numeric($_POST['capacidad_maxima_metal_mac']) && 
            is_numeric($_POST['capacidad_actual_carton_mac']) && is_numeric($_POST['capacidad_maxima_carton_mac']) && 
            is_numeric($_POST['capacidad_actual_pilas_mac']) && is_numeric($_POST['capacidad_maxima_pilas_mac'])
        ) {
            // Obtener los datos del formulario
            $ubicacion_mac = $_POST['ubicacion_mac'] ?? null; // Manejo de ubicación opcional
            $estado_mac = $_POST['estado_mac'];
            $ultima_mantenimiento_mac = $_POST['ultima_mantenimiento_mac'] ?? null; // Manejo de fecha opcional
            $modelo_maquina_mac = $_POST["modelo_maquina_mac"];
            $capacidad_actual_vidrio_mac = $_POST["capacidad_actual_vidrio_mac"];
            $capacidad_maxima_vidrio_mac = $_POST["capacidad_maxima_vidrio_mac"];
            $capacidad_actual_plastico_mac = $_POST["capacidad_actual_plastico_mac"];
            $capacidad_maxima_plastico_mac = $_POST["capacidad_maxima_plastico_mac"];
            $capacidad_actual_metal_mac = $_POST["capacidad_actual_metal_mac"];
            $capacidad_maxima_metal_mac = $_POST["capacidad_maxima_metal_mac"];
            $capacidad_actual_carton_mac = $_POST["capacidad_actual_carton_mac"];
            $capacidad_maxima_carton_mac = $_POST["capacidad_maxima_carton_mac"];
            $capacidad_actual_pilas_mac = $_POST["capacidad_actual_pilas_mac"];
            $capacidad_maxima_pilas_mac = $_POST["capacidad_maxima_pilas_mac"];

            // Actualizar los datos en la base de datos
            $actualizar_maquina = "UPDATE maquinas_reciclaje SET 
            ubicacion_mac='$ubicacion_mac',
            estado_mac='$estado_mac',
            ultima_mantenimiento_mac='$ultima_mantenimiento_mac',
            modelo_maquina_mac='$modelo_maquina_mac', 
            capacidad_actual_vidrio_mac=$capacidad_actual_vidrio_mac, 
            capacidad_maxima_vidrio_mac=$capacidad_maxima_vidrio_mac, 
            capacidad_actual_plastico_mac=$capacidad_actual_plastico_mac, 
            capacidad_maxima_plastico_mac=$capacidad_maxima_plastico_mac, 
            capacidad_actual_metal_mac=$capacidad_actual_metal_mac, 
            capacidad_maxima_metal_mac=$capacidad_maxima_metal_mac, 
            capacidad_actual_carton_mac=$capacidad_actual_carton_mac, 
            capacidad_maxima_carton_mac=$capacidad_maxima_carton_mac, 
            capacidad_actual_pilas_mac=$capacidad_actual_pilas_mac, 
            capacidad_maxima_pilas_mac=$capacidad_maxima_pilas_mac
            WHERE id_maquina_mac=$id_maquina_mac";

            if ($conn->query($actualizar_maquina) === TRUE) {
            echo "<script>
                alert('Máquina actualizada correctamente.');
                window.location.href = '../../views/admin/maquinas-reciclaje.php';
                </script>";
            exit();
            } else {
            echo "<script>
                alert('Error al actualizar la máquina: " . $conn->error . "');
                window.location.href = '../../views/admin/modificar-maquina.php?id=" . $_POST['id'] . "';
                </script>";
            exit();
            }
        } else {
            echo "<script>
                    alert('Por favor, completa todos los campos obligatorios correctamente.');
                    window.location.href = '../../views/admin/modificar-maquina.php?id=" . $_POST['id'] . "';
                </script>";
            exit();
        }
    }
?>