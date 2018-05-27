<?php
ob_start();
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
    if(!isset($_POST['id_proy'])){
        header('Location: cpaneladmin.php?rm=3&rt=3a=3');
        exit();
    }
if($_POST['id_proy']!=-1){
    include('_include/conexion.php');
    include('_include/funciones.php');
    $pid=$_POST['id_proy'];
    /*hacemos el update del campo mostrar poniendolo a 0*/
    $UPDATE = consulta($conexion,"UPDATE proyectos SET 
                                                    mostrar ='0'
                                                    WHERE id_proyecto like $pid");
    //enviamos el correo
require_once('_include/PHPMailerAutoload.php'); 
        //Buscamos los integrantes de este proyecto para enviarle un correo
    $int= consulta($conexion, "SELECT * FROM usuarios where id_user in (SELECT id_user FROM usuproy where id_proyecto like $pid)");
    //rescatamos el nombre del proyecto
    $proye=consulta($conexion,"SELECT * FROM proyectos where id_proyecto like $pid");
    $filaPro=mysqli_fetch_array($proye);
    $nombre=$filaPro['nombre_pro'];
while($filaInt=mysqli_fetch_array($int)){
        $intNom=$filaInt['nombre'];
        $intEmail=$filaInt['email'];

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
                $mail->Username ="$cuenta"; //Email para enviar
                $mail->Password = "$passEmail"; //Su password
                //Agregar destinatario
                $mail->setFrom("$cuenta", 'Admin');
                $mail->AddAddress("$intEmail");//A quien mandar email
                $mail->SMTPKeepAlive = true;  
                $mail->Mailer = "smtp"; 


                    //Content
                $mail->isHTML(true); // Set email format to HTML


                $mail->Subject = 'El proyecto puede editarse de nuevo';
                $mail->Body    = "<h1>¡Hola $intNom!</h1>
                <p>El proyecto $nombre, en el que participa, en la app de planes y proyectos del IES Delgado Hernández ha sido despublicado, por lo que puede volver a ser editado</p>
                <p>Puede Acceder a la App desde el siguiente enlace:</p>
                                        <p>$enlaceEmail</p>";

                if(!$mail->send()) {
                  echo 'Error al enviar email';
                  echo 'Mailer error: ' . $mail->ErrorInfo;
                } else {
                  echo 'Mail enviado correctamente';
                }
}
    //fin de enviar correo
    $_SESSION['msgproydel']=DESPUB;
    header('Location: cpaneladmin.php?rm=3&rt=3a=3');
    mysqli_close($conexion);
    exit(); 
}else{
    $_SESSION['msgproydel']=DEBCHO;
    header('Location: cpaneladmin.php?rm=3&rt=3a=3');
    mysqli_close($conexion);
    exit(); 
}
ob_end_flush();