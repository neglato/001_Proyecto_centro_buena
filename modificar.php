<?php
    include('_include/funciones.php');
    include('_include/conexion.php');
    include('_include/variables.php');
    session_start();
    if (!isset($_SESSION['user'])){
        header('Location: index.php');
    }
$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$email=$_POST['correo'];
$sexo=$_POST['genero'];
$id=$_SESSION['user'];
$_SESSION['nombre']=$nombre;
$update=consulta($conexion,"UPDATE usuarios SET nombre='{$nombre}', apellidos='{$apellidos}',sexo='{$sexo}', email='{$email}' where id_user like '{$id}' and baja like 0");
if($_SESSION['email'] != $email){
    rename('_users/'.$_SESSION['email'],'_users/'.$email);
    $_SESSION['email']=$email;
}
header('Location: profile.php?a=2');
exit();
    
