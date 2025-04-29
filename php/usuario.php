<?php
    // Database connection parameters
    require_once ('php/conexion.php');

    class Usuario {
        private $id_usuario_usr;
        public $primer_nombre_usr;
        public $segundo_nombre_usr;
        public $primer_apellido_usr;
        public $segundo_apellido_usr;
        public $cedula_usr;
        public $telefono_usr;
        public $correo_electronico_usr;
        public $contrasena_hash_usr;
        public $codigo_qr_usr;
        public $fecha_registro_usr;
        public $rol_usr;
        public $estado_cuenta_usr;
        public $puntos_acumulados_usr;

        function __construct($id_usuario_usr, $primer_nombre_usr, $segundo_nombre_usr, $primer_apellido_usr, $segundo_apellido_usr, $cedula_usr, $telefono_usr, $correo_electronico_usr, $contrasena_hash_usr, $codigo_qr_usr, $fecha_registro_usr, $rol_usr, $estado_usr, $puntos_acumulados_usr) {
            $this->id_usuario_usr = $id_usuario_usr;
            $this->primer_nombre_usr = $primer_nombre_usr;
            $this->segundo_nombre_usr = $segundo_nombre_usr;
            $this->primer_apellido_usr = $primer_apellido_usr;
            $this->segundo_apellido_usr = $segundo_apellido_usr;
            $this->cedula_usr = $cedula_usr;
            $this->telefono_usr = $telefono_usr;
            $this->correo_electronico_usr = $correo_electronico_usr;
            $this->contrasena_hash_usr = password_hash($contrasena_hash_usr, PASSWORD_DEFAULT);
            $this->codigo_qr_usr = null; // Initialize as null
            $this->fecha_registro_usr = date("Y-m-d H:i:s");
            $this->rol_usr = "estudiante"; // Default role
            $this->estado_cuenta_usr = "activo"; // Active by default
            $this->puntos_acumulados_usr = 0; // Initialize points to 0
        }

        public function getIdUsuario() {
            return $this->id_usuario_usr;
        }
        public function setIdUsuario($id_usuario_usr) {
            $this->id_usuario_usr = $id_usuario_usr;
        }
        public function getPrimerNombre() {
            return $this->primer_nombre_usr;
        }
        public function getSegundoNombre() {
            return $this->segundo_nombre_usr;
        }
        public function getPrimerApellido() {
            return $this->primer_apellido_usr;
        }
        public function getSegundoApellido() {
            return $this->segundo_apellido_usr;
        }
        public function getCedula() {
            return $this->cedula_usr;
        }
        public function getTelefono() {
            return $this->telefono_usr;
        }
        public function getEmail() {
            return $this->correo_electronico_usr;
        }
        public function getContrasena() {
            return $this->contrasena_hash_usr;
        }
        public function getCodigoQR() {
            return $this->codigo_qr_usr;
        }
        public function getFechaRegistro() {
            return $this->fecha_registro_usr;
        }
        public function getRol() {
            return $this->rol_usr;
        }
        public function getEstado() {
            return $this->estado_cuenta_usr;
        }

        public function setPrimerNombre($primer_nombre_usr) {
            $this->primer_nombre_usr = $primer_nombre_usr;
        }
        public function setSegundoNombre($segundo_nombre_usr) {
            $this->segundo_nombre_usr = $segundo_nombre_usr;
        }
        public function setPrimerApellido($primer_apellido_usr) {
            $this->primer_apellido_usr = $primer_apellido_usr;
        }
        public function setSegundoApellido($segundo_apellido_usr) {
            $this->segundo_apellido_usr = $segundo_apellido_usr;
        }
        public function setCedula($cedula_usr) {
            $this->cedula_usr = $cedula_usr;
        }
        public function setTelefono($telefono_usr) {
            $this->telefono_usr = $telefono_usr;
        }
        public function setEmail($correo_electronico_usr) {
            $this->correo_electronico_usr = $correo_electronico_usr;
        }
        public function setContrasena($contrasena_hash_usr) {
            $this->contrasena_hash_usr = password_hash($contrasena_hash_usr, PASSWORD_DEFAULT);
        }
        public function setCodigoQR($codigo_qr_usr) {
            $this->codigo_qr_usr = $codigo_qr_usr;
        }
        public function setFechaRegistro($fecha_registro_usr) {
            $this->fecha_registro_usr = $fecha_registro_usr;
        }
        public function setRol($rol_usr) {
            $this->rol_usr = $rol_usr;
        }
        public function setEstado($estado_cuenta_usr) {
            $this->estado_cuenta_usr = $estado_cuenta_usr;
        }
    }
?>