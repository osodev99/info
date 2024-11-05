<?php
session_start();
require "conexion.php";

if (!isset($_SESSION['idUSUARIO'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}

$id_usuario = $_SESSION['idUSUARIO'];
$data = json_decode(file_get_contents('php://input'), true);
$id_producto = $data['id_producto'];
$cantidad = $data['cantidad'];

// Verificar si hay un carrito abierto para el usuario
$query = "SELECT id_carrito FROM carrito WHERE id_usuario = $id_usuario AND cerrado = 0 LIMIT 1";
$result = mysqli_query($mysqli, $query);

if (mysqli_num_rows($result) > 0) {
    // Hay un carrito abierto, se puede añadir el producto
    $carrito = mysqli_fetch_assoc($result);
    $id_carrito = $carrito['id_carrito'];

    // Verificar si el producto ya está en el carrito
    $query = "SELECT * FROM carrito WHERE id_carrito = $id_carrito AND id_producto = $id_producto";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
        // Si el producto ya existe, actualizar la cantidad
        $query = "UPDATE carrito SET cantidad = cantidad + $cantidad WHERE id_carrito = $id_carrito AND id_producto = $id_producto";
        mysqli_query($mysqli, $query);
    } else {
        // Si el producto no está en el carrito, insertarlo
        $query = "INSERT INTO carrito (id_usuario, id_producto, cantidad, estado, cerrado) VALUES ($id_usuario, $id_producto, $cantidad, 'pendiente', 0)";
        mysqli_query($mysqli, $query);
    }

    echo json_encode(['success' => true]);
} else {
    // No hay un carrito abierto, se debe crear uno nuevo
    $query = "INSERT INTO carrito (id_usuario, id_producto, cantidad, estado, cerrado) VALUES ($id_usuario, $id_producto, $cantidad, 'pendiente', 0)";
    mysqli_query($mysqli, $query);
    echo json_encode(['success' => true, 'message' => 'Carrito creado y producto añadido.']);
}
?>
