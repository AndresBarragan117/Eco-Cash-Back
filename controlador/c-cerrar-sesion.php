<?php
    session_start(); // Iniciar la sesión

    session_destroy(); // Destruir la sesión actual
    echo "<script>
            alert('Sesión Cerrada Correctamente.');
            window.location.href = '../views/inicio-sesion.php'; // Redirigir a la página de inicio de sesión
        </script>";
?>