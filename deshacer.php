<?php 
    include('_include/variables.php');
    include('_include/funciones.php');
    session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}else{
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
    $img2="img2.jpg";
    $img="img.jpg";
    if(file_exists($ruta.$img2) == true){
            $imgant=$ruta.$img2;
            $imgor=$ruta.$img;
            copy($imgant, $imgor );
            $_SESSION['msgfoto']=RESCOR;
            header('Location: profile.php?ed=1&a=2');
        }else{
        $_SESSION['msgfoto']=NOFOT;
        header('Location: profile.php?ed=1&a=2');
        
    }
}