<?php
require("../BD/conn.php");
require("../Clases/Persona.php");
require("../Clases/Alumno.php");
require("../Clases/Parametro.php");
$conectarDB = new Conexion;
$conectarDB->connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reporte Regulares</title>
  <link rel="stylesheet" href="../Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../styletabla.css">
  <link rel="stylesheet" href="../Resources/css/sweetalert2.min.css" />
</head>

<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script>
  <script src="../Resources/js/bootstrap.bundle.min.js"></script>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a href=".././index.php">
        <div class="redondo">
          <img src="../Multimedia/logo2.png" class="logo">
        </div>
      </a>
      <div class="d-flex justify-content-end">
        <h1 class="text-light"><b>¿QuienVino?</b></h1>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Asistencias</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="../Control/listarAsistencias.php">Listar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="../Control/contarAsistencias.php">Contar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="../Control/asistenciasTardiasIndex.php">Asistencias
                  tardías</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Registros</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="../ABM/Alumno/ABM_Alumno.php">Alumno</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Contacto</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark"
                  href="https://www.instagram.com/santiago_martinez03/?utm_source=qr&igshid=NGExMmI2YTkyZg%3D%3D">Instagram</a>
              </li>
              <li><a class="dropdown-item text-dark" href="https://www.facebook.com/fede.garcia.37604/">Facebook</a>
              </li>
              <li><a class="dropdown-item text-dark"
                  href="https://www.linkedin.com/in/santiago-mart%C3%ADnez-681b38238/">Linkedin</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Reportes</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="./diario.php">Reporte de asistencias</a>
              </li>
              <li><a class="dropdown-item text-dark" href="./promocionados.php">Reporte de
                  promocionados</a></li>
              <li><a class="dropdown-item text-dark" href="./regulares.php">Reporte de
                  regulares</a></li>
              <li><a class="dropdown-item text-dark" href="./libres.php">Reporte de libres</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="nav-item dropstart">
        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <img src="../Multimedia/sliders2.svg" alt="" class="img-fluid config" style="margin-right: 5px;">
        </a>
        <ul class="dropdown-menu text-dark">
          <li><a class="dropdown-item text-dark" href="../Control/parametros.php">Parámetros</a></li>
          <!-- <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/logOut.php">Cerrar Sesión</a></li> -->
        </ul>
      </div>
    </div>
  </nav>
   <div class="container text-center mb-2">
    <button class="btn btn-primary" id="pdfout">Exportar como PDF</button>
  </div>
  <div class="bg-primary text-light rounded border text-center form-control" id="maintable">
    <div class="d-flex justify-content-center">
      <table class="text-center" style="background-color: white; width: 100%;">
        <thead>
          <tr>
            <th colspan="5" class="bg-primary text-white">
              <h2>Regulares</h2>
            </th>
          </tr>
          <tr>
            <th scope="col">DNI</th>
            <th scope="col">Apellido</th>
            <th scope="col">Nombre</th>
            <th scope="col">Cantidad Asistencias</th>
            <th scope="col">Promedio</th>
          </tr>
        </thead>
        <tbody id="tableInfo">
          <?php
          $conectarDB = new Conexion();
          $consulta = Alumno::contarAsistencias();
          $traerDatos = $conectarDB->ejecutar($consulta);
          $resultado = $traerDatos->fetch_all();
          //var_dump($resultado);
          if ($resultado <> NULL) {
            $regular = 0;
            foreach ($resultado as $eachResult => $value) {
              $asistencia = $value[3];
              $traerDias = Alumno::traerParametroAsistencias();
              $ejecutar = $conectarDB->ejecutar($traerDias);
              $dias_de_clase = $ejecutar->fetch_all();
              $traerParametros = Parametro::traerParametros();
              $ejecutar = $conectarDB->ejecutar($traerParametros);
              $listadoParametros = $ejecutar->fetch_all();

              if ($listadoParametros <> NULL) {
                $dia = intval($dias_de_clase[0][0]);
                $promedioAlumno = round($asistencia * 100 / $dia);
                if (($promedioAlumno < $listadoParametros[0][2]) && $promedioAlumno >= $listadoParametros[0][3]) {
                  $regular = $regular += 1;
                  ?>
                  <tr>
                    <td>
                      <div class="mt-3">
                        <?php echo ($value[0]); ?>
                      </div>
                    </td>
                    <td>
                      <div class="mt-3">
                        <?php echo ($value[2]); ?>
                      </div>
                    </td>
                    <td>
                      <div class="mt-3">
                        <?php echo ($value[1]); ?>
                      </div>
                    </td>
                    <td>
                      <div class="mt-3">
                        <?php echo ($value[3]); ?>
                      </div>
                    </td>
                    <td>
                      <?php
                      if (($promedioAlumno < $listadoParametros[0][2]) && $promedioAlumno >= $listadoParametros[0][3]) {
                        echo "<div class='divR mt-1'>$promedioAlumno% </div>";
                      }
                }

                ?>
                  </td>
                </tr>
                <?php
              } elseif ($listadoParametros == NULL) {
                ?>
                      <?php
                      echo "<th colspan='5' class='alert alert-danger mt-1 h-25 w-25'> <h5>Imposible calcular, parámetros requeridos.</h5></th>";

                      ?>
              
                  <?php
                  break;
              }
            }
            ?>
            <tr>
              <th colspan="5" class="bg-primary text-light">
                <h4 class="mt-4">Cantidad de Regulares:
                  <?php echo ($regular); ?>
                </h4>
              </th>
            </tr>
            <?php
            //var_dump($listadoParametros);
            
          } else {
            ?>
        </tbody>
        </table>
      </div>
    </div>
    <div class="alert alert-warning">
      <h3>Aún no hay alumnos que tengan asistencias</h3>
    </div>
    <?php
          }
          ?>

  </tbody>
  </table>
  </div>
  </div>
  <script>
    window.jsPDF = window.jspdf.jsPDF;
    var maintable = document.getElementById('maintable'),
      pdfout = document.getElementById('pdfout');

    pdfout.onclick = function () {
      var doc = new jsPDF('p', 'pt', 'letter');
      var margin = 20;
      var scale = (doc.internal.pageSize.width - margin * 2) / document.body.clientWidth;
      var scale_mobile = (doc.internal.pageSize.width - margin * 2) / document.body.getBoundingClientRect();

      // checking
      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        // mobile
        doc.html(maintable, {
          x: margin,
          y: margin,
          html2canvas: {
            scale: scale_mobile,
          },
          callback: function (doc) {
            doc.output('dataurlnewwindow', { filename: 'pdf.pdf' });
          }
        });
      } else {
        // PC
        doc.html(maintable, {
          x: margin,
          y: margin,
          html2canvas: {
            scale: scale,
          },
          callback: function (doc) {
            doc.output('dataurlnewwindow', { filename: 'Regulares.pdf' });
          }
        });
      }
    };
  </script>
</body>
</html>