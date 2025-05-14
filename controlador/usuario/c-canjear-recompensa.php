<?php
    error_reporting(E_ALL); // Mostrar todos los errores
    ini_set('display_errors', 1); // Mostrar errores en la pantalla

    include "../../modelo/conexion.php"; // Incluir el archivo de conexión a la base de datos
    header('Content-Type: application/json'); // Establece que la respuesta será en formato JSON.
    session_start(); // Inicia la sesión para acceder a las variables de sesión.

    // Verifica si la sesión está activa y si el usuario ha iniciado sesión. Si no, devuelve un mensaje de error en formato JSON y detiene la ejecución.
    if (!isset($_SESSION['id_usuario_usr'])) {
        error_log("Sesión no iniciada. Verifica que la sesión esté configurada correctamente."); // Log de error
        echo json_encode(['success' => false, 'message' => 'Sesión no iniciada.']); // Respuesta JSON
        exit();
    } else {
        error_log("Sesión iniciada correctamente. ID de usuario: " . $_SESSION['id_usuario_usr']); // Log de éxito
    }

    // Asegura que la solicitud sea de tipo POST. Si no lo es, devuelve un mensaje de error.
    // Esto es importante para evitar ataques CSRF y asegurar que la solicitud es válida
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        exit();
    }

    try {
        // Procesamiento de los datos recibidos
        $input = json_decode(file_get_contents('php://input'), true); // Obtiene los datos enviados desde el cliente en formato JSON y Convierte los datos JSON en un array asociativo.
        $totalPuntos = $input['totalPuntos']; 
        $cartItems = $input['cartItems']; // Extrae los puntos totales y los ítems del carrito enviados por el cliente.
        $id_usuario = $_SESSION['id_usuario_usr']; // Obtiene el ID del usuario desde la sesión

        // Obtener puntos actuales del usuario
        $stmt = $conn->prepare("SELECT puntos_acumulados_usr FROM usuarios WHERE id_usuario_usr = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        // Verifica si el usuario existe en la base de datos. Si no, devuelve un mensaje de error.
        if (!$usuario) {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
            exit();
        }

        $puntos_disponibles = $usuario['puntos_acumulados_usr'];
        // Verifica si el usuario tiene suficientes puntos para canjear las recompensas. Si no, devuelve un mensaje de error.
        if ($puntos_disponibles < $totalPuntos) {
            echo json_encode(['success' => false, 'message' => 'No tienes suficientes puntos.']);
            exit();
        }

        // Inicia una transacción para garantizar que todas las operaciones (como actualizar puntos y stock) se realicen correctamente. Si ocurre un error, se puede revertir todo.
        $conn->begin_transaction();

        // Procesar cada recompensa del carrito
        foreach ($cartItems as $item) {
            $id_recompensa = $item['id'];
            $puntos_utilizados = $item['price'];

            // Verificar stock
            $stock_stmt = $conn->prepare("SELECT stock_disponible_rec FROM recompensas WHERE id_recompensa_rec = ? AND estado_rec = 'disponible'");
            $stock_stmt->bind_param("i", $id_recompensa);
            $stock_stmt->execute();
            $stock_result = $stock_stmt->get_result();
            $recompensa = $stock_result->fetch_assoc();

            // Verifica si la recompensa existe y tiene stock disponible. Si no, devuelve un mensaje de error.
            if (!$recompensa || $recompensa['stock_disponible_rec'] <= 0) {
                $conn->rollback();
                echo json_encode(['success' => false, 'message' => 'Una de las recompensas no tiene stock disponible.']);
                exit();
            }

            // Insertar en tabla canjes
            $insert_stmt = $conn->prepare("INSERT INTO canjes (id_usuario_can, id_recompensa_can, fecha_canje_can, puntos_utilizados_can, estado_canje_can) 
                                        VALUES (?, ?, NOW(), ?, 'pendiente')");
            $insert_stmt->bind_param("iii", $id_usuario, $id_recompensa, $puntos_utilizados);
            $insert_stmt->execute();

            // Actualizar stock
            $update_stock = $conn->prepare("UPDATE recompensas SET stock_disponible_rec = stock_disponible_rec - 1 WHERE id_recompensa_rec = ?");
            $update_stock->bind_param("i", $id_recompensa);
            $update_stock->execute();
        }

        // Descontar y Actualiza los puntos acumulados del usuario en la base de datos.
        $nuevo_total = $puntos_disponibles - $totalPuntos;
        $update_user = $conn->prepare("UPDATE usuarios SET puntos_acumulados_usr = ? WHERE id_usuario_usr = ?");
        $update_user->bind_param("ii", $nuevo_total, $id_usuario);
        $update_user->execute();

        // Confirma la transacción y actualiza los puntos en la sesión.
        $conn->commit();
        $_SESSION['puntos_acumulados_usr'] = $nuevo_total;
        // Devuelve un mensaje de éxito en formato JSON.
        echo json_encode(['success' => true, 'message' => 'Canje realizado con éxito. Recompensas en proceso de entrega.']);

    } catch (Exception $e) {

        // Si ocurre un error, revierte la transacción y registra el error en los logs en formato JSON.
        $conn->rollback();
        error_log("Error al procesar el canje: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error interno al procesar el canje.']);
    }
?>