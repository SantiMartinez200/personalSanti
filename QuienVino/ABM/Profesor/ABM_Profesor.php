<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABM PROFESOR</title>
  <link rel="stylesheet" href="../../../QuienVino/ABM/Profesor/CSS/styleABMProfesor.css">
  <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
</head>

<body>
  <div class="p-3 mb-2 bg-light text-dark">
    <h1 class="h1title">ABM del Profesor.</h1>
    <p><b>A</b>lta <b>B</b>aja <b>M</b>odificación.</p>
  </div>

  <div class="container col-10">
    <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-success text-white rounded">
      <h2 class="container__title">Registrar Profesor</h2>
    </div>
    <form class="form text-center p-3 mb-2 bg-light text-black col-12" action="../Profesor/Alta.php" method="POST">
      <div class="row">
        <div class="col">
          <label for="" class="container__label">Nombre:</label>
          <div class="d-flex justify-content-center"><input type="text" class="container__input" name="nombre"></div>
        </div>
        <div class="col">
          <label for="" class="container__label">Apellido:</label>
          <div class="d-flex justify-content-center"><input type="text" class="container__input" name="apellido"></div>
        </div>
        <div class="col">
          <label for="" class="container__label">Titulación:</label>
          <div class="d-flex justify-content-center"><input type="text" class="container__input" name="titulacion">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label for="" class="container__label">DNI:</label>
          <div class="d-flex justify-content-center"><input type="number" class="container__input" name="dniProfesor">
          </div>
        </div>
        <div class="col">
          <label for="" asdasd>Fecha de
            nacimiento:</label>
          <div class="d-flex justify-content-center"><input type="date" class="container__input" name="fechaNacimiento">
          </div>
        </div>
        <div class="col">
          <div class="col-12 text-center mt-3">
            <input type="submit" value="Registrar Profesor" class="btn btn-outline-success">
          </div>
        </div>
      </div>

    </form>
  </div>
  <!--//////////////////////////////////////////////////////////////////////-->
  <?php
  include("../../../QuienVino/BD/conn.php");
  $BD = Conexion::connect();
  $selectProfesores = mysqli_query($BD, "SELECT * FROM profesor");
  ?>
  <div class="d-flex justify-content-center">
    <div class="col-10 text-center">
      <table class="table table-hover">
        <thead>
          <tr>
            <th colspan="6" class="bg-success text-white rounded">Profesores</th>
          </tr>
          <tr>
            <th scope="col">DNI</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Fecha de Nacimiento</th>
            <th scope="col">Título</th>
            <th scope="col">Operación</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($selectProfesores)) { ?>
            <tr>
              <td>
                <?php print($row["dni_profesor"]); ?>
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
              <td>
                <?php print($row["titulo"]); ?>
              </td>
              <td><a class="text-success"
                  href="../../../../QuienVino/ABM/Profesor/Modificacion.php?dni=<?php echo ($row["dni_profesor"]) ?>"
                  class="table__item__modify">Actualizar</a>
                <a class="text-success" href="../../ABM/Profesor/Baja.php?id=<?php echo ($row["id"]) ?>"
                  class="table__item__link">Eliminar</a>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="p-3 d-flex justify-content-center">
    <button type="button" class="btn btn-light text-success"><a href="../../../QuienVino/index.php">Volver al
        inicio</a></button>
  </div>
  <script src="../../../QuienVino/ABM/Profesor/JS/confirmDelete.js"></script>
</body>

</html>