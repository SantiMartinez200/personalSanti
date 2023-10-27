<?php
require("Calculo_Trait.php");
class Alumno extends Persona 
{
  Use Calculo;

  public static function insertAlumno($object)
  {
    $insertAlumn = ("INSERT INTO alumno (nombre, apellido, dni, fecha_nacimiento) VALUES ('$object->nombre','$object->apellido','$object->dni','$object->fechaNacimiento')");

    return $insertAlumn;
  }

  public static function listarAlumnos()
  {
    $listarAlumnos = ("SELECT * FROM alumno ORDER BY apellido ASC");
    return $listarAlumnos;
  }
  public static function listarAlumnosConAsistencias()
  {
    $listarQuery = ("SELECT ast.id,a.dni,a.nombre,a.apellido,ast.fecha_asistencia FROM (alumno AS a INNER JOIN asistencia as ast ON a.dni=ast.dni) ORDER BY a.apellido ASC, a.nombre, ast.fecha_asistencia");
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
  public static function updateAlumno($dniColocar, $nombre, $apellido, $dniOriginal, $fechaNacimiento)
  {
    $updateQuery = ("UPDATE alumno SET dni='$dniColocar', nombre = '$nombre', apellido = '$apellido', fecha_nacimiento = '$fechaNacimiento' WHERE dni = '$dniOriginal'");
    return $updateQuery;
  }
  public static function contarAsistencias()
  {
    $contarQuery = ("SELECT al.dni, al.nombre, al.apellido, COUNT(*) AS Asistencias FROM (asistencia AS a INNER JOIN alumno AS al ON al.dni=a.dni) GROUP BY  al.dni, al.nombre, al.apellido ORDER BY al.apellido ASC");
    return $contarQuery;
  }
  public static function insertarAsistencia($dni, $fecha)
  {
    $insertarAsistencia = ("INSERT INTO asistencia (id,dni,fecha_asistencia) VALUES (null,'$dni','$fecha')");
    return $insertarAsistencia;
  }
  public static function traerParametroAsistencias(){
    $diasQuery = ("SELECT dias_clases from parametros");
    return $diasQuery;
  }
  public static function obtenerEdad($fechaActual,$fechaNacimiento){
    $cortarFecha = substr($fechaNacimiento, -19, 4);
    $fechaInt = intval($cortarFecha);
    $cortarFechaActual = substr($fechaActual, -19, 4);
    $fechaIntActual = intval($cortarFechaActual);
    $edad = $fechaIntActual - $fechaInt;
    return $edad;
  }
  public static function verificarIngresoAsistencia($consultarDni, $trimmedDate)
  {
    $consultarAsistencia = ("SELECT * FROM alumno as al inner join asistencia as ac on al.dni=ac.dni WHERE ac.dni='$consultarDni' AND fecha_asistencia like '$trimmedDate%'");
    $conectarDB = new Conexion();
    $conectarDB->connect();
    $ejecutar = $conectarDB->ejecutar($consultarAsistencia); //traje la asistencia del alumno.
    $fetchRow = $ejecutar->fetch_all();
    
    if ($fetchRow == NULL) {
      return False;
    } else {
      return True;
    }
    //ahora vemos si existe una asistencia en la BD con la misma fecha de la asistencia que vamos a ingresar.

  }

  
}
?>