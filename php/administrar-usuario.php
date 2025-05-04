<?php
    // Incluir la conexión a la base de datos
    include('conexion.php');

    // Incluir la clase Usuario
    include_once('usuario.php');

    // Incluir la clase CrudUsuario
    include_once('crud_usuario.php');

    // Crear una instancia de CrudUsuario
    $crudUsuario = new CrudUsuario();

    // Verificar si se ha enviado el formulario de registro
    if (isset($_POST['registrarse'])) {
        try {
            // Crear un nuevo objeto Usuario
            $usuario = new Usuario();
            $usuario->setPrimerNombre($_POST['primer_nombre_usr']);
            $usuario->setSegundoNombre($_POST['segundo_nombre_usr'] ?? ''); // Valor opcional
            $usuario->setPrimerApellido($_POST['primer_apellido_usr']);
            $usuario->setSegundoApellido($_POST['segundo_apellido_usr'] ?? ''); // Valor opcional
            $usuario->setCedula($_POST['cedula_usr']);
            $usuario->setTelefono($_POST['telefono_usr'] ?? ''); // Valor opcional
            $usuario->setEmail($_POST['correo_electronico_usr']);
            $usuario->setContrasena($_POST['contrasena_hash_usr']); // La contraseña se cifra automáticamente en la clase
            $usuario->setCodigoQR(null); // Generar código QR más tarde si es necesario
            $usuario->setFechaRegistro(date("Y-m-d H:i:s")); // Fecha actual
            $usuario->setRol('estudiante'); // Rol por defecto
            $usuario->setEstado('activo'); // Estado por defecto
            $usuario->setPuntosAcumulados(0); // Puntos iniciales

            // Insertar el usuario en la base de datos
            if ($crudUsuario->insertarUsuario($usuario)) {
                header('Location: ../views/inicio-sesion.html'); // Redirigir al inicio de sesión
                exit(); // Terminar el script después de redirigir
            } else {
                echo "Error al registrar el usuario.";
            }
        } catch (Exception $e) {
            error_log("Error al registrar usuario: " . $e->getMessage());
            echo "Ocurrió un error al procesar el registro.";
        }
    }

    // Verificar si se ha enviado el formulario de actualización
    elseif (isset($_POST['actualizar'])) {
        try {
            // Obtener los datos del formulario
            $usuario = new Usuario();
            $usuario->setIdUsuario($_POST['id_usuario_usr']);
            $usuario->setPrimerNombre($_POST['primer_nombre_usr']);
            $usuario->setSegundoNombre($_POST['segundo_nombre_usr'] ?? ''); // Valor opcional
            $usuario->setPrimerApellido($_POST['primer_apellido_usr']);
            $usuario->setSegundoApellido($_POST['segundo_apellido_usr'] ?? ''); // Valor opcional
            $usuario->setCedula($_POST['cedula_usr']);
            $usuario->setTelefono($_POST['telefono_usr'] ?? ''); // Valor opcional
            $usuario->setEmail($_POST['correo_electronico_usr']);
            $usuario->setContrasena($_POST['contrasena_hash_usr']); // La contraseña se cifra automáticamente en la clase
            $usuario->setCodigoQR(null); // Código QR inicializado como null
            $usuario->setFechaRegistro(date("Y-m-d H:i:s")); // Fecha actual
            $usuario->setRol($_POST['rol_usr'] ?? 'estudiante'); // Rol por defecto
            $usuario->setEstado($_POST['estado_cuenta_usr'] ?? 'activo'); // Estado por defecto
            $usuario->setPuntosAcumulados($_POST['puntos_acumulados_usr'] ?? 0); // Puntos iniciales

            // Actualizar el usuario en la base de datos
            if ($crudUsuario->actualizarUsuario($usuario)) {
                header('Location: ../views/index.php'); // Redirigir a la página principal
                exit(); // Terminar el script después de redirigir
            } else {
                echo "Error al actualizar el usuario.";
            }
        } catch (Exception $e) {
            error_log("Error al actualizar usuario: " . $e->getMessage());
            echo "Ocurrió un error al procesar la actualización.";
        }
    }

    // Verificar si se ha solicitado eliminar un usuario
    elseif (isset($_GET['accion']) && $_GET['accion'] == 'e') {
        try {
            // Eliminar el usuario por su ID
            $id_usuario = $_GET['id_usuario_usr'];
            if ($crudUsuario->eliminarUsuario($id_usuario)) {
                header('Location: ../views/index.php'); // Redirigir a la página principal
                exit(); // Terminar el script después de redirigir
            } else {
                echo "Error al eliminar el usuario.";
            }
        } catch (Exception $e) {
            error_log("Error al eliminar usuario: " . $e->getMessage());
            echo "Ocurrió un error al procesar la eliminación.";
        }
    }

    // Verificar si se ha solicitado actualizar un usuario
    elseif (isset($_GET['accion']) && $_GET['accion'] == 'a') {
        try {
            // Redirigir a la página de actualización con el ID del usuario
            $id_usuario = $_GET['id_usuario_usr'];
            header('Location: ../views/actualizar.php?id_usuario_usr=' . urlencode($id_usuario)); // Redirigir a la página de actualización
            exit(); // Terminar el script después de redirigir
        } catch (Exception $e) {
            error_log("Error al redirigir a la página de actualización: " . $e->getMessage());
            echo "Ocurrió un error al redirigir.";
        }
    }
?>