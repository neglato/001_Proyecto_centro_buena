<?php 
    include('_include/funciones.php');
include('_include/conexion.php');
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
    
$url=$_SERVER['REQUEST_URI'];
$url=substr($url,1);
$url=explode("/",$url);
$url=$url[1];
$_SESSION['url_anterior']=$url;
if($_POST['oldpass'] == "" or $_POST['newpass'] == "" or $_POST['confpass'] == ""){
    $_SESSION['msgpass']=NOPASS;
    header('Location: profile.php?ed=1&a=2');
    
}else{
    $id=$_SESSION['user'];
    $oldpass=md5($_POST['oldpass']);
    $newpass=md5($_POST['newpass']);
    $confpass=md5($_POST['confpass']);
    $pass=consulta($conexion,"SELECT * FROM usuarios where id_user like $id");
    $row=mysqli_fetch_array($pass);
    $password= $row['password'];
    if($password != $oldpass){
        $_SESSION['msgpass']=OLDPASSFAL;
        header('Location: profile.php?ed=1&a=2');
        exit();
    }else{
        if($newpass == md5($_SESSION['email'])){
        $_SESSION['msgpass']=PASSISMAIL;
        header('Location: profile.php?ed=1&a=2');
        exit();
    }else if ($newpass != $confpass){
            $_SESSION['msgpass']=CONFPASSFAL;
            header('Location: profile.php?ed=1&a=2');
            exit();
        }else{
            $_SESSION['msgpass']=CHPASS;
            $update=consulta($conexion,"UPDATE usuarios SET password='{$newpass}' where id_user like '{$id}'");
            header('Location: profile.php?ed=1&a=2');
            exit();
        }
    } 
    
}