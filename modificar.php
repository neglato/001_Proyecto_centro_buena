<?php
    include('_include/variables.php');
    include('_include/funciones.php');
    include('_include/conexion.php');
    session_start();
    if (!isset($_SESSION['user'])){
        header('Location: index.php');
    }
$nombre=htmlentities($_POST['nombre']);
$apellidos=htmlentities($_POST['apellidos']);
$email=htmlentities($_POST['correo']);
$sexo=htmlentities($_POST['genero']);
if($sexo != 0 && $sexo !=1){
    $sexo=0;
}
$id=$_SESSION['user'];
$_SESSION['nombre']=$nombre;
$update=consulta($conexion,"UPDATE usuarios SET nombre='{$nombre}', apellidos='{$apellidos}',sexo='{$sexo}', email='{$email}' where id_user like '{$id}' and baja like 0");
if($_SESSION['email'] != $email){
    rename('_users/'.$_SESSION['email'],'_users/'.$email);
    $_SESSION['email']=$email;
}
header('Location: profile.php?a=2');
exit();
    
