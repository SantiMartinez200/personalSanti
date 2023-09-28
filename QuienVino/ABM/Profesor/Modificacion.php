<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Profesor</title>
  <link rel="stylesheet" href="../../../QuienVino/ABM/Profesor/CSS/styleABMProfesor.css">
  <link rel="stylesheet" href="../../../QuienVino/Resources/css/bootstrap.min.css" />
</head>

<body>
  <?php
  if (!$_POST) { ?>
    <div class="p-3 mb-2 bg-light text-dark">
      <h1 class="h1title">Actualización de registros.</h1>
    </div>
    <?php
    $dni = $_GET["dni"];
    //echo ($dni);
    $traerDatos = "SELECT * FROM profesor WHERE dni_profesor='$dni'";
    include("../../../QuienVino/BD/conn.php");
    $database = Conexion::connect();
    $resultadoDatos = mysqli_query($database, $traerDatos);
    ?>
    <div class="container col-10">
      <div id="textContainer" class="d-flex justify-content-center p-3 mb-2 bg-success text-white rounded">
        <h2 class="container__title">Modificar Profesor</h2>
      </div>
      <form class="form text-center p-3 mb-2 bg-light text-black col-12" action="../Profesor/Modificacion.php"
        method="POST">
        <?php while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
          <div class="row d-flex justify-content-center p-3">
            <label hidden for="" class="container__label">DNI:</label>
            <div class="p-3"><input type="hidden" class="container__input" name="dniToCatch"
                value="<?php print($row["dni_profesor"]); ?>"></div>
            <div class="col d-flex p-3"><label for="" class="p-2">Nombre:</label><input type="text" class="container__input"
                name="nombre" value="<?php print($row["nombre"]); ?>"></div>
            <div class="col d-flex p-3"><label for="" class="p-2">Apellido:</label><input type="text"
                class="container__input" name="apellido" value="<?php print($row["apellido"]); ?> "></div>
            <div class="col d-flex p-3"><label for="" class="p-2">Fecha de nacimiento:</label><input type="date"
                class="container__input" name="fechaNacimiento"
                value="<?php echo date("Y-m-d", strtotime($row['fecha_nacimiento'])); ?>"></div>
            <div class="col d-flex p-3"><label for="" class="p-2">Título:</label><input type="text" class="container__input"
                name="titulo" value="<?php print($row["titulo"]); ?> "></div>
          </div>
        <?php }
        mysqli_free_result($resultadoDatos);
        ?>
        <input type="submit" value="Modificar Profesor" class="btn btn-outline-success">
      </form>
    </div>
    <?php
  } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caughtDNIProffesor = $_POST["dniToCatch"];
    $caughtNameProffesor = $_POST["nombre"];
    $caughtSurnameProffesor = $_POST["apellido"];
    $caughtTitulationProffesor = $_POST["titulo"];
    $cuaghtDateProffesor = $_POST["fechaNacimiento"];
    //echo $caughtDNI;
    $updateData = "UPDATE profesor SET nombre='$caughtNameProffesor', apellido='$caughtSurnameProffesor', fecha_nacimiento='$cuaghtDateProffesor', titulo='$caughtTitulationProffesor' WHERE dni_profesor='$caughtDNIProffesor'";
    include("../../../QuienVino/BD/conn.php");
    $database = Conexion::connect();
    $resultadoDatos = mysqli_query($database, $updateData);
    if ($resultadoDatos) {
      echo "<script>alert('Profesor actualizado correctamente.'); window.location='../Profesor/ABM_Profesor.php'</script>";
    } else {
      echo "<script>alert('Hubo un error al actualizar los datos...'); window.location='../Profesor/ABM_Profesor.php'</script>";
    }

  }

  ?>
  <div class="d-flex justify-content-center">
    <div class="p-3">
      <button type="button" class="btn btn-light"><a href="../../../QuienVino/index.php">Volver al
          inicio</a></button>
    </div>
    <div class="p-3">
      <button type="button" class="btn btn-light"><a href="../../ABM/Profesor/ABM_Profesor.php">Volver a los
          registros.
        </a></button>
    </div>
  </div>
</body>

</html>