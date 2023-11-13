<?php

include("../BD/conn.php");

include("../Clases/Parametro.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

  if (isset($_POST["1"]) && isset($_POST["2"]) && isset($_POST["3"]) && isset($_POST["4"]) && isset($_POST["5"]) && isset($_POST["6"])) {

    if (!empty($_POST["1"]) && !empty($_POST["2"]) && !empty($_POST["3"]) && !empty($_POST["4"]) && !empty($_POST["5"]) && !empty($_POST["6"])) {

      $conectarDB = new Conexion();

      $conectarDB->connect();

      $dias_de_clase = $_POST["1"];

      $edad_minima = $_POST["2"];

      $promocion = $_POST["3"];

      $regular = $_POST["4"];

      $tolerancia = $_POST["5"];

      $horario_fijo = strtotime($_POST["6"]);

      echo $tolerancia;
      echo "<br>";
      echo $horario_fijo;
      

      if (($dias_de_clase < 0) || ($dias_de_clase > 365)) {

        echo "<script>

          window.location='parametros.php?err=4'
          
          </script>";

        $conectarDB->killConn();

      }

      if (($edad_minima < 0) || ($edad_minima > 120)) {

        echo "<script>

          window.location='parametros.php?err=4'
          
          </script>";

        $conectarDB->killConn();

      }


      if (($tolerancia <= 0 || $tolerancia > 60)) {

        echo "<script>

        window.location='parametros.php?err=toleranceHigher'
        
        </script>";

        $conectarDB->killConn();

      }

      if (($regular > $promocion)) {

        echo "<script>

            window.location='parametros.php?err=1'
            
            </script>";

        $conectarDB->killConn();

      } elseif (($regular == $promocion)) {

        echo "<script>

          window.location='parametros.php?err=2'
          
          </script>";

        $conectarDB->killConn();

      } elseif (($promocion > 100) || ($regular > 100) || ($regular < 0) || ($promocion < 0)) {
        echo "<script>
        window.location='parametros.php?err=4'
        </script>";
      } else {

        $sql = Parametro::updateValues($dias_de_clase, $edad_minima, $promocion, $regular,$_POST["5"],$_POST["6"]);

        $ejecutar = $conectarDB->ejecutar($sql);

        if ($ejecutar) {

          echo "<script>
          window.location='../Control/parametros.php?err=success'
          </script>";

          $conectarDB->killConn();

        } else {

          echo "<script>
          window.location='../Control/parametros.php?err=5'
          </script>";

          $conectarDB->killConn();

        }

      }

    } else {

      echo "<script>
      window.location='../Control/parametros.php?err=zero'
      </script>";

    }

  } else {

    echo "<script>
    window.location='../Control/parametros.php?err=unknown'
    </script>";

  }

}

?>