<?php

include("../BD/conn.php");

include("../Clases/Parametro.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

  if (isset($_POST["1"]) && isset($_POST["2"]) && isset($_POST["3"]) && isset($_POST["4"])) {

    if (!empty($_POST["1"]) && !empty($_POST["2"]) && !empty($_POST["3"]) && !empty($_POST["4"])) {

      $clave_ajuste = 1;

      $dias_de_clase = $_POST["1"];

      $edad_minima = $_POST["2"];

      $promocion = $_POST["3"];

      $regular = $_POST["4"];

      if (($dias_de_clase < 0) || ($dias_de_clase > 365)) {

        echo "<script>alert('Ingrese una cantidad de días valida.');

          window.location='parametros.php'</script>";

      }

      if (($edad_minima < 0) || ($edad_minima > 120)) {

        echo "<script>alert('Ingrese una edad valida');

          window.location='parametros.php'</script>";

      }

      if (($regular > $promocion)) {

        echo "<script>alert('El promedio de la promoción no puede ser menor al del regular.');

            window.location='parametros.php'</script>";

      } elseif (($regular == $promocion)) {

        echo "<script>alert('El promedio de la promoción no puede ser igual al del regular.');

          window.location='parametros.php'</script>";

      } elseif(($promocion < 0) || ($regular < 0) || ($promocion > 100) || ($regular > 100)){
    echo "<script>alert('Revise el parametro de promoción o de regularidad.')</script>";
}else {

        $sql = Parametro::insertarParametro($clave_ajuste, $dias_de_clase, $edad_minima, $promocion, $regular);

        $conectarDB = new Conexion();

        $conectarDB->connect();

        $ejecutar = $conectarDB->ejecutar($sql);

        if ($ejecutar) {

          $conectarDB->killConn();

          echo "<script>alert('Se han cargado por primera vez los parámetros'); window.location='../Control/parametros.php'</script>";

        } else {

          $conectarDB->killConn();

          echo "<script>alert('Existió algún dato vacio'); window.location='../Control/parametros.php'</script>";

        }



      }

    } else {

      echo "<script>alert('No se pueden ingresar ceros.'); window.location='../Control/parametros.php'</script>";

    }

  } else {

    $conectarDB->killConn();

    echo "<script>alert('Existió un error desconocido en el formulario.'); window.location='../Control/parametros.php'</script>";

  }

}

?>