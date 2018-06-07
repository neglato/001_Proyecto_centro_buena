<?php
    include('_include/variables.php');
    include('_include/funciones.php');
    include('_include/conexion.php');
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
if(!isset($_POST['comentario'])){
    header('Location: index.php');
        exit();
}
$idc=htmlentities($_POST['comentario']);
$idp=htmlentities($_POST['proyecto']);
/*comprobamos que exista el registro, si no existe no hacemos nada*/
$compCom=consulta($conexion,"SELECT * FROM comentarios WHERE id_comentario like $idc");
$siNo=mysqli_num_rows($compCom);
if($siNo == 0){
    header("Location: cpaneladmin.php?a=3&rm=4&rt=2&idp=$idp");
    exit();
    mysql_close($conexion);
}
/*vamos a eliminar el comentario seleccionado y mostrar un mensaje*/
$deleteCom=consulta($conexion,"DELETE FROM comentarios where id_comentario like $idc");
$_SESSION['msgdeletecom']=DELYES;
/*lo devolvemos a eliminar comentarios al proyecto seleccionado*/
header("Location: cpaneladmin.php?a=3&rm=4&rt=2&idp=$idp");
exit();
mysql_close($conexion);