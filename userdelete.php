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
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    exit();
}
if(!isset($_POST['id_user'])){
    header('Location: cpaneladmin.php?rm=1&rt=3&a=3');
    exit();
}
if($_POST['id_user']!=""){
    $idu=$_POST['id_user'];
    include('_include/conexion.php');
    include('_include/funciones.php');
    $delete= consulta($conexion,"UPDATE usuarios SET
                                baja = 1 
                                where id_user='".$idu."'");
    $_SESSION['msgdel']=USERDELETED;
   header('Location: cpaneladmin.php?rm=1&rt=3&a=3');
    exit();
}