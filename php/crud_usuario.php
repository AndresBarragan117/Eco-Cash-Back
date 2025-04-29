<?php
    // Incluir la conexión a la base de datos
    require_once('conexion2.php');

    class CrudUsuario
    {
        public function insertarUsuario($usuario)
        {
            try {
                $db = Db::conectar(); // Conexión a la base de datos

                // Consulta SQL para insertar un nuevo usuario
                $sql = "INSERT INTO usuarios (
                            primer_nombre_usr, segundo_nombre_usr, primer_apellido_usr, segundo_apellido_usr,
                            cedula_usr, telefono_usr, correo_electronico_usr, contrasena_hash_usr,
                            codigo_qr_usr, fecha_registro_usr, rol_usr, estado_cuenta_usr, puntos_acumulados_usr
                        ) VALUES (
                            :primer_nombre_usr, :segundo_nombre_usr, :primer_apellido_usr, :segundo_apellido_usr,
                            :cedula_usr, :telefono_usr, :correo_electronico_usr, :contrasena_hash_usr,
                            :codigo_qr_usr, :fecha_registro_usr, :rol_usr, :estado_cuenta_usr, :puntos_acumulados_usr
                        )";

                $stmt = $db->prepare($sql);

                // Vincular los parámetros
                $stmt->bindValue(':primer_nombre_usr', $usuario->getPrimerNombre());
                $stmt->bindValue(':segundo_nombre_usr', $usuario->getSegundoNombre());
                $stmt->bindValue(':primer_apellido_usr', $usuario->getPrimerApellido());
                $stmt->bindValue(':segundo_apellido_usr', $usuario->getSegundoApellido());
                $stmt->bindValue(':cedula_usr', $usuario->getCedula());
                $stmt->bindValue(':telefono_usr', $usuario->getTelefono());
                $stmt->bindValue(':correo_electronico_usr', $usuario->getEmail());
                $stmt->bindValue(':contrasena_hash_usr', password_hash($usuario->getContrasena(), PASSWORD_DEFAULT)); // Cifrar contraseña
                $stmt->bindValue(':codigo_qr_usr', $usuario->getCodigoQR() ?? null); // Código QR inicializado como null
                $stmt->bindValue(':fecha_registro_usr', $usuario->getFechaRegistro() ?? date("Y-m-d H:i:s")); // Fecha actual si no se especifica
                $stmt->bindValue(':rol_usr', $usuario->getRol() ?? 'estudiante'); // Rol por defecto
                $stmt->bindValue(':estado_cuenta_usr', $usuario->getEstado() ?? 'activo'); // Estado por defecto
                $stmt->bindValue(':puntos_acumulados_usr', $usuario->getPuntosAcumulados() ?? 0); // Puntos iniciales

                // Ejecutar la consulta
                return $stmt->execute(); // Devuelve true si la inserción fue exitosa
            } catch (Exception $e) {
                error_log("Error al insertar usuario: " . $e->getMessage()); // Registrar el error
                return false; // Error al insertar
            }
        }

        /**
         * Método para obtener todos los usuarios de la base de datos.
         * @return array Lista de objetos Usuario.
         */
        public static function mostrarUsuarios()
        {
            try {
                $db = Db::conectar(); // Conexión a la base de datos

                $lista_usuarios = []; // Inicializar la lista de usuarios
                $sql = "SELECT * FROM usuarios ORDER BY id_usuario_usr"; // Consulta SQL
                $stmt = $db->query($sql);

                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $fila) {
                    $usuario = new Usuario(); // Crear una nueva instancia de Usuario
                    $usuario->setIdUsuario($fila['id_usuario_usr']);
                    $usuario->setPrimerNombre($fila['primer_nombre_usr']);
                    $usuario->setSegundoNombre($fila['segundo_nombre_usr']);
                    $usuario->setPrimerApellido($fila['primer_apellido_usr']);
                    $usuario->setSegundoApellido($fila['segundo_apellido_usr']);
                    $usuario->setCedula($fila['cedula_usr']);
                    $usuario->setTelefono($fila['telefono_usr']);
                    $usuario->setEmail($fila['correo_electronico_usr']);
                    $usuario->setContrasena($fila['contrasena_hash_usr']); // No desencriptar la contraseña
                    $usuario->setCodigoQR($fila['codigo_qr_usr']);
                    $usuario->setFechaRegistro($fila['fecha_registro_usr']);
                    $usuario->setRol($fila['rol_usr']);
                    $usuario->setEstado($fila['estado_cuenta_usr']);
                    $usuario->setPuntosAcumulados($fila['puntos_acumulados_usr']);

                    $lista_usuarios[] = $usuario; // Agregar el usuario a la lista
                }
                return $lista_usuarios; // Devolver la lista de usuarios
            } catch (Exception $e) {
                error_log("Error al mostrar usuarios: " . $e->getMessage()); // Registrar el error
                return []; // Devolver una lista vacía en caso de error
            }
        }

        /**
         * Método para eliminar un usuario por ID.
         * @param int $id_usuario_usr ID del usuario a eliminar.
         * @return bool True si la eliminación fue exitosa, False en caso contrario.
         */
        public function eliminarUsuario($id_usuario_usr)
        {
            try {
                $db = Db::conectar(); // Conexión a la base de datos

                // Consulta SQL para eliminar un usuario
                $sql = "DELETE FROM usuarios WHERE id_usuario_usr = :id_usuario_usr";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':id_usuario_usr', $id_usuario_usr); // Vincular el ID del usuario

                // Ejecutar la consulta
                return $stmt->execute(); // Devuelve true si la eliminación fue exitosa
            } catch (Exception $e) {
                error_log("Error al eliminar usuario: " . $e->getMessage()); // Registrar el error
                return false; // Error al eliminar
            }
        }

        /**
         * Método para obtener un usuario por ID.
         * @param int $id_usuario_usr ID del usuario a buscar.
         * @return Usuario|null Objeto Usuario si se encuentra, null en caso contrario.
         */
        public function obtenerUsuario($id_usuario_usr)
        {
            try {
                $db = Db::conectar(); // Conexión a la base de datos

                // Consulta SQL para obtener un usuario por ID
                $sql = "SELECT * FROM usuarios WHERE id_usuario_usr = :id_usuario_usr";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':id_usuario_usr', $id_usuario_usr); // Vincular el ID del usuario
                $stmt->execute();

                $fila = $stmt->fetch(PDO::FETCH_ASSOC); // Obtener el usuario
                if ($fila) {
                    $usuario = new Usuario(); // Crear una nueva instancia de Usuario
                    $usuario->setIdUsuario($fila['id_usuario_usr']);
                    $usuario->setPrimerNombre($fila['primer_nombre_usr']);
                    $usuario->setSegundoNombre($fila['segundo_nombre_usr']);
                    $usuario->setPrimerApellido($fila['primer_apellido_usr']);
                    $usuario->setSegundoApellido($fila['segundo_apellido_usr']);
                    $usuario->setCedula($fila['cedula_usr']);
                    $usuario->setTelefono($fila['telefono_usr']);
                    $usuario->setEmail($fila['correo_electronico_usr']);
                    $usuario->setContrasena($fila['contrasena_hash_usr']); // No desencriptar la contraseña
                    $usuario->setCodigoQR($fila['codigo_qr_usr']);
                    $usuario->setFechaRegistro($fila['fecha_registro_usr']);
                    $usuario->setRol($fila['rol_usr']);
                    $usuario->setEstado($fila['estado_cuenta_usr']);
                    $usuario->setPuntosAcumulados($fila['puntos_acumulados_usr']);
                    return $usuario; // Devolver el usuario
                }
                return null; // Devolver null si no se encuentra el usuario
            } catch (Exception $e) {
                error_log("Error al obtener usuario: " . $e->getMessage()); // Registrar el error
                return null; // Devolver null en caso de error
            }
        }

        /**
         * Método para actualizar un usuario existente.
         * @param Usuario $usuario Objeto Usuario con los datos actualizados.
         * @return bool True si la actualización fue exitosa, False en caso contrario.
         */
        public function actualizarUsuario($usuario)
        {
            try {
                $db = Db::conectar(); // Conexión a la base de datos

                // Consulta SQL para actualizar un usuario
                $sql = "UPDATE usuarios SET
                            primer_nombre_usr = :primer_nombre_usr,
                            segundo_nombre_usr = :segundo_nombre_usr,
                            primer_apellido_usr = :primer_apellido_usr,
                            segundo_apellido_usr = :segundo_apellido_usr,
                            cedula_usr = :cedula_usr,
                            telefono_usr = :telefono_usr,
                            correo_electronico_usr = :correo_electronico_usr,
                            contrasena_hash_usr = :contrasena_hash_usr,
                            codigo_qr_usr = :codigo_qr_usr,
                            fecha_registro_usr = :fecha_registro_usr,
                            rol_usr = :rol_usr,
                            estado_cuenta_usr = :estado_cuenta_usr,
                            puntos_acumulados_usr = :puntos_acumulados_usr
                        WHERE id_usuario_usr = :id_usuario_usr";

                $stmt = $db->prepare($sql);

                // Vincular los parámetros
                $stmt->bindValue(':id_usuario_usr', $usuario->getIdUsuario());
                $stmt->bindValue(':primer_nombre_usr', $usuario->getPrimerNombre());
                $stmt->bindValue(':segundo_nombre_usr', $usuario->getSegundoNombre());
                $stmt->bindValue(':primer_apellido_usr', $usuario->getPrimerApellido());
                $stmt->bindValue(':segundo_apellido_usr', $usuario->getSegundoApellido());
                $stmt->bindValue(':cedula_usr', $usuario->getCedula());
                $stmt->bindValue(':telefono_usr', $usuario->getTelefono());
                $stmt->bindValue(':correo_electronico_usr', $usuario->getEmail());
                $stmt->bindValue(':contrasena_hash_usr', password_hash($usuario->getContrasena(), PASSWORD_DEFAULT)); // Cifrar contraseña
                $stmt->bindValue(':codigo_qr_usr', $usuario->getCodigoQR() ?? null);
                $stmt->bindValue(':fecha_registro_usr', $usuario->getFechaRegistro() ?? date("Y-m-d H:i:s"));
                $stmt->bindValue(':rol_usr', $usuario->getRol() ?? 'estudiante');
                $stmt->bindValue(':estado_cuenta_usr', $usuario->getEstado() ?? 'activo');
                $stmt->bindValue(':puntos_acumulados_usr', $usuario->getPuntosAcumulados() ?? 0);

                // Ejecutar la consulta
                return $stmt->execute(); // Devuelve true si la actualización fue exitosa
            } catch (Exception $e) {
                error_log("Error al actualizar usuario: " . $e->getMessage()); // Registrar el error
                return false; // Error al actualizar
            }
        }
    }
?>