<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alta de Profesor</title>
  <link rel="stylesheet" href="../../QuienVino/Resources/css/bootstrap.min.css" />
</head>

<body>
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["dniProfesor"]) || isset($_POST["nombre"]) || isset($_POST["apellido"]) || isset($_POST["fechaNacimiento"])) {
      if (!empty($_POST["dniProfesor"]) && !empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["fechaNacimiento"])) {
        /*echo ($_POST["dni"]);
        echo ($_POST["nombre"]);
        echo ($_POST["apellido"]);
        echo ($_POST["fechaNacimiento"]);
        echo "recibido";*/
        $nombreInsertar = $_POST["nombre"];
        $apellidoInsertar = $_POST["apellido"];
        $dniInsertar = $_POST["dniProfesor"];
        $fechaNacimientoInsertar = $_POST["fechaNacimiento"];
        $titulacionInsertar = $_POST["titulacion"];
        include("../../../QuienVino/BD/conn.php");
        $database = Conexion::connect();
        $queryInsert = "INSERT INTO profesor (dni_profesor,nombre,apellido,fecha_nacimiento,titulo) VALUES('$dniInsertar', '$nombreInsertar', '$apellidoInsertar', '$fechaNacimientoInsertar','$titulacionInsertar');";

        try {
          $result = mysqli_query($database, $queryInsert);
        } catch (mysqli_sql_exception $e) {
          if (str_contains($e, 'Duplicate entry')) {
            echo "<script>alert('El DNI ya existe.');
                  window.location='../Profesor/ABM_Profesor.php'</script>";
          }
          die("Error inserting user details into database: " . $e->getMessage());
        }
        echo "<script>alert('Datos cargados con éxito');
              window.location='../Profesor/ABM_Profesor.php'</script>";
        /*$myQuery->bindParam(":dni", $dniInsertar);
        $myQuery->bindParam(":nombre", $nombreInsertar);
        $myQuery->bindParam(":apellido", $apellidoInsertar);
        $myQuery->bindParam(":fecha_nacimiento", $fechaNacimientoInsertar);*/
        /*if ($database->errno == 1062) {
          echo "<script>alert('sos boludo?');
              window.location='../Alumno/ABM_Alumno.php'</script>";
        } else {
        }*/
      } else {
        echo "<script>alert('Existió algún vacio'); window.location='../Profesor/ABM_Profesor.php'</script>";
      }

      ?>
      <?php
    }
  }
  ?>
</body>

</html>