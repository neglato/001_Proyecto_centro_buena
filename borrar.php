<?php 
    include('_include/funciones.php');
    session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    exit();
}
    if(isset($_SESSION['lang'])){
        if($_SESSION['lang']==1){
            include('_include/UK-uk.php'); 
        }else{
            include('_include/ES-es.php');
            }
    }else{
        include('_include/ES-es.php');
        }
$email=$_SESSION['email'];
$ruta="_users/".$email."/";
$img="img.jpg";
if(file_exists($ruta.$img) == true){
    $imgact=$ruta.$img;
    $copia=$ruta."img2.jpg";
    copy ($imgact, $copia);
    unlink($imgact);
    $_SESSION['msgfoto']=FOTBOR;
}else if(file_exists($ruta.$img) == false){
    $_SESSION['msgfoto']=FOTAFK;
}
header('Location: profile.php?ed=1&a=2');
mysqli_close($conexion);
exit();