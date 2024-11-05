<?php
session_start();
require "conexion.php";

#Activa el gd en en php.ini busca en chat gpt

if (!isset($_SESSION['idUSUARIO'])) {
    header("location: index.php");
}

// Verificamos si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre_producto = mysqli_real_escape_string($mysqli, $_POST['nombre_producto']);
    $descripcion_producto = mysqli_real_escape_string($mysqli, $_POST['descripcion_producto']);
    $precio_producto = floatval($_POST['precio_producto']);
    $categoria_producto = intval($_POST['categoria_producto']);
    $stock_producto = intval($_POST['stock_producto']);
    
    // Verificar si se ha subido una imagen
    if (isset($_FILES['foto_producto']) && $_FILES['foto_producto']['error'] == 0) {
        $foto = $_FILES['foto_producto']['tmp_name'];
        $foto_producto = compressAndResizeImage($foto, 300, 300, 64); // Llama a la función para redimensionar y comprimir la imagen
    } else {
        $foto_producto = NULL; // Si no se adjuntó imagen
    }

    // Insertar los datos en la base de datos
    $id_artesano = $_SESSION['idUSUARIO']; // Asumiendo que el id del artesano es el del usuario logueado
    $query = "INSERT INTO producto (nombre, Stock, descripcion, precio, id_artesano, id_categoria, imagen)
              VALUES ('$nombre_producto', $stock_producto, '$descripcion_producto', $precio_producto, $id_artesano, $categoria_producto, '$foto_producto')";


    if (mysqli_query($mysqli, $query)) {
        // Si se registra correctamente, redirigir a una página de éxito
        header("location: mostra_producto.php");
    } else {
        // Si ocurre un error, mostrar mensaje
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
}

function compressAndResizeImage($source, $width, $height, $maxSizeKB) {
    // Cargar la imagen
    $imageInfo = getimagesize($source);
    $mime = $imageInfo['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            break;
        default:
            return NULL; // Tipo de imagen no soportado
    }

    // Crear una nueva imagen en blanco
    $newImage = imagecreatetruecolor($width, $height);
    
    // Redimensionar la imagen
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));

    // Guardar la imagen en un buffer para calcular su tamaño
    ob_start();
    imagejpeg($newImage, NULL, 100); // Guardar a la memoria, calidad 100
    $imageData = ob_get_contents();
    ob_end_clean();

    // Comprimir la imagen hasta que esté por debajo del tamaño máximo permitido
    $quality = 100; // Calidad inicial
    while (strlen($imageData) > $maxSizeKB * 1024 && $quality > 0) {
        ob_start();
        imagejpeg($newImage, NULL, $quality);
        $imageData = ob_get_contents();
        ob_end_clean();
        $quality -= 5; // Reducir la calidad
    }

    // Liberar memoria
    imagedestroy($image);
    imagedestroy($newImage);

    return addslashes($imageData); // Retornar la imagen en formato binario
}
?>
