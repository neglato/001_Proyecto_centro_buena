<?php 
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
$idp=$_SESSION['idp'];
if($_POST['mensaje']==""){
    $_SESSION['msgcomment']=NOCOMM;
    header("Location: proyecto.php?idp=$idp&a=1");
    exit();
}
$comentario=$_POST['mensaje'];
if(!isset($_SESSION['user'])){
    if($_POST['user']==""){
    $_SESSION['msgcomment']=NONOMB;
    header("Location: proyecto.php?idp=$idp&a=1");
    exit();
    }else{
        $user=$_POST['user'];
    }
}else{
    $user=$_SESSION['nombre']." ".$_SESSION['apellidos'];
}
//una ve comprobado que tenemos los datos necesarios hacemos el insert en la tabla
$insert=consulta($conexion,"INSERT INTO comentarios (id_proyecto, usuario, comentario) 
                                    VALUES ('{$idp}', '{$user}', '{$comentario}')");
header("Location: proyecto.php?idp=$idp&a=1");
exit();
    