<?php
include("../BD/conn.php");
include("../Clases/Persona.php");
include("../Clases/Alumno.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $conexion = new Conexion();
  $conexion->connect();
  $dni = $_GET['dni'];
  $query = Alumno::busquedaDNI($dni);
  $buscar = $conexion->ejecutar($query);
  $buscar = $buscar->fetch_all();
  //var_dump ($buscar);
  if (empty($buscar)) {
    echo "<div class='caja-index alert alert-danger text-center mt-5 ' style=' overflow-y: auto; '>";
    echo ("No existen asistencias para ese DNI.");

    echo "</div>";
  } else {
    echo "<table class='table table-hover text-center d-table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th colspan='6' class='bg-primary text-white'>";
    echo "<h2>Resultados</h2>";
    echo "</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>ID de asistencia</th>";
    echo "<th>DNI</th>";
    echo "<th>Apellido</th>";
    echo "<th>Nombre</th>";
    echo "<th>Fecha y Hora</th>";
    echo "<th>Operacion</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody id='tableInfo'>";

    foreach ($buscar as $elementosBuscar) {
      echo "<tr>";
      echo "<td>$elementosBuscar[0]</td>";
      echo "<td>$elementosBuscar[1]</td>";
      echo "<td>$elementosBuscar[3]</td>";
      echo "<td>$elementosBuscar[2]</td>";
      $originalDate = $elementosBuscar[4];
      $newDate = date('d/m/Y H:i', strtotime($originalDate));
      echo "<td>
            $newDate
            </td>";
      echo "<td>
          <a class='link-dark table__item__link' onclick='alerta_eliminar($elementosBuscar[0])'>Eliminar</a>
        </td>";
      echo "</tr>";
    }
    echo "</tr>";
    echo "</tbody>";
    echo "</table>";
    echo "<div style='margin-bottom:20px; overflow-y: auto;></div>";

  }
  ?>

</body>


</html>