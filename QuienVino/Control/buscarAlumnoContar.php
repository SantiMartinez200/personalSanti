<?php
include("../BD/conn.php");
include("../Clases/Persona.php");
include("../Clases/Alumno.php");
include("../Clases/Parametro.php");
$conectarDB = new Conexion();
$conectarDB->connect();
$dni = $_GET['dni'];
$query = Alumno::busquedaDNICantidad($dni);
$buscar = $conectarDB->ejecutar($query);
$buscar = $buscar->fetch_all();

if (empty($buscar)) {
  echo "<div class='caja-index alert alert-danger text-center mt-5 ' style=' overflow-y: auto; '>";
  echo ("No existen asistencias para ese DNI");

  echo "</div>";
} else {
  echo "<table class='table table-hover text-center'>";
  echo "          <thead>";
  echo "            <tr>";
  echo "              <th colspan='5' class='bg-primary text-white'>";
  echo "                <h4>Cuenta de asistencias</h4>";
  echo "              </th>";
  echo "            </tr>";
  echo "            <tr>";
  echo "              <th scope='col'>DNI</th>";
  echo "             <th scope='col'>Apellido</th>";
  echo "             <th scope='col'>Nombre</th>";
  echo "             <th scope='col'>Cantidad Asistencias</th>";
  echo "             <th scope='col'>Promedio</th>";
  echo "           </tr>";
  echo "         </thead>";
  echo "         <tbody id='tableInfo'>";
  foreach ($buscar as $elementosBuscar) {
    echo "<tr>";
    echo "  <td>";
    echo "    <div class='mt-3'>";
    echo "      $elementosBuscar[0]";
    echo "    </div>";
    echo "  </td>";
    echo "  <td>";
    echo "    <div class='mt-3'>";
    echo "      $elementosBuscar[2]";
    echo "    </div>";
    echo "  </td>";
    echo "  <td>";
    echo "    <div class='mt-3'>";
    echo "      $elementosBuscar[1]";
    echo "    </div>";
    echo "  </td>";
    echo "  <td>";
    echo "    <div class='mt-3'>";
    echo "      $elementosBuscar[3]";
    echo "    </div>";
    echo "  </td>";
    echo "  <td>";
        $asistencia = intval($elementosBuscar[3]);
        $traerDias = Alumno::traerParametroAsistencias();
        $ejecutar = $conectarDB->ejecutar($traerDias);
        $dias_de_clase = $ejecutar->fetch_all();
        $traerParametros = Parametro::traerParametros();
        $ejecutar = $conectarDB->ejecutar($traerParametros);
        $listadoParametros = $ejecutar->fetch_all();
        //var_dump($listadoParametros);
        if ($listadoParametros == NULL) {
          echo "<div class='alert alert-danger mt-1'> Imposible calcular, parámetros requeridos. </div>";
        } else {
          $dia = intval($dias_de_clase[0][0]);
    
          $promedioAlumno = round($asistencia * 100 / $dia);
          if ($promedioAlumno >= $listadoParametros[0][2]) {
            echo "<div class='alert alert-success mt-1'>$promedioAlumno%</div>";
          } elseif (($promedioAlumno < 80) && ($promedioAlumno >= $listadoParametros[0][3])) {
            echo "<div class='alert alert-warning mt-1'>$promedioAlumno%</div>";
          } else {
            echo "<div class='alert alert-danger'>$promedioAlumno%</div>";
          }
        }
  }
  echo "</td>";
  echo "</tr>";
  echo "</tbody>";
  echo "</table>";
}
?>
<script src="../ABM/Alumno/JS/confirmDelete.js"></script>