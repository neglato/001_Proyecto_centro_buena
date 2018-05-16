<?php 
    include('_include/funciones.php');
    include('_include/variables.php');
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
$email=$_SESSION['email'];
$ruta="_users/".$email."/";
$img="img.jpg";
if(file_exists($ruta.$img) == true){
    $imgact=$ruta.$img;
    $copia=$ruta."img2.jpg";
    copy ($imgact, $copia);
    }   
$uploadfile_temporal=$_FILES['fichero']['tmp_name']; 
$uploadfile_nombre=$ruta."img.jpg";
$_SESSION['msgfoto']=FOTSUB;

if (is_uploaded_file($uploadfile_temporal)){ 
    move_uploaded_file($uploadfile_temporal,$uploadfile_nombre);
    $_SESSION['msg']=FOTSUB;
    }else{ 
        $_SESSION['msgfoto']="Error"; 
    } 
header('Location: profile.php?ed=1&a=2');
mysqli_close($conexion);
exit();
?>