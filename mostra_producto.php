<?php
session_start();
require "conexion.php";

if (!isset($_SESSION['idUSUARIO'])) {
    header("location: index.php");
}

$nombre = $_SESSION['nombre'];
$nivel = $_SESSION['nivel'];
$tipo_idtipo = $_SESSION['tipo_idtipo'];

// Obtener la categoría seleccionada de los parámetros de la URL
$categoria_seleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'Todos';
?>

<?php include("template/cabecera.php"); ?>

<main class="container mx-auto px-6 py-24">
    </br>
    <div class="flex justify-end mb-4">
        <a href="carrito.php" class="flex items-center text-gray-900 hover:text-indigo-700">
            <i class="fas fa-shopping-cart text-2xl"></i>
            <span class="ml-2">Mi Carrito</span>
        </a>
    </div>
    </br>
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">NUESTROS PRODUCTOS ARTESANALES</h1>

    <!-- Filtros de categorías -->
    <div class="flex justify-center mb-8">
        <div class="inline-flex rounded-md shadow-sm" role="group">
            <a href="mostra_producto.php?categoria=Todos" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-indigo-700 focus:z-10 focus:ring-2 focus:ring-indigo-700 focus:text-indigo-700">
                Todos
            </a>
            <a href="mostra_producto.php?categoria=Textiles" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-indigo-700 focus:z-10 focus:ring-2 focus:ring-indigo-700 focus:text-indigo-700">
                Textiles
            </a>
            <a href="mostra_producto.php?categoria=Cerámica" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-indigo-700 focus:z-10 focus:ring-2 focus:ring-indigo-700 focus:text-indigo-700">
                Cerámica
            </a>
            <a href="mostra_producto.php?categoria=Cuero" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-indigo-700 focus:z-10 focus:ring-2 focus:ring-indigo-700 focus:text-indigo-700">
                Cuero
            </a>
            <a href="mostra_producto.php?categoria=Trabajo en Semilla" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-indigo-700 focus:z-10 focus:ring-2 focus:ring-indigo-700 focus:text-indigo-700">
                Trabajo en Semilla
            </a>
        </div>
    </div>

    <!-- Mostrar productos en cuadrícula -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php
        // Consultar productos según tipo_idtipo
        if ($tipo_idtipo == 2) {
            // Solo mostrar productos del usuario logueado
            if ($categoria_seleccionada == 'Todos') {
                $query = "SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.stock, p.imagen, c.descripcion AS categoria 
                          FROM producto p 
                          INNER JOIN categoria c ON p.id_categoria = c.id_categoria
                          WHERE p.id_artesano = " . $_SESSION['idUSUARIO'];
            } else {
                // Filtrar productos según la categoría seleccionada por id_categoria
                switch ($categoria_seleccionada) {
                    case "Textiles":
                        $categoria_id = 1;
                        break;
                    case "Cerámica":
                        $categoria_id = 2;
                        break; 
                    case "Cuero":
                        $categoria_id = 3;
                        break;
                    case "Trabajo en Semilla":
                        $categoria_id = 4;
                        break;
                    default:
                        echo "<script>alert('Categoría no válida'); window.location.href='mostrar_productos.php';</script>";
                        exit;
                }
                $query = "SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.stock, p.imagen, c.descripcion AS categoria 
                          FROM producto p 
                          INNER JOIN categoria c ON p.id_categoria = c.id_categoria 
                          WHERE p.id_categoria = $categoria_id AND p.id_artesano = " . $_SESSION['idUSUARIO'];
            }
        } else if ($tipo_idtipo == 3) {
            // Mostrar todos los productos
            if ($categoria_seleccionada == 'Todos') {
                $query = "SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.stock, p.imagen, c.descripcion AS categoria 
                          FROM producto p 
                          INNER JOIN categoria c ON p.id_categoria = c.id_categoria";
            } else {
                // Filtrar productos según la categoría seleccionada por id_categoria
                switch ($categoria_seleccionada) {
                    case "Textiles":
                        $categoria_id = 1;
                        break;
                    case "Cerámica":
                        $categoria_id = 2;
                        break;
                    case "Cuero":
                        $categoria_id = 3;
                        break;
                    case "Trabajo en Semilla":
                        $categoria_id = 4;
                        break;
                    default:
                        echo "<script>alert('Categoría no válida'); window.location.href='mostrar_productos.php';</script>";
                        exit;
                }
                $query = "SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.stock, p.imagen, c.descripcion AS categoria 
                          FROM producto p 
                          INNER JOIN categoria c ON p.id_categoria = c.id_categoria 
                          WHERE p.id_categoria = $categoria_id";
            }
        }

        $result = mysqli_query($mysqli, $query);

        while ($row = mysqli_fetch_array($result)) {
            // Decodificar la imagen BLOB para mostrarla
            $imagen = base64_encode($row['imagen']);
            $precio = number_format($row['precio'], 2);
            $stock = $row['stock']; // Obtener stock
        ?> 
           <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
                 <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-200">
                    <img src="data:image/jpeg;base64,<?php echo $imagen; ?>" alt="<?php echo $row['nombre']; ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1 text-gray-800"><?php echo $row['nombre']; ?></h3>
                        <p class="text-gray-600 mb-2"><?php echo $row['descripcion']; ?></p>
                        <p class="text-sm text-gray-500 mb-2">Categoría: <?php echo $row['categoria']; ?></p>
                        <p class="text-sm text-gray-500 mb-2">Stock: <?php echo $stock; ?></p> <!-- Mostrar stock -->
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-xl font-bold text-indigo-600">$<?php echo $precio; ?></span>
                            <button onclick="addToCart(<?php echo $row['id_producto']; ?>)" class="bg-orange-500 hover:bg-orange-600 text-black px-4 py-2 rounded-md transition-colors duration-200">
                                Añadir al carrito
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>

<script>
    function addToCart(productId) {
        fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id_producto: productId,
                    cantidad: 1
                }) // Cambia la cantidad según sea necesario
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la red: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                if (data.success) {
                    alert('Producto añadido al carrito.');
                } else {
                    alert('Error al añadir el producto al carrito: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

<?php include("template/pie.php"); ?>