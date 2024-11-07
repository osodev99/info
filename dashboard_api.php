<?php
session_start();
require "conexion.php";

if ($mysqli->connect_error) {
    echo json_encode(["error" => "Error de conexión: " . $mysqli->connect_error]);
    exit();
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'ventas_hoy':
        obtenerVentasHoy($mysqli);
        break;

    case 'ventas_mes':
        obtenerVentasPorMes($mysqli);
        break;
    
    case 'productos_dia':
        productosDia($mysqli);
        break;
    
    case 'productos':
        productos($mysqli);
        break;

    default:
        header('Content-Type: application/json');
        echo json_encode(["error" => "Endpoint no válido"]);
        break;
}


// Función para obtener ventas del día actual
function obtenerVentasHoy($mysqli) {
    $sql = "SELECT * FROM carrito WHERE estado = 'aceptado' AND DATE(fecha_creacion) = CURDATE()";
    ejecutarConsulta($mysqli, $sql);
}

// Función para obtener ventas agrupadas por mes
function obtenerVentasPorMes($mysqli) {
    $sql = "SELECT 
                YEAR(fecha_creacion) AS anio, 
                MONTH(fecha_creacion) AS mes,
                COUNT(*) AS total_ventas,
                SUM(cantidad) AS total_productos 
            FROM carrito 
            WHERE estado = 'aceptado'
            GROUP BY YEAR(fecha_creacion), MONTH(fecha_creacion)
            ORDER BY anio DESC, mes DESC";
    ejecutarConsulta($mysqli, $sql);
}

function productosDia($mysqli) {
    $sql = "SELECT 
        DATE(fecha_creacion) AS fecha,
        estado,
        COUNT(*) AS total_productos
            FROM carrito
            GROUP BY DATE(fecha_creacion), estado
            ORDER BY fecha DESC;";
    ejecutarConsulta($mysqli, $sql);
}


// Función para obtener ventas del día actual
function productos($mysqli) {
    $sql = "SELECT 
    estado,
    COUNT(*) AS total_productos
FROM carrito
GROUP BY estado;";
    ejecutarConsulta($mysqli, $sql);
}

// Función para ejecutar una consulta y devolver el resultado en JSON
function ejecutarConsulta($mysqli, $sql) {
    $resultado = $mysqli->query($sql);

    if ($resultado) {
        $datos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
        header('Content-Type: application/json');
        echo json_encode($datos);
        $resultado->free();
    } else {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Error en la consulta: " . $mysqli->error]);
    }
}
// Cerrar la conexión
$mysqli->close();
?>
