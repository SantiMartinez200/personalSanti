<?php
//primer pantalla: indexhtml con una cajita para poner el DNI y poner CONSULTAR
//Un menú que diga ALUMNO y otro PROFESOR, que lleven a sus pantallas correspondientes y dar un ABM de cada uno.
//Usar BoostStrap
//ABM : Alta-Baja-Modificacion
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABM ALUMNO</title>
  <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../QuienVino/ABM/Alumno/CSS/styleAlumno.css">
</head>

<body>
  <div class="p-3 mb-2 bg-light text-dark">
    <h1 class="h1title">ABM del alumno.</h1>
    <p><b>A</b>lta <b>B</b>aja <b>M</b>odificación.</p>
  </div>

  <div class="container col-10">
    <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-primary text-white rounded">
      <h2 class="container__title">Registrar Alumno</h2>
    </div>

    <form class="form text-center p-3 mb-2 bg-light text-black col-12" action="../Alumno/Alta.php" method="POST">
      <div class="row">
        <div class="col">
          <label for="" class="container__label">Nombre:</label>
          <div class="d-flex justify-content-center"><input type="text" class="container__input" name="nombre"></div>
        </div>
        <div class="col"><label for="" class="container__label">Apellido:</label>
          <div class="d-flex justify-content-center"><input type="text" class="container__input" name="apellido"></div>
        </div>
      </div>
      <div class="row">
        <?php //////////////////////////////////////// ?>
        <?php

        //echo ($id);
        if (isset($_GET["dni"])) {
          if (!empty($_GET["dni"])) {
            $id = $_GET["dni"];
            ?> <!--      VINO DESDE LA ASISTENCIA         -->
            <div class="col">
              <label for="" class="container__label">DNI:</label>
              <div><input type="number" class="container__input" name="dni" value="<?php echo ($id) ?>"></div>
            </div>
            <?php
          }
        } else { //viene desde esta página
          ?>
          <div class="col">
            <label for="" class="container__label">DNI:</label>
            <div><input type="number" class="container__input" name="dni"></div>
          </div>
          <?php
        }
        ?>
        <?php //////////////////////////////////////// ?>
        <div class="col">
          <label for="" class="container__label">Fecha de nacimiento:</label>
          <div><input type="date" class="container__input" name="fechaNacimiento"></div>
        </div>
      </div>
      <div class="col-12 text-center">
        <input type="submit" value="Registrar Alumno" class="btn btn-outline-primary">
      </div>
    </form>
  </div>
  <div class="d-flex justify-content-center">
    <div class="col-10 text-center">
      <table class="table table-hover">
        <thead>
          <tr>
            <th colspan="5" class="bg-primary text-white">Alumnos</th>
          </tr>
          <tr>
            <th scope="col">DNI</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Fecha de Nacimiento</th>
            <th scope="col">Operación</th>
          </tr>
        </thead>
        <tbody>

          <?php
          include("../../../QuienVino/BD/conn.php");
          $BD = Conexion::connect();
          $selectAlumnos = mysqli_query($BD, "SELECT * FROM alumno");
          ?>
          <?php
          while ($row = mysqli_fetch_assoc($selectAlumnos)) { ?>
            <tr>
              <td>
                <?php print($row["dni"]); ?>
              </td>
              <td>
                <?php print($row["nombre"]); ?>
              </td>
              <td>
                <?php print($row["apellido"]); ?>
              </td>
              <td>
                <?php print($row["fecha_nacimiento"]); ?>
              </td>
              <td><a href="../../ABM/Alumno/Modificacion.php?dni=<?php echo ($row["dni"]) ?>"
                  class="table__item__modify">Actualizar</a>
                <a href="../../ABM/Alumno/Baja.php?dni=<?php echo ($row["dni"]) ?>" class="table__item__link">Eliminar</a>
              </td>
            </tr>


            <!--//////////////////////////////////////////////////////////////////////-->
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  <div class="d-flex justify-content-center">
    <button type="button" class="btn btn-light"><a href="../../../QuienVino/index.php">Volver al
        inicio</a></button>

    <script src="../../ABM/Alumno/JS/confirmDelete.js"></script>

  </div>
</body>

</html>