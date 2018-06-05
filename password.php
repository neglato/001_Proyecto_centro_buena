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
    $oldpass=$_POST['oldpass'];
    $oldpass=$chorizo1.$oldpass.$chorizo2;
    $oldpass=md5($oldpass);
    $newpass=$_POST['newpass'];
    $newpass=$chorizo1.$newpass.$chorizo2;
    $newpass=md5($newpass);
    $confpass=$_POST['confpass'];
    $confpass=$chorizo1.$confpass.$chorizo2;
    $confpass=md5($confpass);
    $pass=consulta($conexion,"SELECT * FROM usuarios where id_user like $id");
    $row=mysqli_fetch_array($pass);
    $password= $row['password'];
    if($password != $oldpass){
        $_SESSION['msgpass']=OLDPASSFAL;
        header('Location: profile.php?ed=1&a=2');
        exit();
    }else{
        if($newpass == md5($chorizo1.$_SESSION['email'].$chorizo2)){
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