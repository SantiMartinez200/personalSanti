<?php
trait Calculo {
    public static function calcularSituacion($porcentaje,$nota1,$nota2){
        $porcentajeNotas = ($nota1 + $nota2) / 2;
        
        if (($porcentaje >= 80)&&($porcentajeNotas >= 8)){
            $palabra = "Es promocion" ;
        }elseif((($porcentaje <= 80)&&($porcentaje >= 50))&&($porcentajeNotas >= 6)){
            $palabra = "Es regular" ;
        }elseif(($porcentaje < 50)||($porcentajeNotas<6)){
            $palabra = "Es libre" ;
        }else{
            echo "a";
        }
        return $palabra;
    }
}

?>