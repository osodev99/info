<?php
require 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['action'], $data['id_pedido'])) {
    $id_pedido = $data['id_pedido'];
    $action = $data['action'];

    if ($action === 'aceptar') {
        // Actualizar el estado del pedido a 'Aceptado'
        $query = "UPDATE pedidos SET estado = 'Aceptado' WHERE id_pedido = $id_pedido";
    } elseif ($action === 'rechazar') {
        // Actualizar el estado del pedido a 'Rechazado'
        $query = "UPDATE pedidos SET estado = 'Rechazado' WHERE id_pedido = $id_pedido";
    }

    if (mysqli_query($mysqli, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($mysqli)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
}

mysqli_close($mysqli);
?>
