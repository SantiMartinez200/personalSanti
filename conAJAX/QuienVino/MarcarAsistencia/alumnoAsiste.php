<?php
include("../../QuienVino/BD/conn.php");
include("../../QuienVino/Clases/Persona.php");
include("../../QuienVino/Clases/Alumno.php");
$conectarDB = new Conexion();
date_default_timezone_set('America/Argentina/Buenos_Aires');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST["dni"])) {
    if (!empty($_POST["dni"])) {
      $consultarDni = $_POST["dni"]; //traer el alumno
      $consulta = Alumno::getAlumno($consultarDni);
      $traerAlumno = $conectarDB->ejecutar($consulta);
      $alumnos = $traerAlumno->fetch_object();
      if ($alumnos == NULL) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Alumno NO registrado.</title>
          <link rel="stylesheet" href="../../QuienVino/Resources/css/bootstrap.min.css" />
          <link rel="stylesheet" href="../../QuienVino/styleIndex.css">
        </head>

        <body>
          <div class="p-3 mb-2 bg-light text-dark">
            <h1 class="h1title">DNI no encontrado.</h1>
            <h3 class="h3title">¿Desea registrar el DNI?</h3>
          </div>
          <div class="container text-center d-flex justify-content-center align-items-center text-center">
            <div class="row m-3"><button type="button" class="btn btn-dark  border "><a href="../../QuienVino/index.php">
                  Consultar otro DNI.</a></button></div>
            <div class="row m-3">
               <a href="../../QuienVino/ABM/Alumno/ABM_Alumno.php?dni=<?php echo ($consultarDni) ?>">Alumno</a>
                    </div>
                  </div>
                </body>

                </html>
        <?php
      } else { ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Consultar DNI</title>
          <link rel="stylesheet" href="../../QuienVino/styleIndex.css">
          <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
        </head>

        <body>
          <?php
          $fecha_actual = date("Y-m-d H:i:s");

          ?>
          <div class="p-3 mb-2 bg-light text-dark">
            <h1 class="h1title">Asistencia registrada.</h1>
          </div>
          <?php
          $queryAsistencias = $conectarDB->query("SELECT * FROM alumno as a INNER JOIN asistencia as asis ON a.dni=asis.dni WHERE asis.dni='$consultarDni'");
          ?>
          <div class="d-flex justify-content-center">
            <div class="col-10 text-center">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th colspan="5" class="bg-primary text-white">Asistencias de:
                      <?php $row = $queryAsistencias->fetch_all();
                      echo ($row[0][1] . " " . $row[0][2]); ?>
                    </th>
                  </tr>
                  <tr>
                    <th scope="col">ID de Asistencia</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha y Hora</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($row as $eachRow => $value) {
                    ?>
                    <tr>
                      <td>
                        <?php echo ($value[4]); ?>
                      </td>
                      <td>
                        <?php echo ($value[0]); ?>
                      </td>
                      <td>
                        <?php echo ($value[1]); ?>
                      </td>
                      <td>
                        <?php echo ($value[2]); ?>
                      </td>
                      <td>
                        <?php echo ($value[6]); ?>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="container">
            <div class="row m-5">
              <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-primary"><a href="../../QuienVino/index.php">Volver al
                    inicio</a></button>
              </div>
              <div class="col d-flex justify-content-start">
                <button type="button" class="btn btn-primary"><a
                    href="../../QuienVino/MarcarAsistencia/alumnoAsiste.php">Registrar
                    otra asistencia</a></button>
              </div>
            </div>
          </div>
        </body>
        <?php
        $queryAsistencias->close();
      }
    } else {
      echo "<script>alert('El campo está vacio'); window.location='../MarcarAsistencia/consultaDNI.php'</script>";
    }
  }
}



?>