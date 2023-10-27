<?php
class Conexion
{
  private $host = "localhost";
  private $contrasena = "";
  private $bd = "sistemaasistencia";
  private $usuario = "root";

  private $conn;
  public  function __construct()
  {
    $this->conn = new mysqli($this->host, $this->usuario, $this->contrasena, $this->bd);
    if (mysqli_connect_errno()) {
      echo "<p hidden>Falló la conexion</p>";
    } else {
      echo "<p hidden>conexión exitosa</p>";
    }
  }
  public function connect(){
    $this->conn;
  }

   public function killConn() {
        $this->conn->close();
    }

  public function ejecutar($consulta)
  {
    return $this->conn->query($consulta);
  }

}

// Function desconectar mysqli_close($this->$mysql);




//print_r(Conexion::connect());

?>