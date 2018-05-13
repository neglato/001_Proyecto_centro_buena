<?php
ob_start();
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
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    exit();
}
if(!isset($_POST['id_user'])){
    header('Location: cpaneladmin.php?rm=1&rt=3&a=3');
    exit();
}
if($_POST['id_user']!=""){
    $idu=$_POST['id_user'];
    include('_include/conexion.php');
    include('_include/funciones.php');
    //Buscamos el email del usuario, para poder notificarle la baja
    $emailuser=consulta($conexion,"select email from usuarios where id_user like $idu");
    $fila=mysqli_fetch_array($emailuser);
    $email=$fila['email'];
    $delete= consulta($conexion,"UPDATE usuarios SET
                                baja = 1 
                                where id_user='".$idu."'");
    $_SESSION['msgdel']=USERDELETED;
    //Enviamos un correo indicando la baja
    //Load composer's autoloader
require_once('_include/PHPMailerAutoload.php'); 

$mail = new PHPMailer(true); 
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->SMTPDebug = 2; 
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;// TCP port to connect to
$mail->CharSet = 'UTF-8';
$mail->Username ='idhappmaster@gmail.com'; //Email para enviar
$mail->Password = 'adminIdh1572'; //Su password
//Agregar destinatario
$mail->setFrom('idhappmaster@gmail.com', 'Admin');
$mail->AddAddress("$email");//A quien mandar email
$mail->SMTPKeepAlive = true;  
$mail->Mailer = "smtp"; 


    //Content
$mail->isHTML(true); // Set email format to HTML


$mail->Subject = 'Has sido dado de baja';
$mail->Body    = 'Has sido dado de baja de la aplicacion de planes y proyectos del IES Delgado Hernández';

if(!$mail->send()) {
  echo 'Error al enviar email';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Mail enviado correctamente';
}
    //fin correo
   header('Location: cpaneladmin.php?rm=1&rt=3&a=3');
    exit();
}
ob_end_flush();