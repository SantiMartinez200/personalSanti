<?php
Class Parametro{

  public static function insertarParametro($clave_ajuste, $dias_clases, $edad_minima, $promocion, $regularidad)
  {
    $queryInsertar = ("INSERT INTO parametros SET clave_ajuste=$clave_ajuste,dias_clases=$dias_clases,promedio_promocion=$promocion,promedio_regularidad=$regularidad,edad_minima=$edad_minima");
    return $queryInsertar;
  }
  public static function traerParametros(){
    $queryParametros = ("SELECT * FROM parametros");
    return $queryParametros;
  }

  public static function updateValues($dias_clases,$edad_minima,$promocion,$regularidad){
    $queryEditar = ("UPDATE parametros SET dias_clases='$dias_clases', edad_minima='$edad_minima',promedio_promocion='$promocion',promedio_regularidad='$regularidad' WHERE clave_ajuste='1'");
    return $queryEditar;
  }

  
}

?>