<?php

include("../BD/conn.php");

include("../Clases/Parametro.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

  if (isset($_POST["1"]) && isset($_POST["2"]) && isset($_POST["3"]) && isset($_POST["4"])) {

    if (!empty($_POST["1"]) && !empty($_POST["2"]) && !empty($_POST["3"]) && !empty($_POST["4"])) {

      $conectarDB = new Conexion();

      $conectarDB->connect();

      $dias_de_clase = $_POST["1"];

      $edad_minima = $_POST["2"];

      $promocion = $_POST["3"];

      $regular = $_POST["4"];

        if (($dias_de_clase < 0) || ($dias_de_clase > 365)) {

          echo "<script>alert('Ingrese una cantidad de días valida.');

          window.location='parametros.php'</script>";

          $conectarDB->killConn();

        }

        if (($edad_minima < 0) || ($edad_minima > 120)) {

          echo "<script>alert('Ingrese una edad valida');

          window.location='parametros.php'</script>";

          $conectarDB->killConn();

        }

        if (($regular > $promocion)) {

          echo "<script>alert('El promedio de la promoción no puede ser menor al del regular.');

            window.location='parametros.php'</script>";

          $conectarDB->killConn();

        } elseif (($regular == $promocion)) {

          echo "<script>alert('El promedio de la promoción no puede ser igual al del regular.');

          window.location='parametros.php'</script>";

          $conectarDB->killConn();

        } elseif(($promocion > 100) || ($regular > 100) || ($regular < 0) || ($promocion < 0)){
    echo "<script>alert('Revise el parámetro de Promocion o Regularidad.'); window.location='../Control/parametros.php'</script>";
}else{

          $sql = Parametro::updateValues($dias_de_clase, $edad_minima, $promocion, $regular);

          $ejecutar = $conectarDB->ejecutar($sql);

          if ($ejecutar) {

            echo "<script>alert('Se han actualizado los parámetros'); window.location='../Control/parametros.php'</script>";

            $conectarDB->killConn();

          } else {

            echo "<script>alert('Existió algún vacio'); window.location='../Control/parametros.php'</script>";

            $conectarDB->killConn();

          }

        }

    }else{

      echo "<script>alert('No se pueden ingresar ceros.'); window.location='../Control/parametros.php'</script>";

    }

  } else {

    echo "<script>alert('Existió un error desconocido en el formulario.'); window.location='../Control/parametros.php'</script>";

  }

}

?>