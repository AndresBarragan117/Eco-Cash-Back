<?php
    include ('conexion.php');

    class CrudUsuario
    {
        private $id;
        public $primer_nombre;
        public $segundo_nombre;
        public $primer_apellido;
        public $segundo_apellido;
        public $cedula;
        public $telefono;
        public $email;
        public $contrasena;
        public $codigo_qr;
        public $fecha_registro;
        public $rol;
        public $estado;

        function __construct($id, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $cedula, $telefono, $email, $contrasena, $codigo_qr, $fecha_registro, $rol, $estado) {
            // Constructor code here
            // Initialize properties
            $this->id = $id;
            $this->primer_nombre = $primer_nombre;
            $this->segundo_nombre = $segundo_nombre;
            $this->primer_apellido = $primer_apellido;
            $this->segundo_apellido = $segundo_apellido;
            $this->cedula = $cedula;
            $this->telefono = $telefono;
            $this->email = $email;
            $this->contrasena = password_hash($contrasena, PASSWORD_DEFAULT); // Hash the password
            $this->codigo_qr = null; // Initialize as null
            $this->fecha_registro = date("Y-m-d H:i:s"); // Current date and time
            $this->rol = "estudiante"; // Default role
            $this->estado = "activo"; // Active by default
        }

        // Add methods for CRUD operations here
        public function createUsuario($primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $cedula, $telefono, $email, $contrasena, $codigo_qr, $fecha_registro, $rol, $estado) {
            // Code to insert a new user into the database
            // Example: 
            // $sql = "INSERT INTO usuarios (primer_nombre, segundo_nombre, ...) VALUES ('$primer_nombre', '$segundo_nombre', ...)";
            // Execute the query and handle errors
            // $conn->query($sql);
            include ('conexion.php');

            $crear_usuario = "INSERT INTO usuarios (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, cedula, telefono, email, contrasena, codigo_qr, fecha_registro, rol, estado) VALUES ('$primer_nombre', '$segundo_nombre', '$primer_apellido', '$segundo_apellido', '$cedula', '$telefono', '$email', '$contrasena', '$codigo_qr', '$fecha_registro', '$rol', '$estado')";
            $resultado = mysqli_query($conn, $crear_usuario);
            if ($resultado) {
                return true; // User created successfully
                echo "Registro exitoso. Puedes iniciar sesión ahora.";
                header("Location: login.php"); // Redirect to login page after successful registration
                
            } else {
                return false; // Error creating user
                echo "Error: " . $crear_usuario . "<br>" . mysqli_error($conn);
            }
        }

        public function readUsuario($id) {
            // Code to retrieve a user from the database by ID
            // Example: 
            // $sql = "SELECT * FROM usuarios WHERE id = $id";
            // Execute the query and return the result
            include ('conexion.php');

            $leer_usuario = "SELECT * FROM usuarios WHERE id = $id";
            $resultado = mysqli_query($conn, $leer_usuario);
            if ($resultado) {
                return mysqli_fetch_assoc($resultado); // Return user data as an associative array
            } else {
                return false; // Error retrieving user
                echo "Error: " . $leer_usuario . "<br>" . mysqli_error($conn);
            }
        }

        public function updateUsuario($id, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $cedula, $telefono, $email, $contrasena, $codigo_qr, $fecha_registro, $rol, $estado) {
            // Code to update a user in the database
            // Example: 
            // $sql = "UPDATE usuarios SET primer_nombre = '$primer_nombre', ... WHERE id = $id";
            // Execute the query and handle errors
            include ('conexion.php');

            $actualizar_usuario = "UPDATE usuarios SET primer_nombre = '$primer_nombre', segundo_nombre = '$segundo_nombre', primer_apellido = '$primer_apellido', segundo_apellido = '$segundo_apellido', cedula = '$cedula', telefono = '$telefono', email = '$email', contrasena = '$contrasena', codigo_qr = '$codigo_qr', fecha_registro = '$fecha_registro', rol = '$rol', estado = '$estado' WHERE id = $id";
            $resultado = mysqli_query($conn, $actualizar_usuario);
            if ($resultado) {
                return true; // User updated successfully
            } else {
                return false; // Error updating user
                echo "Error: " . $actualizar_usuario . "<br>" . mysqli_error($conn);
            }
        }

        public function deleteUsuario($id) {
            // Code to delete a user from the database
            // Example: 
            // $sql = "DELETE FROM usuarios WHERE id = $id";
            // Execute the query and handle errors
            include ('conexion.php');

            $eliminar_usuario = "DELETE FROM usuarios WHERE id = $id";
            $resultado = mysqli_query($conn, $eliminar_usuario);
            if ($resultado) {
                return true; // User deleted successfully
            } else {
                return false; // Error deleting user
                echo "Error: " . $eliminar_usuario . "<br>" . mysqli_error($conn);
            }
        }
    }
?>