<?php
session_start();
require "conexion.php";

if (!isset($_SESSION['idUSUARIO'])) {
    header("location: index.php");
}

$nombre = $_SESSION['nombre'];
$nivel = $_SESSION['nivel'];
$tipo_idtipo = $_SESSION['tipo_idtipo'];
$id_usuario = $_SESSION['idUSUARIO'];

// Cambiar la consulta para obtener solo carritos abiertos
$query = "SELECT p.nombre, p.precio, c.cantidad, (p.precio * c.cantidad) AS total
          FROM carrito c
          JOIN producto p ON c.id_producto = p.id_producto
          WHERE c.id_usuario = $id_usuario AND c.cerrado = 0"; // Solo carritos abiertos

$result = mysqli_query($mysqli, $query);
?>

<?php include("template/cabecera.php"); ?>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Selecciona el Método de Pago</h2>
        <div class="text-center mt-4">
            <!-- Botones de selección de método de pago -->
            <button class="btn btn-primary mx-2" onclick="mostrarQR()">QR</button>
            <button class="btn btn-primary mx-2" onclick="mostrarTarjeta()">Tarjeta de Crédito</button>
            <button class="btn btn-primary mx-2" onclick="mostrarEfectivo()">Efectivo</button>
        <!-- <a href="pago_exitoso.php" class="btn btn-primary">Proceder al Pago</a> -->
        </div>
        
        <!-- Contenedor para mostrar el contenido del método de pago seleccionado -->
        <div id="contenidoPago" class="mt-4 text-center"></div>
    </div>

    <script>
        function mostrarQR() {
            document.getElementById('contenidoPago').innerHTML = `
                <h4>Código QR</h4>
                <img src="img/frame.png" alt="Código QR" class="img-fluid" style="max-width: 300px;">
                <hr/>
                <a href="pago_exitoso.php" class="btn btn-primary">Continuar</a>
            `;
        }

        function mostrarTarjeta() {
            document.getElementById('contenidoPago').innerHTML = `
                <h4>Pago con Tarjeta de Crédito</h4>
                <form id="formTarjeta" class="mt-3 needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="nroTarjeta" class="form-label">Número de Tarjeta</label>
                        <input type="text" class="form-control" id="nroTarjeta" placeholder="1234 5678 9012 3456" required pattern="\\d{16}">
                        <div class="invalid-feedback">Ingrese un número de tarjeta válido de 16 dígitos.</div>
                    </div>
                    <div class="mb-3">
                        <label for="csv" class="form-label">CSV</label>
                        <input type="text" class="form-control" id="csv" placeholder="123" required pattern="\\d{3}">
                        <div class="invalid-feedback">Ingrese un CSV de 3 dígitos.</div>
                    </div>
                    <div class="mb-3">
                        <label for="fechaExpiracion" class="form-label">Fecha de Expiración</label>
                        <input type="month" class="form-control" id="fechaExpiracion" required>
                        <div class="invalid-feedback">Ingrese una fecha de expiración válida.</div>
                    </div>
                    <div class="mb-3">
                        <label for="nombreDueno" class="form-label">Nombre del Dueño</label>
                        <input type="text" class="form-control" id="nombreDueno" placeholder="Nombre en la tarjeta" required>
                        <div class="invalid-feedback">Ingrese el nombre del dueño de la tarjeta.</div>
                    </div>
                    <button type="button" class="btn btn-success" onclick="validarFormulario()">Pagar</button>
                </form>
            `;
        }

        function validarFormulario() {
            // Selecciona el formulario y activa la validación de Bootstrap
            const form = document.getElementById('formTarjeta');
            if (form.checkValidity()) {
                alert('Pago realizado con éxito');
                window.location.href='pago_exitoso.php';
            } else {
                form.classList.add('was-validated');
            }
        }

        function mostrarEfectivo() {
            document.getElementById('contenidoPago').innerHTML = `
                <h4>Pago en Efectivo</h4>
                <p>Por favor, acércate a la caja para realizar tu pago en efectivo.</p>
                <a href="pago_exitoso.php" class="btn btn-primary">Continuar</a>
            `;
        }
    </script>
</body>

<?php include("template/pie.php"); ?>