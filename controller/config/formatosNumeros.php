<?php
    function formatoNumero($cadena){
        $arreglo = str_split($cadena);
        $cadenaFinal = "";
        $multiploTres = 0;
        for($x=count($arreglo)-1;$x>=0;$x--){
            $cadenaFinal = $cadenaFinal.$arreglo[$x];
            $multiploTres++;
            if($multiploTres == 3 && $x!=0){
                $cadenaFinal = $cadenaFinal.",";
                $multiploTres = 0;
            }
        }
        $cadenaFinal = strrev($cadenaFinal);
        return $cadenaFinal;
    }
?>