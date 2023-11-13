<?php
require("../BD/conn.php");
require("../Clases/Parametro.php");
?>
<!DOCTYPE html>
<html lang="en">
<!--  COUNT DE LAS ASISTENCIAS, HACER EL NUMERO PARAMETRIZABLE
Menú Configuración, que aparezca DIAS DE CLASE, guardarlos en la base de datos, comparamos porcentaje con el valor cargado y el valor de las asistencias. -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Parámetros</title>
  <link rel="stylesheet" href="../Resources/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../styleIndex.css">
  <link rel="stylesheet" href="../Resources/css/sweetalert2.min.css">
</head>

<body>

  <script src="../Resources/js/sweetalert2.all.min.js"></script>
  <script src="./JS/deleteParametros.js"></script>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <a href="../index.php">
        <div class="redondo">
          <img src="../Multimedia/logo2.png" class="logo">
        </div>
      </a>
      <div class="d-flex justify-content-end">
        <h1 class="text-light"><b>Parámetros de control</b></h1>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <ul class="navbar-nav">
          <li class="nav-item dropdown text-light">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Asistencias</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-dark" href="./listarAsistencias.php">Listar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="./contarAsistencias.php">Contar asistencias</a></li>
              <li><a class="dropdown-item text-dark" href="./asistenciasTardiasIndex.php">Asistencias tardías</a></li>
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
              <li><a class="dropdown-item text-dark" href="../Reportes/diario.php">Reporte de asistencias</a>
              </li>
              <li><a class="dropdown-item text-dark" href="../Reportes/promocionados.php">Reporte de
                  promocionados</a></li>
              <li><a class="dropdown-item text-dark" href="../Reportes/regulares.php">Reporte de
                  regulares</a></li>
              <li><a class="dropdown-item text-dark" href="../Reportes/libres.php">Reporte de libres</a>
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
          <li><a class="dropdown-item text-dark" href="./parametros.php">Parámetros</a></li>
          <!-- <li><a class="dropdown-item text-dark" href="../../../QuienVino/Control/logOut.php">Cerrar Sesión</a></li> -->
        </ul>
      </div>
    </div>
  </nav>

  <?php
  $conectarDB = new Conexion();
  $conectarDB->connect();
  $sql = Parametro::traerParametros();
  $ejecutar = $conectarDB->ejecutar($sql);
  $listadoParametros = $ejecutar->fetch_object();
  $listado2 = $ejecutar->fetch_all();
  if ($listadoParametros <> NULL) {
    ?>
    <div class="container d-flex justify-content-center align-items-center w-75 bg-light text-center mt-5 rounded p-2">
      <form action="./actualizarParametros.php" class="form-control rounded  p-3" method="POST">
        <div class="row">
          <div class="bg-primary">
            <h2 class="form_control bg-primary text-light"><b>Parametros</b></h2>
          </div>
        </div>
        <div class="container d-flex justify-content-center">
          <div class="w-50 row">
            <div class="row">
              <label for="diasClases">
                <h4>Dias de clase</h4>
              </label>
              <input id="diasClases" type="number" class="form-control-lg text-center" name="1"
                value="<?php print($listadoParametros->dias_clases); ?>">
            </div>
            <div class="row">
              <label for="promedioPromocion">
                <h4>Promedio para promocionar</h4>
              </label>
              <input id="promedioPromocion" type="number" class="form-control-lg text-center" name="3"
                value="<?php print($listadoParametros->promedio_promocion); ?>">
            </div>
            <div class="row">
              <label for="promedioRegularidad">
                <h4>Promedio para regularizar</h4>
              </label>
              <input id="promedioRegularidad" type="number" class="form-control-lg text-center" name="4"
                value="<?php print($listadoParametros->promedio_regularidad); ?>">
            </div>
            <div class="row">
              <label for="edadRegistro">
                <h4>Edad mínima para registro</h4>
              </label>
              <input id="edadRegistro" type="number" class="form-control-lg text-center" name="2"
                value="<?php print($listadoParametros->edad_minima); ?>">
            </div>
            <div class="row">
              <label for="tolerancia">
                <h4>Tolerancia</h4>
              </label>
              <input id="tolerancia" type="number" class="form-control-lg text-center" name="5"
                value="<?php print($listadoParametros->tolerancia); ?>">
            </div>
            <div class="container d-flex justify-content-center">
              <div class="row">
                <div class="col-md-12 text-center mt-3">

                </div>
                <div class="col-md-12 text-center mt-3">
                  <label for="horario">
                    <h4>Horario de clases</h4>
                  </label>
                  <input id="horario" type="time" class="form-control-lg text-center" name="6"
                    value="<?php print($listadoParametros->horario_fijo); ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <input type="submit" class="btn btn-primary mt-5" value="Aplicar cambios">
          <a onclick="alerta_eliminar(<?php echo ($listadoParametros->clave_ajuste) ?>)"
            class="btn btn-danger mt-5">Eliminar TODOS los parámetros</a>
      </form>
    </div>
    </div>
    </div>
    </div>
    <?php
  } else {
    ?>
    <div class="container d-flex justify-content-center align-items-center w-75 bg-light text-center mt-5 rounded p-2">

      <form action="./insertarParametros.php" class="form-control rounded  p-3" method="POST">
        <div class="row">
          <h2 class="form_control bg-primary text-light"><b>Cargue los parámetros en la base de datos.</b>
            <h2>
        </div>
        <div class="container d-flex justify-content-center">
          <div class="w-50 row">
            <div class="row">
              <label for="diasClases">
                <h4>Dias de clase</h4>
              </label>
              <input id="diasClases" type="number" class="form-control-lg text-center" name="1">
            </div>
            <div class="row">
              <label for="promedioPromocion">
                <h4>Promedio para promocionar</h4>
              </label>
              <input id="promedioPromocion" type="number" class="form-control-lg text-center" name="3">
            </div>
            <div class="row">
              <label for="promedioRegularidad">
                <h4>Promedio para regularizar</h4>
              </label>
              <input id="promedioRegularidad" type="number" class="form-control-lg text-center" name="4">
            </div>
            <div class="row">
              <label for="edadRegistro">
                <h4>Edad mínima para registro</h4>
              </label>
              <input id="edadRegistro" type="number" class="form-control-lg text-center" name="2">
            </div>
            <div class="row">
              <label for="tolerancia">
                <h4>Tolerancia</h4>
              </label>
              <input id="tolerancia" type="number" class="form-control-lg text-center" name="5">
            </div>
            <div class="container d-flex justify-content-center">
              <div class="row text-center">
                <div class="col-md-12 text-center mt-3">

                </div>
                <div class="col-md-12 text-center mt-3">
                  <label for="horario">
                    <h4>Horario de clases</h4>
                  </label>
                  <input id="horario" type="time" class="form-control-lg text-center" name="6">
                </div>
              </div>
            </div>
            <div>
              <input type="submit" class="btn btn-primary mt-5" value="Cargar Parametros">

            </div>
          </div>
        </div>
      </form>
    </div>
    <?php
  }
  ?>

  <style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }
  </style>
  <script src="./JS/deleteParametros.js"></script>
</body>
<?php
if (isset($_GET["err"])) {
  if (!empty($_GET["err"])) {
    switch ($_GET["err"]) {
      case 'zero':
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Ingresaste algún campo vacío',
                          'Completa todos los campos',
                          'info',
                        )};
                         fireSweetAlert();
                        </script>
                        ";
        break;
      /*case 'sameTime':
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Error en la definición de datos.',
                          'Los horarios no pueden ser iguales.',
                          'error',
                        )};
                         fireSweetAlert();
                        </script>
                        ";
        break;*/
      case 'toleranceHigher':
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Error en la definición de datos',
                          'Los minutos de tolerancia no pueden ser iguales a 0 o mayores a 60.',
                          'error',
                        )};
                         fireSweetAlert();
                        </script>
                        ";
        break;
      case 1:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Error en la definición de datos.',
                          'El promedio regular no puede ser mayor al de promoción.',
                          'error',
                        )};
                         fireSweetAlert();
                        </script>
                        ";
        break;
      case 2:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Error en la definición de datos.',
                          'Los promedios no pueden ser iguales.',
                          'error',
                        )};
                        fireSweetAlert();
                        </script>
                        ";
        break;
      case 4:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Los campos no son correctos.',
                          'Posibles errores: Valores muy largos, cortos o inválidos (negativos)',
                          'info',
                        )};
                         fireSweetAlert();
                        </script>
                        ";
        break;
      case 5:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Ocurrió un error en la consulta de actualización.',
                          '',
                          'info',
                        )};
                        </script>
                        ";
        break;
      case 'success':
        echo "<script>
                              const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Parámetros modificados con éxito.'
})  

                            </script>";
        break;
      case 'deleted':
        echo "<script>
                              const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Parámetros eliminados.'
})  

                            </script>";
        break;
      case 'unknown':
        echo "<script>
                              const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'error',
  title: 'Error en el envío de datos.'
})  

                            </script>";
        break;
      case "noParams":
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'No tiene parámetros definidos.',
                          'Defina los parámetros del sistema para que funcione correctamente.',
                          'info',
                        )};
                        fireSweetAlert();</script>
                        ";
    
        break;

      default:
        echo "<script>function fireSweetAlert(){
                        Swal.fire(
                          'Ocurrió algún error desconocido.',
                          '',
                          'info',
                        )};
                        </script>
                        ";
        break;
    }
  }
}

?>
<script src="../Resources/js/bootstrap.bundle.min.js"></script>


</html>