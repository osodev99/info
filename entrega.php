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
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Empecemos la entrega</h1>
    <p class="text-center text-gray-600"></p>
    
    <div id="controls" class="text-center mt-6">
        <button onclick="startDelivery()" class="btn btn-primary">Iniciar Entrega</button>
        <button onclick="endDelivery()" class="btn btn-secondary" style="display:none;">Terminar Entrega</button>
    </div>
    
    <div id="map" style="height: 400px; width: 100%; display: none;" class="mt-6"></div>
</main>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlu1d6wEiPaMAMb4UwWSTKU5rRFZwLtvA&callback=initMap" async defer></script>
<script>
    let map;
    let marker;

    function initMap() {
        // Inicializa el mapa con una ubicación predeterminada
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 }, // Coordenadas predeterminadas
            zoom: 15,
        });
    }

    function startDelivery() {
        // Muestra el mapa y obtiene la ubicación del usuario
        document.getElementById("map").style.display = "block";

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // Centra el mapa en la ubicación del usuario
                map.setCenter(pos);

                // Coloca un marcador en la ubicación
                if (marker) {
                    marker.setMap(null); // Eliminar marcador anterior si existe
                }
                marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: "Tu ubicación",
                });

                // Mostrar el botón de terminar entrega
                document.querySelectorAll("#controls button")[1].style.display = "inline-block"; // Mostrar botón "Terminar Entrega"
            }, () => {
                handleLocationError(true, map.getCenter());
            });
        } else {
            // El navegador no soporta Geolocalización
            handleLocationError(false, map.getCenter());
        }
    }

    function endDelivery() {
        // Oculta el mapa y elimina el marcador
        document.getElementById("map").style.display = "none";
        if (marker) {
            marker.setMap(null);
        }

        // Ocultar el botón de "Terminar Entrega"
        document.querySelectorAll("#controls button")[1].style.display = "none";
    }

    function handleLocationError(browserHasGeolocation, pos) {
        alert(browserHasGeolocation
            ? "Error: El servicio de geolocalización falló."
            : "Error: Tu navegador no soporta geolocalización.");
    }
</script>

<?php include("template/pie.php"); ?>
