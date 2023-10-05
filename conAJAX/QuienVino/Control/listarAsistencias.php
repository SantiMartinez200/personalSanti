<?php
include("../BD/conn.php");
include("../Clases/Persona.php");
include("../Clases/Alumno.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de asistencias</title>
  <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../QuienVino/styleIndex.css">
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a href="../../QuienVino/index.php">
        <div class="redondo">
          <img src="../Multimedia/logo.png" class="logo">
        </div>
      </a>
      <div class="d-flex justify-content-end">
        <h1 class="text-light"><b>Asistencias</b></h1>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Asistencias</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="./listarAsistencias.php">Listar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="./contarAsistencias.php">Contar asistencias</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Registros</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="../ABM/Alumno/ABM_Alumno.php">Alumno</a></li>
              <li><a class="dropdown-item text-dark" href="../ABM/Profesor/ABM_Profesor.php">Profesor</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php

  //var_dump($alumnos);
  ?>
  <div class="d-flex justify-content-center">
    <div class="col-10">
      <div class="container m-2">
        <form action="listarAsistencias.php" method="POST">
          <label for="campo">
            <h3 class="text-light">Filtrar por alumno</h3>
          </label>
          <div class="d-flex "><input id="campo" class="form-control form-control-lg" type="text" name="dni">
          </div>
        </form>
        <table class="table table-hover text-center">
          <thead>
            <tr>
              <th colspan="6" class="bg-primary text-white ">
                <h4>Asistencias</h4>
              </th>
            </tr>
            <tr>
              <th scope="col">ID de Asistencia</th>
              <th scope="col">DNI</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>
              <th scope="col">Fecha y Hora</th>
              <th scope="col">Rol</th>
            </tr>
          </thead>
          <tbody id="content">

          </tbody>
        </table>
        <script>
          document.getElementById("campo").addEventListener("keyup", getData)
          function getData() {
            let input = document.getElementById("campo").value
            let content = document.getElementById("content")
            let url = "../../QuienVino/Control/cargar.php"
            let formaData = new FormData()
            formaData.append('campo', input)

            fetch(url, {
              method: "POST", body: formaData
            }).then(response => response.json()).then(data => {
              content.innerHTML = data
            }).catch(err => console.log(err))
          }
        </script>
        <?php
        ?>

      </div>

    </div>
  </div>
  <style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }
  </style>
  <script src="../../QuienVino/Resources/js/bootstrap.bundle.min.js"></script>
</body>

</html>