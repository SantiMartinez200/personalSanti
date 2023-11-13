<?php
date_default_timezone_set("America/Argentina/Buenos_Aires");
include("../../../QuienVino/BD/conn.php");
include("../../../QuienVino/Clases/Persona.php");
include("../../../QuienVino/Clases/Alumno.php");
include("../../../QuienVino/Clases/Parametro.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Alumno</title>
    <link rel="stylesheet" href="../../../QuienVino/ABM/Alumno/CSS/styleAlumno.css">
    <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
  </head>

  <body>
    <?php
    if (isset($_POST["dniOriginal"]) && isset($_POST["dniToCatch"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["fechaNacimiento"])) {
      if (!empty($_POST["dniOriginal"]) && !empty($_POST["dniToCatch"]) && !empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["fechaNacimiento"])) {
        ///////////////////////////////////////////////////////////
  
        $DNIoriginal = $_POST["dniOriginal"];
        $dniColocado = $_POST["dniToCatch"];
        $caughtName = $_POST["nombre"];
        $caughtSurname = $_POST["apellido"];
        $conectarDB = new Conexion();
        $edad = Alumno::obtenerEdad(date("Y-m-d H:i:s"), $_POST["fechaNacimiento"]);
        echo ($edad);
        $sqlParam = Parametro::traerParametros();
        $ejecutarSqlParam = $conectarDB->ejecutar($sqlParam);
        $fetchParams = $ejecutarSqlParam->fetch_object();
        //var_dump($fetchParams);
        $caughtDate = $_POST["fechaNacimiento"];
          if ($fetchParams == NULL) {
            echo "<script>window.location='ABM_Alumno.php?err=noParamsModify';</script>";
            $conectarDB->killConn();
          }
        if ((strlen($caughtName) < 30) && (strlen($caughtSurname) < 30) && (($dniColocado < 99999999) && ($dniColocado > 0) && ($DNIoriginal < 99999999) && ($DNIoriginal > 0)) && (($edad >= $fetchParams->edad_minima) && ($fetchParams->edad_minima <> NULL))) {
          if ((preg_match("/^[a-zA-Z\p{L}\s]+$/i", $caughtName)) && (preg_match("/^[a-zA-Z\p{L}\s]+$/i", $caughtSurname))) {
            $conectarDB = new Conexion();
            $conectarDB->connect();
            $actualizarAlumno = Alumno::updateAlumno($dniColocado, $caughtName, $caughtSurname, $DNIoriginal, $caughtDate);
            try {
              $ejecutar = $conectarDB->ejecutar($actualizarAlumno);
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
    }

    $conectarDB->killConn(); ?>
    <style>
      input[type="number"]::-webkit-inner-spin-button,
      input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
      }
    </style>
    <script src="../../../QuienVino/Resources/js/bootstrap.bundle.min.js"></script>
  </body>
  

  </html>
  <?php
}