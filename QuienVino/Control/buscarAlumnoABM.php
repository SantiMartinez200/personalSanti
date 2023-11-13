<?php
include("../BD/conn.php");
include("../Clases/Persona.php");
include("../Clases/Alumno.php");
$conexion = new Conexion();
$conexion->connect();
$dni = $_GET['dni'];
$query = Alumno::listarAlumnosDNI($dni);
$buscar = $conexion->ejecutar($query);
$buscar = $buscar->fetch_all();
date_default_timezone_set("America/Argentina/Buenos_Aires");
$trimmedDate = date("Y-m-d");
$date = date("Y-m-d H:i:s");
if (empty($buscar)) {
  echo "<div class='caja-index alert alert-danger text-center mt-5 ' style=' overflow-y: auto; '>";
  echo ("No existe el alumno");
  echo "</div>";
} else {
  echo "<table class='table table-hover text-center'>";
  echo "          <thead>";
  echo "            <tr>";
  echo "              <th colspan='5' class='bg-primary text-white'>";
  echo "                <h4>Alumnos</h4>";
  echo "              </th>";
  echo "            </tr>";
  echo "            <tr>";
  echo "              <th scope='col'>DNI</th>";
  echo "             <th scope='col'>Apellido</th>";
  echo "             <th scope='col'>Nombre</th>";
  echo "             <th scope='col'>Fecha de Nacimiento</th>";
  echo "             <th scope='col'>Operación</th>";
  echo "           </tr>";
  echo "         </thead>";
  echo "         <tbody id='tableInfo'>";
  foreach ($buscar as $elementosBuscar) {
    echo "<tr>";
    echo "  <td>";
    echo "  $elementosBuscar[0]";
    echo "  </td>";
    echo "  <td>";
    echo "  $elementosBuscar[2]";
    echo "  </td>";
    echo "  <td>";
    echo "  $elementosBuscar[1]";
    echo "  </td>";
    echo "  <td>";
    $originalDate = $elementosBuscar[3];
    $newDate = date("d/m/Y", strtotime($originalDate));
    echo "      $newDate";
    echo "  </td>";
    echo "<td><a href='../../ABM/Alumno/Modificacion.php?dni=$elementosBuscar[0]'
                    class='link-dark table__item__modify'>Actualizar </a>";
    echo "<a onclick='alumno_eliminar($elementosBuscar[0])'
                class='link-dark table__item__link'>Eliminar </a>";
    $verificarFechaAsistencia = Alumno::verificarIngresoAsistencia($elementosBuscar[0], $trimmedDate);
    if ($verificarFechaAsistencia == True) {
      echo "<img src='../../../QuienVino/Multimedia/check-all.svg' alt=''>";
    } else {
      echo "<a href='../../ABM/Alumno/asistirAlumno.php?dni=$elementosBuscar[0]&date=$date'
        class='link-dark table__item__asist'><img src='../../../QuienVino/Multimedia/plus-circle-fill.svg'
                        alt=''>
                    </a>";

      
    }
    echo "</td>";
  }
  echo "</td>";
  echo "</tr>";
  echo "</tbody>";
  echo "</table>";
}
?>