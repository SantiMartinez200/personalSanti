<?php
include("../../../QuienVino/BD/conn.php");
include("../../../QuienVino/Clases/Persona.php");
include("../../../QuienVino/Clases/Alumno.php");
include("../../../QuienVino/Clases/Asistencia.php");
include("../../../QuienVino/Clases/Parametro.php");
date_default_timezone_set("America/Argentina/Buenos_Aires");
?>
<script src="../../Resources/js/sweetalert2.all.min.js"></script>
<?php
$conectarDB = new Conexion();
$conectarDB->connect();
$dni = $_GET["dni"];
$date = $_GET["date"];
$consulta = Alumno::getAlumno($dni);
$traerAlumno = $conectarDB->ejecutar($consulta);
$alumnos = $traerAlumno->fetch_all(); //acomodar en array
$n = $alumnos[0][1];
$a = $alumnos[0][2];

$traerParametros = Parametro::traerParametros();
$execParams = $conectarDB->ejecutar($traerParametros);
$listParams = $execParams->fetch_all();
//var_dump($listParams);
$time = date("H:i");
if ($listParams <> NULL) {
  $horaInicial = $listParams[0][6];
  $minutosASumar = intval($listParams[0][5]);
  $fechaHora = DateTime::createFromFormat('H:i:s', $horaInicial);
  $fechaHora->add(new DateInterval('PT' . $minutosASumar . 'M'));
  $horaResultante = $fechaHora->format('H:i');
  if ($time <= $horaResultante) {
  } else {
    $conectarDB->killConn();
    echo "<script>window.location='ABM_Alumno.php?err=Late';</script>";
  }
} else {
  echo "<script>window.location='ABM_Alumno.php?err=noParams';</script>";
  $conectarDB->killConn();
}














$consulta = Alumno::insertarAsistencia($dni, $date);
$cargarAsistencia = $conectarDB->ejecutar($consulta);
$birthday = Alumno::cumple($date, $dni);
$execBirthday = $conectarDB->ejecutar($birthday);
$listBirthday = $execBirthday->fetch_all();
if ($listBirthday != NULL) {
  $cumple = true;
  if ($cargarAsistencia) {
    ?>
    <script>
      var birthday = <?php echo $cumple; ?>;
      window.location.href = 'ABM_Alumno.php?var=fireSweetAlert()' + '&birthday=' + birthday;
    </script>;
    <?php
  }
  $conectarDB->killConn();
} else {
  if ($cargarAsistencia) {
    echo "<script>window.location.href='ABM_Alumno.php?var=fireSweetAlert()'</script>";
  }
  $conectarDB->killConn();
}





?>