<?php
     session_start();
    include('_include/variables.php');
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
if(!isset($_POST['id_curso'])){
    header('Location: cpaneladmin.php?rm=2&rt=3&a=3');
    exit();
}
if($_POST['id_curso']!=""){
    include('_include/conexion.php');
    include('_include/funciones.php');
    $cid=$_POST['id_curso'];
    /*recuperamos sus datos*/
    $curso=consulta($conexion, "SELECT * from cursos where id_curso like $cid");
    $info=mysqli_fetch_array($curso);
    $nomCurso=$info['curso'];
    $delete= consulta($conexion,"DELETE FROM cursos where id_curso like $cid");
    $_SESSION['msgdelcour']=COURDELETED;
    /*borramos su carpeta*/
     $home="_cursos/$nomCurso";
    rmdir($home);
   header('Location: cpaneladmin.php?rm=2&rt=3&a=3');
    mysqli_close($conexion);
    exit();
}