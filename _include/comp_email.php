<?php
    require_once('conexion.php');
    require_once('funciones.php');
    if(isset($_POST['q'])){
    
        $peticion="SELECT * FROM usuarios WHERE email = '{$_POST['q']}'";
        $resultado= mysqli_query($conexion, $peticion);

        $fila=mysqli_fetch_array($resultado);
        echo count($fila);
       
    }

mysqli_close($conexion);
?>