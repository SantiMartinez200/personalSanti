<?php
class Alumno extends Persona
{

  public function insertAlumno()
  {
    $constulta = ("INSERT INTO alumno (nombre, apellido, dni, fecha_nacimiento) VALUES ('$this->nombre','$this->apellido','$this->dni','$this->fechaNacimiento')");
    return $constulta;
  }
  public static function listarAlumnos()
  {
    $listarQuery = ("SELECT * FROM alumno");
    return $listarQuery;
  }
  public static function deleteAlumno($dni)
  {
    $deleteQuery = ("DELETE FROM alumno WHERE dni = '$dni'");
    return $deleteQuery;
  }
  public static function getAlumno($dni)
  {
    $getQuery = ("SELECT * FROM alumno WHERE dni = '$dni'");
    return $getQuery;
  }
  public static function updateAlumno($nombre, $apellido, $dni, $fechaNacimiento)
  {
    $updateQuery = ("UPDATE alumno SET nombre = '$nombre', apellido = '$apellido', dni = '$dni', fecha_nac = '$fechaNacimiento' WHERE dni_alumno = '$dni'");
    return $updateQuery;
  }
  public static function contarAsistencias()
  {
    $contarQuery = ("SELECT COUNT(*) FROM alumnos as a INNER JOIN asistencias as asis on a.dni=asis.dni");
    return $contarQuery;
  }

  public static function contarAsistenciasEspecifico($dni)
  {
    $contarEspecificoQuery = ("SELECT COUNT(*) FROM alumnos as a INNER JOIN asistencias as asis on a.dni=asis.dni WHERE a.dni='$dni'");
    return $contarEspecificoQuery;
  }

  public static function insertarAsistencia($dni, $fecha)
  {
    $insertarAsistencia = ("INSERT INTO asistencia (id,dni,fecha_asistencia) VALUES (null,'$dni','$fecha')");
    return $insertarAsistencia;
  }
}
?>