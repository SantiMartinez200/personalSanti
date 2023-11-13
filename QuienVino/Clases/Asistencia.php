<?php
Class Asistencia{
  public static function deleteAsistencia($idEliminar){
    $deleteQuery = ("DELETE from asistencia WHERE id=$idEliminar");

    return $deleteQuery;
  }

  public static function calendarioAsistencia($fecha){
    //ID de Asistencia	DNI	Apellido	Nombre	Fecha y Hora
    $calendarQuery = ("SELECT a.id, al.dni, al.nombre, al.apellido, a.fecha_asistencia FROM asistencia as a inner join alumno as al on a.dni=al.dni WHERE fecha_asistencia LIKE '$fecha%'");
    return $calendarQuery;
  }

  public static function llegaTarde($time, $horaResultante){
    if ($time <= $horaResultante){
      return false;
    }elseif($time > $horaResultante){
      return true;
    }
  }
  
}

?>