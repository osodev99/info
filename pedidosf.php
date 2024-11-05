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

// Verificar si el usuario es un artesano (id_usuario = 2)
$is_artesano = ($id_usuario == 2);

// Consulta para obtener pedidos aceptados del usuario logueado
$query_aceptados = "SELECT p.id_pedido, p.nombre_cliente, p.direccion, p.telefono, p.detalle_pedido, p.estado, p.fecha_pedido
                    FROM pedidos p
                    WHERE p.estado = 'Aceptado'"; // Agregar condición para artesano

$result_aceptados = mysqli_query($mysqli, $query_aceptados);

// Consulta para obtener pedidos rechazados del usuario logueado
$query_rechazados = "SELECT p.id_pedido, p.nombre_cliente, p.direccion, p.telefono, p.detalle_pedido, p.estado, p.fecha_pedido
                     FROM pedidos p
                     WHERE p.estado = 'Rechazado' "; // Agregar condición para artesano

$result_rechazados = mysqli_query($mysqli, $query_rechazados);

?>

<?php include("template/cabecera.php"); ?>
<main class="container mx-auto px-6 py-24">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Tus Pedidos Aceptados y Rechazados</h1>

    <!-- Sección de Pedidos Aceptados -->
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Pedidos Aceptados</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <?php $hay_aceptados = false; // Variable para verificar si hay pedidos aceptados
        while ($row = mysqli_fetch_array($result_aceptados)) {
            $hay_aceptados = true; ?>
            <div class="product-card bg-white rounded-lg shadow-md overflow-hidden">
                <h3 class="font-semibold text-xl mb-2"><?php echo $row['nombre_cliente']; ?></h3>
                <p class="text-gray-600 mb-4">Dirección: <?php echo $row['direccion']; ?></p>
                <p class="text-gray-600 mb-4">Teléfono: <?php echo $row['telefono']; ?></p>
                <p class="text-gray-600 mb-4">Detalles: <?php echo $row['detalle_pedido']; ?></p>
                <p class="text-sm text-gray-500">Estado: <?php echo $row['estado']; ?></p>
                <p class="text-sm text-gray-500">Fecha: <?php echo date('Y-m-d H:i', strtotime($row['fecha_pedido'])); ?></p>
            </div>
        <?php }
        if (!$hay_aceptados) { // Mensaje si no hay pedidos aceptados
            echo "<p class='text-gray-500'>No tienes pedidos aceptados.</p>";
        } ?>
    </div>

    <!-- Sección de Pedidos Rechazados -->
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Pedidos Rechazados</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php $hay_rechazados = false; // Variable para verificar si hay pedidos rechazados
        while ($row = mysqli_fetch_array($result_rechazados)) {
            $hay_rechazados = true; ?>
            <div class="product-card bg-white rounded-lg shadow-md overflow-hidden">
                <h3 class="font-semibold text-xl mb-2"><?php echo $row['nombre_cliente']; ?></h3>
                <p class="text-gray-600 mb-4">Dirección: <?php echo $row['direccion']; ?></p>
                <p class="text-gray-600 mb-4">Teléfono: <?php echo $row['telefono']; ?></p>
                <p class="text-gray-600 mb-4">Detalles: <?php echo $row['detalle_pedido']; ?></p>
                <p class="text-sm text-red-600">Estado: <?php echo $row['estado']; ?></p>
                <p class="text-sm text-gray-500">Fecha: <?php echo date('Y-m-d H:i', strtotime($row['fecha_pedido'])); ?></p>
            </div>
        <?php }
        if (!$hay_rechazados) { // Mensaje si no hay pedidos rechazados
            echo "<p class='text-gray-500'>No tienes pedidos rechazados.</p>";
        } ?>
    </div>
</main>

<?php include("template/pie.php"); ?>
