<?php
session_start();
require "conexion.php";

if (!isset($_SESSION['idUSUARIO'])) {
    header("location: index.php");
    exit;
}

$id_usuario = $_SESSION['idUSUARIO'];
$tipo_entrega = $_POST['opcion']; // Opción de delivery o tienda
$direccion_entrega = null;
$telefono = null;

// Si selecciona "delivery", obtenemos la dirección y el teléfono
if ($tipo_entrega === 'delivery') {
    // Escapar las entradas para evitar inyecciones SQL
    $direccion = mysqli_real_escape_string($mysqli, $_POST['direccion']);
    $ciudad = mysqli_real_escape_string($mysqli, $_POST['ciudad']);
    $telefono = mysqli_real_escape_string($mysqli, $_POST['telefono']);
    
    $direccion_entrega = "$direccion, $ciudad";
}

// Actualizar la tabla carrito con el tipo de entrega y la dirección si es delivery
$updateQuery = "UPDATE carrito 
                SET tipo_entrega = '$tipo_entrega', 
                    direccion_entrega = " . ($direccion_entrega ? "'$direccion_entrega'" : "NULL") . "
                WHERE id_usuario = $id_usuario AND cerrado = 0";

if (mysqli_query($mysqli, $updateQuery)) {
    // Si la actualización fue exitosa, ahora cerramos el carrito
    $closeCartQuery = "UPDATE carrito 
                       SET cerrado = 1 
                       WHERE id_usuario = $id_usuario AND cerrado = 0";
    
    if (mysqli_query($mysqli, $closeCartQuery)) {
        // Redirigir a una página de confirmación
        header("Location: confirmacion.php");
        exit;
    } else {
        // Manejar el error si el cierre del carrito falla
        echo "Error al cerrar el carrito: " . mysqli_error($mysqli);
    }
} else {
    // Manejar el error si la actualización del tipo de entrega falla
    echo "Error al actualizar el carrito: " . mysqli_error($mysqli);
}

// Cerrar la conexión
mysqli_close($mysqli);
?>
