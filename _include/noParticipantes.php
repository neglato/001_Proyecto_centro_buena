<?php
include('variables.php');
    session_start();

if(isset($_SESSION['lang'])){
if($_SESSION['lang']==1){
    include('UK-uk.php'); 
    }else{
        include('ES-es.php');
        }
    }else{
      include('ES-es.php');
}  
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    exit();
}


    require_once('conexion.php');
    include('funciones.php');
    if(isset($_POST['q'])){
        $peticion= mysqli_query($conexion,"SELECT * 
                                            FROM usuarios 
                                            WHERE id_user not in (SELECT id_user
                                                                  FROM usuproy
                                                                  WHERE id_proyecto = {$_POST['q']})
                                            AND tipo = 2
                                            AND baja like 0");
        $totalfilas=mysqli_num_rows($peticion);
        if($totalfilas == 0){
            echo "<option value='-1' disabled>" . ALUMPAINS . "</option>";
            
        }else{
            while($fila= mysqli_fetch_array($peticion)){
                        $iduser= $fila['id_user'];
                        $nombre= $fila['nombre'];
                        $apell= $fila['apellidos'];
                        echo "<option value='{$iduser}'>{$nombre} {$apell}</option>";
        }
        }
    }