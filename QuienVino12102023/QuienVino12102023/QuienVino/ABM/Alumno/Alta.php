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
        if ((strlen($nombreInsertar) < 30) && (strlen($apellidoInsertar) < 30) && (($dniInsertar < 99999999) && ($dniInsertar > 0)) && ($edad >= $fetchParams->edad_minima)) {
          if ((preg_match("/^[a-zA-Z\p{L}\s]+$/i", $nombreInsertar)) && (preg_match("/^[a-zA-Z\p{L}\s]+$/i", $apellidoInsertar))) {
            $alumno = new Alumno($nombreInsertar, $apellidoInsertar, $dniInsertar, $fechaNacimiento);
            $sql = Alumno::insertAlumno($alumno);
            try {
              $traerAlumno = $conectarDB->ejecutar($sql);
            } catch (mysqli_sql_exception $e) {
              if (str_contains($e, 'Duplicate entry')) {
                echo "<script>alert('El DNI ya existe.');
                  window.location='ABM_Alumno.php'</script>";
              } else {
                die(print_r("<script>alert('Existió algún error desconocido, inténtelo denuevo.'); window.location='../Alumno/ABM_Alumno.php'</script>"));
              }
            }
            echo "<script>alert('Datos cargados con éxito');
              window.location='../Alumno/ABM_Alumno.php'</script>";
          } else {
            echo "<script>alert('No se pueden ingresar nombres ni apellidos con caracteres especiales ni números.');
                  window.location='ABM_Alumno.php'</script>";
          }
        } else {
          echo "<script>alert('Revise los parámetros ingresados.');
                  window.location='ABM_Alumno.php'</script>";
        }

      } else {
        echo "<script>alert('Existió algún dato vacio'); window.location='../Alumno/ABM_Alumno.php'</script>";
      }
      ?>
      <?php
    }
  }
  $conectarDB->killConn();
  ?>
</body>

</html>