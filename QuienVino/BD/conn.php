<?php
class Conexion
{
  public static function connect()
  {
    $mysql = new mysqli('localhost','root','','sistemaasistencia');
    $mysql->set_charset('utf8');

    if (mysqli_connect_errno()){
      echo "<p hidden>Falló la conexion</p>";
    }else{
      echo "<p hidden>conexión exitosa</p>";
    }
    return $mysql;
  }
}

// Function desconectar mysqli_close($this->$mysql);




//print_r(Conexion::connect());

?>