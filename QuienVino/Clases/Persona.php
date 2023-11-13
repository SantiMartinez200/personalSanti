<?php
Class Persona{
  public $dni;
  public $nombre;
  public $apellido;
  public $fechaNacimiento;

  public function __construct($nombre, $apellido, $dni, $fechaNacimiento)
  {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->dni = $dni;
    $this->fechaNacimiento = $fechaNacimiento;
  }
}

?>