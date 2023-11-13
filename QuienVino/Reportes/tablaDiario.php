<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  if (isset($_POST["calendario"])) {
    if (!empty($_POST["calendario"])) {
      require("../BD/conn.php");
      require("../Clases/Asistencia.php");
      $fechaReporte = $_POST["calendario"];
      $conectarDB = new Conexion;
      $conectarDB->connect();
      $reporte = Asistencia::calendarioAsistencia($fechaReporte);
      $ejecutarReporte = $conectarDB->ejecutar($reporte);
      $listadoReporte = $ejecutarReporte->fetch_all();
      //var_dump($listadoReporte);


      //array(11) { [0]=> array(7) { [0]=> string(3) "346" [1]=> string(8) "42850626" [2]=> string(19) "2023-11-10 00:20:42" [3]=> string(8) "42850626" [4]=> string(6) "Lucas " [5]=> string(29) "Barreiro " [6]=> string(10) "2000-12-12" }
      ?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reporte diario</title>
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
                  <th colspan="5" class="bg-primary text-white ">
                    <h2>Reporte del día:
                      <?php echo (date("d/m/Y", strtotime($_POST["calendario"]))); ?>
                    </h2>
                    <h4 class="mt-3">Cantidad de asistidos:
                      <?php echo (count($listadoReporte)); ?>
                    </h4>
                  </th>
                </tr>
                <tr>
                  <th scope="col">ID de Asistencia</th>
                  <th scope="col">DNI</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Fecha y Hora</th>
                </tr>
              </thead>
              <tbody id="tableInfo">
                <?php

                if ($listadoReporte == NULL) {
                  ?>
                  <tr>
                    <th colspan=5>
                      <div class="alert alert-warning border border-dark">
                        <h3>No hay asistencias registradas este día</h3>
                      </div>
                    </th>
                  </tr>
                </tbody>
              </table>

              <?php
                } else {
                  foreach ($listadoReporte as $cadaResultado) {
                    ?>
                <tr>
                  <td>
                    <?php echo ($cadaResultado[0]); ?>
                  </td>
                  <td>
                    <?php echo ($cadaResultado[1]); ?>
                  </td>
                  <td>
                    <?php echo ($cadaResultado[3]); ?>
                  </td>
                  <td>
                    <?php echo ($cadaResultado[2]); ?>
                  </td>
                  <td>
                    <?php
                    $originalDate = $cadaResultado[4];
                    $newDate = date("d/m/Y H:i", strtotime($originalDate));
                    echo ($newDate);
                    ?>
                  </td>
                </tr>
                <?php
                  }
                }

                ?>
            </tbody>
            </table>
          </div>
        </div>

        <!-- tablaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa -->

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
                  doc.output('dataurlnewwindow', { filename: 'Reporte.pdf' });
                }
              });
            }
          };
        </script>
      </body>

      </html>


      <?php
    } else {
      echo "<script>
      window.location='diario.php?err=empty';
      </script>";
    }
  }
}
?>