<?php
    require_once ('/php/conexion.php');

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
        public function createUsuario($primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $cedula, $telefono, $email, $contrasena) {
            // Code to insert a new user into the database
            // Example: 
            // $sql = "INSERT INTO usuarios (primer_nombre, segundo_nombre, ...) VALUES ('$primer_nombre', '$segundo_nombre', ...)";
            // Execute the query and handle errors
            $db=Db::conectar();
            $inserta=$db->prepare("INSERT INTO usuarios (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, cedula, telefono, email, contrasena, fecha_registro, rol, estado) VALUES (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :cedula, :telefono, :email, :contrasena, NOW(), 'estudiante', 'activo')");
            $insertar->bindValue(':primer_nombre', $primer_nombre);
            $insertar->bindValue(':segundo_nombre', $segundo_nombre);
        }
    }
?>