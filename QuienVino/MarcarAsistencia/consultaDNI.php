<?php
include("../../TRABAJO_PRACTICO/BD/conn.php");
$conectarDB = Conexion::connect();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar DNI</title>
    <link rel="stylesheet" href="../../QuienVino/MarcarAsistencia/CSS/styleAsis.css">
    <link rel="stylesheet" href="../../QuienVino/Resources/css/bootstrap.min.css" />
  </head>

  <body>
    <div class="container mt-2">
      <div class="container col-10">
        <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-danger text-white rounded">
          <h2 class="container__title">¿Es usted alumno o profesor?</h2>
        </div>
        <div class="container d-flex justify-content-center">
          <div class="row d-flex justify-content-center">
            <div class="col">
              <button name="redirectAlumno" class="btn btn-primary" onclick="redirectAlumno()">Alumno</button>
            </div>
            <div class="col">
              <button name="redirectProfesor" class="btn btn-success" onClick="redirectProfesor()">Profesor</button>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-danger mt-3"><a href="../../../QuienVino/index.php">Volver al
            inicio</a></button>
      </div>
      <script src="./JS/redirectProfesor.js"></script>
      <script src="./JS/redirectAlumno.js"></script>
  </body>

  </html>
  <?php
}