<?php
include("../../../QuienVino/BD/conn.php");
include("../../../QuienVino/Clases/Persona.php");
include("../../../QuienVino/Clases/Alumno.php");
include("../../../QuienVino/Clases/Parametro.php");
date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alta de Alumno</title>
  <link rel="stylesheet" href="../../QuienVino/css/bootstrap.min.css" />
</head>

<body>
  <?php
  $var = "fireSweetAlert()";
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["dni"]) || isset($_POST["nombre"]) || isset($_POST["apellido"]) || isset($_POST["fechaNacimiento"])) {
      if (!empty($_POST["dni"]) && !empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["fechaNacimiento"])) {
        ///////////////////////////////////////////////////////////
        $edad = Alumno::obtenerEdad(date("Y-m-d H:i:s"), $_POST["fechaNacimiento"]);
        $conectarDB = new Conexion();
        $conectarDB->connect();
        $sqlParam = Parametro::traerParametros();
        $ejecutarSqlParam = $conectarDB->ejecutar($sqlParam);
        $fetchParams = $ejecutarSqlParam->fetch_object();
        $nombreInsertar = $_POST["nombre"];
        $apellidoInsertar = $_POST["apellido"];
        $dniInsertar = $_POST["dni"];
        $fechaNacimiento = $_POST["fechaNacimiento"];
        if ($fetchParams == NULL) {
          echo "<script>window.location='ABM_Alumno.php?err=noParamsRegister';</script>";
          $conectarDB->killConn();
        }
        if ((strlen($nombreInsertar) < 30) && (strlen($apellidoInsertar) < 30) && (($dniInsertar < 99999999) && ($dniInsertar > 0)) && (($edad >= $fetchParams->edad_minima) && ($fetchParams->edad_minima <> NULL))) {
          if ((preg_match("/^[a-zA-Z\p{L}\s]+$/i", $nombreInsertar)) && (preg_match("/^[a-zA-Z\p{L}\s]+$/i", $apellidoInsertar))) {
            $alumno = new Alumno($nombreInsertar, $apellidoInsertar, $dniInsertar, $fechaNacimiento);
            $sql = Alumno::insertAlumno($alumno);
            try {
              $traerAlumno = $conectarDB->ejecutar($sql);
            } catch (mysqli_sql_exception $e) {
              if (str_contains($e, 'Duplicate entry')) {
                echo "<script>window.location.href='ABM_Alumno.php?var=fireSweetAlert()?errno=1'</script>";
              } else {
                die(print_r("<script>window.location.href='ABM_Alumno.php?var=fireSweetAlert()?errno=2'</script>"));
              }
            }
            echo "<script>window.location.href='ABM_Alumno.php?var=fireSweetAlert()?errno=6'</script>";
          } else {
            echo "<script>window.location.href='ABM_Alumno.php?var=fireSweetAlert()?errno=3'</script>";
          }
        } else {
          echo "<script>window.location.href='ABM_Alumno.php?var=fireSweetAlert()?errno=4'</script>";
        }

      } else {
        echo "<script>window.location.href='ABM_Alumno.php?var=fireSweetAlert()?errno=5'</script>";
      }
      ?>
      <?php
    }
  }
  $conectarDB->killConn();
  ?>
</body>

</html>