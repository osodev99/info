<?php 
require "conexion.php";

if (!isset($_SESSION['idUSUARIO'])) {
    header("location: index.php");
}

$nombre = $_SESSION['nombre'];
$nivel = $_SESSION['nivel'];
$tipo_idtipo = $_SESSION['tipo_idtipo'];
$id_usuario = $_SESSION['idUSUARIO'];
?>

<main class="container mx-auto px-6 py-24">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Empecemos la entrega</h1>
    <p class="text-center text-gray-600">Ubica tu posición en tiempo real y gestiona tus entregas con precisión.</p>
    
    <div id="controls" class="text-center mt-6">
        <button onclick="startDelivery()" class="btn btn-primary">Iniciar Entrega</button>
        <button onclick="endDelivery()" class="btn btn-secondary" style="display:none;">Terminar Entrega</button>
    </div>
    
    <div id="map" style="height: 400px; width: 100%; display: none;" class="mt-6"></div>
    <p id="status" class="text-center text-red-500 mt-4"></p>
</main>

<!-- Leaflet.js CSS y JavaScript -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    let map;
    let marker;
    let startTime;
    let endTime;
    let startCoords;
    let endCoords;

    function initMap(pos) {
        // Inicializa el mapa centrado en la posición del usuario
        map = L.map('map').setView([pos.coords.latitude, pos.coords.longitude], 15);
        
        // Agrega el mapa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);
        
        // Coloca un marcador en la ubicación inicial
        marker = L.marker([pos.coords.latitude, pos.coords.longitude]).addTo(map)
            .bindPopup("Tu ubicación").openPopup();
    }

    function startDelivery() {
        document.getElementById("map").style.display = "block";
        startTime = new Date().toISOString(); // Registrar hora de inicio

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                startCoords = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                initMap(position); // Inicializa el mapa con la ubicación actual
                document.querySelectorAll("#controls button")[1].style.display = "inline-block"; // Mostrar botón "Terminar Entrega"
                document.getElementById("status").innerText = ""; // Limpia el mensaje de error si todo fue exitoso
            }, error => {
                handleLocationError(error);
            });
        } else {
            handleLocationError({ code: 0 });
        }
    }

    function endDelivery() {
        endTime = new Date().toISOString(); // Registrar hora de entrega

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                endCoords = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // Oculta el mapa y elimina el marcador
                document.getElementById("map").style.display = "none";
                if (marker) {
                    map.removeLayer(marker);
                }

                // Ocultar el botón de "Terminar Entrega"
                document.querySelectorAll("#controls button")[1].style.display = "none";

                // Enviar datos al servidor
                saveDeliveryData();
            });
        }
    }

    function saveDeliveryData() {
        fetch('guardar_entrega.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id_usuario: <?php echo json_encode($id_usuario); ?>,
                start_time: startTime,
                end_time: endTime,
                start_coords: startCoords,
                end_coords: endCoords
            })
        }).then(response => response.json())
          .then(data => alert("Datos de entrega guardados con éxito"))
          .catch(error => console.error("Error al guardar datos:", error));
    }

    function handleLocationError(error) {
        const statusElement = document.getElementById("status");
        switch (error.code) {
            case 1:
                statusElement.innerText = "Error: El usuario negó el permiso de geolocalización.";
                break;
            case 2:
                statusElement.innerText = "Error: La ubicación no está disponible.";
                break;
            case 3:
                statusElement.innerText = "Error: La solicitud de geolocalización expiró.";
                break;
            default:
                statusElement.innerText = "Error: La geolocalización no es compatible con tu navegador.";
                break;
        }
    }
</script>
