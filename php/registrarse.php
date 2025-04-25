<?php
    // Database connection parameters
    require_once ('php/conexion.php');
    require_once ('php/ususario.php');
    require_once ('php/crud_ususario.php');

    $crud = new CrudUsuario(0, "", "", "", "", "", "", "", "", null, "", "estudiante", 1);
    $usuario = new Usuario(0, "", "", "", "", "", "", "", "", null, "", "estudiante", 1);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $nombre = $_POST['first_name'];
        $senombre = $_POST['first_name'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $contrasena = $_POST['contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];

        // Validate the form data
        if (empty($nombre) || empty($apellido) || empty($email) || empty($telefono) || empty($contrasena) || empty($confirmar_contrasena)) {
            echo "Por favor, complete todos los campos.";
            exit;
        }

        if ($contrasena !== $confirmar_contrasena) {
            echo "Las contraseñas no coinciden.";
            exit;
        }

        // Hash the password
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insert the user into the database
        $sql = "INSERT INTO usuarios (nombre, apellido, email, telefono, contrasena) VALUES ('$nombre', '$apellido', '$email', '$telefono', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso. Puedes iniciar sesión ahora.";
            header("Location: login.php"); // Redirect to login page after successful registration
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>