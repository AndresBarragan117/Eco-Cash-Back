<?php
    session_start(); // Iniciar la sesión

    session_destroy(); // Destruir la sesión actual
    header("Location: ../views/inicio-sesion.php"); // Redirigir a la página de iniciar sesión
?>