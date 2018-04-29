<?php
session_start();
    if(isset($_SESSION['lang'])){
        if($_SESSION['lang']==1){
            include('_include/UK-uk.php'); 
        }else{
            include('_include/ES-es.php');
            }
    }else{
        include('_include/ES-es.php');
        }
    if (!isset($_SESSION['user'])){
        header('Location: index.php');
        exit();
    }
    if(!isset($_POST['id_proy'])){
        header('Location: cpaneladmin.php?rm=3&rt=3a=3');
        exit();
    }
if($_POST['id_proy']!=-1){
    include('_include/conexion.php');
    include('_include/funciones.php');
    /*hacemos el update del campo mostrar poniendolo a 0*/
    $pid=$_POST['id_proy'];
    $UPDATE = consulta($conexion,"UPDATE proyectos SET 
                                                    mostrar ='0'
                                                    WHERE id_proyecto like $pid");
    $_SESSION['msgproydel']=DESPUB;
    header('Location: cpaneladmin.php?rm=3&rt=3a=3');
    mysqli_close($conexion);
    exit(); 
}else{
    $_SESSION['msgproydel']=DEBCHO;
    header('Location: cpaneladmin.php?rm=3&rt=3a=3');
    mysqli_close($conexion);
    exit(); 
}