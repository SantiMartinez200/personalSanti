<?php
Class Profesor extends Persona{
  public $titulo;
  
  public Function __construct($nombre, $apellido, $dni, $fechaNacimiento, $titulo){
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->dni = $dni;
    $this->fechaNacimiento = $fechaNacimiento;
    $this->titulo = $titulo;
  }
}

?>