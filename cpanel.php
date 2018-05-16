<!DOCTYPE html>
<?php
session_start();
include('_include/variables.php');
include('_include/conexion.php');
include('_include/funciones.php');
if(!isset($_SESSION['user'])){
     header('Location: index.php');
}
    $USER = $_SESSION['user']; 
    $RESULTADO = consulta($conexion,"SELECT * FROM usuarios WHERE id_user like $USER");

    $info = mysqli_fetch_array($RESULTADO);
mysqli_close($conexion);
switch ($info['tipo']){
    case 0:
        header('Location: cpaneladmin.php?a=3');
        break;
    case 1:
        header('Location: cpanelprofe.php?a=3');
        break;
    case 2:
        header('Location: cpanelalum.php?a=3');
        break;
    case "*":
        header('Location: index.php?a=1');
        break;
}
