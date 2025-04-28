<?php
    // Database connection parameters
    require_once ('php/conexion.php');

    class Usuario {
        private $id_usuario;
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
            $this->id_usuario = $id;
            $this->primer_nombre = $primer_nombre;
            $this->segundo_nombre = $segundo_nombre;
            $this->primer_apellido = $primer_apellido;
            $this->segundo_apellido = $segundo_apellido;
            $this->cedula = $cedula;
            $this->telefono = $telefono;
            $this->email = $email;
            $this->contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
            $this->codigo_qr = null; // Initialize as null
            $this->fecha_registro = date("Y-m-d H:i:s");
            $this->rol = "estudiante"; // Default role
            $this->estado = "activo"; // Active by default
        }

        public function getIdUsuario() {
            return $this->id_usuario;
        }
        public function setIdUsuario($id_usuario) {
            $this->id_usuario = $id_usuario;
        }
        public function getPrimerNombre() {
            return $this->primer_nombre;
        }
        public function getSegundoNombre() {
            return $this->segundo_nombre;
        }
        public function getPrimerApellido() {
            return $this->primer_apellido;
        }
        public function getSegundoApellido() {
            return $this->segundo_apellido;
        }
        public function getCedula() {
            return $this->cedula;
        }
        public function getTelefono() {
            return $this->telefono;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getContrasena() {
            return $this->contrasena;
        }
        public function getCodigoQR() {
            return $this->codigo_qr;
        }
        public function getFechaRegistro() {
            return $this->fecha_registro;
        }
        public function getRol() {
            return $this->rol;
        }
        public function getEstado() {
            return $this->estado;
        }

        public function setPrimerNombre($primer_nombre) {
            $this->primer_nombre = $primer_nombre;
        }
        public function setSegundoNombre($segundo_nombre) {
            $this->segundo_nombre = $segundo_nombre;
        }
        public function setPrimerApellido($primer_apellido) {
            $this->primer_apellido = $primer_apellido;
        }
        public function setSegundoApellido($segundo_apellido) {
            $this->segundo_apellido = $segundo_apellido;
        }
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
        public function setTelefono($telefono) {
            $this->telefono = $telefono;
        }
        public function setEmail($email) {
            $this->email = $email;
        }
        public function setContrasena($contrasena) {
            $this->contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        }
        public function setCodigoQR($codigo_qr) {
            $this->codigo_qr = $codigo_qr;
        }
        public function setFechaRegistro($fecha_registro) {
            $this->fecha_registro = $fecha_registro;
        }
        public function setRol($rol) {
            $this->rol = $rol;
        }
        public function setEstado($estado) {
            $this->estado = $estado;
        }
    }
?>