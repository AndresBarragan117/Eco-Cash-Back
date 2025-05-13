<?php
    include "../../modelo/conexion.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/usuario/catalogo-usuario.css">
    <link rel="icon" href="../../img/titulo-logo.ico">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <title>Catálago Premios</title>
</head>
<body>
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <header class="header">
        <img class="logo" src="../../img/titulo-logo.png" alt="">
        <h1 class="title-header">Eco Cash Back</h1>
    </header>

    <nav class="nav">
        <ul class="barnav">
            <a class="menu" href="../../views/usuario/entrar-usuario.php">Puntos</a>
            <a class="menu" href="">Catálogo De Premios</a>
            <a class="menu" href="">Materiales Reciclados</a>
            <a class="menu" href="">Cambio de Contraseña</a>
            <a class="menu" href="../../controlador/c-cerrar-sesion.php">Cerrar Sesión</a>
        </ul>
    </nav>

    <section class="catalogo">
        <div class="container">
            <h2 class="titulo-h3">Catálogo de Premios</h2>
            <div class="row">
                <?php 
                    // Consulta para obtener los premios disponibles
                    $mostrar_recompensas = "SELECT id_recompensa_rec, nombre_recompensa_rec, costo_puntos_rec, imagen_rec, descripcion_rec FROM recompensas WHERE estado_rec = 'disponible'";
                    $resultado_recompensas = $conn->query($mostrar_recompensas);

                    if ($resultado_recompensas->num_rows > 0) {
                        while ($datos = $resultado_recompensas->fetch_object()) {
                ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="../../img/img-catalogo/<?= $datos->imagen_rec ?>" alt="<?= $datos->nombre_recompensa_rec ?>" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $datos->nombre_recompensa_rec ?></h5>
                                        <p class="card-text">Costo: <?= $datos->costo_puntos_rec ?> puntos</p>
                                        <p class="card-description">
                                            <span class="short-description"><?= substr($datos->descripcion_rec, 0, 80) ?>...</span>
                                            <span class="full-description d-none"><?= $datos->descripcion_rec ?></span>
                                            <button class="btn btn-link toggle-description">Leer más</button>
                                        </p>
                                        <button class="btn btn-primary" onclick="addToCart('<?= $datos->nombre_recompensa_rec ?>', <?= $datos->costo_puntos_rec ?>)">Agregar</button>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    } else {
                        echo "<p>No hay premios disponibles en este momento.</p>";
                    }
                ?>
            </div>
        </div>
    </section>

    <section class="cart">
        <h2 class="cart-title">Tu Carrito</h2>
        <p id="user-points" class="cart-points"><strong>Puntos disponibles: <?= $_SESSION['puntos_acumulados_usr'] ?> puntos</strong></p>
        <div id="cart-items" class="cart-items">
            <!-- Los items del carrito se agregarán aquí dinámicamente -->
        </div>
        <div id="cart-total" class="cart-total">
            <strong>Total Puntos: 0</strong>
        </div>
        <button href="../../controlador/c-canjear-recompensa.php" class="checkout-btn" onclick="checkout()">Proceder al Pago</button>
    </section>

    <script>
        // Mostrar/ocultar descripción completa
        // Agregar evento de clic a los botones de "Leer más"
        document.addEventListener('DOMContentLoaded', function () { // Esperar a que el DOM esté completamente cargado
            const toggleButtons = document.querySelectorAll('.toggle-description'); // Seleccionar todos los botones de "Leer más"

            toggleButtons.forEach(button => { // Recorrer cada botón
                button.addEventListener('click', function () { // Agregar evento de clic
                    const cardBody = this.closest('.card-body'); // Obtener el contenedor del cuerpo de la tarjeta
                    const shortDescription = cardBody.querySelector('.short-description'); // Obtener la descripción corta
                    const fullDescription = cardBody.querySelector('.full-description'); // Obtener la descripción completa

                    if (fullDescription.classList.contains('d-none')) { // Verificar si la descripción completa está oculta
                        shortDescription.classList.add('d-none'); // Ocultar la descripción corta
                        fullDescription.classList.remove('d-none'); // Mostrar la descripción completa
                        this.textContent = 'Leer menos'; // Cambiar el texto del botón
                    } else {
                        shortDescription.classList.remove('d-none'); // Mostrar la descripción corta
                        fullDescription.classList.add('d-none'); // Ocultar la descripción completa
                        this.textContent = 'Leer más'; // Cambiar el texto del botón
                    }
                });
            });
        });
        
        // Carrito de compras
        // Variables del carrito
        let cart = [];
        let total = 0;
        let userPoints = <?= $_SESSION['puntos_acumulados_usr'] ?>; // Puntos del usuario

        // Funciones del carrito
        function addToCart(name, price) { // Agregar un producto al carrito
            if (price > userPoints - total) { // Verificar si el usuario tiene suficientes puntos
                alert('No tienes suficientes puntos para canjear esta recompensa.'); // Mostrar alerta
                return; // Salir de la función
            }

            cart.push({ name, price }); // Agregar el producto al carrito
            total += price; // Sumar el precio al total
            updateCart(); // Actualizar el carrito
        }

        function removeFromCart(index) { // Eliminar un producto del carrito
            total -= cart[index].price; // Restar el precio del total
            cart.splice(index, 1); // Eliminar el producto del carrito
            updateCart(); // Actualizar el carrito
        }

        // Actualizar el carrito
        // Esta función actualiza la visualización del carrito y el total de puntos
        function updateCart() {
            const cartItems = document.getElementById('cart-items'); // Obtener el contenedor del carrito
            const cartTotal = document.getElementById('cart-total'); // Obtener el contenedor del total
            const userPointsDisplay = document.getElementById('user-points'); // Obtener el contenedor de los puntos del usuario

            cartItems.innerHTML = ''; // Limpiar el contenedor del carrito
            cart.forEach((item, index) => { // Recorrer los productos del carrito
                const cartItem = document.createElement('div'); // Crear un nuevo elemento para el producto
                cartItem.className = 'cart-item'; // Asignar clase al elemento
                // Asignar el contenido HTML al elemento
                cartItem.innerHTML = ` 
                    <div class="cart-item-info">
                        <span>${item.name}</span> <!-- Nombre del producto -->
                    </div>
                    <div class="cart-item-info">
                        <span>${item.price} puntos</span> <!-- Precio del producto -->
                        <i class="fas fa-trash remove-item" onclick="removeFromCart(${index})"></i> <!-- Icono de eliminar -->
                    </div>
                `;
                cartItems.appendChild(cartItem); // Agregar el producto al contenedor
            });

            cartTotal.innerHTML = `<strong>Total Puntos: ${total}</strong>`; // Mostrar el total de puntos
            userPointsDisplay.innerHTML = `<strong>Puntos disponibles: ${userPoints - total}</strong>`; // Mostrar los puntos restantes
        }

        function checkout() {
            if (cart.length === 0) { // Verificar si el carrito está vacío
                alert('Tu carrito está vacío.'); // Mostrar alerta
                return; // Salir de la función
            }

            if (total > userPoints) { // Verificar si el usuario tiene suficientes puntos
                alert('No tienes suficientes puntos para completar el canje.'); // Mostrar alerta
                return; // Salir de la función
            }

            // Enviar los datos del carrito al servidor
        }
    </script>

    <footer class="footer">
        <section class="icono-redes">
            <div class="redes-sociales">
                <a href="https://www.google.com" target="_blank"><i class="fa-brands fa-facebook"></i></i></a>
                <a href="https://www.google.com" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.google.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.google.com" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.google.com" target="_blank"><i class="fa-brands fa-google-plus"></i></a>
            </div>
        </section>
        <section class="avisos">
            <a href="#">Avisos Legales</a>
            <a href="#">Políticas de Privacidad</a>
            <a href="#">Políticas de Cookies</a> 
        </section>
        <div class="derechos">
            <p>&copy; 2025 - Eco Cash Back | Todos los Derechos Reservados</p>
        </div>
    </footer>
</body>
</html>