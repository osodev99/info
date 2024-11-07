<?php
    session_start();
    require "conexion.php";

    if(!isset($_SESSION['tipo_idtipo'])){//indica que el usuario inicio secion
        header("location: index.php");
    }
    
    $nombre = $_SESSION['nombre'];
    $nivel = $_SESSION['nivel'];
    //$pater = $_SESSION['tipo_idtipo'];//para crear aca necesitamos mandarnos ap en la consulta y en la sesion, desde index.php
    //echo $nivel;
    $tipo_idtipo = $_SESSION['tipo_idtipo'];//sabemos si es 1 o 2 tipo de usuario
    $idusu = $_SESSION['tipo_idtipo'];//como ya tenemos idUSUARIO mandandonos desde index le damos este valor a idusu para poder utilizar este registro
?>

<?php include("template/cabecera.php"); ?>

<body class="container px-6 py-24">

<div class="card m-4 p-2">
   <b>Ventas por mes</b> 
  <canvas id="graph" aria - label="chart" height="200"></canvas>

</div>
<div class="card m-4 p-2">
   <b>Ventas de hoy</b> 
  <canvas id="graphhoy" aria - label="chart" height="200"></canvas>
</div>

<div class="card m-4 p-2">
  <b>Estado de los pedidos</b> 
  <canvas id="graphestado" aria - label="chart" height="200"></canvas>
</div>

 <script>

function ventasMes() {
    fetch(`dashboard_api.php?action=ventas_mes`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la red');
            }
            return response.json();
        })
        .then(data => {
            console.log('Datos recibidos:', data);
            let meses = data.map((d) => {
                return numeroAMes(d.mes);
            });
            let ventas = data.map((d) => {
                return d.total_ventas;
            });
            let productos = data.map((d) => {
                return d.total_productos;
            });
            console.log(meses);
            
            
      var chrt = document.getElementById("graph");
      var graph = new Chart(chrt, {
          type: 'bar',
          data: {
            labels: meses,
              datasets: [
                {
                  label: "Ventas",
                  backgroundColor: '#007bff',
                  data: ventas,
                },
                {
                  label: "Productos",
                  backgroundColor: '#ced4da',
                  data: productos,
                }
            ],
          },
          options: {
              responsive: true,
          },
      },);
            // Aquí puedes agregar lógica para mostrar los datos en tu página
        })
        .catch(error => {
            console.error('Error en la petición:', error);
        });
}

function numeroAMes(numero) {
    const meses = [
        'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 
        'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
    ];
    return meses[numero - 1]; // Restamos 1 porque los arrays en JavaScript son cero indexados
}


function ventasHoy() {
    fetch(`dashboard_api.php?action=ventas_hoy`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la red');
            }
            return response.json();
        })
        .then(data => {
            console.log('Datos recibidos:', data);
            let meses = data.map((d) => {
                return d.fecha_creacion;
            });
            let ventas = data.map((d) => {
                return d.cantidad;
            });
            console.log(meses);
            
            
      var chrt = document.getElementById("graphhoy");
      var graph = new Chart(chrt, {
          type: 'bar',
          data: {
            labels: meses,
              datasets: [
                {
                  label: "Ventas",
                  backgroundColor: '#007bff',
                  data: ventas,
                },
            ],
          },
          options: {
              responsive: true,
          },
      },);
            // Aquí puedes agregar lógica para mostrar los datos en tu página
        })
        .catch(error => {
            console.error('Error en la petición:', error);
        });
}


function estadoPedidos() {
    fetch(`dashboard_api.php?action=productos_dia`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la red');
            }
            return response.json();
        })
        .then(data => {
            console.log('Datos recibidos:', data);
            let meses = data.map((d) => {
                return d.fecha;
            });
            let acep = [];
            let rech = [];
            let pen = [];
            data.forEach((item, i) => {
                console.log('item', item);
                
                if(item.estado == "aceptado") acep.push(item.total_productos)
                if(item.estado == "rechazado") rech.push(item.total_productos)
                if(item.estado == "pendiente") pen.push(item.total_productos)
            });
        console.log(acep, rech, pen);
        
            
            
      var chrt = document.getElementById("graphestado");
      var graph = new Chart(chrt, {
          type: 'line',
          data: {
            labels: meses,
              datasets: [
                {
                  label: "Aceptados",
                  backgroundColor: '#007bff',
                  data: acep,
                  fill: false,
                  tension: 0.5,
                },
                {
                  label: "Rechazados",
                  backgroundColor: '#ff0000',
                  data: rech,
                  fill: false,
                  tension: 0.5,
                },
                {
                  label: "Pendientes",
                  backgroundColor: '#9b9b9b',
                  data: pen,
                  fill: false,
                  tension: 0.5,
                },
            ],
          },
          options: {
              responsive: true,
          },
      },);
        })
        .catch(error => {
            console.error('Error en la petición:', error);
        });
}

ventasMes();
ventasHoy();
estadoPedidos();

  </script>
</body>
<?php include("template/pie.php");?>