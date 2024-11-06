<?php
session_start();
require "conexion.php";

if (!isset($_SESSION['idUSUARIO'])) {
    header("location: index.php");
    exit;
}

$sql = "SELECT sum(c.cantidad) cantidad,  p.nombre 
from carrito c 
INNER JOIN producto p ON c.id_producto = p.id_producto 
WHERE date(c.fecha_creacion) = CURDATE() GROUP BY c.id_producto;";


// Ejecutar la consulta
$resultado = $mysqli->query($sql);

if ($resultado) {
    // Crear un array para almacenar los resultados
    $datos = [];

    // Recorrer los resultados y agregarlos al array
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }

    // Convertir el array a JSON
    // add header content-type application/json
    header('Content-Type: application/json');
    echo json_encode($datos);

    // Liberar el conjunto de resultados
    $resultado->free();
} else {
    // En caso de error en la consulta, mostrar el mensaje
    echo json_encode(["error" => "Error en la consulta: " . $mysqli->error]);
}
// Cerrar la conexión
mysqli_close($mysqli);
?>
