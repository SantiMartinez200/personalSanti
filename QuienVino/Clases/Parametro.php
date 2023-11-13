<?php
Class Parametro{

  public static function insertarParametro($clave_ajuste, $dias_clases, $edad_minima, $promocion, $regularidad, $tolerancia, $horario_fijo)
  {
    $queryInsertar = ("INSERT INTO parametros SET clave_ajuste=$clave_ajuste,dias_clases=$dias_clases,promedio_promocion=$promocion,promedio_regularidad=$regularidad,edad_minima=$edad_minima,tolerancia='$tolerancia',horario_fijo='$horario_fijo'");
    return $queryInsertar;
  }
  public static function traerParametros(){
    $queryParametros = ("SELECT * FROM parametros");
    return $queryParametros;
  }

  public static function updateValues($dias_clases,$edad_minima,$promocion,$regularidad,$tolerancia,$horario_fijo){
    $queryEditar = ("UPDATE parametros SET dias_clases='$dias_clases', edad_minima='$edad_minima',promedio_promocion='$promocion',promedio_regularidad='$regularidad',tolerancia='$tolerancia',horario_fijo='$horario_fijo' WHERE clave_ajuste='1'");
    return $queryEditar;
  }

  public static function deleteParametros($codigo){
    $delete = ("DELETE FROM parametros WHERE clave_ajuste = '$codigo'");
    return $delete;
  }

  
}

?>