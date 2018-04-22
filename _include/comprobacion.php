<?php
require_once('conexion.php');
include('funciones.php');
    $e= $_POST['e'];
    $d="_";
/*separamos la variable en un array pasando como delimitador _*/
$array=explode($d, $e);
/*guardamos la posicion 0 que es el email*/
$e=$array[0];
/*guardamos la pasicion 1 que es la password*/
$p=$array[1];
    
    $peticion= mysqli_query($conexion,"SELECT email, password FROM usuarios WHERE email = '{$e}'");
    $totalfilas= mysqli_num_rows($peticion);
    if($totalfilas==0){
        echo "No existe el usuario";
    }else{
        while($row= mysqli_fetch_array($peticion)){
        if($p!=$row['password']){
            echo "Contraseña incorrecta";
        }else{
            
        }
        }
       }

