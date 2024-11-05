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
include("template/cabecera.php"); 

?>

<main class="container mx-auto px-6 py-24">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">¡Gracias por tu compra!</h1>
    <p class="text-center text-gray-600">Tu pedido ha sido procesado correctamente.</p>
</main>

<?php include("template/pie.php"); ?>
