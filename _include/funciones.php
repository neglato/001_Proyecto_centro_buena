<?php
   function esActivo($a,$activo){
    if($a==$activo){
        echo "class='activo'";
    }
   }
   function esActivo2($a,$activo){
    if($a==$activo){
        echo "activoico";
    }
   }
   function esActivo3($a,$activo){
    if($a==$activo){
        echo "class='activoico'";
    }
   }
    function consulta($conex, $select){
     
        $resultado= mysqli_query($conex, $select);
        return $resultado;
    }

    