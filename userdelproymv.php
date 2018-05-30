<?php 
ob_start();
    include('_include/variables.php');
    include('_include/funciones.php');
    include('_include/conexion.php');
    session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
    mysqli_close($conexion);
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
/*primero comprobamos que exista */
if(!isset($_POST['id_user']) && !isset($_SESSION['userdelproy'])){
   header('Location: index.php');
    exit();
}
if(isset($_POST['id_user'])){
    unset($_SESSION['userdelproy']);
}
if(isset($_SESSION['userdelproy'])){
    /*ssi existe lo mandamos a la propia pagina para que seleccione al menos una imagen*/
        $_SESSION['msguserdelproy']=DEBUSU;
        $proy=$_SESSION['iduserdelproy'];
        header("Location: cpanelprofe.php?rm=1&rt=3&a=3&udp=$proy");
        mysqli_close($conexion);
        exit();
}
$proy=$_SESSION['iduserdelproy'];
if(count($_POST['id_user']) > 0){
                $use=$_POST['id_user'];
                foreach($use as $i){
                        $delete = consulta($conexion,"DELETE FROM usuproy WHERE id_proyecto like $proy and id_user like $i");
                                        //correo
                    $email=consulta($conexion,"SELECT * FROM usuarios where id_user like $i");
                    $usFila=mysqli_fetch_array($email);
                    $nomUser=$usFila['nombre'];
                    $emailUser=$usFila['email'];
                    $proyecto=consulta($conexion,"SELECT * FROM proyectos where id_proyecto like $proy");
                    $prFila=mysqli_fetch_array($proyecto);
                    $nomPro=$prFila['nombre_pro'];
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
                    $mail->Username ="$cuenta"; //Email para enviar
                    $mail->Password = "$passEmail"; //Su password
                    //Agregar destinatario
                    $mail->setFrom("$cuenta", 'Admin');
                    $mail->AddAddress("$emailUser");//A quien mandar email
                    $mail->SMTPKeepAlive = true;  
                    $mail->Mailer = "smtp"; 


                        //Content
                    $mail->isHTML(true); // Set email format to HTML


                    $mail->Subject = 'Ha sido relevado';
                    $mail->Body    = "<h1>¡Hola $nomUser!</h1> 
                                    <p>Ha sido relevado de su puesto como editor del proyecto $nomPro en la APP de planes y proyectos del IES Delgado Hernández.</p>
                                    <p>Puede Acceder a la App desde el siguiente enlace:</p>
                                        <p>$enlaceEmail</p>";

                    if(!$mail->send()) {
                      echo 'Error al enviar email';
                      echo 'Mailer error: ' . $mail->ErrorInfo;
                    } else {
                      echo 'Mail enviado correctamente';
                    }
                }
        //fin mandar correo
    $_SESSION['msguserdelproy']=USUDELPROYOK;
        header("Location: cpanelprofe.php?rm=1&rt=3&a=3&udp=$proy");
        mysqli_close($conexion);
        exit();
    }
ob_end_flush();