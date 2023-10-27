<?php
Class Asistencia{
  public static function deleteAsistencia($idEliminar){
    $deleteQuery = ("DELETE from asistencia WHERE id=$idEliminar");

    return $deleteQuery;
  }
}

?>