<?php
session_start();
require "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data['action'] === 'aceptar') {
        $id_carrito = $data['id_carrito'];
        $id_producto = $data['id_producto'];
        $cantidad = $data['cantidad'];

        // Step 1: Update the stock of the product
        $query = "UPDATE producto SET stock = stock - $cantidad WHERE id_producto = $id_producto";
        mysqli_query($mysqli, $query);

        // Step 2: Mark the order as 'accepted' and close the cart
        $query = "UPDATE carrito SET estado = 'aceptado', cerrado = 1 WHERE id_carrito = $id_carrito";
        mysqli_query($mysqli, $query);

        // Step 3: Get user details for the order (you can adjust this query to match your schema)
        $query_user = "SELECT nombre, telefono FROM usuario WHERE id_usuario = " . $_SESSION['idUSUARIO'];
        $result_user = mysqli_query($mysqli, $query_user);
        $user = mysqli_fetch_assoc($result_user);

        // Step 4: Create a detailed description of the order
        $query_product = "SELECT nombre FROM producto WHERE id_producto = $id_producto";
        $result_product = mysqli_query($mysqli, $query_product);
        $product = mysqli_fetch_assoc($result_product);

        $detalle_pedido = "Producto: " . $product['nombre'] . "\nCantidad: " . $cantidad;

        // Step 5: Insert the order into the `pedidos` table
        $query_pedido = "INSERT INTO pedidos (nombre_cliente, direccion, telefono, detalle_pedido, estado)
                         VALUES ('" . $user['nombre'] . "', 'Dirección de ejemplo', '" . $user['telefono'] . "', '" . $detalle_pedido . "', 'Pendiente')";
        mysqli_query($mysqli, $query_pedido);

        echo json_encode(['success' => true]);
    } elseif ($data['action'] === 'rechazar') {
        $id_carrito = $data['id_carrito'];

        // Mark the order as 'rejected' and close the cart
        $query = "UPDATE carrito SET estado = 'rechazado', cerrado = 1 WHERE id_carrito = $id_carrito";
        mysqli_query($mysqli, $query);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
